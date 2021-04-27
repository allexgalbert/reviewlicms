@extends('layouts.backend')

@section('title')
  админы
@endsection

@section('content')

  @if(session('success'))
    <div class="alert alert-success" role="alert">
      {{session('success')}}
    </div>
  @endif

  @if ($admins)

    <table class="table caption-top">

      <caption>админы</caption>

      <thead class="table-light">
      <tr>
        <th scope="col">id</th>
        <th scope="col">name</th>
        <th scope="col">действия</th>
      </tr>
      </thead>

      <tbody>
      @foreach ($admins as $admin)
        <tr>

          <th scope="row">
            {{ $admin->id }}
          </th>

          <td>
            {{ $admin->name }}
          </td>

          <td>

            <a class="btn btn-warning" href='{{route('backend.admins.edit', $admin->id)}}'>
              изменить
            </a>

            <form method="post" action='{{route('backend.admins.destroy', $admin->id)}}' class='d-inline'>
              @method('delete')
              @csrf

              <button type="submit" class="btn btn-danger delete">удалить</button>
            </form>

          </td>
        </tr>
      @endforeach
      </tbody>

    </table>

    {{$admins->links()}}

  @endif

@endsection

@section('pagejs')
  <script src="{{mix('/js/backend/admins.js')}}"></script>
@endsection
