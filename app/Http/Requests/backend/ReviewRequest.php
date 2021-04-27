<?php

namespace App\Http\Requests\backend;

use Illuminate\Foundation\Http\FormRequest;

class ReviewRequest extends FormRequest {

  //определить может ли юзер делать запрос
  public function authorize() {
    return true;
  }

  //правила валидации
  public function rules() {
    return [
      'comment' => 'required',
    ];
  }

  //свои мессаги
  public function messages() {
    return [
      'comment.required' => 'отзыв обязателен',
    ];
  }
}
