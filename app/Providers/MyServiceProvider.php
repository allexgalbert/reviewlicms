<?php

//создать свой провайдер

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class MyServiceProvider extends ServiceProvider {

  //подключить свой класс к контейнеру
  public function register() {

    //"$this->app" это контейнер

    //кладем свой класс MyClass в ячейку 'cellname' в контейнер
    $this->app->bind('cellname', 'App\MyClasses\MyClass');

    //весь контейнер
    //dd($this->app);

  }

  public function boot() {
  }
}
