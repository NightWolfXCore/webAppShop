<?php

namespace Model;

use Exception;
use mysqli;
use mysqli_result;

class DataProductRepository
{
    private mysqli $dataBase;

    public function __construct(mysqli $dataBase)
    {
        $this->dataBase = $dataBase;
    }
    public function getDataProductByID(int $ID): bool|object|null
    {
        $result = null;
        try {
            $sqlQueryGetProduct = sprintf("SELECT * FROM `products` WHERE `product_ID` = '%d'", $ID);
            if (($result = mysqli_query($this->dataBase, $sqlQueryGetProduct)) === false)
                throw new Exception("Ошибка выдачи информации о товаре!");
            self::anomalyCheck($result);
            return $result->fetch_object();
        } catch (Exception $ex) {
            die($ex->getMessage());
        }
    }
    public function getDataProductByName(string $name): bool|object|null
    {
        $result = null;
        try {
            $sqlQueryGetProduct = sprintf("SELECT * FROM `products` WHERE `product_Name` = '%s'", $name);
            if (($result = mysqli_query($this->dataBase, $sqlQueryGetProduct)) === false)
                throw new Exception("Ошибка выдачи информации о товаре!");
            self::anomalyCheck($result);
            return $result->fetch_object();
        } catch (Exception $ex) {
            die($ex->getMessage());
        }
    }


    public function insertDataProduct(array $productData): bool|null
    {
        try {
            foreach ($productData as $key => $value) {
                if ($key === "product_DemoPhoto") {
                    $$key = $value ?? "";
                } else {
                    $$key = $value;
                }
            }

            $initialDataProduct = $this->getDataProductByName($product_Name);

            self::existProduct($initialDataProduct);

            $sqlQueryInsertProduct = sprintf("INSERT INTO `products`(`product_Name`, `product_Description`, `product_Compound`, `product_Weight`, `product_Protein`, `product_Carbohydrates`, `product_Fat`, `product_Calories`, `product_Cost`, `product_Manufacturer`, `product_DemoPhoto`) VALUES
            ('%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s')", $product_Name, $product_Description, $product_Compound, $product_Weight, $product_Protein, $product_Carbohydrates, $product_Fat, $product_Calories, $product_Cost, $product_Manufacturer, (empty($product_DemoPhoto) ? "NULL" : htmlspecialchars("'" . $product_DemoPhoto . "'", ENT_NOQUOTES)));

            $result = mysqli_query($this->dataBase, $sqlQueryInsertProduct);

            if (!$result)
                throw new Exception("Ошибка при вставке пользователя: возможно, почта или телефон уже используются другим пользователем");

            return $result;
        } catch (Exception $ex) {
            die($ex->getMessage());
        }
    }

    public function updateProduct(array $productData): bool|null
    {
        $result = null;
        try {
            $initialDataProduct = $this->getDataProductByID($productData["product_ID"]);
            $productData = self::emptyCheck($productData, $initialDataProduct);
            foreach ($productData as $key => $value) {
                $$key = $value;
            }
            $sqlQueryUpdateProduct = sprintf("UPDATE `products` SET
            `product_Name`='%s',            `product_Description`='%s',
            `product_Compound`='%s',        `product_Weight`='%s',
            `product_Protein`='%s',         `product_Carbohydrates`='%s',
            `product_Fat`='%s',             `product_Calories`='%s',
            `product_Cost`='%s',            `product_Manufacturer`='%s',
            `product_DemoPhoto`=%s
            WHERE `product_ID` = '%s'", $product_Name, $product_Description, $product_Compound, $product_Weight, $product_Protein, $product_Carbohydrates, $product_Fat, $product_Calories, $product_Cost, $product_Manufacturer, (empty($product_DemoPhoto) ? "NULL" : htmlspecialchars("'".$product_DemoPhoto."'", ENT_NOQUOTES)), $product_ID);

            $result = mysqli_query($this->dataBase, $sqlQueryUpdateProduct);

            if (!$result)
                throw new Exception("Ошибка при обновлении товара: возможно, каких-то данные не хватает");
            
            return $result;
        } catch (Exception $ex) {
            die($ex->getMessage());
        }
    }
    private static function emptyCheck(array $productData, object $initialDataProduct): array|bool
    {
        try {
            foreach ($productData as $key => $value) {
                if (empty($productData[$key])) {
                    if ($key === "product_DemoPhoto") continue;
                    $productData[$key] = $initialDataProduct->$key;
                }
            }
            return $productData;
        } catch (Exception $ex) {
            die($ex->getMessage());
        }
    }

    private static function existProduct(mysqli_result $result): void
    {
        try {
            if (mysqli_num_rows($result) === 1)
                throw new Exception("Данный товара уже существует по данному имени!");
        } catch (Exception $ex) {
            die($ex->getMessage());
        }
    }

    private static function anomalyCheck(mysqli_result $result): void
    {
        try {
            if (mysqli_num_rows($result) !== 1)
                throw new Exception("Ошибка: товара не существует или аномалии в БД, где товара > 1");
        } catch (Exception $ex) {
            die($ex->getMessage());
        }
    }
}