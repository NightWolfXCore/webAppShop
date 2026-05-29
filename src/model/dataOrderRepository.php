<?php

namespace Model;

use Exception;
use mysqli;

class DataOrderRepository
{
    private ?mysqli $dataBase;

    public function __construct(mysqli $dataBase)
    {
        $this->dataBase = $dataBase;
    }
    public function createOrder(array $orderData): int|bool|null
    {
        $result = null;
        try {
            $clientID = $orderData["order_Client"];
            $clientFullname = $orderData["order_FullName"];
            $address = $orderData["order_Address"];
            $comment = $orderData["order_Comment"];
            $payment = $orderData["order_Payment"];
            $FinalCost = $orderData["order_total_price"];

            $sqlCreateOrder = sprintf("INSERT INTO `orders`(`order_Client`, `order_Fullname`, `order_address`, `order_comment`, `order_payment`, `order_FinalCost`)
            VALUES ('%s','%s','%s',%s,'%s','%s')", $clientID, $clientFullname, $address, (!empty($comment)) ? htmlspecialchars("'" . $comment . "'", ENT_NOQUOTES) : "NULL", $payment, $FinalCost);

            if (($result = mysqli_query($this->dataBase, $sqlCreateOrder)) === false)
                throw new Exception("Ошибка создания заказа!");

            $result = (int)mysqli_insert_id($this->dataBase);

            $result = $this->checkLastInsertID($result);

            return $result;
        } catch (Exception $ex) {
            die($ex->getMessage());
        }
    }
    public function insertProductOrder(array $orderData, int $idOrder): bool|null
    {
        $result = null;
        try {
            $sqlInsertProductOrder = "";
            foreach ($orderData as $variable) {
                $position_ID = $variable["id"];
                $position_price = $variable["price"];
                $position_Quantity = $variable["quantity"];

                $sqlInsertProductOrder .= sprintf("INSERT INTO `position_order`(`position_Item`, `position_Quantity`, `position_Cost`, `position_Order`) VALUES ('%s','%s','%s','%s'); ", $position_ID, $position_Quantity, $position_price,    $idOrder);
            }
            // print_r($sqlInsertProductOrder);
            if (($result = mysqli_multi_query($this->dataBase, $sqlInsertProductOrder)) === false)
                throw new Exception("Ошибка добавления товара в заказ!");

            return $result;
        } catch (Exception $ex) {
            die($ex->getMessage());
        }
    }

    private function checkLastInsertID(int $id): int|bool|null
    {
        $result = null;
        try {
            $lastIDOrder = (int)$id;
            $clientID = (int)$_SESSION["user_SESSION"]["user_ID"];

            $sqlCheckID = sprintf("SELECT (IF (`order_Client` = '%d', TRUE, FALSE)) as result FROM `orders` WHERE `order_ID` = '%d'", $clientID, $lastIDOrder);

            $result = mysqli_query($this->dataBase, $sqlCheckID);

            if (($result = $result->fetch_object()->result) === false) {
                $sqlGetID = sprintf("SELECT `order_ID` as result FROM `orders` WHERE `order_Client` = '%d' ORDER BY `order_ID` DESC LIMIT 1", $clientID);
                if (($result = mysqli_query($this->dataBase, $sqlGetID)) === false)
                    throw new Exception("Ошибка в получении ID!");
                $result = $result->fetch_object()->result;
            }
            return (int)$result;
        } catch (Exception $ex) {
            die($ex->getMessage());
        }
    }
}
