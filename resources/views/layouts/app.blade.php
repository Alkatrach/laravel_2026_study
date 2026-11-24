<!doctype html>
<html lang="ru">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>@yield('title', 'Сайт про черепах')</title>
  @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>

<body>
  <nav id="header" class="navbar navbar-expand-lg">
    <div class="container-fluid">
      <div id="header-logo-container">
        <a class="nav-link d-inline-flex align-items-center" aria-current="page" href="{{ route('turtles.index') }}">
          <span id="header-logo">🐢</span>
          <span id="header-title" class="navbar-brand ms-1">Сайт про черепах</span>
        </a>
      </div>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup"
        aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
        <div class="navbar-nav w-100 align-items-lg-center gap-lg-2">
          <a class="nav-link active" aria-current="page" href="{{ route('turtles.index') }}">Главная страница</a>
          @auth
            <a class="nav-link" href="{{ route('users.index') }}">Пользователи</a>
            <a class="nav-link" href="{{ route('feed') }}">Лента</a>
            <button type="button" class="ms-lg-auto btn btn-primary js-form"
              data-url="{{ route('turtles.create', [], false) }}">Загрузить</button>
            <form method="POST" action="{{ route('logout') }}">
              @csrf
              <button type="submit" class="btn btn-link nav-link">Выйти ({{ auth()->user()->username }})</button>
            </form>
          @else
            <a class="nav-link ms-lg-auto" href="{{ route('login') }}">Вход</a>
            <a class="nav-link" href="{{ route('register') }}">Регистрация</a>
          @endauth
        </div>
      </div>
    </div>
  </nav>

  @yield('content')

  <nav id="footer" class="navbar navbar-expand-lg border-top">
    <div class="container-fluid row">
      <span class="col-9">Какуев Сергей</span>
      <div id="footer-social" class="col-3 row">
        <a href="https://rossgram.ru" class="col"><img src="/content/images/ig.png" class="img-fluid"
            alt="Instagram"></a>
        <a href="https://max.ru" class="col"><img src="/content/images/fb.png" class="img-fluid" alt="Facebook"></a>
        <a href="https://vk.ru" class="col"><img src="/content/images/tw.png" class="img-fluid" alt="Twitter"></a>
      </div>
    </div>
  </nav>

  <div class="modal fade" id="turtleModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
      <div class="modal-content"></div>
    </div>
  </div>

  <div class="modal fade" id="formModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
      <div class="modal-content"></div>
    </div>
  </div>
</body>

</html>
