<!doctype html>
<html lang="ru">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Успешный заказ!</title>
    <link rel="stylesheet" href="/assets/css/bootstrap.css">
    <link rel="stylesheet" href="/assets/css/app.css">
    <?php include __DIR__ . "/../patterns/scripts.php"; ?>
    <script>
        localStorage.removeItem('confectionery_cart');
        const cartBadge = document.getElementById('cartCount');
        if (cartBadge) {
            cartBadge.textContent = 0;
        }
    </script>
</head>

<body>
    <?php include __DIR__ . '/../patterns/header.php'; ?>
    <main class="page">
        <?php include __DIR__ . '/../patterns/order/orderSuccess-content.php'; ?>
    </main>
    <?php include __DIR__ . '/../patterns/footer.php'; ?>
</body>

</html>