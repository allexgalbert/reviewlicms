<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model {

  use HasFactory;

  //аттрибуты массово назначаемые
  protected $fillable = [
    'name',
    'desc',
    'url',
    'file',
    'footer',
  ];

  //brands -> brand_site <- sites
  public function sites() {
    return $this->belongsToMany(Site::class)->withTimestamps();
  }

}
