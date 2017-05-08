<?php

namespace Acme\DemoBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class SalesPersonType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('enName','text', array('attr' => array('placeholder' => 'English Name','title'=>'English Name')))
            ->add('arName','text', array('attr' => array('placeholder' => 'Arabic Name','title'=>'Arabic Name')))
            ->add('created')
            ->add('modified')
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Acme\DemoBundle\Entity\SalesPerson'
        ));
    }

    public function getName()
    {
        return 'acme_demobundle_salespersontype';
    }
}
