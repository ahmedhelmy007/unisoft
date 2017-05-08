<?php

namespace Acme\DemoBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class SelfCustomersType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('address')
            ->add('arName')
            ->add('civilId')
            ->add('contactMobile')
            ->add('contactPerson')
            ->add('contactPhone')
            ->add('created')
            ->add('customerNo')
            ->add('email')
            ->add('enName')
            ->add('fax')
            ->add('flat')
            ->add('floor')
            ->add('gada')
            ->add('gender')
            ->add('house')
            ->add('mobile')
            ->add('modified')
            ->add('notes')
            ->add('part')
            ->add('phone')
            ->add('region')
            ->add('street')
            ->add('nationality')
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Acme\DemoBundle\Entity\SelfCustomers'
        ));
    }

    public function getName()
    {
        return 'acme_demobundle_selfcustomerstype';
    }
}
