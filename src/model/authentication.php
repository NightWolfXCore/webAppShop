<?php

namespace Model;

use Exception;
use repository\Database;
use core;

class Authentication
{
    private DataUserRepository $userRepository;

    public function __construct(DataUserRepository $userRepository)
    {
        $this->userRepository = $userRepository;        
    }
    public function login(array $DataForm)
    {
        $result = null;
        try {
            $initialDataUser = $this->userRepository->getDataUserByLogin($DataForm["user_Login"]);
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

    public function logout(array $DataForm = [])
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

    public function register(array $DataForm)
    {
        $result = null;
        try {
            $user_Login = $DataForm["user_Login"];
            $user_Password = [
                "pass" => $DataForm["user_Password"],
                "confirm" => $DataForm["user_Password_Repeat"]
            ];
            
            if ($user_Password['pass'] !== $user_Password['confirm'])
                throw new Exception("Пароли не совпадают!");

            $result = $this->userRepository->insertDataUser($DataForm);

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
