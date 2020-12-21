<?php


namespace App\Helpers\Message;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Facade;
use phpDocumentor\Reflection\DocBlock\StandardTagFactory;
use phpDocumentor\Reflection\Types\Static_;



class Message extends Facade
{

    protected static function getFacadeAccessor()
    {
       return 'message';
    }
}
