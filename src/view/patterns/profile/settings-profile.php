<main class="page profile-page">
    <div class="wrap">
        <section class="profile-hero">
            <img src="/assets/img/profile/profile-banner.jpg" alt="Настройки профиля" class="profile-hero-image">
            <div class="profile-hero-overlay"></div>
            <div class="profile-hero-content">
                <div class="profile-hero-kicker">Личный кабинет</div>
                <h1 class="profile-hero-title">Настройки профиля</h1>
                <p class="profile-hero-text">
                    Здесь вы можете изменить свои личные данные,
                    контактную информацию и пароль аккаунта.
                </p>
            </div>
        </section>
        <section class="section">
            <div class="profile-box">
                <div class="section-top">
                    <h2 class="section-title">Основная информация</h2>
                    <div class="section-sub">
                        Изменения сохраняются после отправки формы.
                    </div>
                </div>
                <form action="/profile/settings" method="POST" class="profile-form">
                    <div class="profile-grid">
                        <div class="profile-field">
                            <label>ID пользователя</label>
                            <input type="text" value="<?= $user["users_ID"] ?>" disabled>
                        </div>
                        <div class="profile-field">
                            <label>Роль</label>
                            <input type="text" value="<?= $user["users_Role"] ?>" disabled>
                        </div>
                        <div class="profile-field">
                            <label>Логин</label>
                            <input type="text" value="<?= $user["users_Login"] ?>" disabled>
                        </div>
                        <div class="profile-field">
                            <label>Полное имя</label>
                            <input
                                type="text"
                                name="fullname"
                                value="<?= htmlspecialchars($user["users_FullName"]) ?>">
                        </div>
                        <div class="profile-field">
                            <label>Email</label>
                            <input
                                type="email"
                                name="email"
                                value="<?= htmlspecialchars($user["users_Email"]) ?>">
                        </div>
                        <div class="profile-field">
                            <label>Телефон</label>
                            <input
                                type="text"
                                name="phone"
                                value="<?= htmlspecialchars($user["users_Phone"]) ?>">
                        </div>
                        <div class="profile-field">
                            <label>Новый пароль</label>
                            <input
                                type="password"
                                name="password"
                                placeholder="Введите новый пароль">
                        </div>
                    </div>
                    <div class="profile-actions">
                        <button type="submit" class="btn btn-primary profile-save-btn">
                            Сохранить изменения
                        </button>
                        <form action="/logout" method="POST" class="profile-logout-form">
                            <button type="submit" class="btn btn-ghost profile-logout-btn" >
                                Выйти из аккаунта
                            </button>
                        </form>
                    </div>
                </form>
            </div>
        </section>
    </div>
</main>