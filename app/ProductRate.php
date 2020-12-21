<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductRate extends Model
{
    protected $fillable = ['rate' , 'user_ip' , 'product_id'];
}
