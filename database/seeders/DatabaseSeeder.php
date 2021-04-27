<?php

namespace Database\Seeders;

use App\Models\Token;
use Illuminate\Database\Seeder;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Feature;
use App\Models\Review;
use App\Models\Site;
use App\Models\User;
use App\Models\Admin;

class DatabaseSeeder extends Seeder {

  public function run() {

    $count = 15;

    //токены api
    Token::factory($count)->create();

    //категории
    Category::factory($count)->create();

    //юзеры
    User::factory($count)->create();

    //админы
    Admin::factory($count)->create();

    //бренды, сайты, связь бренды-сайты
    Brand::factory($count)
      ->has(Site::factory(3))
      ->create();

    //особенности, сайты, связь особенности-сайты
    Feature::factory($count)
      ->has(Site::factory(3))
      ->create();

    //отзывы
    Review::factory($count * 3)->create();

  }
}
