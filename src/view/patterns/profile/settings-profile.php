<?php global $app;
$role_type = $app->tablesRepository->getOneDataByID('roles', $_SESSION['user_SESSION']['user_Role'], 'role_ID', 'role_Type');
?>

<main class="page profile-page">
    <div class="wrap">
        <section class="profile-hero">
            <img src="/assets/img/cakes/cake_2_0.jpg" alt="Настройки профиля" class="profile-hero-image">
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
                <form action="/profile/settings/change" method="POST" class="profile-form">
                    <div class="profile-grid">
                        <div class="profile-field input-died-wrapper">
                            <label>ID пользователя</label>
                            <input type="text" class="input-died" name="user_ID" value="<?= $app->userData->user_ID ?>">
                        </div>
                        <div class="profile-field input-died-wrapper">
                            <label>Роль</label>
                            <input type="text" class="input-died" name="user_Role" value="<?= $role_type ?>">
                        </div>
                        <div class="profile-field input-died-wrapper">
                            <label>Логин</label>
                            <input type="text" class="input-died" name="user_Login" value="<?= $app->userData->user_Login ?>">
                        </div>
                        <div class="profile-field">
                            <label>Фамилия</label>
                            <input type="text" name="user_Surname" value="<?= htmlspecialchars($app->userData->user_Surname) ?>">
                        </div>
                        <div class="profile-field">
                            <label>Имя</label>
                            <input type="text" name="user_Firstname" value="<?= htmlspecialchars($app->userData->user_Firstname) ?>">
                        </div>
                        <div class="profile-field">
                            <label>Отчество</label>
                            <input type="text" name="user_Patronymic" value="<?= htmlspecialchars($app->userData->user_Patronymic) ?>" placeholder="при наличии">
                        </div>
                        <div class="profile-field">
                            <label>Email</label>
                            <input type="email" name="user_Email" value="<?= htmlspecialchars($app->userData->user_Email) ?>">
                        </div>
                        <div class="profile-field">
                            <label>Телефон</label>
                            <input type="text" name="user_Phone" value="<?= htmlspecialchars($app->userData->user_Phone) ?>">
                        </div>
                        <div class="profile-field">
                            <label>Новый пароль</label>
                            <input type="password" name="user_Password" placeholder="Введите новый пароль">
                        </div>
                    </div>
                    <div class="profile-actions">
                        <button type="submit" class="btn btn-primary profile-save-btn">
                            Сохранить изменения
                        </button>
                    </div>
                </form>
                <form action="/logout" method="POST" class="profile-logout-form">
                    <button type="submit" class="btn btn-ghost profile-logout-btn">
                        Выйти из аккаунта
                    </button>
                    <input class="invisible" name="_returnTo" value="/" placeholder="returnToLink">
                </form>
            </div>
        </section>
    </div>
</main>