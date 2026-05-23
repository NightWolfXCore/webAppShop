<?php

namespace repository;

use mysqli;
use Exception;

class Database
{
    private array $configuration = [
        "host" => "127.0.0.1:3306", // Стандартные хост 
        "user" => "root", // Заходим от суперпользователя root
        "pass" => "", // Пароль
        "dataBase" => "confectioneryshop" // База данных, с которой работаем
    ];

    public ?mysqli $dataBase = null;

    public function connect()
    {
        try {
            $this->dataBase = mysqli_connect(
                $this->configuration["host"],
                $this->configuration["user"],
                $this->configuration["pass"],
                $this->configuration["dataBase"],
            );
            if ($this->dataBase === false)
                throw new Exception("Ошибка подключения");
            $this->dataBase->set_charset("utf8mb4");
            return $this->dataBase;
        } catch (Exception $ex) {
            die($ex->getMessage());
        }
    }
}
