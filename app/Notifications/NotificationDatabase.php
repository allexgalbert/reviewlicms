<?php

//канал database

namespace App\Notifications;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NotificationDatabase extends Notification {

  use Queueable;

  public function __construct(User $user, $message) {
    $this->user = $user;
    $this->message = $message;
  }

  //канал
  public function via($notifiable) {
    return ['database'];
  }

  public function toDatabase($notifiable) {
    return [
      'text' => $this->message
    ];
  }
}
