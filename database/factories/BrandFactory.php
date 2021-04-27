<?php

namespace Database\Factories;

use App\Models\Brand;
use Illuminate\Database\Eloquent\Factories\Factory;

class BrandFactory extends Factory {

  protected $model = Brand::class;

  public function definition() {
    return [
      'name' => 'brand "' . $this->faker->company . '"',
      'desc' => 'brand ' . $this->faker->paragraph(3),
      'url' => $this->faker->url,
      'footer' => $this->faker->numberBetween(0, 1),
    ];
  }
}
