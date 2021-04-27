@extends('layouts.backend')

@section('title')
  изменить сайт
@endsection

@section('content')

  <div class='row justify-content-md-center'>

    <div class='col-6'>

      <form class='border rounded p-3' method="post" action='{{route('backend.sites.update', $site->id)}}'
            enctype="multipart/form-data">

        @method('put')
        @csrf

        <h1>изменить сайт</h1>

        <!------------------------------------------------->

        <div class="mb-3">

          <label class="form-label">название</label>
          <input name="name" type="text" class="form-control" value='{{$site->name}}'>

          @error('name')
          <div class="alert alert-danger" role="alert">
            {{$errors->first('name')}}
          </div>
          @enderror
        </div>

        <!------------------------------------------------->

        <div class="mb-3">
          <label class="form-label">описание</label>
          <textarea name='desc' class="form-control" rows="7">{{$site->desc}}</textarea>

          @error('desc')
          <div class="alert alert-danger" role="alert">
            {{$errors->first('desc')}}
          </div>
          @enderror
        </div>

        <!------------------------------------------------->

        <div class="mb-3">
          <label class="form-label">урл</label>
          <input name="url" type="text" class="form-control" value='{{$site->url}}'>

          @error('url')
          <div class="alert alert-danger" role="alert">
            {{$errors->first('url')}}
          </div>
          @enderror
        </div>

        <!------------------------------------------------->

        @if(@empty($site->file))
          <div class="mb-3">
            <label class="form-label">главное фото</label>
            <input name="file" class="form-control" type="file">

            @error('file')
            <div class="alert alert-danger" role="alert">
              {{$errors->first('file')}}
            </div>
            @enderror
          </div>
        @endif

        <div class="mb-3">
          <label class="form-label">остальные фото</label>
          <input name="sitephotos[]" multiple class="form-control" type="file">

          @error('sitephotos')
          <div class="alert alert-danger" role="alert">
            {{$errors->first('sitephotos')}}
          </div>
          @enderror
        </div>

        <!------------------------------------------------->

        <div class="mb-3">

          <label class="form-label">категория</label>

          <select name='category_id' class="form-control">
            <option value=''>выбрать</option>
            @foreach($categories as $category)
              <option value='{{$category->id}}'

                      {{--открыли страницу. олда нет. в базе отмечен. показать--}}
                      @if(@empty(old('category_id')))
                      {{--расставляем из базы--}}
                      @if ($category->id == $site->category->id) selected @endif
                      @endif

                      {{--был сабмит. олд есть. в олде отмечен. показать --}}
                      {{--расставляем из олда--}}
                      @if ($category->id == old('category_id')) selected @endif

              >

                {{$category->name}}
              </option>
            @endforeach
          </select>

          @error('category_id')
          <div class="alert alert-danger" role="alert">
            {{$errors->first('category_id')}}
          </div>
          @enderror
        </div>

        <!------------------------------------------------->

        <div class="mb-3">

          <label class="form-label">бренды</label>

          <div class="list-group">

            @foreach($brands as $brand)
              <div class="form-check form-switch">

                <input class="form-check-input"
                       type="checkbox"
                       id="brand_id[{{$brand->id}}]"
                       name="brand_id[{{$brand->id}}]"
                       value="{{$brand->id}}"

                       {{--открыли страницу. олда нет. в базе отмечен. показать--}}
                       @if(@empty(old('brand_id')))
                       {{--расставляем из базы--}}
                       @if (in_array($brand->id, $site->brands()->allRelatedIds()->toArray())) checked
                       @endif
                       @endif

                       {{--был сабмит. олд есть. в олде отмечен. показать --}}
                       {{--расставляем из олда--}}
                       @if (!@empty(old('brand_id')[$brand->id])) checked @endif

                >

                <label class="form-check-label" for="brand_id[{{$brand->id}}]">{{$brand->name}}</label>
              </div>
            @endforeach
          </div>

          @error('brand_id')
          <div class="alert alert-danger" role="alert">
            {{$errors->first('brand_id')}}
          </div>
          @enderror
        </div>

        <!------------------------------------------------->

        <div class="mb-3">

          <label class="form-label">особенности</label>

          <div class="list-group">

            @foreach($features as $feature)
              <div class="form-check form-switch">

                <input class="form-check-input"
                       type="checkbox"
                       id="feature_id[{{$feature->id}}]"
                       name="feature_id[{{$feature->id}}]"
                       value="{{$feature->id}}"

                       {{--открыли страницу. олда нет. в базе отмечен. показать--}}
                       @if(@empty(old('feature_id')))
                       {{--расставляем из базы--}}
                       @if (in_array($feature->id, $site->features()->allRelatedIds()->toArray())) checked
                       @endif
                       @endif

                       {{--был сабмит. олд есть. в олде отмечен. показать --}}
                       {{--расставляем из олда--}}
                       @if (!@empty(old('feature_id')[$feature->id])) checked @endif

                >

                <label class="form-check-label"
                       for="feature_id[{{$feature->id}}]">{{$feature->name}}</label>
              </div>
            @endforeach
          </div>

          @error('feature_id')
          <div class="alert alert-danger" role="alert">
            {{$errors->first('feature_id')}}
          </div>
          @enderror
        </div>

        <!------------------------------------------------->

        <button type="submit" class="btn btn-primary">изменить</button>

      </form>

      <!------------------------------------------------->

      @if($site->file)

        <form method="post" action='{{route('backend.sites.destroyfile', $site->id)}}'
              class='border rounded p-3'>

          @method('delete')
          @csrf

          <div class="mb-3">
            <label class="form-label">главное фото</label>
            <img src="{{asset('storage/'. $site->file)}}" class="img-thumbnail d-block">
          </div>

          <button type="submit" class="btn btn-danger">удалить</button>
        </form>
      @endif

    <!------------------------------------------------->

      {{--остальные фото--}}
      @if($sitephotos->isNotEmpty())

        {{--<form action='{{route('backend.sites.destroysitephoto', $site->id)}}'--}}

        <form action='{{route('backend.sites.destroysitephoto', $site->id)}}'
              method="post"
              class='border rounded p-3'>

          @method('delete')
          @csrf

          <div class="mb-3">
            <label class="form-label">остальные фото</label>

            @foreach($sitephotos as $sitephoto)
              <div class="my-3">

                <img src="{{asset('storage/'. $sitephoto->file)}}" class="img-thumbnail d-block">
              </div>
              <button type="submit" name='sitephotos_id' value='{{$sitephoto->id}}' class="btn btn-danger">
                удалить {{$sitephoto->id}}
              </button>
            @endforeach

          </div>

        </form>

      @endif


    </div>
  </div>

@endsection
