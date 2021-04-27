@extends('layouts.backend')

@section('title')
  изменить админа
@endsection

@section('content')

  <div class='row justify-content-md-center'>
    <div class='col-6'>

      <form class='border rounded p-3' method="post" action='{{route('backend.admins.update', $admin->id)}}'>
        @method('put')
        @csrf

        <h1>изменить админа</h1>

        <!------------------------------------------------->

        <div class="mb-3">
          <label class="form-label">имя</label>
          <input name="name" type="text" class="form-control" value='{{$admin->name}}'>

          @error('name')
          <div class="alert alert-danger" role="alert">
            {{$errors->first('name')}}
          </div>
          @enderror
        </div>

        <!------------------------------------------------->

        <button type="submit" class="btn btn-primary">изменить</button>
      </form>

    </div>
  </div>

@endsection
