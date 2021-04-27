<?php

//мой контракт

namespace App\Contracts;

use App\Models\User;
use Illuminate\Http\Request;

interface MyContract {

  public static function save(Request $request, User $user);

  public function checkData($array);
}





