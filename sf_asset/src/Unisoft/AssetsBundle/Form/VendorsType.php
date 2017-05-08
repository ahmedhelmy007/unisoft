<?php

namespace Unisoft\AssetsBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class VendorsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('vendorNo','text',array('label'=>  'Vendor Number'))
            ->add('arName' ,'text',array('label'=>  'Arabic Name', 'attr' => array('placeholder' => 'Arabic Name')))
            ->add('enName' ,'text',array('label'=>  'English Name', 'attr' => array('placeholder' => 'English Name')))
            ->add('country' ,'text',array('label'=>  'Country', 'attr' => array('placeholder' => 'Country')))
            ->add('codeFax' ,'text',array('label'=>  'Code Fax' , 'attr' => array('placeholder' => 'Code Fax'))) 
            ->add('faxNo' ,'text',array('label'=>  'Fax Number', 'attr' => array('placeholder' => 'Fax Number')))
            ->add('codePhone' ,'text',array('label'=>  'Code Phone', 'attr' => array('placeholder' => 'Code Phone')))
            ->add('phoneNo' ,'text',array('label'=>  'Phone Number', 'attr' => array('placeholder' => 'Phone Number')))
            ->add('eMail','text',array('label'=>  'E-mail' , 'attr' => array('placeholder' => 'E-mail')))
            ->add('website' ,'text',array('label'=>  'Web-Site' , 'attr' => array('placeholder' => 'Web-Site')))
            ->add('importingFields' ,'text',array('label'=>  'Importing Fields', 'attr' => array('placeholder' => 'Importing Fields') ))
            ->add('authorized' ,'text',array('label'=>  'Authorized', 'attr' => array('placeholder' => 'Authorized')))
            ->add('accountManager','text',array('label'=>  'Account Manager', 'attr' => array('placeholder' => 'Account Manager')))
            ->add('accountNo' ,'text',array('label'=>  'Account Number', 'attr' => array('placeholder' => 'Account Number')))
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Unisoft\AssetsBundle\Entity\Vendors'
        ));
    }

    public function getName()
    {
        return 'unisoft_assetsbundle_vendorstype';
    }
}
