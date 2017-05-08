<?php

namespace Acme\DemoBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class StoresRentalperiodsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('stores','entity', array('class'=>'Acme\DemoBundle\Entity\SelfStores', 'property'=>'name' ))
            ->add('period','entity', array('class'=>'Acme\DemoBundle\Entity\SelfRentalPeriods', 'property'=>'enName' ))
            ->add('price')
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Acme\DemoBundle\Entity\SelfStoresRentalperiods'
        ));
    }

    public function getName()
    {
        return 'acme_demobundle_storesperiodstype';
    }
}
