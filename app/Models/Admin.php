<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Admin extends Authenticatable {

  use HasFactory, Notifiable;

  //аттрибуты массово назначаемые
  protected $fillable = [
    'name',
    'email',
    'password',
  ];

  //скрыть аттрибуты из результата
  protected $hidden = [
    'password',
    'remember_token',
  ];

  //приведение типов
  protected $casts = [
    'email_verified_at' => 'datetime',
  ];

  //admins -> messages
  public function messages() {
    return $this->hasMany(Message::class);
  }

}
