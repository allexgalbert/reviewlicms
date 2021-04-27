<?php

namespace App\Http\Requests\backend;

use Illuminate\Foundation\Http\FormRequest;

class FeatureRequest extends FormRequest {

  //определить может ли юзер делать запрос
  public function authorize() {
    return true;
  }

  //правила валидации
  public function rules() {
    return [
      'name' => 'required',
      'footer' => 'integer',
    ];
  }

  //свои мессаги
  public function messages() {
    return [
      'name.required' => 'название обязательно',
    ];
  }
}
