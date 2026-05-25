<?php

namespace core;

use Model\Authentication;
use repository\Database;
use Model\DataUserRepository;
use mysqli;

class bootstrap
{
    public Database $database;
    public mysqli $connectionDB;
    public DataUserRepository $userRepository;
    public Authentication $authentication;
    public ?object $userData;
    public ?object $shopInfo;

    public function __construct()
    {
        $this->database = new Database();
        $this->connectionDB = $this->database->connect();
        $this->userRepository = new DataUserRepository($this->connectionDB);
        $this->authentication = new Authentication($this->userRepository);
        $this->userData = isset($_SESSION["user_SESSION"]) ? $this->userRepository->getDataUserByID($_SESSION["user_SESSION"]["user_ID"]) : null;

        if (isset($_SESSION["user_SESSION"])) {
            if (empty($this->userData->user_Patronymic)) {
                $this->userData->FullName = sprintf("%s. %s", mb_substr($this->userData->user_Firstname, 0, 1),  $this->userData->user_Surname);
            } else {
                $this->userData->FullName = sprintf("%s. %s. %s", mb_substr($this->userData->user_Firstname, 0, 1), mb_substr($this->userData->user_Patronymic, 0, 1), $this->userData->user_Surname);
            }
        }
        $this->shopInfo = mysqli_query($this->connectionDB, "SELECT * FROM `shop_info` WHERE `id` = 0")->fetch_object();
    }
}
