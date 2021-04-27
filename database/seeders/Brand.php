<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class Brand extends Seeder {

  public function run() {
    \App\Models\Brand::factory(5)->create();
  }
}
