{{--событие типа вещание. сообщение в тоаст в юзерку--}}

@php
  $user_id = null;
    if ($user = Auth::guard('users')->user()) {
      $user_id = $user->id;
    }
@endphp

<div class="toast-container position-absolute top-0 end-0 p-3" data-user_id="{{$user_id}}"></div>

<script src="{{mix('/js/frontend/global/toast.js')}}"></script>
