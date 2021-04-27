<?php

//каналы вещания

use Illuminate\Support\Facades\Broadcast;
use Illuminate\Support\Facades\Request;

//событие типа вещание. сообщение в чат админу. сообщение в чат юзеру
Broadcast::channel('ChatChannel.{id}', function ($user, $id) {

  //если это юзер, то проверяем
  if (Request::all()['account'] == 'user') {
    return (int)$user->id === (int)$id;
  }

  //если это админ, то не проверяем
  if (Request::all()['account'] == 'admin') {
    return true;
  }

});

//событие типа вещание. сообщение в тоаст в юзерку
Broadcast::channel('UnreadMessagesToUserChannel.{id}', function ($user, $id) {

  //если это юзер, то проверяем
  if (Request::all()['account'] == 'user') {
    return (int)$user->id === (int)$id;
  }

});
