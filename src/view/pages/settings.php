<?php if (! isset($_SESSION["user_SESSION"])) header("Location: /") ?>

<!doctype html>
<html lang="ru">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Настройки профиля</title>

  <link rel="stylesheet" href="/assets/css/bootstrap.css">
  <link rel="stylesheet" href="/assets/css/app.css">

  <script src="/assets/js/bootstrap.bundle.min.js" defer></script>
  <script src="/assets/js/app.js" defer></script>
</head>

<body>

  <?php include __DIR__ . '/../patterns/header.php'; ?>

  <main class="page">
    <?php include __DIR__ . '/../patterns/profile/settings-profile.php'; ?>
  </main>

  <?php include __DIR__ . '/../patterns/footer.php'; ?>

</body>

</html>