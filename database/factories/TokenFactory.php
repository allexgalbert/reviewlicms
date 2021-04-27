<?php

namespace Database\Factories;

use App\Models\Token;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class TokenFactory extends Factory {

  protected $model = Token::class;

  public function definition() {
    return [
      'api_token' => Str::random(10),
    ];
  }
}
