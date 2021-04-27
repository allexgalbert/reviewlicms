<?php

namespace App\Providers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Broadcast;
use Illuminate\Support\ServiceProvider;

class BroadcastServiceProvider extends ServiceProvider {

  public function boot() {

    //роут broadcasting/auth для аутентификации на приватные каналы

    //по умолчанию (использует 'auth:web')
    //Broadcast::routes();

    //с разбивкой на юзер и админ
    Broadcast::routes(['middleware' => ['web', 'AuthUserOrAdminForWebsocket']]);

    require base_path('routes/channels.php');
  }
}
