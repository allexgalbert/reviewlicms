<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model {

  use HasFactory;

  //аттрибуты массово назначаемые
  protected $fillable = [
    'name',
    'desc',
    'footer',
  ];

  //categories -> sites
  public function sites() {
    return $this->hasMany(Site::class);
  }
}
