<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class Category extends Seeder {

  public function run() {
    \App\Models\Category::factory(5)->create();
  }
}
