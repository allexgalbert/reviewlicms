@extends('layouts.frontend')

@section('title')
  войти
@endsection

@section('content')

  <div class='row justify-content-center'>
    <div class='col-6'>

      @if(session('success'))
        <div class="alert alert-success" role="alert">
          {{session('success')}}
        </div>
      @endif

      <form class='border rounded p-3' method="post" action='{{route('frontend.signin.store')}}'>
        @method('post')
        @csrf

        {{--{{$fromcomposer2}}--}}

        <h1>войти</h1>

        <!------------------------------------------------->

        <div class="mb-3">
          <label class="form-label">почта</label>
          <input name="email" type="email" class="form-control" value="{{old('email', 'lowell91@example.net')}}">

          @error('email')
          <div class="alert alert-danger" role="alert">
            {{$errors->first('email')}}
          </div>
          @enderror
        </div>

        <!------------------------------------------------->

        <div class="mb-3">
          <label class="form-label">пароль</label>
          <input name="password" type="password" class="form-control" value="123">

          @error('password')
          <div class="alert alert-danger" role="alert">
            {{$errors->first('password')}}
          </div>
          @enderror
        </div>

        <!------------------------------------------------->

        <div class="mb-3">
          <div class="list-group">
            <div class="form-check form-switch">
              <input class="form-check-input" type="checkbox" id="remember_token" name="remember_token" value="1">
              <label class="form-check-label" for="remember_token">запомнить меня</label>
            </div>
          </div>
        </div>

        <!------------------------------------------------->


        <button type="submit" class="btn btn-primary">войти</button>
      </form>

    </div>
  </div>

@endsection
