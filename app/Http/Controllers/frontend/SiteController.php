<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Feature;
use App\Models\Site;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\DB;

use App\Http\Requests\ReviewRequest;
use App\Models\Review;
use Illuminate\Support\Facades\Auth;

class SiteController extends Controller {

  public function index(Request $request) {

    $site = Site::query();
    $site->find($request->site);

    //колво отзывов
    $site->withCount('reviews');

    //сумма по -1 и +1
    $site->withSum('reviews', 'rating');

    //сумма по -1
    $site->withCount([
      'reviews AS ratingMinus' => function ($query) {
        $query->select(DB::raw("SUM(rating)"))->where('rating', -1);
      }
    ]);

    //сумма по +1
    $site->withCount([
      'reviews AS ratingPlus' => function ($query) {
        $query->select(DB::raw("SUM(rating)"))->where('rating', 1);
      }
    ]);

    //всего оценок не 0
    $site->withCount([
      'reviews AS ratingPlusMinus' => function ($query) {
        $query->select(DB::raw("COUNT(rating)"))->where('rating', '!=', 0);
      }
    ]);

    $site = $site->firstOrFail();

    return view('frontend.site', [
      'site' => $site,
      'reviews' => $site->reviews()->latest()->paginate(5),
    ]);
  }

  //сабмит формы создания ресурса
  public function store(ReviewRequest $request) {

    $request->merge([
      'site_id' => $request->site,
      'user_id' => Auth::guard('users')->id(),
    ]);

    Review::create($request->all());

    return back()->with('success', 'отзыв добавлен');
  }


}
