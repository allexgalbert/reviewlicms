@extends('layouts.backend')

@section('title')
  изменить особенность
@endsection

@section('content')

  <div class='row justify-content-md-center'>
    <div class='col-6'>

      <form class='border rounded p-3' method="post" action='{{route('backend.features.update', $feature->id)}}'>
        @method('put')
        @csrf

        <h1>изменить особенность</h1>

        <!------------------------------------------------->

        <div class="mb-3">
          <label class="form-label">название</label>
          <input name="name" type="text" class="form-control" value='{{$feature->name}}'>

          @error('name')
          <div class="alert alert-danger" role="alert">
            {{$errors->first('name')}}
          </div>
          @enderror
        </div>

        <!------------------------------------------------->

        <div class="mb-3">

          <label class="form-label">показать в футере</label>

          <div class="form-check">
            <input class="form-check-input"
                   type="radio"
                   name="footer"
                   id="footeryes"
                   value="1"
                   @if($feature->footer == 1) checked @endif>

            <label class="form-check-label" for="footeryes">да</label>
          </div>

          <div class="form-check">
            <input class="form-check-input"
                   type="radio"
                   name="footer"
                   id="footernot"
                   value="0"
                   @if($feature->footer == 0) checked @endif>

            <label class="form-check-label" for="footernot">нет</label>
          </div>

          @error('footer')
          <div class="alert alert-danger" role="alert">
            {{$errors->first('footer')}}
          </div>
          @enderror
        </div>

        <!------------------------------------------------->

        <button type="submit" class="btn btn-primary">изменить</button>
      </form>

    </div>
  </div>

@endsection
