<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Pagination\Paginator;

class AppServiceProvider extends ServiceProvider {

  //регистрация сервисов
  public function register() {
  }

  //загрузка сервисов
  public function boot() {

    //Schema::defaultStringLength(300);

    //пагинатор bootstrap 4
    Paginator::useBootstrap();
  }
}
