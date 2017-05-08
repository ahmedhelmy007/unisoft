<?php

namespace Unisoft\AssetsBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class WarrantyUnitsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('warrantyType')
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Unisoft\AssetsBundle\Entity\WarrantyUnits'
        ));
    }

    public function getName()
    {
        return 'unisoft_assetsbundle_warrantyunitstype';
    }
}
