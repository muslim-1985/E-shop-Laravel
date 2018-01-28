<?php

namespace App\Http\Controllers;

use App\AdminModels\Message;
use App\Events\NewMessageAdded;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;
use PhpParser\Node\Name;

class ChatController extends Controller
{
    public function Index()
    {
        $messages = Message::all();

        return view('chat.chat', compact('messages'));
    }
    public function Store(Request $request)
    {
        $message = Message::create($request->all());
        //инициализируем событие Events/NewMessageAdded и передаем ему в качесвте аргумента конструктора
        // объект $message
        event(new NewMessageAdded($message));
        return redirect()->back();
    }
}
