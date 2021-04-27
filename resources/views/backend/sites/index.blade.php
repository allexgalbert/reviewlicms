@extends('layouts.backend')

@section('title')
  сайты
@endsection

@section('content')

  @if(session('success'))
    <div class="alert alert-success" role="alert">
      {{session('success')}}
    </div>
  @endif

  <a href='{{route('backend.sites.create')}}' class="btn btn-success">
    создать
  </a>

  @if ($sites)

    <table class="table caption-top">

      <caption>сайты</caption>

      <thead class="table-light">
      <tr>
        <th scope="col">id</th>
        <th scope="col">name</th>
        <th scope="col">действия</th>
      </tr>
      </thead>

      <tbody>
      @foreach ($sites as $site)
        <tr>

          <th scope="row">
            {{ $site->id }}
          </th>

          <td>
            {{ $site->name }}
          </td>

          <td>

            <a class="btn btn-warning" href='{{route('backend.sites.edit', $site->id)}}'>
              изменить
            </a>

            <form method="post" action='{{route('backend.sites.destroy', $site->id)}}' class='d-inline'>
              @method('delete')
              @csrf

              <button type="submit" class="btn btn-danger delete">удалить</button>
            </form>

          </td>
        </tr>
      @endforeach
      </tbody>

    </table>

    {{$sites->links()}}

  @endif

@endsection

@section('pagejs')
  <script src="{{mix('/js/backend/sites.js')}}"></script>
@endsection
