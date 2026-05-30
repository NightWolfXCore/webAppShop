<?php
global $app;

if (!isset($_SESSION['user_SESSION'])) {
  header("Location: /");
  die();
}


if ($_SESSION['user_SESSION']['user_Role'] !== "2") {
  $app->errors->setCode(403);
  header("Location: /problem/accessDenied");
  die();
}
?>

<!doctype html>
<html lang="ru">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Панель администратора</title>

  <link rel="stylesheet" href="/../assets/css/bootstrap.css">
  <link rel="stylesheet" href="/../assets/css/app.css">

  <?php include __DIR__ . "/../../patterns/scripts.php"; ?>
</head>

<body>

  <?php include __DIR__ . '/../../patterns/header.php'; ?>

  <main class="page">

    <?php include __DIR__ . '/../../patterns/adminpanel/adminpanel-orders-content.php'; ?>

  </main>

  <?php include __DIR__ . '/../../patterns/footer.php'; ?>

</body>

</html>