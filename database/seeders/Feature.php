<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class Feature extends Seeder {

  public function run() {
    \App\Models\Feature::factory(5)->create();
  }
}
