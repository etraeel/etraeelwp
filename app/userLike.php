<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class userLike extends Model
{
  protected $fillable = ['like_or_dislike' , 'user_ip' , 'comment_id'];
}
