<?php
if (!isset($_SESSION['user_SESSION']))
    header("Location: /");

// Смотря от куда был запрос, возвращает на главную страницу заказов, если в query-параметре нет значения для ключа id
if (empty($idOrder = $_GET['id'] ?? "")) {
    if (substr($_SERVER['REQUEST_URI'], 1, 5) === "admin") {
        header("Location: /admin/orders");
    } else {
        header("Location: /myorders");
    }
}
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