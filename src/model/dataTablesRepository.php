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
}

?>