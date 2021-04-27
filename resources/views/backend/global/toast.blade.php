{{--событие типа вещание. сообщение тоаст в админку--}}

@foreach($messages as $message)

  <div class="toast" role="alert" aria-live="assertive" aria-atomic="true" data-bs-delay=1000>

    <div class="toast-header">

      <img src="/favicon.png" class="rounded me-2" style='height: 20px; width: 20px;'>

      <strong class="me-auto">
        @if($message->direction == -1)
          {{$message->admin->name}}
        @elseif($message->direction == 1)
          {{$message->user->name}}
        @endif
      </strong>

      <small>
        {{\Carbon\Carbon::parse($message->created_at)->format('d.m.Y в H:i')}}
      </small>

      <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>

    </div>

    <div class="toast-body">
      {{$message->message}}
    </div>

  </div>

@endforeach
