<?php

namespace Acme\DemoBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class SelfStoresType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('created')
            ->add('hieght')
            ->add('length')
            ->add('modified')
            ->add('name')
            ->add('roomSize')
            ->add('status')
            ->add('width')
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Acme\DemoBundle\Entity\SelfStores'
        ));
    }

    public function getName()
    {
        return 'acme_demobundle_selfstorestype';
    }
}
