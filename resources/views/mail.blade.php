@component('mail::message')
  # {{$text}}

  @component('mail::button', ['url' => 'http://reviewli.loc', 'color' => 'error'])
    войти
  @endcomponent

  @component('mail::panel')
    <p>{{$text}}</p>
  @endcomponent

  Thanks, {{ config('app.name') }}
@endcomponent
