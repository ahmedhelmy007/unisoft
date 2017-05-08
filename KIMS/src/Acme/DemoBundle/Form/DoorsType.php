<?php

namespace Acme\DemoBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Doctrine\ORM\EntityRepository;

class DoorsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', 'text', array('attr' => array('placeholder' => 'الابواب')))
            ->add('subName', 'text', array('attr' => array('placeholder' => 'المصروف')))
            ->add('proName')
            ->add('balance', 'text', array('attr' => array('placeholder' => 'الموازنة')))
            ->add('price','text',array('attr' => array('value' => 0)))   
            ->add('date')
            ->add('perant','entity', array(
                'class'=>   'Acme\DemoBundle\Entity\Doors',
                'property'=>'name',
                'empty_value' => 'الاختيار',
                'required' => false,
                'query_builder'=>function(EntityRepository $er) {
               return $er->createQueryBuilder('Doors')->where('Doors.perant IS NULL');} ))
             ->add('proId')   
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Acme\DemoBundle\Entity\Doors'
        ));
    }

    public function getName()
    {
        return 'acme_demobundle_doorstype';
    }
}
