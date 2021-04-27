<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>@yield('title')</title>

  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="shortcut icon" href="/favicon.png">

  {{--главный css--}}
  <link href="{{mix('/css/app.css')}}" rel='stylesheet'>

  {{--css страниц--}}
  @yield('pageccss')
</head>
<body>

<div class='container'>

  {{--навбар--}}
  @include('backend.global.navbar')

  {{--контент--}}
  @yield('content')

  {{--футер--}}
  <x-footercomponent/>

</div>

{{--главный скрипт--}}
<script src="{{mix('/js/app.js')}}"></script>

{{--скрипты страниц--}}
@yield('pagejs')

{{--событие типа вещание. сообщение тоаст в админку--}}
<x-unreadmessagestoadmincomponent/>

</body>
</html>
