<?php

namespace Unisoft\AssetsBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class CostType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('costCenterNo','text', array('label'=>  'Cost Center Number'))
        ->add('enName','text',array('label'=>  'English Name', 'attr' => array('placeholder' => 'English Name')))
        ->add('arName','text',array('label'=>  'Arabic Name', 'attr' => array('placeholder' => 'Arabic Name')))  
        
      
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Unisoft\AssetsBundle\Entity\Cost'
        ));
    }

    public function getName()
    {
        return 'unisoft_assetsbundle_costtype';
    }
}
