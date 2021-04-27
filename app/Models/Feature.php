<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Feature extends Model {

  use HasFactory;

  //аттрибуты массово назначаемые
  protected $fillable = [
    'name',
    'footer',
  ];

  //features -> feature_site <- sites
  public function sites() {
    return $this->belongsToMany(Site::class)->withTimestamps();
  }
}
