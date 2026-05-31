<?php
global $app;

$idOrder = $_GET['id'] ?? 0;

$order = $app->orderRepository->getOrderByID($idOrder)[0];
$products = $app->orderRepository->getProductsInTheOrderByID($idOrder);
$product_DemoPhoto = $products[0]["product_DemoPhoto"];
$status_order = $app->tablesRepository->getAllDataByNameTable('status_order');
$status_name = $app->tablesRepository->getOneDataByID("status_order", $order["order_Status"], "status_ID", "status_Type");
$payment = $app->tablesRepository->getOneDataByID("payment", $order["order_payment"], "payment_ID", "payment_Type");
?>

<section class="section">
    <div class="wrap">
        <section class="orders-hero">

            <div class="orders-hero-image"
                style="background-image:url('/assets/img/<?= htmlspecialchars($products[0]["product_DemoPhoto"] ?? "default.webp") ?>')">
            </div>

            <div class="orders-hero-overlay"></div>

            <div class="orders-pattern"></div>
            <div class="orders-hero-content">
                <div class="orders-kicker">
                    Детали заказа
                </div>
                <h1 class="orders-title">
                    Заказ #<?= $order["order_ID"] ?>
                </h1>
                <div class="orders-text">
                    Подробная информация о заказе, доставке и приобретённых товарах.
                </div>
            </div>
        </section>
        <div class="order-details-layout">
            <div class="order-details-main">
                <div class="order-details-box">
                    <div class="order-details-title">
                        Состав заказа
                    </div>
                    <div class="order-details-products">
                        <?php foreach ($products as $variable): ?>
                            <div class="order-details-product">
                                <img src="/assets/img/<?= $variable["product_DemoPhoto"] ?>" alt="<?= $variable["product_Name"] ?>">
                                <div class="order-details-product-content">
                                    <div class="order-details-product-title">
                                        <?= $variable["product_Name"] ?>
                                    </div>
                                    <div class="order-details-product-description">
                                        <?= $variable["product_Description"] ?>
                                    </div>
                                    <div class="order-details-product-meta">
                                        Количество: <?= $variable["position_Quantity"] ?>
                                    </div>
                                </div>
                                <div class="order-details-product-price">
                                    <?= $variable["position_Cost"] * $variable["position_Quantity"] ?> ₽
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
            <aside class="order-details-sidebar">
                <div class="order-details-box">
                    <div class="order-details-title">
                        Информация о заказе
                    </div>

                    <div class="order-details-info">
                        <div class="order-details-row">
                            <span>Номер заказа</span>
                            <strong>#<?= $order["order_ID"] ?></strong>
                        </div>
                        <div class="order-details-row">
                            <span>Статус</span>
                            <div class="order-details-row-status-<?= $order["order_Status"] ?>">
                                <strong><?= $status_name ?></strong>
                            </div>
                        </div>
                        <div class="order-details-row">
                            <span>Дата</span>
                            <strong><?= $order["order_Datetime"] ?></strong>
                        </div>
                        <div class="order-details-row">
                            <span>Способ оплаты</span>
                            <strong><?= $payment ?></strong>
                        </div>
                        <div class="order-details-row">
                            <span>Стоимость</span>
                            <strong><?= $order["order_FinalCost"] ?> ₽</strong>
                        </div>
                    </div>
                </div>
                <div class="order-details-box">
                    <div class="order-details-title">
                        Доставка
                    </div>
                    <div class="order-details-info">
                        <div class="order-details-row">
                            <span>Получатель</span>
                            <strong><?= $order["order_Fullname"] ?></strong>
                        </div>
                        <div class="order-details-row">
                            <span>Адрес</span>
                            <strong><?= $order["order_address"] ?></strong>
                        </div>
                    </div>
                </div>
                <?php if ($_SESSION["user_SESSION"]["user_Role"] === "2"): ?>
                    <div class="order-details-box">
                        <div class="order-details-title">
                            Управление заказом
                        </div>
                        <form method="POST" class="admin-order-form" action="/admin/orders/statuschange">
                            <input type="hidden" name="order_ID" value="<?= $order["order_ID"] ?>">
                            <div class="orders-field">
                                <label>Статус</label>
                                <select name="order_status" class="form-control input">
                                    <?php foreach ($status_order as $variable): ?>
                                        <option value="<?= htmlspecialchars($variable['status_ID']) ?>" <?php if ((int)$variable['status_ID'] === (int)$order['order_Status']) echo "selected disabled"; ?>><?= htmlspecialchars($variable['status_Type']) ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="admin-order-buttons">
                                <button type="submit" name="update_order" class="btn btn-primary">
                                    Обновить заказ
                                </button>
                                <button type="submit" name="delete_order" class="btn btn-danger">
                                    Удалить заказ
                                </button>
                            </div>
                        </form>
                    </div>
                <?php endif; ?>
            </aside>
        </div>
    </div>
</section>