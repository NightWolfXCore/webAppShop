<?php
global $app;

if (!isset($_SESSION['user_SESSION']))
    header("Location: /");

// Смотря от куда был запрос, возвращает на главную страницу заказов, если в query-параметре нет значения для ключа id
if (empty($idOrder = (int)$_GET['id'] ?? "")) {
    if (substr($_SERVER['REQUEST_URI'], 1, 5) === "admin") {
        header("Location: /admin/orders");
    } else {
        header("Location: /myorders");
    }
}
$order = $app->orderRepository->getOrderByID($idOrder)[0];
if (($order["order_Client"] != $_SESSION['user_SESSION']['user_ID']) & ($_SESSION['user_SESSION']['user_Role'] != "2"))
    header("Location: /problem/accessDenied");
if (($_SESSION['user_SESSION']['user_Role'] === "2") & (substr($_SERVER['REQUEST_URI'], 1, 8) === "myorders") & ($order["order_Client"] != $_SESSION['user_SESSION']['user_ID']))
    header("Location: /admin/orders/orderdetails?id=" . $idOrder);
?>

<!doctype html>
<html lang="ru">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Заказ <?= $idOrder ?></title>

    <link rel="stylesheet" href="/assets/css/bootstrap.css">
    <link rel="stylesheet" href="/assets/css/app.css">

    <?php include __DIR__ . "/../patterns/scripts.php"; ?>
</head>

<body>

    <?php include __DIR__ . '/../patterns/header.php'; ?>

    <main class="page">

        <?php include __DIR__ . "/../patterns/orderdetails/orderDetails-content.php"; ?>

    </main>

    <?php include __DIR__ . '/../patterns/footer.php'; ?>

</body>

</html>