<?php

namespace App\Http\Requests\backend;

use Illuminate\Foundation\Http\FormRequest;

class AdminRequest extends FormRequest {

  //определить может ли юзер делать запрос
  public function authorize() {
    return true;
  }

  //правила валидации
  public function rules() {
    return [
      'name' => 'required',
    ];
  }

  //свои мессаги
  public function messages() {
    return [
      'name.required' => 'имя обязательно',
    ];
  }
}
