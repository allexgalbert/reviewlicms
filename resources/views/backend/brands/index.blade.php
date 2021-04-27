@extends('layouts.backend')

@section('title')
  бренды
@endsection

@section('content')

  @if(session('success'))
    <div class="alert alert-success" role="alert">
      {{session('success')}}
    </div>
  @endif

  <form class='my-3' method="get" action='{{route('backend.brands.index')}}'>
    <div class="input-group mb-3">
      <input name="name" type="text" class="form-control" placeholder="найти" value="{{app('request')->input('name')}}">
      <a href='{{route('backend.brands.index')}}' class="btn btn-info">сброс</a>
    </div>
  </form>

  <a href='{{route('backend.brands.create')}}' class="btn btn-success">
    создать
  </a>

  @if ($brands)

    <table class="table caption-top">

      <caption>брендов {{$brandsCount}}</caption>

      <thead class="table-light">
      <tr>
        <th scope="col">id</th>
        <th scope="col">name</th>
        <th scope="col">действия</th>
      </tr>
      </thead>

      <tbody>
      @foreach ($brands as $brand)
        <tr>

          <th scope="row">
            {{ $brand->id }}
          </th>

          <td>

            <h6>
              {{ $brand->name }}
            </h6>

            <p>
              На {{ $brand->sites->count() }} сайтах
            </p>

          </td>

          <td>

            <a class="btn btn-warning" href='{{route('backend.brands.edit', $brand->id)}}'>
              изменить
            </a>

            <form method="post" action='{{route('backend.brands.destroy', $brand->id)}}' class='d-inline'>
              @method('delete')
              @csrf

              <button type="submit" class="btn btn-danger delete">удалить</button>
            </form>

          </td>
        </tr>
      @endforeach
      </tbody>

    </table>

    {{$brands->links()}}

  @endif

@endsection

@section('pagejs')
  <script src="{{mix('/js/backend/brands.js')}}"></script>
@endsection
