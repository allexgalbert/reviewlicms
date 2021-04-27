<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\backend\AdminRequest;
use App\Models\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller {

  //список ресурсов
  public function index() {
    return view('backend.admins.index', [
      'admins' => Admin::query()->latest()->paginate(10)
    ]);
  }

  //вывод формы редактирования ресурса
  public function edit($locale, Admin $admin) {
    return view('backend.admins.edit', ['admin' => $admin]);
  }

  //сабмит формы редактирования ресурса
  public function update($locale, AdminRequest $request, Admin $admin) {
    $admin->update($request->all());
    return redirect()->route('backend.admins.index')->with('success', 'админ изменен');
  }

  //удалить ресурс
  public function destroy($locale, Admin $admin) {
    $admin->delete();
    return redirect()->route('backend.admins.index')->with('success', 'админ удален');
  }

  public function logout(Request $request) {
    Auth::guard('admins')->logout();
    $request->session()->regenerateToken();
    return redirect()->route('frontend.signinadmin.create');
  }

}
