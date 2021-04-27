<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;

class AuthenticateAdmin extends Middleware {

  //если админ не залогинен, то редирект сюда
  protected function redirectTo($request) {
    if (!$request->expectsJson()) {
      return route('frontend.signinadmin.create');
    }
  }
}
