<?php

namespace App\Jobs;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class NameJob implements ShouldQueue {

  use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

  //это обязательно. иначе не видит переменных в handle()
  protected $user, $message;

  public function __construct(User $user, $message) {
    $this->user = $user;
    $this->message = $message;
  }

  //главный метод
  public function handle() {
    $this->user->update(['ban' => 1]);
  }
}
