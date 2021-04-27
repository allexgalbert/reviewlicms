<?php

//роуты для api
//мидлваре-группа 'api' в app/Http/Kernel.php
//префикс урлов будет /api/

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

//Route::middleware('auth:api')
//  ->get('/user', function (Request $request) {
//    return $request->user();
//  });
//-------------------------------------------------

use App\Http\Controllers\api\UserController;

//Route::get('/user/create/{email}', [UserController::class, 'create'])
//  ->name('api.user.create');

//Route::middleware('auth:api')
//  ->get('/user/create/{email}', [UserController::class, 'create'])
//  ->name('api.user.create');

Route::get('/user/create/{email}', [UserController::class, 'create'])
  ->name('api.user.create');
