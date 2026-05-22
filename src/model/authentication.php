<?php

namespace Model;

use Exception;
use repository\Database;

class Authentication
{

    public static function login(array $newData)
    {
        $result = null;
        try {
            $dataUser = new DataUser();
            $initialDataUser = DataUser::getDataUserByLogin($newData["user_Login"]);
            if (mysqli_num_rows($initialDataUser) === 1) {
                $initialDataUserObject = $initialDataUser->fetch_object();
                if (password_verify($newData["user_Password"], $initialDataUserObject->user_Password)) {
                    $_SESSION["user_SESSION"] = [
                        "user_ID" => $initialDataUserObject->user_ID,
                        "user_Login" => $initialDataUserObject->user_Login,
                        "user_Role" => $initialDataUserObject->user_Role
                    ];
                } else {
                    throw new Exception("Ошибка аутентификации: неверный пароль");
                }
            } else {
                throw new Exception("Ошибка аутентификации: данного пользователя в базе не существует!");
            }
        } catch (Exception $ex) {
            die($ex->getMessage());
        }
    }

    public static function logout(array $newData = [])
    {
        $result = null;
        try {
            if (!isset($_SESSION["user_SESSION"])) 
                throw new Exception("Forbidden");
            unset($_SESSION["user_SESSION"]);
        } catch (Exception $ex) {
            die($ex->getMessage());
        }
    }

    public static function register(array $newData)
    {
        $result = null;
        try {
            $user_Login = $newData["user_Login"];
            $user_Email = $newData["user_Email"];
            $user_Phone = $newData["user_Phone"];
            $user_Surname = $newData["user_Surname"];
            $user_Firstname = $newData["user_Name"];
            $user_Patronymic = $newData["user_Patronymic"] ?? "";
            $user_Password = [
                "pass" => $newData["user_Password"],
                "confirm" => $newData["user_Password_Repeat"]
            ];

            if ($user_Password['pass'] !== $user_Password['confirm'])
                throw new Exception("Пароли не совпадают!");

            $initialDataUser = DataUser::getDataUserByLogin($user_Login);
            if (mysqli_num_rows($initialDataUser) === 1)
                throw new Exception("Данный пользователь уже существует по данному логину!");

            $sqlQueryInsertUser = sprintf("INSERT INTO `users`(`user_Login`, `user_Email`, `user_Phone`, `user_Surname`, `user_Firstname`, `user_Patronymic`, `user_Password`) VALUES
            ('%s', '%s', '%s', '%s', '%s')", $user_Login, $user_Email, $user_Phone, $user_Surname, $user_Firstname, ((!empty($user_Patronymic) ? $user_Patronymic : "NULL")), password_hash($user_Password['pass'], PASSWORD_BCRYPT));

            $result = mysqli_query(Database::connect(), $sqlQueryInsertUser);
            if (!$result)
                throw new Exception("Ошибка при регистрации пользователя: возможно, почта или телефон уже используются другим пользователем");

            Authentication::login(
                [
                    "user_Login" => $user_Login,
                    "user_Password" => $user_Password['pass']
                ]
            );
        } catch (Exception $ex) {
            die($ex->getMessage());
        }
    }
}
