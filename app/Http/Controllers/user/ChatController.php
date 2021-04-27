<?php

namespace App\Http\Controllers\user;

use App\Events\ChatEvent;
use App\Events\UnreadMessagesToAdminEvent;
use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Message;
use Illuminate\Support\Facades\Auth;

use App\Http\Requests\backend\MessageRequest;
use Illuminate\Support\Facades\Validator;

class ChatController extends Controller {

  //показать чат
  public function index() {

    //текущий юзер
    $user = Auth::guard('users')->user();

    //очистить счетчик юзера
    $user->unreadmessages_touser = 0;
    $user->save();

    //сообщения
    $messages = Message::query()->where('user_id', $user->id)->oldest()->get();

    return view('user.chat', [
      'messagesList' => view('backend.messages.message', ['messages' => $messages])->render(),
      'messages' => $messages,
      'user' => $user,
    ]);
  }

  //создать сообщение
  public function update($locale, MessageRequest $request) {

    //dd(
    //  $request->getMessage()
    //);
    //Response::json([  'errors'=> [ ['message' => $request->getMessage()] ]


    //текущий юзер
    $user = Auth::guard('users')->user();

    //дефолтовый админ
    $admin = Admin::query()->find(1);
    //-------------------------------------------------

    //вставляем сообщение
    $request->merge([
      'user_id' => $user->id,
      'admin_id' => $admin->id,
      'direction' => 1,
    ]);
    $message = Message::create($request->all());

    //добавить в счетчик админу
    $user->increment('unreadmessages_toadmin');
    //-------------------------------------------------

    //оборачиваем сообщение во вьюху
    $message1 = view('backend.messages.message', ['messages' => [$message]])->render();

    //событие типа вещание. сообщение в чат админу
    broadcast(new ChatEvent($user, $message1))->toOthers();
    //-------------------------------------------------

    //оборачиваем сообщение во вьюху тоаст
    $message2 = view('backend.global.toast', ['messages' => [$message]])->render();

    //событие типа вещание. сообщение в тоаст в админку
    broadcast(new UnreadMessagesToAdminEvent($user, $message2))->toOthers();
    //-------------------------------------------------

    return $message1;

    return redirect()->route('user.chat.index')->with('success', 'сообщение добавлено');
  }

}
