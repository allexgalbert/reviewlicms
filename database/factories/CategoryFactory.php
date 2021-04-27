<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

class CategoryFactory extends Factory {

  protected $model = Category::class;

  public function definition() {
    return [
      'name' => 'category "' . $this->faker->company . '"',
      'desc' => 'category ' . $this->faker->paragraph(3),
      'footer' => $this->faker->numberBetween(0, 1),
    ];
  }
}
