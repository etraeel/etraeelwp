<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Price extends Model
{
    protected $fillable = ['price' , 'off_price', 'inventory' , 'attribute' , 'value' ,  'product_id' , 'status' ];

    public function product()
    {
        return $this->belongsTo(Product::class);
 }
}
