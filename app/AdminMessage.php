<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AdminMessage extends Model
{
   protected $fillable = ['user_id' , 'title' , 'text' , 'sender'];

    public function user()
    {
        return $this->belongsTo(User::class);
   }

    public function sender()
    {
        return $this->belongsTo(User::class , 'sender');
    }
}
