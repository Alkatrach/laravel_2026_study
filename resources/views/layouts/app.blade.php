<!doctype html>
<html lang="ru">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Сайт про черепах</title>
  @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>

<body>
  <nav id="header" class="navbar navbar-expand-lg">
    <div class="container-fluid">
      <div id="header-logo-container">
        <a class="nav-link d-inline-flex align-turtles-center" aria-current="page" href="{{ route('turtles.index') }}">
          <span id="header-logo">🐢</span>
          <span id="header-title" class="navbar-brand ms-1">Сайт про черепах</span>
        </a>
      </div>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup"
        aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
        <div class="navbar-nav w-100">
          <a class="nav-link active" aria-current="page" href="{{ route('turtles.index') }}">Главная страница</a>
          <button class="ms-lg-auto btn btn-primary" id="liveToastBtn">Загрузить</button>
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

  <div class="toast-container position-fixed bottom-0 end-0 p-3">
    <div id="liveToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
      <div class="toast-header">
        <i class="fa-solid fa-spinner fa-spin"></i>
        <strong class="me-auto">Ой!</strong>
        <small>Черепаший Иисус покинул нас.</small>
        <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
      </div>
      <div class="toast-body">
        На текущий момент этот функционал недоступен.
      </div>
    </div>
  </div>
</body>

</html>
