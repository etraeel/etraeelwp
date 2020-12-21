<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductGallery extends Model
{
    protected $fillable = ['image' , 'alt'];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
