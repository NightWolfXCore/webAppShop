<header class="site-header">
  <div class="wrap header-row">
    <a href="/" class="header-logo">
      <img src="/assets/img/logo/logo.svg" alt="Sweet World">
    </a>

    <nav class="top-nav d-none d-lg-flex" aria-label="Навигация">
      <div class="dropdown">
        <button class="nav-btn" type="button" data-bs-toggle="dropdown" data-bs-display="static" aria-expanded="false">
          Каталог <span class="chev" aria-hidden="true"></span>
        </button>
        <ul class="dropdown-menu dd-menu">
          <li><a class="dropdown-item dd-item" href="/catalog">Все категории</a></li>
          <?php require __DIR__ . "/header/catalogMenu.php"; ?>
        </ul>
      </div>

      <form class="search" action="/catalog" method="get" role="search" aria-label="Поиск">
        <input class="form-control input" type="search" name="q" placeholder="Поиск..." autocomplete="off">
        <button class="search-btn" type="submit" aria-label="Найти">
          <svg width="18" height="18" viewBox="0 0 24 24" aria-hidden="true">
            <path d="M10.5 3a7.5 7.5 0 1 0 4.7 13.3l4.5 4.4a1 1 0 0 0 1.4-1.4l-4.4-4.5A7.5 7.5 0 0 0 10.5 3Zm0 2a5.5 5.5 0 1 1 0 11a5.5 5.5 0 0 1 0-11Z" />
          </svg>
        </button>
      </form>

      <div class="dropdown">
        <button class="nav-btn" type="button" data-bs-toggle="dropdown" data-bs-display="static" aria-expanded="false">
          О нас <span class="chev" aria-hidden="true"></span>
        </button>
        <ul class="dropdown-menu dd-menu">
          <li><a class="dropdown-item dd-item" href="/about">Об организации</a></li>
          <li><a class="dropdown-item dd-item" href="/partners">О партнёрах</a></li>
        </ul>
      </div>

      <div class="dropdown">
        <button class="nav-btn" type="button" data-bs-toggle="dropdown" data-bs-display="static" aria-expanded="false">
          Помощь <span class="chev" aria-hidden="true"></span>
        </button>
        <ul class="dropdown-menu dd-menu">
          <li><a class="dropdown-item dd-item" href="/delivery">Доставка и оплата</a></li>
          <li><a class="dropdown-item dd-item" href="/faq">FAQ</a></li>
          <li><a class="dropdown-item dd-item" href="/contacts">Контакты</a></li>
        </ul>
      </div>

      <a class="nav-link cart-link" href="/cart">
        Корзина <span class="badge" id="cartCount">0</span>
      </a>
      
      <!-- <a class="btn btn-soft auth-btn" href="/auth">Авторизация</a> -->
       
      <?php include __DIR__ . "/../patterns/header/buttonAuthProfile.php" ?>
    </nav>

    <button class="burger-btn d-lg-none" type="button" data-bs-toggle="offcanvas" data-bs-target="#mobileMenu" aria-controls="mobileMenu" aria-label="Меню">
      <span class="burger-icon" aria-hidden="true"></span>
    </button>
  </div>
  
  <!-- Mobile menu action -->

  <div class="offcanvas offcanvas-end mobile-menu" tabindex="-1" id="mobileMenu" aria-labelledby="mobileMenuLabel">
    <div class="offcanvas-header">
      <div class="offcanvas-title mobile-title" id="mobileMenuLabel">Меню</div>
      <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Закрыть"></button>
    </div>

    <div class="offcanvas-body">
      <form class="mobile-search" action="/catalog" method="get">
        <input class="form-control input" type="search" name="q" placeholder="Поиск..." autocomplete="off">
        <button class="search-btn" type="submit" aria-label="Найти">
          <svg width="18" height="18" viewBox="0 0 24 24" aria-hidden="true">
            <path d="M10.5 3a7.5 7.5 0 1 0 4.7 13.3l4.5 4.4a1 1 0 0 0 1.4-1.4l-4.4-4.5A7.5 7.5 0 0 0 10.5 3Zm0 2a5.5 5.5 0 1 1 0 11a5.5 5.5 0 0 1 0-11Z" />
          </svg>
        </button>
      </form>

      <div class="accordion acc" id="mobileAcc">
        <div class="accordion-item acc-item">
          <h2 class="accordion-header">
            <button class="accordion-button acc-btn" type="button" data-bs-toggle="collapse" data-bs-target="#accCatalog" aria-expanded="true" aria-controls="accCatalog">
              Каталог
            </button>
          </h2>
          <div id="accCatalog" class="accordion-collapse collapse show" data-bs-parent="#mobileAcc">
            <div class="accordion-body acc-body">
              <a class="m-link" href="/catalog">Все категории</a>
              <a class="m-link" href="/catalog?cat=1">Торты</a>
              <a class="m-link" href="/catalog?cat=2">Пирожные</a>
              <a class="m-link" href="/catalog?cat=3">Капкейки</a>
            </div>
          </div>
        </div>

        <div class="accordion-item acc-item">
          <h2 class="accordion-header">
            <button class="accordion-button collapsed acc-btn" type="button" data-bs-toggle="collapse" data-bs-target="#accAbout" aria-expanded="false" aria-controls="accAbout">
              О нас
            </button>
          </h2>
          <div id="accAbout" class="accordion-collapse collapse" data-bs-parent="#mobileAcc">
            <div class="accordion-body acc-body">
              <a class="m-link" href="/about">Об организации</a>
              <a class="m-link" href="/partners">О партнёрах</a>
            </div>
          </div>
        </div>

        <div class="accordion-item acc-item">
          <h2 class="accordion-header">
            <button class="accordion-button collapsed acc-btn" type="button" data-bs-toggle="collapse" data-bs-target="#accHelp" aria-expanded="false" aria-controls="accHelp">
              Помощь
            </button>
          </h2>
          <div id="accHelp" class="accordion-collapse collapse" data-bs-parent="#mobileAcc">
            <div class="accordion-body acc-body">
              <a class="m-link" href="/delivery">Доставка и оплата</a>
              <a class="m-link" href="/faq">FAQ</a>
              <a class="m-link" href="/contacts">Контакты</a>
            </div>
          </div>
        </div>
      </div>

      <div class="mobile-actions">
        <a class="btn btn-soft w-100" href="/auth">Авторизация</a>
        <a class="btn btn-ghost w-100" href="/cart">Корзина</a>
      </div>
    </div>
  </div>
</header>