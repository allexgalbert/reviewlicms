<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider {

  //маппинг политик
  protected $policies = [
    //'App\Models\Model' => 'App\Policies\ModelPolicy',
  ];

  //регистрация служб аунтентификаций и авторизаций
  public function boot() {
    $this->registerPolicies();
  }
}
