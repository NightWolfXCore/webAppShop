<?php
global $app;

$status = (!empty($_GET['status'])) ? (int)$_GET['status'] : 0;
$user_Fullname = (!empty($_GET['user_Fullname'])) ? $_GET['user_Fullname'] : "";
$order = (!empty($_GET['order'])) ? (int)$_GET['order'] : 0;

$orders = $app->orderRepository->getOrderByParameters($order, $user_Fullname, $status);
$status_order = $app->tablesRepository->getAllDataByNameTable('status_order');
// print_r($orders);

?>
<section class="section">
    <div class="wrap">
        <section class="orders-hero admin-hero">
            <div class="orders-pattern"></div>
            <div class="orders-hero-content">
                <div class="orders-kicker">
                    Панель управления
                </div>
                <h1 class="orders-title">
                    Управление заказами
                </h1>
                <div class="orders-text">
                    Просмотр, фильтрация и управление заказами пользователей.
                </div>
            </div>
        </section>
        <div class="orders-layout">
            <aside class="orders-sidebar">
                <div class="orders-box">
                    <div class="orders-box-title">
                        Фильтрация
                    </div>
                    <form class="orders-filters" method="GET" action="/admin/orders">
                        <div class="orders-field">
                            <label>Номер заказа</label>
                            <input type="text" class="form-control input" name="order" value="<? if($order) echo $order ?>" placeholder="Введите номер">
                        </div>
                        <div class="orders-field">
                            <label>Пользователь</label>
                            <input type="text" class="form-control input" name="user_Fullname" value="<?= $user_Fullname ?>" placeholder="ФИО">
                        </div>
                        <div class="orders-field">
                            <label>Статус</label>
                            <select class="form-control input" name="status">
                                <option value="0" <?php if ((int)$status === 0) echo "selected"; ?>>Все</option>
                                <?php foreach ($status_order as $variable): ?>
                                    <option value="<?= htmlspecialchars($variable['status_ID']) ?>" <?php if ((int)$variable['status_ID'] === (int)$status) echo "selected"; ?>><?= htmlspecialchars($variable['status_Type']) ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary orders-filter-button">
                            Применить
                        </button>
                        <a href="/admin/orders" class="btn btn-danger">
                            Сбросить
                        </a>
                    </form>
                </div>
            </aside>
            <div class="orders-content">
                <div class="orders-list">
                    <?php foreach ($orders as $variable): ?>
                        <?php $status_name = $app->tablesRepository->getOneDataByID("status_order", $variable["order_Status"], "status_ID", "status_Type") ?>
                        <?php $payment = $app->tablesRepository->getOneDataByID("payment", $variable["order_payment"], "payment_ID", "payment_Type") ?>
                        <article class="order-card">
                            <div class="order-card-top">
                                <div>
                                    <div class="order-number">
                                        Заказ #<?= htmlspecialchars($variable["order_ID"]) ?>
                                    </div>
                                    <div class="order-date">
                                        <?= htmlspecialchars($variable["order_Datetime"]) ?>
                                    </div>
                                </div>
                                <div class="order-status status-<?= $variable["order_Status"] ?>">
                                    <?= htmlspecialchars($status_name) ?>
                                </div>
                            </div>
                            <div class="admin-order-user">
                                Заказчик: <?= htmlspecialchars($variable["order_Fullname"]) ?>
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
                            <div class="admin-order-actions">
                                <form class="admin-order-controls" method="POST" action="orders/statuschange">
                                    <div class="admin-order-left">
                                        <input type="hidden" name="order_ID" value="<?= htmlspecialchars($variable["order_ID"]) ?>">
                                        <select class="form-control input" name="order_status">
                                            <?php foreach ($status_order as $variable1): ?>
                                                <option value="<?= htmlspecialchars($variable1['status_ID']) ?>" <?php if ((int)$variable1['status_ID'] === (int)$variable["order_Status"]) echo "selected disabled"; ?>>
                                                    <?= htmlspecialchars($variable1['status_Type']) ?>
                                                </option>
                                            <?php endforeach; ?>
                                        </select>
                                        <button type="submit" name="update_order" class="btn btn-primary">
                                            Обновить
                                        </button>
                                        <input type="hidden" name="_returnTo" value="/admin/orders">
                                    </div>
                                </form>
                                <div class="admin-order-right">
                                    <a class="btn btn-primary" href="orders/orderdetails?id=<?= $variable["order_ID"] ?>">
                                        Подробнее
                                    </a>
                                    <form class="admin-order-delete" method="POST" action="orders/deleteorder">
                                        <input type="hidden" name="order_ID" value="<?= htmlspecialchars($variable["order_ID"]) ?>">
                                        <button type="submit" name="delete_order" class="btn btn-danger">
                                            Удалить
                                        </button>
                                        <input type="hidden" name="_returnTo" value="/admin/orders">
                                    </form>
                                </div>
                            </div>
                        </article>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</section>