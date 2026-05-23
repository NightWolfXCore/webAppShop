<?php

namespace Model;

use Exception;
use mysqli;
use mysqli_result;
use repository\Database;

class DataUserRepository
{
    private mysqli $dataBase;
    
    public function __construct(mysqli $dataBase)
    {
        $this->dataBase = $dataBase;
    }
    public function getDataUserByID(int $ID): bool|object|null
    {
        $result = null;
        try {
            $sqlQueryGetUser = sprintf("SELECT * FROM `users` WHERE `user_ID` = '%d'", $ID);
            if (($result = mysqli_query($this->dataBase, $sqlQueryGetUser)) === false)
                throw new Exception("Ошибка выдачи информации о пользователе!");
            DataUserRepository::anomalyCheck($result);
            return $result->fetch_object();
        } catch (Exception $ex) {
            die($ex->getMessage());
        }
    }
    public function getDataUserByLogin(string $login): bool|object|null
    {
        $result = null;
        try {
            $sqlQueryGetUser = sprintf("SELECT * FROM `users` WHERE `user_Login` = '%s'", $login);
            if (($result = mysqli_query($this->dataBase, $sqlQueryGetUser)) === false)
                throw new Exception("Ошибка выдачи информации о пользователе!");
            DataUserRepository::anomalyCheck($result);
            return $result->fetch_object();
        } catch (Exception $ex) {
            die($ex->getMessage());
        }
    }

    private static function anomalyCheck(mysqli_result $result): void
    {
        try {
            if (mysqli_num_rows($result) !== 1)
                throw new Exception("Ошибка: пользователя не существует или аномалии в БД, где пользователя > 1");
        } catch (Exception $ex) {
            die($ex->getMessage());
        }
    }
}
