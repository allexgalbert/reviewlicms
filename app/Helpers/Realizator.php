<?php

//класс реализатор, контракта MyContract
//по факту хелпер

namespace App\Helpers;

use App\Contracts\MyContract;
use App\Models\User;
use Illuminate\Http\Request;

class Realizator implements MyContract {

  public static function save(Request $request, User $user) {
    $obj = new self();
    $data = $obj->checkData($request->all());
  }

  public function checkData($array) {
    return $array;
  }
}
