<?php

//роуты для кабинета юзера

//чат
use App\Http\Controllers\user\ChatController;

Route::get('chat', [ChatController::class, 'index'])->name('chat.index');
Route::put('chat', [ChatController::class, 'update'])->name('chat.update');

//профиль
use App\Http\Controllers\user\ProfileController;

Route::get('profile', [ProfileController::class, 'index'])->name('profile.index');
Route::put('profile', [ProfileController::class, 'update'])->name('profile.update');

//отзывы
use App\Http\Controllers\user\ReviewController;

Route::get('reviews', [ReviewController::class, 'index'])->name('reviews.index');

//разлогин
use App\Http\Controllers\user\LogoutController as LogoutController1;

Route::get('logout', [LogoutController1::class, 'logout'])->name('logout.logout');
