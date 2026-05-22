<section class="section">
  <div class="wrap">

    <div class="auth-layout">

      <div class="auth-side">

        <img
          class="auth-side-image"
          src="/assets/img/cakes/cake0.jpg"
          alt="Авторизация">

        <div class="auth-side-overlay"></div>

        <div class="auth-side-content">
          <div class="auth-side-kicker">
            Личный кабинет
          </div>

          <h1 class="auth-side-title">
            Добро пожаловать
          </h1>

          <div class="auth-side-text">
            Авторизуйтесь для оформления заказов и отслеживания покупок.
          </div>
        </div>

      </div>

      <div class="auth-card">

        <div class="auth-head">
          <h2 class="auth-title">
            Авторизация
          </h2>

          <div class="auth-sub">
            Введите логин и пароль
          </div>
        </div>

        <form class="auth-form" action="/login" method="POST">

          <div class="auth-field">

            <label class="auth-label">
              <span class="auth-icon">👤</span>
              Логин
            </label>

            <input
              class="form-control auth-input"
              type="text"
              name="user_Login"
              placeholder="Введите логин">

          </div>

          <div class="auth-field">

            <label class="auth-label">
              <span class="auth-icon">🔒</span>
              Пароль
            </label>

            <input
              class="form-control auth-input"
              type="password"
              name="user_Password"
              placeholder="Введите пароль">

          </div>

          <button class="btn btn-primary auth-submit" type="submit">
            Войти
          </button>

          <div class="auth-links">
            <a href="/recoveryPass">Забыли пароль?</a>
            <a href="/registerNewUser">Регистрация</a>
          </div>

          <div class="invisible">
            <input name="_returnTo" value="/" placeholder="returnToLink">
          </div>

        </form>

      </div>

    </div>

  </div>
</section>