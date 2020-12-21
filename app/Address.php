<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $fillable = ['user_id' , 'province_id' , 'city_id' , 'description' ,'postal_code' ,'home_number' , 'default_address'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function city()
    {
        return $this->belongsTo(City::class );
    }

    public function province()
    {
        return $this->belongsTo(Province::class);
    }
}
