<?php

namespace App\Validator;

use App\Entity\Work;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class WorkParentValidator extends ConstraintValidator
{
    public function validate($value, Constraint $constraint)
    {
        /* @var $constraint \App\Validator\WorkParent */
        /* @var $value Work*/


        if (!$value->getId() || !$value->getParent() || $value->getId() != $value->getParent()->getId()){
            return;
        }

        // TODO: implement the validation here
        $this->context->buildViolation($constraint->message)
            ->setParameter('{{ value }}', $value)
            ->addViolation();
    }
}
