<?php

namespace App\Http\Controllers;

use App\Address;
use App\City;
use App\Helpers\Message\Message;
use App\Notifications\channels\ghasedakChannel;
use App\Notifications\smsNotification;
use App\Order;
use App\User;
use App\UserMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class ProfileController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        return view('profile.layouts.index' , compact('user'));
    }

    public function edit()
    {
        $user = Auth::user();
        return view('profile.layouts.editProfile' ,compact('user'));
    }
    public function editUser(Request $request)
    {

        $this->validate($request, [
            'logo_img' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:1024',
            'name' => 'required',
            'mobile' => 'required',
        ]);

        if ($request->hasFile('logo_img')) {

            $image = $request->file('logo_img');
            $name = time().'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('/images/avatars/');
            $image->move($destinationPath, $name);


            $oldImage = Auth::user()->pic_logo;
            if($oldImage != null){
                $oldImageUrl = public_path($oldImage);
                unlink($oldImageUrl);
            }

            Auth::user()->update([
                'pic_logo'=>'/images/avatars/'.$name,
                'name' => $request->name,
                'mobile' => $request->mobile,
            ]);

            alert()->success('اطلاعات شما با موفقیت ویرایش شد ');
            return back();
        }
    }

    public function messages()
    {

        $messages = Message::userMessages(Auth::user()->id);
        return view('profile.layouts.messages' ,compact('messages'));
    }

    public function showMessage(Request $request)
    {
        $message = Message::get($request->id , $request->option);
        return view('profile.layouts.showMessage' ,compact('message'));
    }

    public function sendMessage()
    {
        return view('profile.layouts.sendMessage');
    }

    public function sendMessageToAdmin(Request $request)
    {
       $data =  $request->validate([
           'title' => 'required',
           'text' => 'required'
       ]);
        $sender = Auth::user()->id;
        $receiver = User::where('type' , 'admin')->first();
        Message::send($sender , $receiver->id, $request->title ,$request->text , 3);

        alert()->success('پیام با موفقیت ارسال شد ');
        return redirect(route('profile.messages'));
    }

    public function addresses()
    {
        $addresses = Auth::user()->addresses;
        return view('profile.layouts.addresses' ,compact('addresses'));
    }
    public function getCities()
    {
        return City::all();
    }
    public function addAddress(Request $request)
    {
       $data = $request->validate([

           'province_id' => ['required'],
           'city_id' => ['required'],
           'description' => ['required', 'string'],
           'postal_code' => ['required'],
           'home_number' => ['required'],

       ]);


       $data['user_id'] = Auth::user()->id;

       if(count(Auth::user()->addresses) == 0){
           $data['default_address'] = 1;
       }else{
           $data['default_address'] = 0;
       }
       $product = Address::create($data);

       alert()->success('آدرس با موفقیت ثبت شد ');
       return redirect()->back();
    }
    public function setDefaultAddress(Request $request)
    {

         $addresses = Address::where('user_id' , Auth::user()->id)->update([
             'default_address' => 0
         ]);
        $addresses = Address::where('id' , $request->id)->update([
            'default_address' => 1
        ]);

    }
    public function deleteAddress($id)
    {
        $address = Address::where('id' , $id)->first();
        if($address->id == 0){
           $address->delete();
        }else{
            $address->delete();
            Address::where('user_id' , Auth::user()->id)->first()->update([
                'default_address' => 1
            ]);
        }
        alert()->success('آدرس مورد نظر با موفقیت حذف شد ');
        return redirect()->back();


    }

    public function orders()
    {
        $orders = Order::where( 'user_id',Auth::user()->id)->get();
        return view('profile.layouts.orders' ,compact('orders'));
    }

}
