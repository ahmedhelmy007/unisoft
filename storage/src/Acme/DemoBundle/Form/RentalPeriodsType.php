<?php

namespace Acme\DemoBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class RentalPeriodsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('enName','text', array('attr' => array('placeholder' => 'English Name','title'=>'English Name')))
            ->add('arName','text', array('attr' => array('placeholder' => 'Arabic Name','title'=>'Arabic Name')))
            ->add('unit','choice', array(
            'choices' => array('Day' => 'Day', 'Month' => 'Month')))
            ->add('numberOfUnits','text', array('attr' => array('placeholder' => 'Number','title'=>'Number')))
            ->add('created')
            ->add('modified')
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
        return 'acme_demobundle_rentalperiodstype';
    }
}
