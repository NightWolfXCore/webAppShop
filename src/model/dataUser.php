<?php
namespace Model;
use Exception;
use repository\Database;

class DataUser {
    public static function getDataUserByID(int $ID)
    {
        $result = null;
        try {
            $sqlQueryGetUser = sprintf("SELECT * FROM `users` WHERE `user_ID` = '%d'", $ID);
            if (($result = mysqli_query(Database::connect(), $sqlQueryGetUser)) === false)
                throw new Exception("Ошибка выдачи информации о пользователе!");
            return $result;
        } catch (Exception $ex) {
            die($ex->getMessage());
        }
    }
    public static function getDataUserByLogin(string $login)
    {
        $result = null;
        try {
            $sqlQueryGetUser = sprintf("SELECT * FROM `users` WHERE `user_Login` = '%s'", $login);
            if (($result = mysqli_query(Database::connect(), $sqlQueryGetUser)) === false)
                throw new Exception("Ошибка выдачи информации о пользователе!");
            return $result;
        } catch (Exception $ex) {
            die($ex->getMessage());
        }
    }
}
?>