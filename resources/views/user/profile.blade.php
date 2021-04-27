@extends('layouts.frontend')

@section('title')
  профиль
@endsection

@section('content')

  @if(session('success'))
    <div class="alert alert-success" role="alert">
      {{session('success')}}
    </div>
  @endif

  <div class='row justify-content-md-center'>
    <div class='col-6'>

      <form class='border rounded p-3' method="post" action='{{route('user.profile.update')}}'
            enctype="multipart/form-data">
        @method('put')
        @csrf

        <div class="mb-3">
          <label class="form-label">имя</label>
          <input name="name" type="text" class="form-control" value='{{$user->name}}'>

          @error('name')
          <div class="alert alert-danger" role="alert">
            {{$errors->first('name')}}
          </div>
          @enderror
        </div>

        <button type="submit" class="btn btn-primary">сохранить</button>
      </form>

    </div>
  </div>

@endsection

@section('pagejs')
  <script src="{{mix('/js/user/profile.js')}}"></script>
@endsection
