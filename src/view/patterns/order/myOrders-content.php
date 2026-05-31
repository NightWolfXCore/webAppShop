<?php
global $app;

$status = (isset($_GET['status'])) ? (int)$_GET['status'] : 0;
$order = (isset($_GET['order'])) ? (int)$_GET['order'] : 0;

$myOrders = $app->orderRepository->getOrdersByUserID($_SESSION['user_SESSION']['user_ID'], $order, $status);
$status_order = $app->tablesRepository->getAllDataByNameTable('status_order');
?>

<section class="section">
    <div class="wrap">
        <section class="orders-hero orders-hero-myorders">
            <div class="orders-pattern"></div>
            <div class="orders-hero-content">
                <div class="orders-kicker">
                    Личный кабинет
                </div>
                <h1 class="orders-title">
                    Мои заказы
                </h1>
                <div class="orders-text">
                    История ваших заказов и текущие статусы обработки.
                </div>
            </div>
        </section>
        <div class="orders-layout">
            <aside class="orders-filters">
                <div class="orders-box">
                    <div class="orders-box-title">
                        Фильтрация
                    </div>
                    <form class="orders-filters" method="GET">
                        <div class="orders-field">
                            <label>Номер заказа</label>
                            <input type="text" class="form-control input" name="order" value="<? if ($order) echo $order ?>" placeholder="Введите номер">
                        </div>
                        <div class="orders-field">
                            <label>Статус</label>
                            <select class="form-control input" name="status">
                                <option value="0" <?php if ($status === 0) echo "selected"; ?>>Все</option>
                                <?php foreach ($status_order as $variable): ?>
                                    <option value="<?= htmlspecialchars($variable['status_ID']) ?>" <?php if ((int)$variable['status_ID'] === $status) echo "selected"; ?>><?= htmlspecialchars($variable['status_Type']) ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary orders-filter-button">
                            Применить
                        </button>
                        <a href="/myorders" class="btn btn-danger">
                            Сбросить
                        </a>
                    </form>
                </div>
                <?php if ($_SESSION['user_SESSION']['user_Role'] === "2"): ?>
                    <a href="/admin/orders" class="btn btn-primary">
                        Панель администратора
                    </a>
                <?php endif; ?>
            </aside>
            <div class="orders-content">
                <div class="orders-list">
                    <?php foreach ($myOrders as $variable): ?>
                        <?php $status_name = $app->tablesRepository->getOneDataByID("status_order", $variable["order_Status"], "status_ID", "status_Type") ?>
                        <?php $payment = $app->tablesRepository->getOneDataByID("payment", $variable["order_payment"], "payment_ID", "payment_Type") ?>
                        <article class="order-card">
                            <div class="order-card-top">
                                <div>
                                    <div class="order-number">
                                        Заказ #<?= htmlspecialchars($variable["order_ID"]) ?>
                                    </div>
                                    <div class="order-date">
                                        <?= $variable["order_Datetime"] ?>
                                    </div>
                                </div>
                                <div class="order-status status-<?= htmlspecialchars($variable["order_Status"]) ?>">
                                    <?= htmlspecialchars($status_name) ?>
                                </div>
                            </div>
                            <div class="order-info">
                                <div class="order-info-item">
                                    <span>Сумма</span>
                                    <strong><?= htmlspecialchars($variable["order_FinalCost"]) ?> ₽</strong>
                                </div>
                                <div class="order-info-item">
                                    <span>Оплата</span>
                                    <strong><?= htmlspecialchars($payment) ?></strong>
                                </div>
                                <div class="order-info-item">
                                    <span>Адрес</span>
                                    <strong><?= htmlspecialchars($variable["order_address"]) ?></strong>
                                </div>
                            </div>
                            <div class="order-actions">
                                <a class="btn btn-soft" href="/myorders/orderdetails?id=<?= htmlspecialchars($variable["order_ID"]) ?>">
                                    Подробнее
                                </a>
                            </div>
                        </article>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</section>