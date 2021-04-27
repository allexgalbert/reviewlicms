@extends('layouts.backend')

@section('title')
  изменить категорию
@endsection

@section('content')

  <div class='row justify-content-md-center'>
    <div class='col-6'>

      <form class='border rounded p-3' method="post"
            action='{{route('backend.categories.update', $category->id)}}'>
        @method('put')
        @csrf

        <h1>изменить категорию</h1>

        <!------------------------------------------------->

        <div class="mb-3">
          <label class="form-label">название</label>
          <input name="name" type="text" class="form-control" value='{{$category->name}}'>

          @error('name')
          <div class="alert alert-danger" role="alert">
            {{$errors->first('name')}}
          </div>
          @enderror
        </div>

        <!------------------------------------------------->

        <div class="mb-3">
          <label class="form-label">описание</label>
          <textarea name='desc' class="form-control" rows="7">{{$category->desc}}</textarea>

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
              <input class="form-check-input" type="checkbox" id="footer" name="footer"
                     @if($category->footer == 1) checked value="1" @endif
                     @if($category->footer == 0) value="0" @endif
              >
              <label class="form-check-label" for="footer">показать в футере</label>
            </div>
          </div>
        </div>


        <!------------------------------------------------->

        <button type="submit" class="btn btn-primary">изменить</button>
      </form>

    </div>
  </div>

@endsection
