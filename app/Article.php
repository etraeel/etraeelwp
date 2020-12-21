<?php

namespace App;

use App\Http\Controllers\Article\ArticleController;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $fillable = [
        'title','text', 'writer', 'password','key_words','reading_time','image','description',
    ];

//    public $timestamps = false;

    public function likes(){
        return $this->hasMany(ArticleLike::class);
    }
}
