<?php

namespace Acme\DemoBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ItemsDescriptionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('description','text',array('label'=> 'description'))
//            ->add('agreement', 'entity', array(   
//                'class' => 'Acme\DemoBundle\Entity\Agreements',
//                   'property' => 'id',
//                    
//                ))
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Acme\DemoBundle\Entity\ItemsDescription'
        ));
    }

    public function getName()
    {
        return 'acme_demobundle_itemsdescriptiontype';
    }
}
