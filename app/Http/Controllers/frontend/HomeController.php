<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

//use myalias;

class HomeController extends Controller {

  public function index(Request $request, $locale) {

    //вызываем фасад
    //myalias::mymethod1();
    //myalias::mymethod2();

    return view('frontend.home');
  }

}
