<?php

namespace App\Validator;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class OrderInterval extends Constraint
{
    /*
     * Any public properties become valid options for the annotation.
     * Then, use these in your validator class.
     */
    public $message = 'Нельзя создать заказ с пересечением';

    public function getTargets(): string
    {
        return self::CLASS_CONSTRAINT;
    }
}
