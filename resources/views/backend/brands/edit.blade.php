@extends('layouts.backend')

@section('title')
  изменить бренд
@endsection

@section('content')

  <div class='row justify-content-md-center'>

    <div class='col-6'>

      <form class='border rounded p-3' method="post" action='{{route('backend.brands.update', $brand->id)}}'
            enctype="multipart/form-data">

        @method('put')
        @csrf

        <h1>изменить бренд</h1>

        <!------------------------------------------------->

        <div class="mb-3">
          <label class="form-label">название</label>
          <input name="name" type="text" class="form-control"

                 {{--открыли страницу. олда нет. берем из базы--}}
                 @if(@empty(old('name')))
                 {{--расставляем из базы--}}
                 value='{{$brand->name}}'
                 @else
                 {{--был сабмит. олд есть. берем из олда--}}
                 value='{{old('name')}}'
            @endif

          >

          @error('name')
          <div class="alert alert-danger" role="alert">
            {{$errors->first('name')}}
          </div>
          @enderror
        </div>

        <!------------------------------------------------->

        <div class="mb-3">
          <label class="form-label">описание</label>
          <textarea name='desc' class="form-control" rows="7">{{$brand->desc}}</textarea>

          @error('desc')
          <div class="alert alert-danger" role="alert">
            {{$errors->first('desc')}}
          </div>
          @enderror
        </div>

        <!------------------------------------------------->

        <div class="mb-3">
          <label class="form-label">урл</label>
          <input name="url" type="text" class="form-control" value='{{$brand->url}}'>

          @error('url')
          <div class="alert alert-danger" role="alert">
            {{$errors->first('url')}}
          </div>
          @enderror
        </div>

        <!------------------------------------------------->

        @if(@empty($brand->file))
          <div class="mb-3">
            <label class="form-label">файл</label>
            <input name="file" class="form-control" type="file">

            @error('file')
            <div class="alert alert-danger" role="alert">
              {{$errors->first('file')}}
            </div>
            @enderror
          </div>
      @endif

      <!------------------------------------------------->

        <div class="mb-3">

          <label class="form-label">показать в футере</label>

          <div class="form-check">
            <input class="form-check-input"
                   type="radio"
                   name="footer"
                   id="footeryes"
                   value="1"
                   @if($brand->footer == 1) checked @endif>

            <label class="form-check-label" for="footeryes">да</label>
          </div>

          <div class="form-check">
            <input class="form-check-input"
                   type="radio"
                   name="footer"
                   id="footernot"
                   value="0"
                   @if($brand->footer == 0) checked @endif>

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

      <!------------------------------------------------->

      @if($brand->file)

        <form method="post" action='{{route('backend.brands.destroyfile', $brand->id)}}'
              class='border rounded p-3'>

          @method('delete')
          @csrf

          <div class="mb-3">
            <label class="form-label">файл</label>
            <img src="{{asset('storage/'. $brand->file)}}" class="img-thumbnail d-block">
          </div>

          <button type="submit" class="btn btn-danger">удалить</button>
        </form>
    @endif

    <!------------------------------------------------->

    </div>
  </div>

@endsection
