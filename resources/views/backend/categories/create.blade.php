@extends('layouts.backend')

@section('title')
  создать категорию
@endsection

@section('content')

  <div class='row justify-content-md-center'>
    <div class='col-6'>

      <form class='border rounded p-3' method="post" action='{{route('backend.categories.store')}}'>
        @method('post')
        @csrf

        <h1>создать категорию</h1>

        <!------------------------------------------------->

        <div class="mb-3">
          <label class="form-label">название</label>
          <input name="name" type="text" class="form-control" value='{{old('name')}}'>

          @error('name')
          <div class="alert alert-danger" role="alert">
            {{$errors->first('name')}}
          </div>
          @enderror
        </div>

        <!------------------------------------------------->

        <div class="mb-3">
          <label class="form-label">описание</label>
          <textarea name='desc' class="form-control" rows="7">{{old('desc')}}</textarea>

          @error('desc')
          <div class="alert alert-danger" role="alert">
            {{$errors->first('desc')}}
          </div>
          @enderror
        </div>

        <!------------------------------------------------->
        <div class="mb-3">
          <div class="list-group">
            <div class="form-check form-switch">
              <input class="form-check-input" type="checkbox" id="footer" name="footer" value="1">
              <label class="form-check-label" for="footer">показать в футере</label>
            </div>
          </div>
        </div>
        <!------------------------------------------------->

        <button type="submit" class="btn btn-primary">создать</button>
      </form>

    </div>
  </div>

@endsection
