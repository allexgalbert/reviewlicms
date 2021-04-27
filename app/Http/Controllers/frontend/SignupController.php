<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Jobs\NameJob;
use App\Mail\SignupUser;
use App\Models\User;
use App\Notifications\NotificationMail;
use App\Notifications\NotificationDatabase;
use App\Notifications\NotificationBroadcast;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;


class SignupController extends Controller {

  //вывод формы создания ресурса
  public function create() {

    //задача в очередь
    //$user = User::find(5);
    //JobName1::dispatch($user, $message = 'tratata');
    //-------------------------------------------------

    return view('frontend.signup');
  }

  //сабмит формы создания ресурса
  public function store(Request $request) {

    //валидация
    $request->validate([
      'email' => 'required|email|unique:users',
    ]);

    //пароль
    $password = 123;
    $request->merge(['password' => Hash::make($password)]);

    //создать юзера
    $credentials = $request->only('email', 'password');
    $user = User::create($credentials);

    //на почту
    Mail::to($user->email)
      ->send(new SignupUser($user, $password));

    //на почту в очередь
    //Mail::to($user->email)
    //  ->queue(new SignupUser($user, $password));

    return redirect()->route('frontend.signup.create')
      ->with('success', 'юзер создан. логин ' . $request->email . ' пароль ' . $password);

  }
}
