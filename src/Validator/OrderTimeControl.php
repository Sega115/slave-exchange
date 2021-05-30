<?php

namespace App\Validator;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class OrderTimeControl extends Constraint
{
    /*
     * Any public properties become valid options for the annotation.
     * Then, use these in your validator class.
     */
    public $message = 'Раб не может работать больше 16 часов';

    public function getTargets(): string
    {
        return self::CLASS_CONSTRAINT;
    }
}
