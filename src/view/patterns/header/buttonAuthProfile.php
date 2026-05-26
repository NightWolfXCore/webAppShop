<?php global $app; ?>
<?php if (!isset($_SESSION["user_SESSION"])): ?>
    <a href="/auth" class="btn btn-soft auth-btn">Авторизоваться</a>
<?php else: ?>
    <div class="dropdown">
        <button class="btn btn-soft auth-btn dropdown-toggle" type="button" data-bs-toggle="dropdown"><?= htmlspecialchars($app->userData->FullName) ?></button>
        <ul class="dropdown-menu dropdown-menu-end">
            <li>
                <a class="dropdown-item" href="/profile/settings">Настройки</a>
            </li>
            <?php if ((int)$_SESSION["user_SESSION"]["user_Role"] === 2): ?>
                <li>
                    <hr class="dropdown-divider">

                </li>
                <li>
                    <a class="dropdown-item" href="/admin">Панель администратора</a>
                </li>
            <?php endif; ?>
            <li>
                <hr class="dropdown-divider">
            </li>
            <li>
                <!-- <a class="dropdown-item" href="/logout">Выйти</a> -->
                <form action="/logout" method="post">
                    <button class="dropdown-item">Выйти</button>
                </form>
            </li>
        </ul>
    </div>
<?php endif; ?>