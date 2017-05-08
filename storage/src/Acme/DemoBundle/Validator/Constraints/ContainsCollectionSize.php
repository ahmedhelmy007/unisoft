<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ContainsAlphanumeric
 *
 * @author ksamir
 */
namespace Acme\DemoBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class ContainsCollectionSize extends Constraint
{
    public $message = 'The collection length 0';
}