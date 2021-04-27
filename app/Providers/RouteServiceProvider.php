<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\URL;

class RouteServiceProvider extends ServiceProvider {

  //урл после логина
  public const HOME = '/';

  //Пространство имен для контроллеров. Роуты контроллеров автоматически получат этот префикс
  //protected $namespace = 'App\\Http\\Controllers';

  //Привязка роутов к моделям
  public function boot() {

    //установка локали
    $this->setmylocale();

    $this->configureRateLimiting();

    $this->routes(function () {

      //роуты для api (пусто)
      //Route::namespace($this->namespace)
      //  ->middleware('api')
      //  ->prefix('api')
      //  ->group(base_path('routes/api.php'));

      //роуты для web (пусто)
      Route::namespace($this->namespace)
        ->middleware('web')
        ->group(base_path('routes/web.php'));
      //-------------------------------------------------

      //роуты для frontend
      Route::namespace($this->namespace)
        ->middleware('web')
        ->prefix('{locale}')
        ->group(base_path('routes/frontend.php'));

      //роуты для user
      Route::namespace($this->namespace)
        ->middleware(['web', 'authUser:users'])
        ->prefix('/{locale}/user')
        ->name('user.')
        ->group(base_path('routes/user.php'));

      //роуты для backend
      Route::namespace($this->namespace)
        ->middleware(['web', 'authAdmin:admins'])
        ->prefix('/{locale}/backend')
        ->name('backend.')
        ->group(base_path('routes/backend.php'));

      //роуты для Api
      Route::namespace($this->namespace)
        ->middleware(['api', 'authApi:api'])
        ->prefix('/{locale}/api')
        ->group(base_path('routes/api.php'));

      //'web', 'api' из $middlewareGroups в kernel.php
      //это группа мидлварей

      //'authUser', 'authAdmin', 'authApi' из $routeMiddleware в kernel.php
      //это отдельные мидлвари

      //'users', 'admins', 'api' это гуарды из auth.php


    });
  }

  //Ограничения скорости для роутов
  protected function configureRateLimiting() {
    RateLimiter::for('api', function (Request $request) {
      return Limit::perMinute(60)->by(optional($request->user())->id ?: $request->ip());
    });
  }

  //установка локали
  protected function setmylocale() {

    //готовые переводы
    $locales = ['ru', 'en', 'be', 'uk'];

    //берем язык с урла
    $locale = \Illuminate\Support\Facades\Request::segment(1);

    //broadcasting/auth
    if ($locale == 'broadcasting') {
      App::setLocale('ru');
      URL::defaults(['locale' => 'ru']);
      return;
    }

    //если языка нет в урле, или это не язык из готовых переводов
    if (empty($locale) || !in_array($locale, $locales)) {

      //текущий урл
      $path = \Illuminate\Support\Facades\Request::getRequestUri();

      //язык браузера
      if (!empty($_SERVER['HTTP_ACCEPT_LANGUAGE'])) {
        $browserLang = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);
      } else {
        $browserLang = 'ru';
      }

      //если язык браузера есть в списке готовых переводов
      if (in_array($browserLang, $locales)) {
        $this->redirect($path, '/' . $browserLang . $path);
      } else {
        //иначе редиректим на русский
        $this->redirect($path, '/ru' . $path);
      }

    } else {
      //если язык есть то всё ок. ставим локаль и параметр в урле
      App::setLocale($locale);
      URL::defaults(['locale' => $locale]);
    }

  }

}
