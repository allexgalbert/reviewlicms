<?php

namespace App\Http\Requests\backend;

use Illuminate\Foundation\Http\FormRequest;

class BrandRequest extends FormRequest {

  //определить может ли юзер делать запрос
  public function authorize() {

    return true;

    //не дать. вернет HTTP 403 The action is unauthorized
    //return false;

    //дать
    //return true;

    //дать если залогинен
    //return auth()->check();

    //дать если правильная роль
    //return auth()->user()->hasRole('customer');
  }

  //правила валидации
  public function rules() {

    return [
      'name' => 'required',
      'file' => 'image',
      'footer' => 'integer',
      //'desc' => 'required',
      //'url' => 'required|url',
    ];

  }

  //свои мессаги
  public function messages() {

    return [
      'name.required' => 'название обязательно',
      'file.image' => 'файл должен быть картинкой',
      'desc.required' => 'описание обязательно',
      'url.required' => 'урл обязателен',
      'url.url' => 'урл должен быть правильным',
    ];

  }

  //добавить в $request->all() данные
  //public function merge() {
  //$request->merge(['is_active' => true]);
  //}

  //изменить данные перед валидацией
  //public function prepareForValidation() {
  //$this->merge(['is_active' => true]);
  //}

  //изменить данные или вернуть свой массив аттрибутов
  //public function all() {
  //return [];

  //получили $request->all()
  //$requestAll = parent::all();

  //добавили новое
  //$requestAll['foo'] = 'bar';

  //return $requestAll;
  //}

  //сообщение для метода authorize()
  //public function failedAuthorization() {
  //throw new AuthorizationException("Sorry you don't have access");
  //}


}
