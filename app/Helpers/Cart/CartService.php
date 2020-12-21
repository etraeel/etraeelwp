<?php


namespace App\Helpers\Cart;


use App\Price;
use Highlight\Mode;
use Illuminate\Database\Eloquent\Model;
use Psy\Util\Str;
use function GuzzleHttp\Psr7\str;

class CartService
{

    protected $cart;

    public function __construct()
    {
       $this->cart = session()->get('cart') ?? collect([]);
     }

    public function put(array $value , $obj = null)
    {
        if(! is_null($obj) && $obj instanceof Model){
            $value = array_merge($value , [
                'id' => \Illuminate\Support\Str::random(10),
                'subject_id' => $obj->id,
                'subject_type' => get_class($obj)
            ]);
        }
        elseif(! isset($value['id'])){
            $value = array_merge($value , [
                'id' => \Illuminate\Support\Str::random(10),
            ]);
        }
        $this->cart->put($value['id'] , $value);
        session()->put('cart' , $this->cart);

        return $this;
     }

    public function has($key)
    {
        if($key instanceof Model){
            return ! is_null($this->cart->Where('subject_id' , $key->id)->where('subject_type' , get_class($key))->first());
        }
        return ! is_null($this->cart->firstWhere('id' , $key));

     }

    public function get($key , $withRelationship = true)
    {
        $item = $key instanceof Model ?
            $this->cart->Where('subject_id' , $key->id)->where('subject_type' , get_class($key))->first()
            : $this->cart->firstWhere('id' , $key);
       return $withRelationship ? $this->withRelationshipIfExist($item) :  $item;

    }

    public function all()
    {
        $cart = $this->cart;
       $cart =  $cart->map(function ($item){
           return $this->withRelationshipIfExist($item);
        });

        return $cart;
    }

    public function update($key , $option , $type)
    {
        $item = collect($this->get($key , false));
        if($type == 'quantity'){
            if(is_numeric($option)){
                $item =  $item->merge([
                    'quantity' => $option,
                ]);
            }
        }
        if($type == 'price'){
            if(is_numeric($option)){
                $item =  $item->merge([
                    'subject_id' => $option,
                    'quantity' => 1,
                ]);
            }
        }

        $this->put($item->toArray());
        return $this;

    }

    public function delete($id)
    {
//        $item = collect($this->get($id , false));
        $this->cart->forget($id);
        session()->put('cart' , $this->cart);

    }

    private function withRelationshipIfExist($item)
    {
        if( isset($item['subject_id'])  && isset($item['subject_type']) ){
            $class = $item['subject_type'];
            $subject = (new $class)->find($item['subject_id']);
            $item[strtolower(class_basename($class))] = $subject;

            unset($item['subject_type']);
            unset($item['subject_id']);

            return $item;
        }
    }

    public function flush()
    {
        $this->cart = collect([]);
        session()->forget('cart');
    }

}
