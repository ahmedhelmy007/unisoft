<?php

namespace Unisoft\AssetsBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class EmployeeAssetsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('employee','entity', array('class'=>'Unisoft\AssetsBundle\Entity\Employees', 'property'=>'name' ))
            ->add('asset','entity', array('class'=>'Unisoft\AssetsBundle\Entity\Assets', 'property'=>'english_name' ))
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Unisoft\AssetsBundle\Entity\EmployeeAssets'
        ));
    }

    public function getName()
    {
        return 'unisoft_assetsbundle_employeeassetstype';
    }
}
