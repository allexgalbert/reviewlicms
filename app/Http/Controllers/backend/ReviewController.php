<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\backend\ReviewRequest;
use App\Models\Review;

class ReviewController extends Controller {

  //список ресурсов
  public function index() {
    return view('backend.reviews.index', [
      'reviews' => Review::query()->latest()->paginate(10)
    ]);
  }

  //вывод формы редактирования ресурса
  public function edit($locale, Review $review) {
    return view('backend.reviews.edit', ['review' => $review]);
  }


  //сабмит формы редактирования ресурса
  public function update($locale, ReviewRequest $request, Review $review) {
    $review->update($request->all());
    return redirect()->route('backend.reviews.index')->with('success', 'отзыв изменен');
  }

  //удалить ресурс
  public function destroy($locale, Review $review) {
    $review->delete();
    return redirect()->route('backend.reviews.index')->with('success', 'отзыв удален');
  }
}
