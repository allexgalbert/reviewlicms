<?php

namespace App\Http\Controllers\backend;

use App\Events\ChatEvent;
use App\Events\UnreadMessagesToUserEvent;
use App\Http\Controllers\Controller;
use App\Http\Requests\backend\MessageRequest;
use App\Models\Message;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller {

  //показать чат
  public function index($locale, User $user) {

    //очистить счетчик админа
    $user->unreadmessages_toadmin = 0;
    $user->save();

    //сообщения
    $messages = Message::query()->where('user_id', $user->id)->oldest()->get();

    return view('backend.messages.index', [
      'messagesList' => view('backend.messages.message', ['messages' => $messages])->render(),
      'messages' => $messages,
      'user' => $user,
    ]);
  }

  //создать сообщение
  public function update($locale, MessageRequest $request, User $user) {

    //текущий админ
    $admin = Auth::guard('admins')->user();
    //-------------------------------------------------

    //вставляем сообщение
    $request->merge([
      'user_id' => $user->id,
      'admin_id' => $admin->id,
      'direction' => -1,
    ]);
    $message = Message::create($request->all());

    //добавить в счетчик юзеру
    $user->increment('unreadmessages_touser');
    //-------------------------------------------------

    //оборачиваем сообщение во вьюху
    $message1 = view('backend.messages.message', ['messages' => [$message]])->render();

    //событие типа вещание. сообщение в чат юзеру
    broadcast(new ChatEvent($user, $message1))->toOthers();
    //-------------------------------------------------

    //оборачиваем сообщение во вьюху тоаст
    $message2 = view('frontend.global.toast', ['messages' => [$message]])->render();

    //событие типа вещание. сообщение в тоаст в юзерку
    broadcast(new UnreadMessagesToUserEvent($user, $message2))->toOthers();
    //-------------------------------------------------

    return $message1;

    return redirect()->route('backend.messages.index', $user)->with('success', 'сообщение добавлено');
  }
}
