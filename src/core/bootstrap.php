<?php
namespace core;

use Model\Authentication;
use repository\Database;
use Model\DataUserRepository;

$dataBase = new Database();
$connectionDB = $dataBase->connect();

$userRepository = new DataUserRepository($connectionDB);
$authentication = new Authentication($userRepository)

?>