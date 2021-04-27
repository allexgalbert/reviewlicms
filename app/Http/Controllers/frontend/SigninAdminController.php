<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Session;

class SigninAdminController extends Controller {

  //вывод формы создания ресурса
  public function create(Request $request) {
    return view('frontend.signinadmin');
  }

  //сабмит формы создания ресурса
  public function store(Request $request) {

    $request->validate([
      'email' => 'required',
      'password' => 'required',
    ]);

    $credentials = $request->only('email', 'password', 'ban');

    if (Auth::guard('admins')->attempt($credentials)) {

      if (Auth::guard('admins')->user()->ban == 1) {
        return redirect()->route('frontend.signinadmin.create')->with('success', 'вы забанены');
      }

      $request->session()->regenerate();
      return redirect()->route('backend.home');

    } else {
      return redirect()->route('frontend.signinadmin.create')->with('success', 'неправильная почта или пароль');
    }

  }

}
