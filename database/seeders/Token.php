<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class Token extends Seeder {

  public function run() {
    \App\Models\Token::factory(5)->create();
  }
}
