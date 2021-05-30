<?php

namespace App\Validator;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class OrderDate extends Constraint
{
    public $message = 'дата начала должна быть меньше чем дата конца';

    public function getTargets(): string
    {
        return self::CLASS_CONSTRAINT;
    }
}
