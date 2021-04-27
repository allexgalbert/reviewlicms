<nav class="navbar navbar-expand-md navbar-light bg-light mb-5">

  <div class="container-fluid">

    <a href="{{route('backend.home')}}"
       class="navbar-brand">
      дашбоард
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

        <?php
        $menu = [
          'backend.categories.index' => 'категории',
          'backend.brands.index' => 'бренды',
          'backend.features.index' => 'особенности',
          'backend.sites.index' => 'сайты',
          'backend.users.index' => 'юзеры',
          'backend.reviews.index' => 'отзывы',
          'backend.admins.index' => 'админы',
          //'frontend.home.index' => 'сайт',
        ];

        ?>

        @foreach($menu as $route =>$title)
          <li class="nav-item">
            <a href='{{route($route)}}'
               class="nav-link @if(Request::routeIs($route) || Request::segment(3) == explode('.', $route)[1]) active @endif">
              {{$title}}
            </a>
          </li>
        @endforeach

        <li class="nav-item">
          <a href='{{route('frontend.home.index')}}'
             class="nav-link"
             target='_blank'>
            к сайту
          </a>
        </li>

      </ul>

      <ul class="navbar-nav mb-2 mb-lg-0">

        <li class="nav-item dropdown">

          <a class="nav-link dropdown-toggle"
             href="#"
             id="navbarDropdown"
             role="button"
             data-bs-toggle="dropdown"
             aria-expanded="false">

            @auth('admins')
              @php
                $user = Auth::guard('admins')->user();
              @endphp
              {{$user->email}}
            @endauth

          </a>

          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">

            @auth('admins')
              <li class="nav-item">
                <a href="{{route('backend.admins.logout')}}"
                   class="nav-link">
                  выйти
                </a>
              </li>
            @endauth

          </ul>

        </li>

      </ul>

    </div>
  </div>
</nav>
