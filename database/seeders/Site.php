<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class Site extends Seeder {

  public function run() {
    \App\Models\Site::factory(5)->create();
  }
}
