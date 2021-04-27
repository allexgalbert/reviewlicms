@extends('layouts.frontend')

@section('title')
  забыли пароль?
@endsection

@section('content')

  <div class='row justify-content-center'>
    <div class='col-6'>

      @if(session('success'))
        <div class="alert alert-success" role="alert">
          {{session('success')}}
        </div>
      @endif

      <form class='border rounded p-3' method="post" action='{{route('frontend.forget.store')}}'>
        @method('post')
        @csrf

        {{--{{$fromcomposer2}}--}}
        {{--{{$fromcomposer3}}--}}

        <h1>забыли пароль?</h1>

        <div class="mb-3">
          <label class="form-label">почта</label>
          <input name="email" type="email" class="form-control" value="{{old('email')}}">

          @error('email')
          <div class="alert alert-danger" role="alert">
            {{$errors->first('email')}}
          </div>
          @enderror
        </div>

        <button type="submit" class="btn btn-primary">выслать новый пароль</button>
      </form>

    </div>
  </div>

@endsection
