<?php

namespace Database\Factories;

use App\Models\Review;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Site as Site;
use App\Models\User as User;

class ReviewFactory extends Factory {

  protected $model = Review::class;

  public function definition() {

    return [
      'rating' => $this->faker->numberBetween(-1, +1),
      'comment' => 'Review ' . $this->faker->text(),
      'site_id' => $this->faker->unique(true)->numberBetween(1, Site::count()),
      'user_id' => $this->faker->unique(true)->numberBetween(1, User::count()),
    ];
  }
}
