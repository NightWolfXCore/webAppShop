<?php

namespace Model;

use Exception;

class Orders
{
    private DataOrderRepository $orderRepository;
    private DataUserRepository $userRepository;

    public function __construct(DataOrderRepository $orderRepository, DataUserRepository $userRepository)
    {
        $this->orderRepository = $orderRepository;
        $this->userRepository = $userRepository;
    }
    public function submitOrder(array $orderData): never
    {
        $result = null;
        try {
            $orderCartData = json_decode($orderData["cart_products"], true);

            $this->checkOrderCart($orderCartData);

            $resultIDOrder = $this->orderRepository->createOrder($orderData);
            $result = $this->orderRepository->insertProductOrder($orderCartData, $resultIDOrder);

            if (!$result)
                throw new Exception("Ошибка! Что-то случилось на этапе создания заказа :(");

            header("Location: /order/success");
            exit();
        } catch (Exception $ex) {
            die($ex->getMessage());
        }
    }

    public function deleteOrder(array $orderData): void
    {
        $this->userRepository->checkAdminPermission();

        $result = null;
        try {
            $orderID = $orderData["order_ID"];

            $result = $this->orderRepository->deleteOrderByID($orderID);

            if (!$result)
                throw new Exception("Ошибка! Что-то случилось на этапе удаления заказа :(");
        } catch (Exception $ex) {
            die($ex->getMessage());
        }
    }

    public function changeStatusOrder(array $orderData): void
    {
        $this->userRepository->checkAdminPermission();

        $result = null;
        try {
            $orderID = $orderData["order_ID"];
            $status_order = $orderData["order_status"];

            $result = $this->orderRepository->changeStatusOrder($orderID, $status_order);

            if (!$result)
                throw new Exception("Ошибка! Что-то случилось на этапе смене статуса заказа :(");
        } catch (Exception $ex) {
            die($ex->getMessage());
        }
    }

    private function checkOrderCart(array $orderCartData): bool|null
    {
        $result = null;
        try {
            if (empty($orderCartData))
                throw new Exception("Корзина пуста! Создание заказа невозможно.");
            return $result;
        } catch (Exception $ex) {
            die($ex->getMessage());
        }
    }
}
