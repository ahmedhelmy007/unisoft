<?php

namespace Unisoft\AssetsBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('username','text',array('label'=>  'User Name', 'attr' => array('placeholder' => 'User Name')))
        ->add('password', 'repeated', array(
             'type' => 'password',
             'invalid_message' => 'The password fields must match.',
             'options' => array('attr' => array('class' => 'password-field')),
             'required' => true,
             'first_options'  => array('label'=>  'Password', 'attr' => array('placeholder' => 'Password')),
             'second_options' => array('label' => 'Repeat Password', 'attr' => array('placeholder' => 'Repeat Password'))))
        ->add('first_name','text',array('label'=>  'First Name', 'attr' => array('placeholder' => 'First Name')))
        ->add('last_name','text',array('label'=>  'Last Name', 'attr' => array('placeholder' => 'Last Name')))
        ->add('address','text',array('label'=>  'Address', 'attr' => array('placeholder' => 'Address')))
        ->add('city','text',array('label'=>  'City', 'attr' => array('placeholder' => 'City')))
        ->add('country','text',array('label'=>  'Country', 'attr' => array('placeholder' => 'Country')))
        ->add('mobile','text',array('label'=>  'Mobile', 'attr' => array('placeholder' => 'Mobile')))
        ;
        
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Unisoft\AssetsBundle\Entity\User'
        ));
    }

    public function getName()
    {
        return 'unisoft_assetsbundle_usertype';
    }
}
