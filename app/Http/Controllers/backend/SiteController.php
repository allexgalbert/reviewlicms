<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\backend\SiteRequest;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Feature;
use App\Models\Site;
use App\Models\Sitephoto;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Storage;

class SiteController extends Controller {

  //список ресурсов
  public function index() {
    return view('backend.sites.index', [
      'sites' => Site::query()->latest()->paginate(10)
    ]);
  }

  //вывод формы создания ресурса
  public function create() {
    return view('backend.sites.create', [
      'categories' => Category::all(),
      'brands' => Brand::all(),
      'features' => Feature::all(),
    ]);
  }

  //сабмит формы создания ресурса
  public function store(SiteRequest $request) {

    $site = Site::create($request->all());

    //сохраним главное фото
    if ($request->hasFile('file')) {
      $file = $request->file('file')->store('sites', 'public');
      $site->update(['file' => $file]);
    }

    //сохраним связи в другие таблицы
    $site->brands()->attach($request->brand_id);
    $site->features()->attach($request->feature_id);

    //сохраним остальные фото
    if ($request->hasFile('sitephotos')) {
      foreach ($request->sitephotos as $key => $fileObject) {
        $file = $fileObject->store('sites', 'public');
        Sitephoto::create(['site_id' => $site->id, 'file' => $file]);
      }
    }

    return redirect()->route('backend.sites.index')->with('success', 'сайт создан');
  }

  //вывод формы редактирования ресурса
  public function edit($locale, Site $site) {

    $site->load('category');
    $site->load('brands');
    $site->load('features');

    return view('backend.sites.edit', [
      'site' => $site,
      'categories' => Category::all(),
      'brands' => Brand::all(),
      'features' => Feature::all(),
      'sitephotos' => $site->sitephotos()->get(),
    ]);
  }

  //сабмит формы редактирования ресурса
  public function update($locale, SiteRequest $request, Site $site) {

    $site->update($request->all());

    //сохраним главное фото
    if ($request->hasFile('file')) {
      $file = $request->file('file')->store('sites', 'public');
      $site->update(['file' => $file]);
    }

    //сохраним связи в другие таблицы
    $site->brands()->sync($request->brand_id);
    $site->features()->sync($request->feature_id);

    //сохраним остальные фото
    if ($request->hasFile('sitephotos')) {
      foreach ($request->sitephotos as $key => $fileObject) {
        $file = $fileObject->store('sites', 'public');
        Sitephoto::create(['site_id' => $site->id, 'file' => $file]);
      }
    }

    return redirect()->route('backend.sites.index')->with('success', 'сайт изменен');
  }

  //удалить ресурс
  public function destroy($locale, Site $site) {
    $this->destroyfile($locale, $site);
    $site->delete();
    return redirect()->route('backend.sites.index')->with('success', 'сайт удален');
  }

  //удалить файл
  public function destroyfile($locale, Site $site) {
    //dd($site->file);
    Storage::disk('public')->delete($site->file);
    $site->update(['file' => null]);
    return back();
  }

  public function destroysitephoto($locale, Site $site, Request $request) {

    //id фото из формы
    $sitephotos_id = $request::input('sitephotos_id');

    //нашли фото в таблице
    $file = $site->sitephotos()->where('id', $sitephotos_id)->first();

    //удаляем из папки
    Storage::disk('public')->delete($file->file);

    //удаляем из таблицы
    $file->delete();

    return back();
  }
}
