@extends('layouts.backend')

@section('title')
  изменить отзыв
@endsection

@section('content')

  <div class='row justify-content-md-center'>
    <div class='col-6'>

      <form class='border rounded p-3' method="post" action='{{route('backend.reviews.update', $review->id)}}'>
        @method('put')
        @csrf

        <h1>изменить отзыв</h1>

        <!------------------------------------------------->

        <div class="mb-3">
          <label class="form-label">отзыв</label>
          <textarea name='comment' class="form-control" rows="7">{{$review->comment}}</textarea>

          @error('comment')
          <div class="alert alert-danger" role="alert">
            {{$errors->first('comment')}}
          </div>
          @enderror
        </div>

        <!------------------------------------------------->

        <button type="submit" class="btn btn-primary">изменить</button>
      </form>

    </div>
  </div>

@endsection
