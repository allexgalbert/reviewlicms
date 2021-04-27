<?php

namespace Database\Factories;

use App\Models\Feature;
use Illuminate\Database\Eloquent\Factories\Factory;

class FeatureFactory extends Factory {

  protected $model = Feature::class;

  public function definition() {
    return [
      'name' => 'feature "' . $this->faker->company . '"',
      'footer' => $this->faker->numberBetween(0, 1),
    ];
  }
}
