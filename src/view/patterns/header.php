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

      <?php if (isset($_SESSION['user_SESSION'])): ?>
      <a class="nav-link cart-link" href="/cart">
        Корзина <span class="badge" id="cartCount">0</span>
      </a>
      <?php endif; ?>

      <!-- <a class="btn btn-soft auth-btn" href="/auth">Авторизация</a> -->
       
      <?php include __DIR__ . "/../patterns/header/buttonAuthProfile.php" ?>
    </nav>

    <button class="burger-btn d-lg-none" type="button" data-bs-toggle="offcanvas" data-bs-target="#mobileMenu" aria-controls="mobileMenu" aria-label="Меню">
      <span class="burger-icon" aria-hidden="true"></span>
    </button>
  </div>
</header>