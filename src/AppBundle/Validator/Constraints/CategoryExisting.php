<?php

namespace AppBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

class CategoryExisting extends Constraint
{
    public $message = 'Category "{{ id }}" does not exist!';

    public function validatedBy()
    {
        return get_class($this).'Validator';
    }
}