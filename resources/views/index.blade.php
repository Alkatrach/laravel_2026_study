<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Bootstrap w/ Webpack</title>
  @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>

<body>
  <nav id="header" class="navbar navbar-expand-lg">
    <div class="container-fluid">
      <div id="header-logo-container">
        <a class="nav-link d-inline-flex align-items-center" aria-current="page" href="#">
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
          <a class="nav-link active" aria-current="page" href="#">Главная страница</a>
          <button class="ms-lg-auto btn btn-primary" id="liveToastBtn">Загрузить</button>
        </div>
      </div>
    </div>
  </nav>
  <div id="content" class="container">
    <h1 id="title">Семейство черепах</h1>
    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 row-cols-xxxl-4 g-4">
      <div class="col">
        <div class="card">
          <span class="content-type">Исполинские черепахи</span>
          <img src="content/images/turtle1.jpg" class="img-fluid" alt="Ого смотри какая здоровая черепаха!">
          <div class="card-body">
            <h5 class="content-title">Сейшельская гигантская черепаха</h5>
            <p class="content-description">Вид сухопутных черепах. Эндемик острова Альдабра, редкий вид. Отдельные
              гигантские черепахи доживали в неволе до 150 лет. Возраст старейших представителей вида черепах —
              Джонатан (род. 1832) и умершая Адвайта (1800—2006), чей возраст оценивается более 180—200 лет.</p>
            <button type="button" class="btn btn-primary" data-bs-toggle="modal"
              data-bs-target="#modal1">Подробнее</button>
          </div>
        </div>
      </div>
      <div class="col">
        <div class="card">
          <span class="content-type">Трёхкоготные черепахи</span>
          <img src="content/images/turtle2.jpg" class="img-fluid" alt="Ого смотри какая здоровая черепаха!">
          <div class="card-body">
            <h5 class="content-title">Колючий трионикс</h5>
            <p class="content-description">Один из самых крупных видов пресноводных мягкотелых черепах в Северной
              Америке. Ранее этот вид классифицировали в роде Trionyx, но сейчас он относится к роду Apalone.</p>
            <button type="button" class="btn btn-primary" data-bs-toggle="modal"
              data-bs-target="#modal2">Подробнее</button>
          </div>
        </div>
      </div>
      <div class="col">
        <div class="card">
          <span class="content-type">Зелёные черепахи</span>
          <img src="content/images/turtle3.jpg" class="img-fluid" alt="Ого смотри какая здоровая черепаха!">
          <div class="card-body">
            <h5 class="content-title">Кожистые черепахи</h5>
            <p class="content-description">Единственный современный вид из семейства кожистых черепах
              (Dermochelyidae). Это самые крупные современные черепахи: у крупнейшего[3][4] измеренного экземпляра
              полная длина тела составляла 2,6 м, размах передних ласт — 2,5 м, а масса 916 кг. По другим данным,
              длина тела этих черепах достигает 2,5 метров, размах передних ласт — 5 м, а масса — 600 кг.</p>
            <button type="button" class="btn btn-primary" data-bs-toggle="modal"
              data-bs-target="#modal3">Подробнее</button>
          </div>
        </div>
      </div>
      <div class="col">
        <div class="card">
          <span class="content-type">Каймановые черепахи</span>
          <img src="content/images/turtle4.jpg" class="img-fluid" alt="Ого смотри какая здоровая черепаха!">
          <div class="card-body">
            <h5 class="content-title">Каймановая черепаха</h5>
            <p class="content-description">Отличительный признак каймановых черепах — небольшой пластрон, имеющий
              крестообразную форму, длинный хвост (больше половины длины тела), покрытый сверху рядом крупных
              шиповатых чешуй. Голова и шея покрыты мелкими шиповатыми чешуйками.</p>
            <button type="button" class="btn btn-primary" data-bs-toggle="modal"
              data-bs-target="#modal4">Подробнее</button>
          </div>
        </div>
      </div>
      <div class="col">
        <div class="card">
          <span class="content-type">Большеголовые черепахи</span>
          <img src="content/images/turtle5.jpg" class="img-fluid" alt="Ого смотри какая здоровая черепаха!">
          <div class="card-body">
            <h5 class="content-title">Большеголовая черепаха</h5>
            <p class="content-description">Сравнительно небольшая черепаха, с панцирем длиной до 20 см, имеет
              несоразмерно крупную голову, покрытую сверху одним большим прочным щитком. Шея у неё длинная и
              подвижная, но голова из-за своей величины не втягивается в панцирь. Верхняя челюсть вооружена
              острым, направленным вниз клювом. Панцирь сильно уплощён, ноги и очень длинный хвост не могут
              полностью убираться внутрь, поэтому наружные части ног и хвост покрыты крупными роговыми щитками для
              защиты. Пальцы снабжены короткими, но крепкими когтями и не имеют перепонок.</p>
            <button type="button" class="btn btn-primary" data-bs-toggle="modal"
              data-bs-target="#modal5">Подробнее</button>
          </div>
        </div>
      </div>
    </div>
  </div>
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
  </nav>

  <!-- Зачем я это делаю прописываю? Мне вот реально делать нечего было кроме как без бэкенда вручную это каля малякать? Ну видимо да. -->
  <div class="modal fade" id="modal1" tabindex="-1" aria-labelledby="modal1Label" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modal1Label">Сейшельская гигантская черепаха</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <img src="content/images/turtle1.jpg" class="modal-img img-fluid mb-3" alt="Сейшельская гигантская черепаха">
          <p>Это <span class="popover-term" tabindex="0" data-bs-toggle="popover" data-bs-title="Эндемик"
              data-bs-content="Вид, который обитает только в одном ограниченном регионе и нигде больше в природе не встречается.">эндемик</span>
            атолла Альдабра. Питается травой, листьями и плодами.</p>
          <p>Известна как <span class="popover-term" tabindex="0" data-bs-toggle="popover" data-bs-title="Долгожитель"
              data-bs-content="Организм с очень большой продолжительностью жизни.">долгожитель</span>: Джонатан,
            родившийся около 1832 года, до сих пор жив на острове Святой Елены.</p>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="modal2" tabindex="-1" aria-labelledby="modal2Label" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modal2Label">Колючий трионикс</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <img src="content/images/turtle2.jpg" class="modal-img img-fluid mb-3" alt="Колючий трионикс">
          <p>Крупная пресноводная <span class="popover-term" tabindex="0" data-bs-toggle="popover"
              data-bs-title="Мягкотелая черепаха"
              data-bs-content="Черепаха без роговых щитков: панцирь покрыт плотной кожей.">мягкотелая черепаха</span>
            Северной Америки. Хорошо плавает и подолгу сидит в иле, выставив наружу только длинный нос.</p>
          <p>Раньше относился к роду Trionyx, а сейчас — к роду <span class="popover-term" tabindex="0"
              data-bs-toggle="popover" data-bs-title="Apalone"
              data-bs-content="Научное название рода американских мягкотелых черепах.">Apalone</span>.</p>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="modal3" tabindex="-1" aria-labelledby="modal3Label" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modal3Label">Кожистая черепаха</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <img src="content/images/turtle3.jpg" class="modal-img img-fluid mb-3" alt="Кожистая черепаха">
          <p>Самая большая из современных черепах и единственный вид семейства <span class="popover-term" tabindex="0"
              data-bs-toggle="popover" data-bs-title="Dermochelyidae"
              data-bs-content="Семейство кожистых черепах; все остальные его представители вымерли.">Dermochelyidae</span>.
            Панцирь у неё не роговой, а кожистый.</p>
          <p>Совершает огромные <span class="popover-term" tabindex="0" data-bs-toggle="popover"
              data-bs-title="Миграции"
              data-bs-content="Регулярные перемещения животных между местами кормления и размножения.">миграции</span>
            через океаны и ныряет на сотни метров.</p>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="modal4" tabindex="-1" aria-labelledby="modal4Label" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modal4Label">Каймановая черепаха</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <img src="content/images/turtle4.jpg" class="modal-img img-fluid mb-3" alt="Каймановая черепаха">
          <p>Свирепая на вид пресноводная черепаха с длинным хвостом и шиповатыми чешуями. Главный признак —
            маленький крестообразный <span class="popover-term" tabindex="0" data-bs-toggle="popover"
              data-bs-title="Пластрон" data-bs-content="Нижняя часть панциря черепахи (брюшной щит).">пластрон</span>.
          </p>
          <p>Часто ждёт добычу на дне, привлекая рыбок червеобразным отростком на языке — это называется <span
              class="popover-term" tabindex="0" data-bs-toggle="popover" data-bs-title="Приманка"
              data-bs-content="Приспособление хищника, имитирующее корм и подманивающее жертву.">приманка</span>.</p>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="modal5" tabindex="-1" aria-labelledby="modal5Label" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modal5Label">Большеголовая черепаха</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <img src="content/images/turtle5.jpg" class="modal-img img-fluid mb-3" alt="Большеголовая черепаха">
          <p>Небольшая черепаха с панцирем до 20 см и огромной головой, которая не убирается внутрь. Верхняя
            челюсть заканчивается острым <span class="popover-term" tabindex="0" data-bs-toggle="popover"
              data-bs-title="Клюв" data-bs-content="Роговой чехол челюстей; у черепах заменяет зубы.">клювом</span>.</p>
          <p>Отлично лазает по камням и ветвям, поэтому её называют <span class="popover-term" tabindex="0"
              data-bs-toggle="popover" data-bs-title="Лазающая"
              data-bs-content="Из-за цепких лап и длинного хвоста черепаха может забираться по ручьям и скалам.">«лазающей»</span>
            черепахой.</p>
        </div>
      </div>
    </div>
  </div>
</body>

</html>