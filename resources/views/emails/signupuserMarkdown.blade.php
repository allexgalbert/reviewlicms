@component('mail::message')

  # вы зарегистрировались

  теперь можете зайти в магазин

  @component('mail::button', ['url' => 'http://reviewli.loc', 'color' => 'success'])
    войти
  @endcomponent

  @component('mail::panel')
    <p>почта {{$user->email}}</p>
    <p>пароль {{$password}}</p>
  @endcomponent

  Thanks, {{ config('app.name') }}

@endcomponent



