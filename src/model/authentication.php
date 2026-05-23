<?php

namespace Model;

use Exception;
use repository\Database;

class Authentication
{
    public static function login(array $DataForm)
    {
        $result = null;
        try {
            $initialDataUser = ->getDataUserByLogin($DataForm["user_Login"]);
            if (password_verify($DataForm["user_Password"], $initialDataUser->user_Password)) {
                $_SESSION["user_SESSION"] = [
                    "user_ID" => $initialDataUser->user_ID,
                    "user_Login" => $initialDataUser->user_Login,
                    "user_Role" => $initialDataUser->user_Role
                ];
            } else {
                throw new Exception("Ошибка аутентификации: неверный пароль");
            }
        } catch (Exception $ex) {
            die($ex->getMessage());
        }
    }

    public static function logout(array $DataForm = [])
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

    public static function register(array $DataForm)
    {
        $result = null;
        try {
            $user_Login = $DataForm["user_Login"];
            $user_Email = $DataForm["user_Email"];
            $user_Phone = $DataForm["user_Phone"];
            $user_Surname = $DataForm["user_Surname"];
            $user_Firstname = $DataForm["user_Name"];
            $user_Patronymic = $DataForm["user_Patronymic"] ?? "";
            $user_Password = [
                "pass" => $DataForm["user_Password"],
                "confirm" => $DataForm["user_Password_Repeat"]
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
