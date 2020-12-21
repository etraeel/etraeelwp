<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
   protected $fillable = [
       'resnumber' , 'status'
   ];

    public function order()
    {
       return $this->belongsTo(Order::class);
   }
}
