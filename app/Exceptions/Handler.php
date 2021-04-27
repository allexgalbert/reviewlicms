<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;

class Handler extends ExceptionHandler {

  //типы исключений без лога
  protected $dontReport = [];

  //данные которые не участвуют в логе
  protected $dontFlash = [
    'password',
    'password_confirmation',
  ];

  //регистрация колбеков для исключений
  public function register() {
    $this->reportable(function (Throwable $e) {
    });
  }
}
