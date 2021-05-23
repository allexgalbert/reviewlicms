<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Feature;
use App\Models\Site;
use Illuminate\Http\Request;

class CatalogController extends Controller {

  public function index(Request $request) {

    $sites = Site::getList($request);

    return view('frontend.catalog', [
      'sites' => $sites->latest()->paginate(5),
      'categories' => Category::all(),
      'brands' => Brand::all(),
      'features' => Feature::all(),
      'getprams' => $request->all(),
    ]);
  }

}
