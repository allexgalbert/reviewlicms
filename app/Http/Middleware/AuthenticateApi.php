<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;

class AuthenticateApi extends Middleware {

  //если по api не передали токен, то редирект сюда
  protected function redirectTo($request) {

    //регать юзера так
    //GET http://reviewli.loc/ru/api/user/create/a1@exa2mpl1e.net
    //Authorization: Bearer dqtUODlWhl

    if (!$request->expectsJson()) {
      return route('frontend.signin.create');
    }

  }
}
