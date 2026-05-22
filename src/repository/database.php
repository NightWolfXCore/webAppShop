<?php

namespace repository;

use Exception;

class Database
{
    public static $dataBase = [
        "host" => "127.0.0.1:3306", // Стандартные хост 
        "user" => "root", // Заходим от суперпользователя root
        "pass" => "", // Пароль
        "dataBase" => "confectioneryshop" // База данных, с которой работаем
    ];

    public static function connect()
    {
        try {
            $result = mysqli_connect(
                self::$dataBase["host"],
                self::$dataBase["user"],
                self::$dataBase["pass"],
                self::$dataBase["dataBase"],
            );
            if ($result === false)
                throw new Exception("Ошибка подключения");
            $result->set_charset("utf8mb4");
            return $result;
        } catch (Exception $ex) {
            die($ex->getMessage());
        }
    }
}
