<?php

//роуты для frontend

use Illuminate\Support\Facades\Route;

//главная
use App\Http\Controllers\frontend\HomeController;

Route::get('/', [HomeController::class, 'index'])->name('frontend.home.index');

//каталог
use App\Http\Controllers\frontend\CatalogController;

Route::get('catalog', [CatalogController::class, 'index'])->name('frontend.catalog.index');

//страница сайта
use App\Http\Controllers\frontend\SiteController as SiteController1;

Route::get('site/{site}', [SiteController1::class, 'index'])->name('frontend.site.index');

//сабмит отзыва
Route::post('site/{site}', [SiteController1::class, 'store'])->name('frontend.site.store');
//-------------------------------------------------

//регистрация
use App\Http\Controllers\frontend\SignupController;

Route::get('signup', [SignupController::class, 'create'])->name('frontend.signup.create');
Route::post('signup', [SignupController::class, 'store'])->name('frontend.signup.store');

//войти
use App\Http\Controllers\frontend\SigninController as SigninController1;

Route::get('signin', [SigninController1::class, 'create'])->name('frontend.signin.create');
Route::post('signin', [SigninController1::class, 'store'])->name('frontend.signin.store');

//восстановить пароль
use App\Http\Controllers\frontend\ForgetController;

Route::get('forget', [ForgetController::class, 'create'])->name('frontend.forget.create');
Route::post('forget', [ForgetController::class, 'store'])->name('frontend.forget.store');
//-------------------------------------------------

//войти как админ
use App\Http\Controllers\frontend\SigninAdminController;

Route::get('signinadmin', [SigninAdminController::class, 'create'])->name('frontend.signinadmin.create');
Route::post('signinadmin', [SigninAdminController::class, 'store'])->name('frontend.signinadmin.store');
