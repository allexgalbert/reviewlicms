<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\Message;
use App\Models\Review;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller {

  public function index($locale) {

    //текущий юзер
    $user = Auth::guard('users')->user();

    return view('user.reviews', [
      'reviews' => Review::query()->where('user_id', $user->id)->oldest()->paginate(10),
      'user' => $user,
    ]);

  }

  public function update($locale, UserRequest $request) {

    //текущий юзер
    $user = Auth::guard('users')->user();

    $user->update($request->all());

    return redirect()->route('user.profile.index')->with('success', 'профиль изменен');
  }

}
