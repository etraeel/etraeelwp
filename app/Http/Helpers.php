<?php

use Illuminate\Support\Facades\Route;

if (!function_exists('is_active')) {
    function is_active($key, $activeclassname = 'active')
    {
        if (is_array($key)) {
            return in_array(Route::currentRouteName(), $key) ? $activeclassname : '';
        }
        return Route::currentRouteName() == $key ? $activeclassname : '';
    }
}

if (!function_exists('attributeAnalysis')) {
    function attributeAnalysis($id, $model = \App\Product::class)
    {
        $product = $model::find($id);

        $attributes = collect([]);

        foreach ($product->attributes as $attr) {
            if (!$attributes->has($attr->name)) {
                $attributes->put($attr->name, []);
            }
        }

        foreach ($attributes->keys() as $attribute) {

            for ($i = 0; $i < count($product->attributes); $i++) {
                if ($product->attributes[$i]->name == $attribute) {
                    $index = $i;
                    $attributes[$attribute] = array_merge($attributes[$attribute], [$product->attributes[$index]->pivot->value->value]);
                }
            }
        }

        return $attributes;
    }
}
if(! function_exists('isUrl') ) {

    function isUrl($url , $activeClassName = 'active') {
        return \request()->fullUrlIs($url) ? $activeClassName : '';
    }

    }
