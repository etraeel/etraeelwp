<?php

namespace App\Http\Controllers\Admin;

use App\AdminMessage;
use App\Helpers\Message\Message;
use App\Http\Controllers\Controller;
use App\UserMessage;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $messages = AdminMessage::orderBy('created_at', 'desc')->paginate(10);
       return view('admin.message.all' , compact('messages'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.message.create');
    }


    public function store(Request $request)
    {

        $data = $request->validate([
            'title' => ['required', 'string'],
            'text' => ['required', 'string'],
            'receivers' => ['required'],

        ]);

         Message::send($request->sender , $request->receivers , $request->title ,$request->text);

        alert()->success('پیام با موفقیت ارسال شد ');
        return redirect(route('admin.message.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $message = AdminMessage::where( 'id',$id)->first();
        return view('admin.message.edit' ,compact('message'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $message = AdminMessage::where('id' , $id)->first();
        $data = $request->validate([
            'title' => ['required'],
            'text' => ['required']
        ]);

        $message->update($data);

        alert()->success('پیام با موفقیت ویرایش شد ');
        return redirect(route('admin.message.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $message =  AdminMessage::find($id);
        $message->delete();
        alert()->success('پیام با موفقیت حذف شد ');
        return redirect(route('admin.message.index'));
    }
}
