<?php

namespace Acme\DemoBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class SelfRentalPeriodsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('arName')
            ->add('created')
            ->add('enName')
            ->add('modified')
            ->add('numberOfUnits')
            ->add('unit')
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Acme\DemoBundle\Entity\SelfRentalPeriods'
        ));
    }

    public function getName()
    {
        return 'acme_demobundle_selfrentalperiodstype';
    }
}
