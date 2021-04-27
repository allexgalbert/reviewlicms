<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LogoutController extends Controller {

  public function logout(Request $request) {
    Auth::guard('users')->logout();
    $request->session()->regenerateToken();
    return redirect()->route('frontend.signin.create');
  }


}
