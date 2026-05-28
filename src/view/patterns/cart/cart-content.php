<?php
global $app;
$fullname = sprintf("%s %s %s", $app->userData->user_Surname, $app->userData->user_Firstname, $app->userData->user_Patronymic ?? "");
$phone = $app->userData->user_Phone;
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
                        <div class="cart-field">
                            <label>ФИО получателя</label>
                            <input type="text" class="form-control input" name="user_FullName" value="<?= $fullname ?>" placeholder="Введите имя">
                        </div>
                        <div class="cart-field">
                            <label>Телефон</label>
                            <input type="text" class="form-control input" name="user_Phone" value="<?= $phone ?>" placeholder="+7 (999) 999-99-99">
                        </div>
                        <div class="cart-field">
                            <label>Адрес доставки</label>
                            <input type="text" class="form-control input" placeholder="Улица, дом, квартира">
                        </div>
                        <div class="cart-field">
                            <label>Комментарий к заказу</label>
                            <textarea class="form-control input cart-textarea" placeholder="Дополнительная информация"></textarea>
                        </div>
                    </div>
                    <div class="cart-box-title mt-4">
                        Способ оплаты
                    </div>
                    <div class="cart-payments">
                        <label class="cart-payment">
                            <input type="radio" name="payment" checked>
                            <div class="cart-payment-ui">
                                Оплата картой
                            </div>
                        </label>
                        <label class="cart-payment">
                            <input type="radio" name="payment">

                            <div class="cart-payment-ui">
                                Наличными курьеру
                            </div>
                        </label>
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
                    <input type="hidden" name="cart_products" id="cart-products-input">
                    <div class="invisible">
                        <input name="_returnTo" value="/" placeholder="returnToLink">
                    </div>
                    <button type="submit" id="cart-submit-but" class="btn btn-primary cart-submit">
                        Оформить заказ
                    </button>
                </form>
            </div>
        </div>
    </div>
</section>