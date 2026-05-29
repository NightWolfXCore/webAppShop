<?php
global $app;
$error = $app->errors->getError();
?>
<section class="section">
    <div class="wrap">
        <section class="error-hero">
            <div class="error-pattern"></div>
            <div class="error-content">
                <div class="error-code">
                    <?= $error["errorCode"] ?>
                </div>
                <div class="error-kicker">
                    Произошла ошибка
                </div>
                <h1 class="error-title">
                    <?= $error["errorTitle"] ?>
                </h1>
                <div class="error-text">
                    <?= $error["errorDescription"] ?>
                </div>
                <div class="error-actions">
                    <a class="btn btn-primary error-button" href="/">
                        Вернуться на главную
                    </a>
                </div>
            </div>
        </section>
    </div>
</section>