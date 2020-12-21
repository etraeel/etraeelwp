<?php

namespace App\Http\Controllers\Admin;

use App\Attribute;
use App\AttributeValue;
use App\Http\Controllers\Controller;
use App\Price;
use App\Product;
use Illuminate\Http\Request;
use phpDocumentor\Reflection\Types\Collection;

class PriceController extends Controller
{
    public function index()
    {
        $products = Product::paginate(15);
        return view('admin.price.all', compact('products'));
    }

    public function singlePriceEdit(Product $product)
    {
        return view('admin.price.singleprice', compact('product'));
    }

    public function singlePriceUpdate(Request $request, Product $product)
    {

        if($product->price == null){


            $data = $request->validate([
                'inventory' => 'required',
                'price' => 'required',
                'off_price' => 'required',

            ]);


            $price = new Price([
                'product_id' => $product->id,
                'inventory' => $data['inventory'],
                'price' => $data['price'],
                'off_price' => $data['off_price'],
                'status' => 1,
            ]);
            $price->save();
//            Price::create([
//                'product_id' => $product->id,
//                'inventory' => $data['inventory'],
//                'price' => $data['price'],
//                'off_price' => $data['off_price'],
//                'status' => 1,
//            ]);

        } else{
            $data = $request->validate([
                'inventory' => 'required',
                'price' => 'required',
                'off_price' => 'required',

            ]);

            Price::find($product->price->id)->forcFill([

                'inventory' => $request->inventory,
                'price' => $request->price,
                'off_price' => $request->off_price,

            ])->save();
        }
                alert()->success('ویرایش با موفقیت انجام شد ');
                return redirect()->back();

            }



    public function multiPriceEdit(Product $product)
    {

        return view('admin.price.multiprice', compact('product'));
    }

    public function multiPriceUpdate(Request $request, Product $product)
    {


        $data = $request->validate([

            'attribute' => 'required',
            'prices_item' => 'required',
            'prices_item.*.id' => ['required'],
            'prices_item.*.value' => ['required', 'max:255'],
            'prices_item.*.inventory' => ['required', 'max:255'],
            'prices_item.*.price' => ['required', 'max:255'],
            'prices_item.*.off_price' => ['required', 'max:255'],

        ]);


        foreach ($data['prices_item'] as $item) {
            $this->firstOrCreateAttributeAndValue($data['attribute'], $item['value']);
        }


        $productPrices = $product->prices()->pluck('id');

        foreach ($data['prices_item'] as $item) {

            if ($productPrices->contains($item['id'])) {
                Price::find($item['id'])->update([
                    'attribute' => Attribute::where('name', $data['attribute'])->first()->id,
                    'value' => AttributeValue::where('value', $item['value'])->first()->id,
                    'price' => $item['price'],
                    'off_price' => $item['off_price'],
                    'inventory' => $item['inventory'],
                    'status' => isset($item['status']) && $item['status'] == 1 ? 1 : 0,
                ]);
                foreach ($productPrices as $key => $value){
                    if ($value == $item['id']) {
                        unset($productPrices[$key]);
                    }
                }
            } else {
            Price::create([
                'product_id' => $product->id,
                'attribute' => Attribute::where('name', $data['attribute'])->first()->id,
                'value' => AttributeValue::where('value', $item['value'])->first()->id,
                'price' => $item['price'],
                'off_price' => $item['price'],
                'inventory' => $item['inventory'],
                'status' => isset($item['status']) && $item['status'] == 1 ? 1 : 0,
            ]);
        }

        }

        if ($productPrices->count()) {
            foreach ($productPrices as $key => $value) {
                Price::find($value)->delete();
            }
        }

        $statusOfStatus = 0;
        foreach ($product->prices() as $price){
            if($price->status == 1){
                $statusOfStatus ++;
                break;
            }
        }
        if($statusOfStatus == 0){
            $product->prices()->first()->forceFill([
                'status' => 1
            ])->save();
        }

        return redirect(route('admin.price.all'));
    }

    protected function firstOrCreateAttributeAndValue($attribute, $value)
    {
        $attr = Attribute::firstOrCreate(
            ['name' => $attribute]
        );

        $attr_value = $attr->values()->firstOrCreate(
            ['value' => $value]
        );
    }

}
