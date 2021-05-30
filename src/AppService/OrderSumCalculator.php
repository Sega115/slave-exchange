<?php


namespace App\AppService;


use App\Entity\Order;

class OrderSumCalculator implements OrderSumCalculatorInterface
{

    public function calculate(Order $order): float
    {
        $startDate = $this->getStartDate($order);
        $endDate = $this->getEndDate($order);
        $diff = $endDate->diff($startDate);
        $wageRate = $order->getSlave()->getWageRate();
        $result =  $diff->days * 16 * $wageRate + $diff->h * $wageRate;
        return (float) $result;
    }

    protected function getStartDate(Order $order): \DateTimeInterface
    {
        return new \DateTime($order->getStartDate()->format('Y-m-d H:00:00'));
    }

    protected function getEndDate(Order $order): \DateTimeInterface
    {
        $date = $order->getEndDate();
        $H = $date->format("H");
        if ($date->format("i:s") != '00:00'){
            $H++;
        }
        return new \DateTime($date->format('Y-m-d '.$H.':00:00'));
    }

}