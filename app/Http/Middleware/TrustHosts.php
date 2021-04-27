<?php

namespace App\Http\Middleware;

use Illuminate\Http\Middleware\TrustHosts as Middleware;

class TrustHosts extends Middleware {

  //паттерны хостов которым можно доверять
  public function hosts() {
    return [
      $this->allSubdomainsOfApplicationUrl(),
    ];
  }
}
