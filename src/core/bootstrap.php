<?php

namespace core;

use Model\Authentication;
use repository\Database;
use Model\DataUserRepository;
use Model\DataProductRepository;
use Model\DataOrderRepository;
use Model\DataTablesRepository;
use Model\Orders;
use mysqli;

class bootstrap
{
    public Database $database; // classic database object for connect to mysql
    public mysqli $connectionDB; // object for keep connection (sorry for my grammar)
    public DataUserRepository $userRepository;
    public DataProductRepository $productRepository;
    public DataOrderRepository $orderRepository;
    public DataTablesRepository $tablesRepository;
    public Authentication $authentication;
    public Orders $orders;
    public ?object $userData;
    public ?object $productData; 

    public ?object $shopInfo;

    public function __construct()
    {
        // Initialization all of variables (objects of custom classes, objects of stdclass)
        $this->database = new Database();
        $this->connectionDB = $this->database->connect();

        $this->userRepository = new DataUserRepository($this->connectionDB);
        $this->authentication = new Authentication($this->userRepository);
        $this->userData = isset($_SESSION["user_SESSION"]) ? $this->userRepository->getDataUserByID($_SESSION["user_SESSION"]["user_ID"]) : null;

        $this->productRepository = new DataProductRepository($this->connectionDB);

        $this->tablesRepository = new DataTablesRepository($this->connectionDB);

        $this->orderRepository = new DataOrderRepository($this->connectionDB);
        $this->orders = new orders($this->orderRepository, $this->userRepository);

        // FullName User initialization
        if (isset($_SESSION["user_SESSION"])) {
            if (empty($this->userData->user_Patronymic)) {
                $this->userData->FullName = sprintf("%s. %s", mb_substr($this->userData->user_Firstname, 0, 1),  $this->userData->user_Surname);
            } else {
                $this->userData->FullName = sprintf("%s. %s. %s", mb_substr($this->userData->user_Firstname, 0, 1), mb_substr($this->userData->user_Patronymic, 0, 1), $this->userData->user_Surname);
            }
        }
        // Get info about shop
        $this->shopInfo = mysqli_query($this->connectionDB, "SELECT * FROM `shop_info` WHERE `id` = 0")->fetch_object();
    }
}
