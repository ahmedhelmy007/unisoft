<?php

namespace Acme\DemoBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ActivitiesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('date', 'text', array('attr' => array('placeholder' => 'التاريخ','class'=>'date_picker')))
            ->add('price')
            ->add('statements', 'text', array('attr' => array('placeholder' => 'البيان')))
            ->add('activeId')
            
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Acme\DemoBundle\Entity\Activities'
        ));
    }

    public function getName()
    {
        return 'acme_demobundle_activitiestype';
    }
}
