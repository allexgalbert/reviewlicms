<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Feature;
use App\Models\Site;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\DB;

class CatalogController extends Controller {

  public function index(Request $request) {

    $sites = Site::query();

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

    return view('frontend.catalog', [
      'sites' => $sites->latest()->paginate(5),
      'categories' => Category::all(),
      'brands' => Brand::all(),
      'features' => Feature::all(),
      'getprams' => $request->all(),
    ]);
  }

}
