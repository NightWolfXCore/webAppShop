<?php

namespace Model;

use Exception;
use mysqli;
use Model\DataProductRepository;

class DataOrderRepository
{
    private ?mysqli $dataBase;
    private DataProductRepository $productRepository;

    public function __construct(mysqli $dataBase)
    {
        $this->dataBase = $dataBase;
        $this->productRepository = new DataProductRepository($dataBase);
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

    public function getAllOrders(int $status = 0)
    {
        $result = null;
        try {
            if ($status) {
                $sqlgetOrders = sprintf("SELECT * FROM `orders` WHERE `order_status` = '%d'", $status);
            } else {
                $sqlgetOrders = "SELECT * FROM `orders`";
            }

            if (($result = mysqli_query($this->dataBase, $sqlgetOrders)) === false)
                throw new Exception("Ошибка поиска заказов!");

            return $result->fetch_all(MYSQLI_ASSOC);
        } catch (Exception $ex) {
            die($ex->getMessage());
        }
    }
    public function getOrderByID(int $orderID, int $status = 0)
    {
        $result = null;
        try {
            $result = [];
            if ($status) {
                $sqlgetOrder = sprintf("SELECT * FROM `orders` WHERE `order_ID` = '%d' AND `order_Status` = %d", $orderID, $status);
            } else {
                $sqlgetOrder = sprintf("SELECT * FROM `orders` WHERE `order_ID` = '%d'", $orderID);
            }
            if (($result = mysqli_query($this->dataBase, $sqlgetOrder)) === false)
                throw new Exception("Ошибка поиска заказа!");
            return $result->fetch_all(MYSQLI_ASSOC);
        } catch (Exception $ex) {
            die($ex->getMessage());
        }
    }

    public function getOrdersByUserID(int $userID, int $status = 0)
    {
        $result = null;
        try {
            if ($status) {
                $sqlgetOrders = sprintf("SELECT * FROM `orders` WHERE `order_Client` = '%d' AND `order_Status` = %d", $userID, $status);
            } else {
                $sqlgetOrders = sprintf("SELECT * FROM `orders` WHERE `order_Client` = '%d'", $userID);
            }

            if (($result = mysqli_query($this->dataBase, $sqlgetOrders)) === false)
                throw new Exception("Ошибка поиска заказов!");

            return $result->fetch_all(MYSQLI_ASSOC);
        } catch (Exception $ex) {
            die($ex->getMessage());
        }
    }

    public function getProductsInTheOrderByID(int $orderID)
    {
        $result = null;
        try {
            $productsArray = [];
            $productsAll = [];
            $sqlGetAllProducts = "";
            $sqlGetProducts = sprintf("SELECT * FROM `position_order` WHERE `position_Order` = '%d'", $orderID);
            $products = mysqli_query($this->dataBase, $sqlGetProducts)->fetch_all(MYSQLI_ASSOC);
            foreach ($products as $variable) {
                $sqlGetAllProducts = sprintf("SELECT `product_ID`, `product_Name`, `product_Description`, `product_DemoPhoto` FROM `products` WHERE `product_ID` = '%d'", $variable['position_Item']);
                $productsAll[] = mysqli_query($this->dataBase, $sqlGetAllProducts)->fetch_assoc();
            }
            foreach ($products as $variable) {
                foreach ($productsAll as $variable2) {
                    if ($variable2['product_ID'] === $variable['position_Item']) {
                        $productsArray[] = array_merge($variable, $variable2);
                    }
                }
            }
            return $productsArray;
        } catch (Exception $ex) {
            die($ex->getMessage());
        }
    }

    public function insertProductOrder(array $orderData, int $orderID): bool|null
    {
        $result = null;
        try {
            $sqlInsertProductOrder = "";
            foreach ($orderData as $variable) {
                $position_ID = $variable["id"];
                $position_price = $variable["price"];
                $position_Quantity = $variable["quantity"];

                $sqlInsertProductOrder .= sprintf("INSERT INTO `position_order`(`position_Item`, `position_Quantity`, `position_Cost`, `position_Order`) VALUES ('%s','%s','%s','%s'); ", $position_ID, $position_Quantity, $position_price, $orderID);
            }
            // print_r($sqlInsertProductOrder);
            if (($result = mysqli_multi_query($this->dataBase, $sqlInsertProductOrder)) === false)
                throw new Exception("Ошибка добавления товара в заказ!");

            return $result;
        } catch (Exception $ex) {
            die($ex->getMessage());
        }
    }

    public function changeStatusOrder(int $orderID, int $status): bool|null
    {
        $result = null;
        try {
            $sqlChangeStatusOrder = sprintf("UPDATE `orders` SET `order_Status` = %d WHERE `order_ID` = %d", $status, $orderID);
            if (($result = mysqli_multi_query($this->dataBase, $sqlChangeStatusOrder)) === false)
                throw new Exception("Ошибка изменения статуса заказа!");
            return $result;
        } catch (Exception $ex) {
            die($ex->getMessage());
        }
    }
    public function deleteOrderByID(int $orderID): bool|null
    {
        $result = null;
        try {
            $sqlDeleteOrder = sprintf("DELETE FROM `orders` WHERE `order_ID` = %d", $orderID);
            if (($result = mysqli_multi_query($this->dataBase, $sqlDeleteOrder)) === false)
                throw new Exception("Ошибка удаления заказа!");
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
            } else {
                $result = $lastIDOrder;
            }
            return (int)$result;
        } catch (Exception $ex) {
            die($ex->getMessage());
        }
    }
}
