<?php

//слушатель

namespace App\Listeners;

use App\Events\ChatEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class NameListener {

  public function __construct() {
  }

  public function handle(ChatEvent $event) {
  }
}
