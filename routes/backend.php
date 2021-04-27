<?php

//роуты для backend

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\backend\HomeController;
use App\Http\Controllers\backend\BrandController;
use App\Http\Controllers\backend\CategoryController;
use App\Http\Controllers\backend\FeatureController;
use App\Http\Controllers\backend\UserController;
use App\Http\Controllers\backend\ReviewController;
use App\Http\Controllers\backend\SiteController;
use App\Http\Controllers\backend\AdminController;
use App\Http\Controllers\backend\MessageController;

//главная
Route::get('home', [HomeController::class, 'index'])->name('home');

//бренд. удаление файла
Route::delete('brands/destroyfile/{brand}', [BrandController::class, 'destroyfile'])->name('brands.destroyfile');
//-------------------------------------------------

//сайт. удаление главного фото
Route::delete('sites/destroyfile/{site}', [SiteController::class, 'destroyfile'])->name('sites.destroyfile');

//сайт. удаление остальных фото
Route::delete('sites/destroysitephoto/{site}', [SiteController::class, 'destroysitephoto'])->name('sites.destroysitephoto');

//-------------------------------------------------

//админ. разлогин
Route::get('admins/logout', [AdminController::class, 'logout'])->name('admins.logout');

//чат
Route::get('messages/{user}', [MessageController::class, 'index'])->name('messages.index');
Route::put('messages/{user}', [MessageController::class, 'update'])->name('messages.update');
//-------------------------------------------------

//юзер

//автологин
Route::get('users/autologin/{user}', [UserController::class, 'autologin'])->name('users.autologin');

//предупреждение
Route::put('users/addcautions/{user}', [UserController::class, 'addcautions'])->name('users.addcautions');
//-------------------------------------------------

Route::resources([
  'brands' => BrandController::class,
  'categories' => CategoryController::class,
  'features' => FeatureController::class,
  'users' => UserController::class,
  'reviews' => ReviewController::class,
  'sites' => SiteController::class,
  'admins' => AdminController::class,
]);
