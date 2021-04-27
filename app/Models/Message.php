<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model {

  use HasFactory;

  //аттрибуты массово назначаемые
  protected $fillable = [
    'message',
    'user_id',
    'admin_id',
    'direction',
  ];

  //messages -> users
  public function user() {
    return $this->belongsTo(User::class);
  }

  //messages -> admins
  public function admin() {
    return $this->belongsTo(Admin::class);
  }

  //protected $casts = [
  //  'created_at' => 'datetime:Y',
  //];

}
