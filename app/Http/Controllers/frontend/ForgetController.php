<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ForgetController extends Controller {

  //вывод формы создания ресурса
  public function create() {
    return view('frontend.forget');
  }

  //сабмит формы создания ресурса
  public function store(Request $request, User $user) {

    $request->validate([
      'email' => 'required|email',
    ]);
    //dd($user->email);

    $password = 1234;

    $request->merge(['password' => Hash::make($password)]);
    $credentials = $request->only('email', 'password');

    $user->update($request->all());

    User::create($credentials);

    return redirect()->route('frontend.signup.create')
      ->with('success', 'юзер создан. логин ' . $request->email . ' пароль ' . $password);

  }


}
