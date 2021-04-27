@extends('layouts.frontend')

@section('title')
  отзывы
@endsection

@section('content')

  {{--сообщения--}}
  @if($reviews->isNotEmpty())

    <ul class="list-group mb-3">
      @foreach($reviews as $review)
        <li class="list-group-item">


          <p>
            {{$review->site->name}}

            @if($review->rating == 1)
              <span class="badge bg-success rounded-pill">лайк</span>
            @endif

            @if($review->rating == -1)
              <span class="badge bg-danger rounded-pill">дизлайк</span>
            @endif
          </p>
          <p>
            {{ $review->comment }}
          </p>
          <p>
            {{\Carbon\Carbon::parse($review->created_at)->format('d.m.Y в H:i')}}
          </p>

        </li>
      @endforeach
    </ul>

    {{$reviews->links()}}
  @endif

@endsection
