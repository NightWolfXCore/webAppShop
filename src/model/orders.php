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
