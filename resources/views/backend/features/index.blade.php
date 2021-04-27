@extends('layouts.backend')

@section('title')
  особенности
@endsection

@section('content')

  @if(session('success'))
    <div class="alert alert-success" role="alert">
      {{session('success')}}
    </div>
  @endif

  <form class='my-3' method="get" action='{{route('backend.features.index')}}'>
    <div class="input-group mb-3">
      <input name="name" type="text" class="form-control" placeholder="найти" value="{{app('request')->input('name')}}">
      <a href='{{route('backend.features.index')}}' class="btn btn-info">сброс</a>
    </div>
  </form>

  <a href='{{route('backend.features.create')}}' class="btn btn-success">
    создать
  </a>

  @if ($features)

    <table class="table caption-top">

      <caption>особенностей {{$featuresCount}}</caption>

      <thead class="table-light">
      <tr>
        <th scope="col">id</th>
        <th scope="col">name</th>
        <th scope="col">действия</th>
      </tr>
      </thead>

      <tbody>
      @foreach ($features as $feature)
        <tr>

          <th scope="row">
            {{ $feature->id }}
          </th>

          <td>

            <h6>
              {{ $feature->name }}
            </h6>

            <p>
              На {{ $feature->sites->count() }} сайтах
            </p>

          </td>

          <td>

            <a class="btn btn-warning" href='{{route('backend.features.edit', $feature->id)}}'>
              изменить
            </a>

            <form method="post" action='{{route('backend.features.destroy', $feature->id)}}'
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

    {{$features->links()}}

  @endif

@endsection

@section('pagejs')
  <script src="{{mix('/js/backend/features.js')}}"></script>
@endsection
