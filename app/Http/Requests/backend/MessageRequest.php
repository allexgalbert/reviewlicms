<?php

namespace App\Http\Requests\backend;

use Illuminate\Foundation\Http\FormRequest;

class MessageRequest extends FormRequest {

  //определить может ли юзер делать запрос
  public function authorize() {
    return true;
  }

  //правила валидации
  public function rules() {
    return [
      'message' => 'required',
      //'message' => 'required|min:10|numeric',
    ];
  }

  //свои мессаги
  public function messages() {
    return [
      'message.required' => 'сообщение обязательно',
      //'message.min' => 'не меньше 10 символов',
      //'message.numeric' => 'поле цифровое',
    ];
  }
}
