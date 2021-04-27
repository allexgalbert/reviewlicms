@extends('layouts.frontend')

@section('title')
  войти как админ
@endsection

@section('content')

  <div class='row justify-content-center'>
    <div class='col-6'>

      @if(session('success'))
        <div class="alert alert-success" role="alert">
          {{session('success')}}
        </div>
      @endif

      <form class='border rounded p-3' method="post" action='{{route('frontend.signinadmin.store')}}'>
        @method('post')
        @csrf

        {{--{{$fromcomposer2}}--}}

        <h1>войти как админ</h1>

        <div class="mb-3">
          <label class="form-label">почта</label>
          <input name="email" type="email" class="form-control" value="{{old('email', 'brown.lelah@example.com')}}">

          @error('email')
          <div class="alert alert-danger" role="alert">
            {{$errors->first('email')}}
          </div>
          @enderror
        </div>


        <div class="mb-3">
          <label class="form-label">пароль</label>
          <input name="password" type="password" class="form-control" value="123">

          @error('password')
          <div class="alert alert-danger" role="alert">
            {{$errors->first('password')}}
          </div>
          @enderror
        </div>

        <button type="submit" class="btn btn-primary">войти</button>
      </form>

    </div>
  </div>

@endsection
