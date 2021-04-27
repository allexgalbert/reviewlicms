<?php

//создание юзера через API
//http://reviewli.loc/ru/api/user/create/low1ell91@exa2mpl1e.net

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller {

  //создать юзера
  public function create($locale, $email, Request $request) {

    //массив пустой. поэтому добавим мыло
    $request->merge([
      'email' => $email,
    ]);

    //валидация
    $validator = Validator::make($request->all(), [
      'email' => 'required|email|unique:users',
    ]);

    if ($validator->fails()) {
      return [
        'status' => false,
        'error' => $validator->errors()->toJson()
      ];

      //{"status":false,"error":"{\"email\":[\"\\u0422\\u0430\\u043a\\u043e\\u0435 \\u0437\\u043d\\u0430\\u0447\\u0435\\u043d\\u0438\\u0435 \\u043f\\u043e\\u043b\\u044f E-Mail \\u0430\\u0434\\u0440\\u0435\\u0441 \\u0443\\u0436\\u0435 \\u0441\\u0443\\u0449\\u0435\\u0441\\u0442\\u0432\\u0443\\u0435\\u0442.\"]}"}
    }

    //пароль
    $password = 123;
    $request->merge(['password' => Hash::make($password)]);

    //создать юзера
    $credentials = $request->only('email', 'password');
    $user = User::create($credentials);

    $result = new UserResource($user);

    return [
      'status' => true,
      'user' => $result->toJson(),
      'password' => $password,
    ];

    //{"status":true,"user":"{\"email\":\"runoldfsdd1son.lelah@example.org\",\"updated_at\":\"2021-02-21T11:11:15.000000Z\",\"created_at\":\"2021-02-21T11:11:15.000000Z\",\"id\":24}","password":123}
  }
}
