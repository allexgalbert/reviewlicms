<nav class="navbar navbar-expand-md navbar-light bg-light mb-5">

  <div class="container-fluid">

    <a href="{{route('frontend.home.index')}}"
       class="navbar-brand" style='color: #df2c47'>
      <img src="{{asset('storage/logo.png')}}" alt="Reviewli CMS" width="32" height="32">eviewli
    </a>

    <button class="navbar-toggler"
            type="button"
            data-bs-toggle="collapse"
            data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent"
            aria-expanded="false"
            aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">


      <ul class="navbar-nav me-auto mb-2 mb-lg-0">

        <li class="nav-item">
          <a href='{{route('frontend.home.index')}}'
             class="nav-link @if(Request::routeIs('frontend.home.index')) active @endif">
            @lang('my1.главная')
          </a>
        </li>

        <li class="nav-item">
          <a href='{{route('frontend.catalog.index')}}'
             class="nav-link @if(Request::routeIs('frontend.catalog.index')) active @endif">
            @lang('my1.каталог')
          </a>
        </li>

        <!------------------------------------------------->

        <li class="nav-item dropdown">

          <a
            class="nav-link dropdown-toggle"
            href="#"
            id="navbarDropdown2"
            role="button"
            data-bs-toggle="dropdown"
            aria-expanded="false">
            @lang('my1.языки')
          </a>

          <ul class="dropdown-menu" aria-labelledby="navbarDropdown2">

            @foreach(['ru' => 'русский', 'en' => 'english', 'be' => 'беларускі','uk'=>'український'] as $k => $v)

              <li>
                <a href='/{{$k. substr(Request::getRequestUri(), 3)}}'
                   class="dropdown-item">
                  {{$v}}
                </a>
              </li>

            @endforeach

          </ul>

        </li>
        <!------------------------------------------------->


        <li class="nav-item dropdown">

          <a
            class="nav-link dropdown-toggle @if(Request::routeIs('frontend.signup.create') || Request::routeIs('frontend.signin.create') || Request::routeIs('frontend.forget.create'))
              active @endif"
            href="#"
            id="navbarDropdown"
            role="button"
            data-bs-toggle="dropdown"
            aria-expanded="false">

            @auth('users')
              @php
                $user = Auth::guard('users')->user();
              @endphp
              #{{$user->id}} {{$user->email}}
            @else
              @lang('my1.гость')
            @endauth

          </a>

          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">

            @guest
              <li>
                <a href='{{route('frontend.signup.create')}}'
                   class="dropdown-item @if(Request::routeIs('frontend.signup.create')) active @endif">
                  регистрация
                </a>
              </li>
              <li>
                <a href='{{route('frontend.signin.create')}}'
                   class="dropdown-item @if(Request::routeIs('frontend.signin.create')) active @endif">
                  войти
                </a>
              </li>
              <li>
                <a href='{{route('frontend.forget.create')}}'
                   class="dropdown-item @if(Request::routeIs('frontend.forget.create')) active @endif">
                  забыли пароль?
                </a>
              </li>
            @endguest

            @auth('users')

              <li class="nav-item">
                <a href="{{route('user.chat.index')}}"
                   class="nav-link">
                  чат ({{$user->unreadmessages_touser}})
                </a>
              </li>

              <li class="nav-item">
                <a href="{{route('user.profile.index')}}"
                   class="nav-link">
                  профиль
                </a>
              </li>

              <li class="nav-item">
                <a href="{{route('user.reviews.index')}}"
                   class="nav-link">
                  отзывы
                </a>
              </li>


              <li class="nav-item">
                <a href="{{route('user.logout.logout')}}"
                   class="nav-link">
                  выйти
                </a>
              </li>

            @endauth

          </ul>

        </li>

      </ul>

      <ul class="navbar-nav mb-2 mb-lg-0">

        @auth('admins')
          <li class="nav-item">
            <a class="nav-link" href="{{route('backend.home')}}">дашбоард</a>
          </li>
        @else

          <li class="nav-item">
            <a class="nav-link" href='{{route('frontend.signinadmin.create')}}'>войти как админ</a>
          </li>

        @endauth

      </ul>

    </div>
  </div>
</nav>
