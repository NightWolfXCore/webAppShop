<?php

namespace Model;

use Exception;
use mysqli;
use mysqli_result;

class DataUserRepository
{
    private mysqli $dataBase;

    public function __construct(mysqli $dataBase)
    {
        $this->dataBase = $dataBase;
    }
    public function getDataUserByID(int $ID, int $parametr = 0): bool|object|null
    {
        $result = null;
        try {
            $sqlQueryGetUser = sprintf("SELECT * FROM `users` WHERE `user_ID` = '%d'", $ID);
            if (($result = mysqli_query($this->dataBase, $sqlQueryGetUser)) === false)
                throw new Exception("Ошибка выдачи информации о пользователе!");
            self::anomalyCheck($result, $parametr);
            return $result->fetch_object();
        } catch (Exception $ex) {
            die($ex->getMessage());
        }
    }
    public function getDataUserByLogin(string $login, int $parametr = 0): bool|object|null
    {
        $result = null;
        try {
            $sqlQueryGetUser = sprintf("SELECT * FROM `users` WHERE `user_Login` = '%s'", $login);
            if (($result = mysqli_query($this->dataBase, $sqlQueryGetUser)) === false)
                throw new Exception("Ошибка выдачи информации о пользователе!");
            self::anomalyCheck($result, $parametr);
            return $result->fetch_object();
        } catch (Exception $ex) {
            die($ex->getMessage());
        }
    }


    public function insertDataUser(array $userData): bool|null
    {
        try {
            foreach ($userData as $key => $value) {
                if ($key === "user_Patronymic") {
                    $$key = $value ?? "";
                } else {
                    $$key = $value;
                }
            }

            $initialDataUser = $this->getDataUserByLogin($user_Login, 1);

            $sqlQueryInsertUser = sprintf("INSERT INTO `users`(`user_Login`, `user_Email`, `user_Phone`, `user_Surname`, `user_Firstname`, `user_Patronymic`, `user_Password`) VALUES
            ('%s', '%s', '%s', '%s', '%s', %s, '%s')", $user_Login, $user_Email, $user_Phone, $user_Surname, $user_Firstname, (empty($user_Patronymic) ? "NULL" : htmlspecialchars("'" . $user_Patronymic . "'", ENT_NOQUOTES)), password_hash($user_Password, PASSWORD_BCRYPT));

            $result = mysqli_query($this->dataBase, $sqlQueryInsertUser);

            if (!$result)
                throw new Exception("Ошибка при вставке пользователя: возможно, почта или телефон уже используются другим пользователем");

            return $result;
        } catch (Exception $ex) {
            die($ex->getMessage());
        }
    }

    public function updateUser(array $userData): bool|null
    {
        $result = null;
        try {
            $initialDataUser = $this->getDataUserByID($userData["user_ID"]);
            $userData = self::emptyCheck($userData, $initialDataUser);
            foreach ($userData as $key => $value) {
                $$key = $value;
            }
            $sqlQueryUpdateUser = sprintf("UPDATE `users` SET
            `user_Email`='%s',        `user_Phone`='%s',
            `user_Surname`='%s',      `user_Firstname`='%s',
            `user_Patronymic`=%s,   `user_Password`='%s'
            WHERE `user_ID` = '%s'", $user_Email, $user_Phone, $user_Surname, $user_Firstname, (empty($user_Patronymic) ? "NULL" : htmlspecialchars("'" . $user_Patronymic . "'", ENT_NOQUOTES)), ((password_needs_rehash($user_Password, PASSWORD_BCRYPT)) ? password_hash($user_Password, PASSWORD_BCRYPT) : $user_Password), $user_ID);

            $result = mysqli_query($this->dataBase, $sqlQueryUpdateUser);

            if (!$result)
                throw new Exception("Ошибка при обновлении пользователя: возможно, каких-то данные не хватает");

            return $result;
        } catch (Exception $ex) {
            die($ex->getMessage());
        }
    }

    public function checkAdminPermission(): void
    {
        $result = null;
        try {
            $userData = $this->getDataUserByID($_SESSION['user_SESSION']['user_ID']);
            
            $user_Role = (int)$userData->user_Role;
            
            if ($user_Role !== 2)
                header("Location: /problem/accessDenied");
        } catch (Exception $ex) {
            die($ex->getMessage());
        }
    }

    private static function emptyCheck(array $userData, object $initialDataUser): array|bool
    {
        try {
            foreach ($userData as $key => $value) {
                if (empty($userData[$key])) {
                    if ($key === "user_Patronymic") continue;
                    $userData[$key] = $initialDataUser->$key;
                }
            }
            return $userData;
        } catch (Exception $ex) {
            die($ex->getMessage());
        }
    }

    private static function existUser(mysqli_result $result): void
    {
        try {
            if (mysqli_num_rows($result) === 1)
                throw new Exception("Данный пользователь уже существует!");
        } catch (Exception $ex) {
            die($ex->getMessage());
        }
    }

    private static function anomalyCheck(mysqli_result $result, int $parametr = 0): void
    {
        try {
            switch ($parametr) {
                case 0: {
                        if (mysqli_num_rows($result) !== 1)
                            throw new Exception("Ошибка: пользователя не существует или аномалии в БД, где пользователя > 1");
                    };
                    break;
                case 1: {
                        if (mysqli_num_rows($result) >= 1)
                            throw new Exception("Ошибка: пользователя уже существует или аномалии в БД, где пользователя > 1");
                    };
                    break;
            }
        } catch (Exception $ex) {
            die($ex->getMessage());
        }
    }
}
