@extends('layouts.backend')

@section('title')
  изменить юзера
@endsection

@section('content')

  <div class='row justify-content-md-center'>
    <div class='col-6'>

      <form class='border rounded p-3' method="post" action='{{route('backend.users.update', $user->id)}}'>
        @method('put')
        @csrf

        <h1>изменить юзера</h1>

        <!------------------------------------------------->

        <div class="mb-3">
          <label class="form-label">имя</label>
          <input name="name" type="text" class="form-control" value='{{$user->name}}'>

          @error('name')
          <div class="alert alert-danger" role="alert">
            {{$errors->first('name')}}
          </div>
          @enderror
        </div>

        <!------------------------------------------------->

        <div class="mb-3">
          <div class="list-group">
            <div class="form-check form-switch">
              <input class="form-check-input" type="checkbox" id="disablereviews" name="disablereviews" value="1"
                     @if($user->disablereviews == 1) checked @endif>
              <label class="form-check-label" for="disablereviews">запретить оставлять отзывы</label>
            </div>
          </div>
        </div>

        <div class="mb-3">
          <div class="list-group">
            <div class="form-check form-switch">
              <input class="form-check-input" type="checkbox" id="ban" name="ban" value="1"
                     @if($user->ban == 1) checked @endif>
              <label class="form-check-label" for="ban">забанить</label>
            </div>
          </div>
        </div>


        <!------------------------------------------------->


        <button type="submit" class="btn btn-primary">изменить</button>
      </form>

    </div>
  </div>

@endsection
