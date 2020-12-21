<?php


namespace App\Helpers\Cart;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Facade;
use phpDocumentor\Reflection\DocBlock\StandardTagFactory;
use phpDocumentor\Reflection\Types\Static_;


/**
 * @return string
 * @method Static bool has($key);
 * @method static array get($key);
 * @method static Collection all();
 * @method static Message put(array $value ,Model $obj  = null)
 */
class Cart extends Facade
{

    protected static function getFacadeAccessor()
    {
       return 'cart';
    }
}
