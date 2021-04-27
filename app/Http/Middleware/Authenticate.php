<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware {

  //заглушка
  protected function redirectTo($request) {
    if (!$request->expectsJson()) {

      //поставили временно этот вариант. если юзер не залогинен, то редирект сюда
      return route('frontend.signin.create');
    }
  }
}
