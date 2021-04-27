<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\backend\BrandRequest;
use App\Models\Brand;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Storage;

class BrandController extends Controller {

  //список ресурсов
  public function index() {

    //модель
    $model = Brand::query();

    //фильтр
    $name = Request::input('name');

    if ($name) {
      $model->whereRaw('LOWER(CONVERT(`name` USING utf8mb4)) LIKE "%' . $name . '%"');
    }

    return view('backend.brands.index', [

      //массив брендов
      'brands' => $model->latest()->paginate(10),

      //колво брендов
      'brandsCount' => $model->count(),
    ]);
  }

  //вывод формы создания ресурса
  public function create() {
    return view('backend.brands.create');
  }

  //сабмит формы создания ресурса
  public function store(BrandRequest $request) {

    $brand = Brand::create($request->all());

    if ($request->hasFile('file')) {
      $file = $request->file('file')->store('brands', 'public');
      $brand->update(['file' => $file]);
    }

    return redirect()->route('backend.brands.index')->with('success', 'бренд создан');
  }

  //вывод формы редактирования ресурса
  public function edit($locale, Brand $brand) {
    return view('backend.brands.edit', ['brand' => $brand]);
  }

  //сабмит формы редактирования ресурса
  public function update($locale, BrandRequest $request, Brand $brand) {

    $brand->update($request->all());

    if ($request->hasFile('file')) {
      $file = $request->file('file')->store('brands', 'public');
      $brand->update(['file' => $file]);
    }

    return redirect()->route('backend.brands.index')->with('success', 'бренд изменен');
  }

  //удалить ресурс
  public function destroy($locale, Brand $brand) {
    $this->destroyfile($locale, $brand);
    $brand->delete();
    return redirect()->route('backend.brands.index')->with('success', 'бренд удален');
  }

  //удалить файл
  public function destroyfile($locale, Brand $brand) {
    Storage::disk('public')->delete($brand->file);
    $brand->update(['file' => null]);
    return back();
  }
}
