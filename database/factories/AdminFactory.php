<?php

namespace Database\Factories;

use App\Models\Admin;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class AdminFactory extends Factory {

  protected $model = Admin::class;

  public function definition() {
    return [
      'name' => 'Admin ' . $this->faker->name,
      'email' => $this->faker->unique()->safeEmail,
      'email_verified_at' => now(),
      'password' => '$2y$10$.0Qgnl64EBZgfUDurrWvfOJ0AfxPa/6R/04B9vmes22gXWyeQubua', // 213
      'remember_token' => Str::random(10),
      'ban' => $this->faker->numberBetween(0, 1),
    ];
  }
}
