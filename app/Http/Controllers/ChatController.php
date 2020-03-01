<?php

namespace App\Http\Controllers;

use App\Events\GreetingSent;
use App\Events\MessageSent;
use App\User;
use Illuminate\Http\Request;

class ChatController extends Controller
{


    /**
     * ChatController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function showChat()
    {
        return view('chat.show');
    }

    public function messageReceived(Request $request)
    {
        $rules = [
            'message' => 'required',
        ];

        $request->validate($rules);

        broadcast(new MessageSent($request->user(), $request->message));

        return response()->json('Message broadcasted');
    }

    public function greetReceived(Request $request, User $user)
    {
        $recipient_message = "{$request->user()->name} greeted you";
        $sender_message = "You greeted {$user->name}";

        broadcast(new GreetingSent($user, $recipient_message));
        broadcast(new GreetingSent($request->user(), $sender_message));

        return "Greeting {$user->name} from {$request->user->name}";
    }
}
