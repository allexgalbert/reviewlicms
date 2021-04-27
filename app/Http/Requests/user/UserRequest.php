<?php

namespace App\Http\Requests\user;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest {

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
