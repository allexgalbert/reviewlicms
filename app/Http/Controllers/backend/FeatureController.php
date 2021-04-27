<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\backend\FeatureRequest;
use App\Models\Feature;
use Illuminate\Support\Facades\Request;

class FeatureController extends Controller {

  //список ресурсов
  public function index() {

    //модель
    $model = Feature::query();

    //фильтр
    $name = Request::input('name');

    if ($name) {
      $model->whereRaw('LOWER(CONVERT(`name` USING utf8mb4)) LIKE "%' . $name . '%"');
    }

    return view('backend.features.index', [

      //массив особенностей
      'features' => $model->latest()->paginate(10),

      //колво особенностей
      'featuresCount' => $model->count(),
    ]);
  }

  //вывод формы создания ресурса
  public function create() {
    return view('backend.features.create');
  }

  //сабмит формы создания ресурса
  public function store(FeatureRequest $request) {
    Feature::create($request->all());
    return redirect()->route('backend.features.index')->with('success', 'особенность создана');
  }

  //вывод формы редактирования ресурса
  public function edit($locale, Feature $feature) {
    return view('backend.features.edit', ['feature' => $feature]);
  }

  //сабмит формы редактирования ресурса
  public function update($locale, FeatureRequest $request, Feature $feature) {
    $feature->update($request->all());
    return redirect()->route('backend.features.index')->with('success', 'особенность изменена');
  }

  //удалить ресурс
  public function destroy($locale, Feature $feature) {
    $feature->delete();
    return redirect()->route('backend.features.index')->with('success', 'особенность удалена');
  }
}
