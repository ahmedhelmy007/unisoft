<?php

namespace Acme\DemoBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class StoresSearchType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name','text',array("mapped" => false,))
                ->add('size','text',array("mapped" => false,))
                 ->add('status', 'choice', array(
    'choices'   => array('1' => 'Available', '2' => 'Rented', '3' => 'Resevation', '4' => 'Delay', '5' => 'Not Available', '6' => 'Company use'),
    'required'  => false,
    'mapped' => false,
))
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
        ));
    }

    public function getName()
    {
        return 'acme_demobundle_searchtype';
    }
}
