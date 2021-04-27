<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sitephoto extends Model {

  use HasFactory;

  //аттрибуты массово назначаемые
  protected $fillable = [
    'file',
    'site_id',
  ];

  //sitephotos -> sites
  public function site() {
    return $this->belongsTo(Site::class);
  }

}
