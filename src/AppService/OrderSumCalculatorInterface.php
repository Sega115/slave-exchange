<?php


namespace App\AppService;


use App\Entity\Order;

interface OrderSumCalculatorInterface
{
    public function calculate(Order $order): float;
}