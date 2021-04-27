<?php

namespace Database\Factories;

use App\Models\Site;
use Illuminate\Database\Eloquent\Factories\Factory;

class SiteFactory extends Factory {

  protected $model = Site::class;

  public function definition() {
    return [
      'name' => 'site "' . $this->faker->company . '"',
      'category_id' => $this->faker->numberBetween(1, 5),
      'desc' => 'site ' . $this->faker->paragraph(3),
      'url' => $this->faker->url,
    ];
  }
}
