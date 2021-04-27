@extends('layouts.frontend')

@section('title')
  каталог
@endsection

@section('content')


  <div class='row justify-content-center mb-5'>

    <div class='col-10 offset-1'>

      <form class='border rounded p-3' method="get" action='{{route('frontend.catalog.index')}}'>

        <div class='row mb-3'>

          <div class='col'>
            <div class="form-floating">
              <select name='category_id' class="form-select">
                <option value=''>выбрать</option>
                @foreach($categories as $category)
                  <option value='{{$category->id}}'
                          @isset($getprams['category_id'])
                          @if($getprams['category_id'] == $category->id) selected @endif
                    @endisset>
                    {{$category->name}}
                  </option>
                @endforeach
              </select>
              <label>категория</label>
            </div>
          </div>

          <div class='col'>
            <div class="form-floating">
              <select name='brand_id' class="form-select">
                <option value=''>выбрать</option>
                @foreach($brands as $brand)
                  <option value='{{$brand->id}}'
                          @isset($getprams['brand_id'])
                          @if($getprams['brand_id'] == $brand->id) selected @endif
                    @endisset>
                    {{$brand->name}}
                  </option>
                @endforeach
              </select>
              <label>бренд</label>
            </div>
          </div>

          <div class='col'>
            <div class="form-floating">
              <select name='feature_id' class="form-select">
                <option value=''>выбрать</option>
                @foreach($features as $feature)
                  <option value='{{$feature->id}}'
                          @isset($getprams['feature_id'])
                          @if($getprams['feature_id'] == $feature->id) selected @endif
                    @endisset>
                    {{$feature->name}}
                  </option>
                @endforeach
              </select>
              <label>особенность</label>
            </div>
          </div>

        </div>

        <div class='row'>

          <div class='col'>

            <div class="form-check form-switch">
              <input class="form-check-input" type="checkbox" id="reviews_count"
                     name="reviews_count" value="1"
                     @isset($getprams['reviews_count'])
                     @if($getprams['reviews_count'] == 1) checked @endif
                @endisset >
              <label class="form-check-label" for="reviews_count">по колву отзывов</label>
            </div>

            <div class="form-check form-switch">
              <input class="form-check-input" type="checkbox" id="reviews_sum_rating"
                     name="reviews_sum_rating" value="1"
                     @isset($getprams['reviews_sum_rating'])
                     @if($getprams['reviews_sum_rating'] == 1) checked @endif
                @endisset >
              <label class="form-check-label" for="reviews_sum_rating">по рейтингу</label>
            </div>

          </div>

          <div class='col text-end'>
            <button type="submit" class="btn btn-primary">найти</button>
            <a href='{{route('frontend.catalog.index')}}' class='btn btn-primary'>сброс</a>
          </div>
        </div>


      </form>


    </div>

  </div>

  <!------------------------------------------------->


  <div class='row justify-content-center'>

    <div class='col-10 offset-1'>

      @if ($sites)

        @forelse ($sites as $site)

          <div class="card mb-5">


            <div id="carouselExampleControls_{{$site->id}}" class="carousel slide" data-bs-ride="carousel">
              <div class="carousel-inner">

                @php
                  //главное фото
                  $mainphoto = $site->file;

                //остальные фото
                $sitephotos = $site->sitephotos()->get();
                @endphp

                @if($mainphoto)
                  <div class="carousel-item active">
                    <img src="{{asset('storage/'. $site->file)}}" class="d-block w-100">
                  </div>
                @endif

                @if($sitephotos->isNotEmpty())
                  @foreach($sitephotos as $sitephoto)
                    <div class="carousel-item">
                      <img src="{{asset('storage/'. $sitephoto->file)}}" class="d-block w-100">
                    </div>
                  @endforeach
                @endif

                @if(empty($mainphoto) && $sitephotos->isEmpty())
                  <img src="{{asset('storage/nophoto.png')}}" class="d-block w-100">
                @endif

              </div>

              @if($sitephotos->isNotEmpty())

                <button class="carousel-control-prev" type="button"
                        data-bs-target="#carouselExampleControls_{{$site->id}}" data-bs-slide="prev">
                  <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                  <span class="visually-hidden">Previous</span>
                </button>

                <button class="carousel-control-next" type="button"
                        data-bs-target="#carouselExampleControls_{{$site->id}}" data-bs-slide="next">
                  <span class="carousel-control-next-icon" aria-hidden="true"></span>
                  <span class="visually-hidden">Next</span>
                </button>

              @endif

            </div>


            <div class="card-body">

              <h3 class="card-title">
                <a href='{{route('frontend.site.index', $site->id)}}'>
                  #{{ $site->id }} {{ $site->name }}
                </a>
              </h3>

              <p class="card-text mt-3">
                {{ $site->desc }}
              </p>

              <a href="#">
                {{ $site->url }}
              </a>


            </div>

            @if($site->brands->isNotEmpty())
              <div class="card-footer">
                <h3>бренды</h3>
                @foreach($site->brands as $brand)
                  <div class="badge bg-primary rounded-pill">
                    {{$brand->name}}
                  </div>
                @endforeach
              </div>
            @endif

            @if($site->features->isNotEmpty())
              <div class="card-footer">
                <h3>особенности</h3>
                @foreach($site->features as $feature)
                  <div class="badge bg-info rounded-pill">
                    {{$feature->name}}
                  </div>
                @endforeach
              </div>
            @endif

            @if($site->reviews_count)
              <div class="card-footer">
                <h3>отзывов</h3>
                <div class="badge bg-secondary rounded-pill">
                  {{$site->reviews_count}}
                </div>
              </div>
            @endif

            @if($site->ratingPlus || $site->ratingMinus)
              <div class="card-footer">
                <h3>рейтинг</h3>

                @if($site->ratingPlusMinus)
                  <div class="badge bg-warning rounded-pill">
                    всего оценок {{$site->ratingPlusMinus}}
                  </div>
                @endif

                <div class="badge bg-warning rounded-pill">
                  сумма лайков и дизлайков (рейтинг) {{$site->reviews_sum_rating}}
                </div>

                <br>

                @if($site->ratingMinus)
                  <div class="badge bg-danger rounded-pill">
                    дизлайков {{$site->ratingMinus}}
                  </div>
                @endif

                @if($site->ratingPlus)
                  <div class="badge bg-success rounded-pill">
                    лайков {{$site->ratingPlus}}
                  </div>
                @endif


              </div>
            @endif


          </div>

        @empty
          <div class='alert alert-dark'>
            ничего нет
          </div>

        @endforelse

        {{$sites->withQueryString()->links()}}

      @endif

    </div>

  </div>

@endsection
