<?php

namespace App\Http\Controllers\backend;

use App\Events\ChatEvent;
use App\Http\Controllers\Controller;
use App\Http\Requests\backend\UserRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

use App\Notifications\NotificationMail;
use App\Notifications\NotificationDatabase;
use App\Notifications\NotificationBroadcast;

class UserController extends Controller {

  //список ресурсов
  public function index() {

    return view('backend.users.index', [
      'users' => User::query()->latest('unreadmessages_toadmin')->latest()->paginate(10),
    ]);
  }

  //вывод формы редактирования ресурса
  public function edit($locale, User $user) {
    return view('backend.users.edit', ['user' => $user]);
  }

  //сабмит формы редактирования ресурса
  public function update($locale, UserRequest $request, User $user) {

    //уведомление
    if ($request->has('ban')) {
      $user->notify(new NotificationMail($user, 'вы забанены за спам'));
    }

    $request->merge([
      'ban' => $request->has('ban'),
      'disablereviews' => $request->has('disablereviews'),
    ]);

    $user->update($request->all());
    return redirect()->route('backend.users.index')->with('success', 'юзер изменен');
  }

  //удалить ресурс
  public function destroy($locale, User $user) {
    $name = "#{$user->id} $user->name | $user->email";
    $user->delete();
    return redirect()->route('backend.users.index')->with('success', 'удален юзер ' . $name);
  }

  //автологин к юзеру
  public function autologin($locale, User $user) {
    Auth::guard('users')->login($user);
    return redirect()->route('frontend.home.index');
  }

  //предупреждение юзеру
  public function addcautions($locale, User $user) {

    $user->increment('cautions');

    //уведомление
    $user->notify(new NotificationMail($user, 'вы получили предупреждение'));
    $user->notify(new NotificationDatabase($user, 'вы получили предупреждение'));
    $user->notify(new NotificationBroadcast($user, 'вы получили предупреждение'));

    //отладка
    //return (new NotificationMail($user, 'вы получили предупреждение'))->toMail($user);
    //return (new NotificationDatabase($user, 'вы получили предупреждение'))->toDatabase($user);
    //return (new NotificationBroadcast($user, 'вы получили предупреждение'))->toBroadcast($user);
    //exit;

    //событие
    //EventName1::dispatch($user, 'вы получили предупреждение');

    $name = "#{$user->id} $user->name | $user->email";
    return redirect()->route('backend.users.index')->with('success', 'предупреждение юзеру ' . $name);
  }

}
