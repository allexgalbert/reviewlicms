@extends('layouts.backend')

@section('title')
  юзеры
@endsection

@section('content')

  @if(session('success'))
    <div class="alert alert-success" role="alert">
      {{session('success')}}
    </div>
  @endif

  @if ($users)

    <table class="table caption-top">

      <caption>юзеры</caption>

      <thead class="table-light">
      <tr>
        <th scope="col">id</th>
        <th scope="col">name</th>
        <th scope="col">действия</th>
      </tr>
      </thead>

      <tbody>
      @foreach ($users as $user)
        <tr>

          <th scope="row">
            {{ $user->id }}
          </th>

          <td>
            {{ $user->name }}
            <br>
            {{ $user->email }}
          </td>

          <td>

            <a class="btn btn-warning" href='{{route('backend.users.edit', $user->id)}}'>
              изменить
            </a>

            <a class="btn btn-info" href='{{route('backend.users.autologin', $user->id)}}' target='_blank'>
              автологин
            </a>

            <a class="btn btn-outline-secondary" href='{{route('backend.messages.index', $user->id)}}'>
              чат ({{$user->unreadmessages_toadmin}})
            </a>


            <form method="post" action='{{route('backend.users.destroy', $user->id)}}' class='d-inline'>
              @method('delete')
              @csrf
              <button type="submit" class="btn btn-danger delete">удалить</button>
            </form>

            <form method="post" action='{{route('backend.users.addcautions', $user->id)}}' class='d-inline'>
              @method('put')
              @csrf
              <button type="submit" class="btn btn-outline-danger delete">предупреждение ({{$user->cautions}})</button>
            </form>


          </td>
        </tr>
      @endforeach
      </tbody>

    </table>

    {{$users->links()}}

  @endif

@endsection

@section('pagejs')
  <script src="{{mix('/js/backend/users.js')}}"></script>
@endsection
