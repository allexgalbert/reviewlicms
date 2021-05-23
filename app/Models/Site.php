<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

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

  public static function getList($request) {

    $sites = self::query();
    $sites->select('sites.*');

    //категория
    if ($request->category_id) {
      $sites
        ->join('categories', 'categories.id', '=', 'sites.category_id')
        ->where('categories.id', $request->category_id);
    }

    //бренд
    if ($request->brand_id) {
      $sites
        ->join('brand_site', 'brand_site.site_id', '=', 'sites.id')
        ->where('brand_site.brand_id', $request->brand_id);
    }

    //особенность
    if ($request->feature_id) {
      $sites
        ->join('feature_site', 'feature_site.site_id', '=', 'sites.id')
        ->where('feature_site.feature_id', $request->feature_id);
    }

    //колво отзывов
    $sites->withCount('reviews');

    //(select count(*) from `reviews` where `sites`.`id` = `reviews`.`site_id`) as `reviews_count`

    //по колву отзывов
    if ($request->reviews_count) {
      $sites->orderBy('reviews_count', 'desc');
    }

    //сумма по -1 и +1
    $sites->withSum('reviews', 'rating');

    //(select sum(`reviews`.`rating`) from `reviews` where `sites`.`id` = `reviews`.`site_id`) as `reviews_sum_rating`


    //сумма по -1
    $sites->withCount([
      'reviews AS ratingMinus' => function ($query) {
        $query->select(DB::raw("SUM(rating)"))->where('rating', -1);
      }
    ]);

    //(select SUM(rating) from `reviews` where `sites`.`id` = `reviews`.`site_id` and `rating` = ?) as `ratingMinus`


    //сумма по +1
    $sites->withCount([
      'reviews AS ratingPlus' => function ($query) {
        $query->select(DB::raw("SUM(rating)"))->where('rating', 1);
      }
    ]);

    //(select SUM(rating) from `reviews` where `sites`.`id` = `reviews`.`site_id` and `rating` = ?) as `ratingPlus`

    //всего оценок не 0
    $sites->withCount([
      'reviews AS ratingPlusMinus' => function ($query) {
        $query->select(DB::raw("COUNT(rating)"))->where('rating', '!=', 0);
      }
    ]);

    //по рейтингу
    if ($request->reviews_sum_rating) {
      $sites->orderBy('reviews_sum_rating', 'desc');
    }

    //dump($sites->dd());
    //Brand::query()->explain()->dd();
    //dump($sites->explain());

    return $sites;
  }
}
