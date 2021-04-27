<?php

//футер

namespace App\View\Components;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Feature;

use Illuminate\View\Component;

class FooterComponent extends Component {

  public function __construct() {
  }

  //<x-footercomponent/>
  public function render() {
    return view('components.footer', [
      'categories' => Category::query()->where('footer', 1)->get(),
      'brands' => Brand::query()->where('footer', 1)->get(),
      'features' => Feature::query()->where('footer', 1)->get(),
    ]);
  }
}
