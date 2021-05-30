<?php

namespace App\Validator;

use App\Entity\Order;
use App\Repository\OrderRepository;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class OrderIntervalValidator extends ConstraintValidator
{

    private $orderRepository;

    public function __construct(OrderRepository $orderRepository)
    {
        $this->orderRepository = $orderRepository;
    }

    public function validate($value, Constraint $constraint)
    {
        /* @var $constraint \App\Validator\OrderInterval */
        /* @var $value Order*/
        $data = $this->orderRepository->findIntersectionIntervals($value)->getQuery()->getResult();
        if (count($data) == 0){
            return;
        }


        // TODO: implement the validation here
        $this->context->buildViolation($constraint->message)
            ->addViolation();
    }
}
