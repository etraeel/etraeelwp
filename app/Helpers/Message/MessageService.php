<?php


namespace App\Helpers\Message;


use App\AdminMessage;
use App\User;
use App\UserMessage;
use Highlight\Mode;
use Illuminate\Database\Eloquent\Model;

class MessageService
{


    public function __construct()
    {

    }

    public function send($sender, $receiver, $title, $text , $status = 0)
    {
        if (is_array($receiver)) {
            if (in_array('ALL', $receiver)) {
                $newMessage = AdminMessage::create([
                    'user_id' => $sender,
                    'sender' => $sender,
                    'title' => $title,
                    'text' => $text,
                ]);
            } else {
                foreach ($receiver as $rec) {
                    $newMessage = UserMessage::create([
                        'user_id' => $rec,
                        'sender' => $sender,
                        'title' => $title,
                        'text' => $text,
                    ]);
                }
            }

        }
        if (is_numeric($receiver)) {

            $newMessage = UserMessage::create([
                'user_id' => $receiver,
                'sender' => $sender,
                'title' => $title,
                'text' => $text,
                'status'=> $status
            ]);

        }

    }

    public function userMessages($user_id)
    {
        $userMessages = UserMessage::where('user_id', $user_id)->get();
        $adminMessages = AdminMessage::all();
        $allMessages = $userMessages->merge($adminMessages);
        $allMessages = $allMessages->sortByDesc('created_at');
        return $allMessages;

    }

    public function get($id, $option = true)
    {

        if ($option == true) {
            $message = UserMessage::where('id', $id)->first();
            $message->update([
                'status' => 1
            ]);
        } else {
            $message = AdminMessage::where('id', $id)->first();
        }
        return $message;

    }

}
