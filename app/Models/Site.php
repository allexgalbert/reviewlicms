<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Site extends Model {

  use HasFactory;

  //аттрибуты массово назначаемые
  protected $fillable = [
    'name',
    'desc',
    'url',
    'file',
    'category_id',
  ];

  //sites -> sitephotos
  public function sitephotos() {
    return $this->hasMany(Sitephoto::class);
  }

  //sites -> categories
  public function category() {
    return $this->belongsTo(Category::class);
  }

  //sites -> brand_site <- brands
  public function brands() {
    return $this->belongsToMany(Brand::class)->withTimestamps();
  }

  //sites -> feature_site <- features
  public function features() {
    return $this->belongsToMany(Feature::class)->withTimestamps();
  }

  //sites -> reviews <- users
  public function users() {
    return $this->belongsToMany(User::class)->withPivot('comment')->withTimestamps();
  }

  //sites -> reviews
  public function reviews() {
    return $this->hasMany(Review::class);
  }
}
