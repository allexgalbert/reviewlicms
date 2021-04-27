<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class Review extends Seeder {

  public function run() {
    \App\Models\Review::factory(5)->create();
  }
}
