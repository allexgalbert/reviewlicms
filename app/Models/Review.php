<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model {

  use HasFactory;

  //аттрибуты массово назначаемые
  protected $fillable = [
    'comment',
    'rating',
    'site_id',
    'user_id',
  ];

  //reviews -> users
  public function user() {
    return $this->belongsTo(User::class);
  }

  //reviews -> sites
  public function site() {
    return $this->belongsTo(Site::class);
  }
}
