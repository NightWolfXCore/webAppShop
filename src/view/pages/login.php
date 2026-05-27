<!doctype html>
<html lang="ru">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Авторизация</title>

  <link rel="stylesheet" href="/assets/css/bootstrap.css">
  <link rel="stylesheet" href="/assets/css/app.css">

  <?php include __DIR__ . "/../patterns/scripts.php"; ?>

</head>
<body>

<?php include __DIR__ . '/../patterns/header.php'; ?>

<main class="page auth-page">

  <?php include __DIR__ . '/../patterns/auth/login-form.php'; ?>

</main>

<?php include __DIR__ . '/../patterns/footer.php'; ?>

</body>
</html>