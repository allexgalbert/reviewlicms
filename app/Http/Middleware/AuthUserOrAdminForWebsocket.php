<?php

//мидлваре для определения кто залогинен. юзер или админ
//в массив докидываем признак
//возвращаем как юзера

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthUserOrAdminForWebsocket {

  public function handle(Request $request, Closure $next) {

    $user = null;

    if ($user = Auth::guard('users')->user()) {
      //юзер залогинен
      $request->merge(['user' => $user, 'account' => 'user']);
    } elseif ($user = Auth::guard('admins')->user()) {
      //админ залогинен
      $request->merge(['user' => $user, 'account' => 'admin']);
    }

    if ($user) {
      $request->setUserResolver(function () use ($user) {
        return $user;
      });
    }

    return $next($request);
  }
}
