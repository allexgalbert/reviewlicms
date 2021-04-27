@extends('layouts.frontend')

@section('title')
  чат с админом
@endsection

@section('content')

  {{--сообщения--}}
  <ul id='chat' class="list-group mb-3" style='height: 300px; overflow-y: scroll'>
    {!! $messagesList !!}
  </ul>
  {{--  {{$messages->links()}}--}}

  <form id='chat' method='post' action='{{route('user.chat.update')}}'>

    @method('put')
    @csrf

    {{--для id приватного канала--}}
    <input name='user_id' type='hidden' value='{{$user->id}}'>

    <div class="mb-3">
      <label class="form-label">сообщение</label>
      <input name='message' type='text' class='form-control' autofocus>

      @error('message')
      <div class="alert alert-danger" role="alert">
        {{$errors->first('message')}}
      </div>
      @enderror
    </div>

    <button type='submit' class='btn btn-info'>отправить</button>
  </form>

  {{--блок с ошибкой--}}
  <div id='error' class="alert alert-danger mt-3 d-none" role="alert">

  </div>

  <p id='listenForWhisper' style='visibility: hidden'>
    админ печатает...
  </p>

@endsection

@section('pagejs')
  <script src="{{mix('/js/user/chat.js')}}"></script>
@endsection
