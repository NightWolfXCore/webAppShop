<section class="section">
  <div class="wrap">

    <div class="auth-layout">

      <div class="auth-side">

        <img
          class="auth-side-image"
          src="/assets/img/cakes/cake1.jpg"
          alt="Регистрация">

        <div class="auth-side-overlay"></div>

        <div class="auth-side-content">

          <div class="auth-side-kicker">
            Новый аккаунт
          </div>

          <h1 class="auth-side-title">
            Присоединяйтесь
          </h1>

          <div class="auth-side-text">
            Создайте аккаунт для оформления заказов, сохранения адресов доставки и отслеживания покупок.
          </div>

        </div>

      </div>

      <div class="auth-card">

        <div class="auth-head">

          <h1 class="auth-title">
            Регистрация
          </h1>

          <div class="auth-sub">
            Создание нового аккаунта
          </div>

        </div>

        <form class="auth-form" action="/register" method="POST">

          <div class="auth-grid">

            <div class="auth-field">
              <label class="auth-label">
                <span class="auth-icon">👤</span>
                Логин
              </label>

              <input
                class="form-control auth-input"
                type="text"
                name="user_Login"
                placeholder="Введите логин"
                required>
            </div>

            <div class="auth-field">
              <label class="auth-label">
                <span class="auth-icon">📧</span>
                Электронная почта
              </label>

              <input
                class="form-control auth-input"
                type="email"
                name="user_Email"
                placeholder="example@mail.com"
                required>
            </div>

            <div class="auth-field">
              <label class="auth-label">
                <span class="auth-icon">📱</span>
                Номер телефона
              </label>

              <input
                class="form-control auth-input"
                type="tel"
                name="user_Phone"
                placeholder="+7 (999) 999-99-99"
                required>
            </div>

            <div class="auth-field">
              <label class="auth-label">
                <span class="auth-icon">🪪</span>
                Фамилия
              </label>

              <input
                class="form-control auth-input"
                type="text"
                name="user_Surname"
                placeholder="Введите фамилию"
                required>
            </div>

            <div class="auth-field">
              <label class="auth-label">
                <span class="auth-icon">📝</span>
                Имя
              </label>

              <input
                class="form-control auth-input"
                type="text"
                name="user_Name"
                placeholder="Введите имя"
                required>
            </div>

            <div class="auth-field">
              <label class="auth-label">
                <span class="auth-icon">📝</span>
                Отчество
              </label>

              <input
                class="form-control auth-input"
                type="text"
                name="user_Patronymic"
                placeholder="При наличии">
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
                placeholder="Введите пароль"
                required>
            </div>

            <div class="auth-field">
              <label class="auth-label">
                <span class="auth-icon">🔐</span>
                Повтор пароля
              </label>

              <input
                class="form-control auth-input"
                type="password"
                name="user_Password_Repeat"
                placeholder="Повторите пароль"
                required>
            </div>

          </div>

          <div class="auth-checks">

            <label class="auth-check">

              <input
                class="auth-check-input"
                type="checkbox"
                name="agreement"
                required>

              <span class="auth-check-ui"></span>

              <span class="auth-check-text">
                Я принимаю пользовательское соглашение
              </span>

            </label>

            <label class="auth-check">

              <input
                class="auth-check-input"
                type="checkbox"
                name="privacy"
                required>

              <span class="auth-check-ui"></span>

              <span class="auth-check-text">
                Я согласен с политикой конфиденциальности
              </span>

            </label>

          </div>

          <button class="btn btn-primary auth-submit" type="submit">
            Зарегистрироваться
          </button>

          <div class="auth-link">
            <a href="/auth">Авторизоваться в существующую уч. запись</a>
          </div>

          <div class="invisible">
            <input name="_returnTo" value="/" placeholder="returnToLink">
          </div>

        </form>

      </div>

    </div>

  </div>
</section>