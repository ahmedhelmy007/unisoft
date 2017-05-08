<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ContainsAlphanumericValidator
 *
 * @author ksamir
 */
namespace Acme\DemoBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class ContainsCollectionSizeValidator extends ConstraintValidator
{
    public function validate($value, Constraint $constraint)
    {
        if (sizeof($value)==0) {
            $this->context->addViolation($constraint->message, array('%string%' => $value));
        }
    }
}
