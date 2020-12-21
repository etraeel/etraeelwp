<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class AdminController extends Controller
{
    public function index()
    {

        $ghasedakCredit =  $this->getCredit();
        return view('admin.index' , compact('ghasedakCredit'));
    }

    public function getCredit()
    {

        $send_sms = Http::withHeaders([
            "apikey" => env('GHASEDAK_APP_KEY'),
        ])->asForm()->post("http://api.ghasedaksms.com/v2/credit" );

        return $send_sms->json()['credit'];
    }
}
