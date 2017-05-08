<?php

namespace Unisoft\AssetsBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class EmployeesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('employeeNo')
            ->add('enName')
                ->add('arName')
                ->add('civilId')
                ->add('passportId')
                ->add('cellPhoneCode')
                ->add('cellPhone')
                ->add('telephoneCode')
                ->add('telephone')
                ->add('email')
                ->add('address')
//                ->add('image')
                ->add('imageName','hidden')
                ->add('costCenter','entity', array('class'=>'Unisoft\AssetsBundle\Entity\Cost', 'property'=>'enName' ))
                ->add('department','entity', array('class'=>'Unisoft\AssetsBundle\Entity\Departments', 'property'=>'enName' ))
                ->add('position','entity', array('class'=>'Unisoft\AssetsBundle\Entity\Position', 'property'=>'enName' ))
//                ->add('sector','entity', array('class'=>'Unisoft\AssetsBundle\Entity\Sectors', 'property'=>'name' ))
                ->add('administration','entity', array('class'=>'Unisoft\AssetsBundle\Entity\Administrations', 'property'=>'enName' ))
                ->add('active')
                
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Unisoft\AssetsBundle\Entity\Employees'
        ));
    }

    public function getName()
    {
        return 'unisoft_assetsbundle_employeestype';
    }
}
