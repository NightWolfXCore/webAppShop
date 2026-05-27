<?php if (!isset($_SESSION['user_SESSION'])) header("Location: /") ?>

<!doctype html>
<html lang="ru">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Ваша корзина</title>

    <link rel="stylesheet" href="/assets/css/bootstrap.css">
    <link rel="stylesheet" href="/assets/css/app.css">

    <?php include __DIR__ . "/../patterns/scripts.php"; ?>
    <script src="/assets/js/cart-page.js"></script>

</head>

<body>
    <?php include __DIR__ . '/../patterns/header.php'; ?>
    <main class="page">
        <?php include __DIR__ . '/../patterns/cart/cart-content.php'; ?>
    </main>
    <?php include __DIR__ . '/../patterns/footer.php'; ?>
</body>

</html>