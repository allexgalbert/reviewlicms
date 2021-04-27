<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Session;

class SigninController extends Controller {

  //вывод формы создания ресурса
  public function create(Request $request) {
    return view('frontend.signin');
  }

  //сабмит формы создания ресурса
  public function store(Request $request) {

    $request->validate([
      'email' => 'required',
      'password' => 'required',
    ]);

    $credentials = $request->only('email', 'password');

    if (Auth::guard('users')->attempt($credentials, $request->has('remember_token'))) {

      if (Auth::guard('users')->user()->ban == 1) {
        return redirect()->route('frontend.signin.create')->with('success', 'вы забанены');
      }

      $request->session()->regenerate();
      return redirect()->route('user.profile.index');

    } else {
      return redirect()->route('frontend.signin.create')->with('success', 'неправильная почта или пароль');
    }

  }
}
