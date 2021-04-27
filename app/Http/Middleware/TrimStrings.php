<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\TrimStrings as Middleware;

class TrimStrings extends Middleware {

  //имена аттрибутов которые не должны обрабатываться функцией trim()
  protected $except = [
    'password',
    'password_confirmation',
  ];
}
