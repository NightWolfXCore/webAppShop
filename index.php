<?php
use core\bootstrap;

session_start();
require_once "src/repository/database.php"; // Important (First ever)
require_once "src/model/dataUserRepository.php";
require_once "src/model/dataProductRepository.php";
require_once "src/model/dataOrderRepository.php";
require_once "src/model/dataTablesRepository.php";
require_once "src/model/authentication.php";
require_once "src/model/orders.php";
require_once "src/core/bootstrap.php";

global $app;
$app = new bootstrap();

require_once "src/router/routing.php";
require_once "src/router/router.php";
?>  