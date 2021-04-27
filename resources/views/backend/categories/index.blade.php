@extends('layouts.backend')

@section('title')
  категории
@endsection

@section('content')

  @if(session('success'))
    <div class="alert alert-success" role="alert">
      {{session('success')}}
    </div>
  @endif

  <form class='my-3' method="get" action='{{route('backend.categories.index')}}'>
    <div class="input-group mb-3">
      <input name="name" type="text" class="form-control" placeholder="найти" value="{{app('request')->input('name')}}">
      <a href='{{route('backend.categories.index')}}' class="btn btn-info">сброс</a>
    </div>
  </form>

  <a href='{{route('backend.categories.create')}}' class="btn btn-success">
    создать
  </a>

  @if ($categories)

    <table class="table caption-top">

      <caption>категорий {{$categoriesCount}}</caption>

      <thead class="table-light">
      <tr>
        <th scope="col">id</th>
        <th scope="col">name</th>
        <th scope="col">действия</th>
      </tr>
      </thead>

      <tbody>
      @foreach ($categories as $category)

        <tr>

          <th scope="row">
            {{ $category->id }}
          </th>

          <td>

            <h6>
              {{ $category->name }}
            </h6>

            <p>
              На {{ $category->sites->count() }} сайтах
            </p>

          </td>

          <td>

            <a class="btn btn-warning" href='{{route('backend.categories.edit', $category->id)}}'>
              изменить
            </a>

            <form method="post" action='{{route('backend.categories.destroy', $category->id)}}'
                  class='d-inline'>
              @method('delete')
              @csrf

              <button type="submit" class="btn btn-danger delete">удалить</button>
            </form>

          </td>
        </tr>
      @endforeach
      </tbody>

    </table>

    {{$categories->withQueryString()->links()}}

  @endif

@endsection

@section('pagejs')
  <script src="{{mix('/js/backend/categories.js')}}"></script>
@endsection
