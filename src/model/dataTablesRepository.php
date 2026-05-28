<?php
namespace Model;

use mysqli;
use Exception;

class DataTablesRepository {
    private mysqli $dataBase;

    public function __construct(mysqli $dataBase)
    {
        $this->dataBase = $dataBase;
    }

    public function getOneDataByID(string $table, int $ID, string $idcolumn, string $columnGet) {
        $result = null;
        try {
            $sqlGetOneData = sprintf("SELECT `%s` FROM `%s` WHERE `%s` = '%d'", $columnGet, $table, $idcolumn, $ID);
            if (($result = mysqli_query($this->dataBase, $sqlGetOneData)) === false)
                throw new Exception("Ошибка при получении данных");
            return $result->fetch_object();
        } catch (Exception $ex) {
            die($ex->getMessage());
        }
    }
    public function getAllDataByNameTable(string $table) {
        $result = null;
        try {
            $sqlGetAllData = sprintf("SELECT * FROM `%s`", $table);
            if (($result = mysqli_query($this->dataBase, $sqlGetAllData)) === false)
                throw new Exception("Ошибка при получении данных");
            return $result->fetch_all(MYSQLI_ASSOC);
        } catch (Exception $ex) {
            die($ex->getMessage());
        }
    }
}

?>