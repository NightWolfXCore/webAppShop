<?php
namespace Model;

use mysqli;

class DataOrderRepository {
    private ?mysqli $dataBase;

    public function __construct(mysqli $dataBase) {
        $this->dataBase = $dataBase;
    }
}
?>