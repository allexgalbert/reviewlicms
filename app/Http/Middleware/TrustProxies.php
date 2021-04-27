<?php

namespace App\Http\Middleware;

use Fideloper\Proxy\TrustProxies as Middleware;
use Illuminate\Http\Request;

class TrustProxies extends Middleware {

  //доверенные прокси
  protected $proxies;

  //использовать эти заголовки для определения прокси
  protected $headers = Request::HEADER_X_FORWARDED_ALL;
}
