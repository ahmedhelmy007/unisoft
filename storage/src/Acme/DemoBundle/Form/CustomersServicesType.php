<?php

namespace Acme\DemoBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class CustomersServicesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('customers','entity', array('class'=>'Acme\DemoBundle\Entity\SelfCustomers', 'property'=>'name' ))
            ->add('services','entity', array('class'=>'Acme\DemoBundle\Entity\SelfServices', 'property'=>'enName' ))
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Acme\DemoBundle\Entity\SelfCustomersServices'
        ));
    }

    public function getName()
    {
        return 'acme_demobundle_storesperiodstype';
    }
}
