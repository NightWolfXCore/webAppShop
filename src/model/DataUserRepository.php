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
            self::anomalyCheck($result);
            return $result->fetch_object();
        } catch (Exception $ex) {
            die($ex->getMessage());
        }
    }


    public function insertDataUser(array $userData)
    {
        try {
            $user_Login = $userData["user_Login"];
            $user_Email = $userData["user_Email"];
            $user_Phone = $userData["user_Phone"];
            $user_Surname = $userData["user_Surname"];
            $user_Firstname = $userData["user_Name"];
            $user_Patronymic = $userData["user_Patronymic"] ?? "";
            $user_Password = $userData["user_Password"];

            $initialDataUser = $this->getDataUserByLogin($user_Login);

            self::existUser($initialDataUser);

            $sqlQueryInsertUser = sprintf("INSERT INTO `users`(`user_Login`, `user_Email`, `user_Phone`, `user_Surname`, `user_Firstname`, `user_Patronymic`, `user_Password`) VALUES
            ('%s', '%s', '%s', '%s', '%s')", $user_Login, $user_Email, $user_Phone, $user_Surname, $user_Firstname, ((!empty($user_Patronymic) ? $user_Patronymic : "NULL")), password_hash($user_Password['pass'], PASSWORD_BCRYPT));

            $result = mysqli_query($this->dataBase, $sqlQueryInsertUser);

            if (!$result)
                throw new Exception("Ошибка при вставке пользователя: возможно, почта или телефон уже используются другим пользователем");

            return $result;
        } catch (Exception $ex) {
            die($ex->getMessage());
        }
    }
    
    private static function existUser(mysqli_result $result): void
    {
        try {
            if (mysqli_num_rows($result) === 1)
                throw new Exception("Данный пользователь уже существует по данному логину!");
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
