<?php

namespace Unisoft\AssetsBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ManufacturersType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('manufacturerNo','text',array('label'=>  'Manufacturer Number'))
            ->add('arName' ,'text',array('label'=>  'Arabic Name', 'attr' => array('placeholder' => 'Arabic Name')))
            ->add('enName' ,'text',array('label'=>  'English Name', 'attr' => array('placeholder' => 'English Name')))
            ->add('country' ,'text',array('label'=>  'Country', 'attr' => array('placeholder' => 'Country')))
            ->add('codeFax' ,'text',array('label'=>  'Code Fax' , 'attr' => array('placeholder' => 'Code Fax'))) 
            ->add('faxNo' ,'text',array('label'=>  'Fax Number', 'attr' => array('placeholder' => 'Fax Number')))
            ->add('codePhone' ,'text',array('label'=>  'Code Phone', 'attr' => array('placeholder' => 'Code Phone')))
            ->add('phoneNo' ,'text',array('label'=>  'Phone Number', 'attr' => array('placeholder' => 'Phone Number')))
            ->add('eMail','text',array('label'=>  'E-mail' , 'attr' => array('placeholder' => 'E-mail')))
            ->add('website' ,'text',array('label'=>  'Web-Site' , 'attr' => array('placeholder' => 'Web-Site')))
            ->add('manufacturingFields' ,'text',array('label'=>  'Mnufacturing Fields', 'attr' => array('placeholder' => 'Manufacturing Fields') ))
            ->add('manufacturingManager' ,'text',array('label'=>  'Manufacturing Manager', 'attr' => array('placeholder' => 'Manufacturing Manager')))
            ->add('regionalManager','text',array('label'=>  'Regional Manager', 'attr' => array('placeholder' => 'Regional Manager')))
            ->add('authorizedAgent' ,'text',array('label'=>  'Authorized Agent', 'attr' => array('placeholder' => 'Authorized Agent')))
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Unisoft\AssetsBundle\Entity\Manufacturers'
        ));
    }

    public function getName()
    {
        return 'unisoft_assetsbundle_manufacturerstype';
    }
}
