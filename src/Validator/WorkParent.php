<?php

namespace App\Validator;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class WorkParent extends Constraint
{
    public $message = 'Не может ссылаться на себя';

    public function getTargets()
    {
        return self::CLASS_CONSTRAINT;
    }
}
