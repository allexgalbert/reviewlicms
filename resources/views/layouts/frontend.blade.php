<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>@yield('title')</title>

  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="shortcut icon" href="{{asset('storage/favicon.png')}}">

  {{--главный css--}}
  <link href="{{mix('/css/app.css')}}" rel='stylesheet'>

  {{--css страниц--}}
  @yield('pageccss')
</head>
<body>

<div class='container'>

  {{--навбар--}}
  @include('frontend.global.navbar')

  {{--контент--}}
  @yield('content')

  {{--футер--}}
  <x-footercomponent/>

</div>

{{--главный скрипт--}}
<script src="{{mix('/js/app.js')}}"></script>

{{--скрипты страниц--}}
@yield('pagejs')

{{--попап WelcomeModalComponent--}}
<x-welcomemodalcomponent/>

{{--попап CountUnreadMessagesUserComponent--}}
<x-countunreadmessagesusercomponent/>

{{--событие типа вещание. сообщение тоаст в юзерку--}}
<x-unreadmessagestousercomponent/>

</body>
</html>
