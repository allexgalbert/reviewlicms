@extends('layouts.frontend')

@section('title')
  {{ $site->name }}
@endsection

@section('content')

  <div class='row justify-content-md-center'>

    <div class='col-10 offset-1'>

      <div class="card mb-5">

        <svg class="rounded-3" width="100%" height="100%"
             xmlns="http://www.w3.org/2000/svg">
          <rect width="100%" height="100%" fill="#868e99"></rect>
          <text x="40%" y="50%" fill="#dee2e6">logo image</text>
        </svg>

        <div class="card-body">

          <h3 class="card-title">
            #{{ $site->id }} {{ $site->name }}
          </h3>

          <a href="#">
            {{ $site->url }}
          </a>

          <p class="card-text mt-3">
            {{ $site->desc }}
          </p>

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

      <!------------------------------------------------->

        @if($site->reviews->isNotEmpty())
          <div class="card-footer">
            <h3>отзывы</h3>

            {{$reviews->withQueryString()->links()}}

            @foreach($reviews as $review)

              <div class="d-flex text-muted pt-3 mb-2">

                <svg class="rounded-3 flex-shrink-0 me-2" width="40" height="40"
                     xmlns="http://www.w3.org/2000/svg">
                  <rect width="100%" height="100%" fill="#868e99"></rect>
                  <text x="20%" y="65%" fill="#dee2e6">
                    {{mb_strtoupper( mb_substr($review->user->name, -2))}}
                  </text>
                </svg>

                <p class="pb-3 mb-0 small lh-sm border-bottom">

                  <strong class="d-block text-gray-dark">
                    {{$review->user->name}}
                  </strong>

                  {{$review->comment}}

                  <span class="d-block text-gray-dark">
                    <b>{{$review->created_at}}</b>
                  </span>

                  @if($review->rating == 1)
                    <span class="badge bg-success rounded-pill">лайк</span>
                  @endif

                  @if($review->rating == -1)
                    <span class="badge bg-danger rounded-pill">дизлайк</span>
                  @endif

                </p>

              </div>

            @endforeach

          </div>
        @endif

        @if(session('success'))
          <div class="alert alert-success" role="alert">
            {{session('success')}}
          </div>
        @endif

        @auth('users')

          @if(Auth::guard('users')->user()->disablereviews == 0)

            <form class='border rounded p-3' method="post" action='{{route('frontend.site.store', $site->id)}}'>
              @method('post')
              @csrf

              <h3>добавить отзыв</h3>

              <div class="mb-3">
                <textarea name='comment' class="form-control"></textarea>

                @error('comment')
                <div class="alert alert-danger" role="alert">
                  {{$errors->first('comment')}}
                </div>
                @enderror

              </div>


              <div class="mb-3">

                <label class="form-label">оценить</label>

                <div class="form-check">
                  <input class="form-check-input" type="radio" name="rating" id="ratingZero" value="0">
                  <label class="form-check-label" for="ratingZero">не оценивать</label>
                </div>

                <div class="form-check">
                  <input class="form-check-input" type="radio" name="rating" id="ratingPlus" value="1">
                  <label class="form-check-label" for="ratingPlus">лайк</label>
                </div>

                <div class="form-check">
                  <input class="form-check-input" type="radio" name="rating" id="ratingMinus" value="-1">
                  <label class="form-check-label" for="ratingMinus">дизлайк</label>
                </div>

              </div>

              <button type="submit" class="btn btn-primary">сохранить</button>
            </form>

          @elseif(Auth::guard('users')->user()->disablereviews == 1)

            <div class='alert alert-dark'>
              вы не можете оставлять отзывы
            </div>

          @endif

        @else

          <div class='alert alert-dark'>
            войдите чтобы оставлять комментарии
          </div>

      @endauth



      <!------------------------------------------------->

      </div>


    </div>

  </div>

@endsection
