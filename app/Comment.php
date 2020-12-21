<?php

namespace App;

use http\Env\Request;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = ['comment', 'parent' , 'commentable_id' ,'commentable_type'];

    public function commentable()
    {
        return $this->morphTo();
    }

    public function child()
    {
        return $this->hasMany(Comment::class, 'parent', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }


}
