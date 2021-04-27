@extends('layouts.backend')

@section('title')
  чат с юзером #{{$user->id}}
@endsection

@section('content')

  {{--сообщения--}}
  <ul id='messages' class="list-group mb-3" style='height: 300px; overflow-y: scroll'>
    {!! $messagesList !!}
  </ul>
  {{--  {{$messages->links()}}--}}

  <form id='messages' method='post' action='{{route('backend.messages.update', $user->id)}}'>

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

    <button type='submit' class='btn btn-secondary'>отправить</button>
  </form>

  <p id='listenForWhisper' style='visibility: hidden'>
    юзер печатает...
  </p>

@endsection

@section('pagejs')
  <script src="{{mix('/js/backend/messages.js')}}"></script>
@endsection
