<?php
global $app;
$fullname = sprintf("%s %s %s", $app->userData->user_Surname, $app->userData->user_Firstname, $app->userData->user_Patronymic ?? "");
$phone = $app->userData->user_Phone;
$payments = $app->tablesRepository->getAllDataByNameTable("payment");
?>
<section class="section">
    <div class="wrap">
        <section class="cart-hero">
            <img class="cart-hero-image" src="/assets/img/cart/cart-banner.jpg" alt="Корзина">
            <div class="cart-hero-overlay"></div>
            <div class="cart-hero-content">
                <div class="cart-hero-kicker">
                    Оформление заказа
                </div>
                <h1 class="cart-hero-title">
                    Ваша корзина
                </h1>
                <div class="cart-hero-text">
                    Проверьте выбранные товары, заполните данные доставки и оформите заказ.
                </div>
            </div>
        </section>
        <div class="cart-layout">
            <div class="cart-products">
                <div class="cart-box">
                    <div class="cart-box-head">
                        <div class="cart-box-title">
                            Товары
                        </div>
                        <div class="cart-box-subtitle">
                            <span id="cartPageCount">0</span> товаров
                        </div>
                    </div>
                    <div id="cart-products-list"></div>
                    <div id="cart-empty" class="cart-empty">
                        Корзина пуста
                    </div>
                </div>
            </div>
            <div class="cart-sidebar">
                <form class="cart-box cart-form" action="/cart/submit" method="POST">
                    <div class="cart-box-title">
                        Данные доставки
                    </div>
                    <div class="cart-fields">
                        <input type="hidden" name="order_Client" value="<?= $_SESSION["user_SESSION"]["user_ID"] ?>">
                        <div class="cart-field">
                            <label>ФИО получателя</label>
                            <input type="text" class="form-control input" name="order_FullName" value="<?= $fullname ?>" placeholder="Введите ФИО получателя" required>
                        </div>
                        <div class="cart-field">
                            <label>Адрес доставки</label>
                            <input type="text" class="form-control input" name="order_Address" placeholder="Улица, дом, квартира" required>
                        </div>
                        <div class="cart-field">
                            <label>Комментарий к заказу</label>
                            <textarea class="form-control input cart-textarea" name="order_Comment" placeholder="Дополнительная информация"></textarea>
                        </div>
                    </div>
                    <div class="cart-box-title mt-4">
                        Способ оплаты
                    </div>
                    <div class="cart-payments">
                        <?php foreach ($payments as $variable): ?>
                            <?php if ($variable['payment_active']): ?>
                                <label class="cart-payment">
                                    <input type="radio" name="order_Payment" value="<?= $variable["payment_ID"] ?>" <?= (($variable["payment_ID"] === "1") ? "checked" : null) ?> />
                                    <div class="cart-payment-ui">
                                        <?= $variable["payment_type"] ?>
                                    </div>
                                </label>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </div>
                    <div class="cart-summary">
                        <div class="cart-summary-row">
                            <span>Товары</span>
                            <span id="cart-total-products">
                                0 ₽
                            </span>
                        </div>
                        <div class="cart-summary-row">
                            <span>Доставка</span>
                            <span>
                                Бесплатно
                            </span>
                        </div>
                        <div class="cart-summary-row cart-summary-total">
                            <span>Итого</span>
                            <span id="cart-total-price">
                                0 ₽
                            </span>
                        </div>
                    </div>
                    <input type="hidden" name="order_total_price" id="order-total-price-input">
                    <input type="hidden" name="cart_products" id="cart-products-input">
                    <input type="hidden" name="_returnTo" value="/" placeholder="returnToLink">
                    <button type="submit" id="cart-submit-but" class="btn btn-primary cart-submit">
                        Оформить заказ
                    </button>
                </form>
            </div>
        </div>
    </div>
</section>