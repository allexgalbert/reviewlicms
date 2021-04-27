@extends('layouts.backend')

@section('title')
  создать бренд
@endsection

@section('content')

  <div class='row justify-content-md-center'>
    <div class='col-6'>

      <form class='border rounded p-3' method="post" action='{{route('backend.brands.store')}}'
            enctype="multipart/form-data">
        @method('post')
        @csrf

        <h1>создать бренд</h1>

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
          <label class="form-label">урл</label>
          <input name="url" type="text" class="form-control" value='{{old('url')}}'>

          @error('url')
          <div class="alert alert-danger" role="alert">
            {{$errors->first('url')}}
          </div>
          @enderror
        </div>

        <!------------------------------------------------->

        <div class="mb-3">
          <label class="form-label">файл</label>
          <input name="file" class="form-control" type="file">

          @error('file')
          <div class="alert alert-danger" role="alert">
            {{$errors->first('file')}}
          </div>
          @enderror
        </div>

        <!------------------------------------------------->

        <div class="mb-3">

          <label class="form-label">показать в футере</label>

          <div class="form-check">
            <input class="form-check-input" type="radio" name="footer" id="footeryes" value="1">
            <label class="form-check-label" for="footeryes">да</label>
          </div>
          <div class="form-check">
            <input class="form-check-input" type="radio" name="footer" id="footernot" value="0" checked>
            <label class="form-check-label" for="footernot">нет</label>
          </div>

          @error('footer')
          <div class="alert alert-danger" role="alert">
            {{$errors->first('footer')}}
          </div>
          @enderror
        </div>

        <!------------------------------------------------->

        <button type="submit" class="btn btn-primary">создать</button>
      </form>

    </div>
  </div>

@endsection
