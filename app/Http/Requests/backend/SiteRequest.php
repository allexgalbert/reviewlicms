<?php

namespace App\Http\Requests\backend;

use Illuminate\Foundation\Http\FormRequest;

class SiteRequest extends FormRequest {

  //определить может ли юзер делать запрос
  public function authorize() {
    return true;
  }

  //правила валидации
  public function rules() {

    return [
      'name' => 'required',
      'file' => 'image',
      'category_id' => 'required',
      //'desc' => 'required',
      //'url' => 'required|url',
    ];

  }

  //свои мессаги
  public function messages() {

    return [
      'name.required' => 'название обязательно',
      'file.image' => 'файл должен быть картинкой',
      'category_id.required' => 'категория обязательно',
      'desc.required' => 'описание обязательно',
      'url.required' => 'урл обязателен',
      'url.url' => 'урл должен быть правильным',
    ];

  }
}
