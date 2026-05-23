<?php
namespace core;

use Model\DataUserRepository;
use repository\Database;


$dataBase = new Database();
$connectionDB = $dataBase->connect();

$userRepository = new DataUserRepository($connectionDB);

?>