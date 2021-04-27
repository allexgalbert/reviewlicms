<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable {

  use HasFactory, Notifiable;

  //аттрибуты массово назначаемые
  protected $fillable = [
    'name',
    'email',
    'password',
    'ban',
    'disablereviews',
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

  //users -> reviews <- sites
  public function sites() {
    return $this->belongsToMany(Site::class)->withPivot('comment')->withTimestamps();
  }

  //users -> reviews
  public function reviews() {
    return $this->hasMany(Review::class);
  }

  //users -> messages
  public function messages() {
    return $this->hasMany(Message::class);
  }

}
