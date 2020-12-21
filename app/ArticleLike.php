<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ArticleLike extends Model
{
    protected $fillable = [
        'ip','article_id',
    ];
    public $timestamps = false;


}
