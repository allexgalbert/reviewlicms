<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Feature;
use App\Models\Review;
use App\Models\Site;
use App\Models\User;

class HomeController extends Controller {

  public function index() {

    return view('backend.home', [
      'brands' => Brand::all()->count(),
      'categories' => Category::all()->count(),
      'features' => Feature::all()->count(),
      'reviews' => Review::all()->count(),
      'sites' => Site::all()->count(),
      'users' => User::all()->count(),
    ]);
  }
}
