@extends('layouts.backend')

@section('title')
  отзывы
@endsection

@section('content')

  @if(session('success'))
    <div class="alert alert-success" role="alert">
      {{session('success')}}
    </div>
  @endif

  @if ($reviews)

    <table class="table caption-top">

      <caption>отзывы</caption>

      <thead class="table-light">
      <tr>
        <th scope="col">id</th>
        <th scope="col" class='col-6'>comment</th>
        <th scope="col">действия</th>
      </tr>
      </thead>

      <tbody>
      @foreach ($reviews as $review)
        <tr>

          <th scope="row">
            {{ $review->id }}
          </th>

          <td>
            <p>
              {{ $review->comment }}
            </p>

            @if($review->rating == 1)
              <span class="badge bg-success rounded-pill">лайк</span>
            @endif

            @if($review->rating == -1)
              <span class="badge bg-danger rounded-pill">дизлайк</span>
            @endif
          </td>

          <td>

            <a class="btn btn-warning" href='{{route('backend.reviews.edit', $review->id)}}'>
              изменить
            </a>

            <form method="post" action='{{route('backend.reviews.destroy', $review->id)}}' class='d-inline'>
              @method('delete')
              @csrf

              <button type="submit" class="btn btn-danger delete">удалить</button>
            </form>

          </td>
        </tr>
      @endforeach
      </tbody>

    </table>

    {{$reviews->links()}}

  @endif

@endsection

@section('pagejs')
  <script src="{{mix('/js/backend/reviews.js')}}"></script>
@endsection
