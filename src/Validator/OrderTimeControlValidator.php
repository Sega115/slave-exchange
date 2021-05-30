<?php

namespace App\Validator;

use App\Entity\Order;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class OrderTimeControlValidator extends ConstraintValidator
{
    public function validate($value, Constraint $constraint)
    {
        /* @var $constraint OrderTimeControl */
        /* @var $value Order*/

        if ($value->getEndDate()->format('Y-m-d') == $value->getStartDate()->format('Y-m-d')){
            $diff = $value->getEndDate()->diff($value->getStartDate());
            if ($diff->h <= 16){
                return;
            }
        }else{
            $startDate = $this->getStartDate($value);
            $endDate = $this->getEndDate($value);
            $diffStart = $startDate->diff($value->getStartDate());
            $diffEnd = $endDate->diff($value->getEndDate());
            if ($diffStart->h <= 16 && $diffEnd->h <= 16){
                return;
            }
        }
        $this->context->buildViolation($constraint->message)
            ->addViolation();
    }

    protected function getEndDate(Order $order): \DateTimeInterface
    {
        return new \DateTime($order->getStartDate()->format('Y-m-d 00:00:00'));
    }

    protected function getStartDate(Order $order): \DateTimeInterface
    {
        $date = clone $order->getEndDate();
        $d = $date->format("d");
        $d++;
        return new \DateTime($date->format('Y-m-'.$d.' 00:00:00'));
    }
}
