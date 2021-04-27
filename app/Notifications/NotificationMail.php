<?php

//канал mail

namespace App\Notifications;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NotificationMail extends Notification {

  use Queueable;

  public function __construct(User $user, $message) {
    $this->user = $user;
    $this->message = $message;
  }

  //канал
  public function via($notifiable) {
    return ['mail'];
  }

  public function toMail($notifiable) {

    //простое уведомление (оно всё равно markdown)
    //return (new MailMessage)
    //  ->line('Это уведомление')
    //  ->action('Это ссылка', url('/'))
    //  ->line('Это линия')
    //  ->error()
    //  ->subject('subject')
    //  ->line('Это переменная ' . $this->message);

    //вьюха
    //return (new MailMessage)->view('banUser', [
    //  'user' => $this->user,
    //  'text' => $this->message,
    //]);

    //вьюха markdown
    return (new MailMessage)
      ->markdown('mail', [
        'user' => $this->user,
        'text' => $this->message,
      ]);
  }

  public function toArray($notifiable) {
    return [
    ];
  }
}
