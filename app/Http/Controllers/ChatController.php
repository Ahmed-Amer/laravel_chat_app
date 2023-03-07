<?php

namespace App\Http\Controllers;

use App\Models\ChatRoom;
use App\Events\MessageSent;
use App\Models\ChatMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    public function rooms(Request $request){
        return ChatRoom::all();
    }

    public function messages(Request $request, $roomId){
        return ChatMessage::where('chat_room_id' , $roomId)
            ->with('user')
            ->orderBy('created_at' , 'DESC')
            ->get();
    }

    public function newMessage(Request $request , $roomId){
       // $user = Auth::user();
        $msg = new ChatMessage;
        $msg->chat_room_id = $roomId;
        $msg->user_id = auth()->id();
        $msg->message = $request->message;
        $msg->save();

        broadcast(new MessageSent($msg))->toOthers();

        return $msg;

    }
}
