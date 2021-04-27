<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;

class AuthenticateUser extends Middleware {

  //если юзер не залогинен, то редирект сюда
  protected function redirectTo($request) {
    if (!$request->expectsJson()) {
      return route('frontend.signin.create');
    }
  }
}
