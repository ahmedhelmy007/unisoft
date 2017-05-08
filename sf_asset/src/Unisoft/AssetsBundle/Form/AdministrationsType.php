<?php

namespace Unisoft\AssetsBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Unisoft\AssetsBundle\Form\EventListener\AddNameFieldSubscriber;

class AdministrationsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $subscriber = new AddNameFieldSubscriber($builder->getFormFactory());
        $builder->addEventSubscriber($subscriber);
        $builder
//        ->add('administrationNo','text', array('label'=>  'Administration Number'))
        ->add('enName','text',array('label'=>  'English Name', 'attr' => array('placeholder' => 'English Name')))
        ->add('arName','text',array('label'=>  'Arabic Name', 'attr' => array('placeholder' => 'Arabic Name')))
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Unisoft\AssetsBundle\Entity\Administrations',
            'translation_domain' => 'messages'
        ));
    }

    public function getName()
    {
        return 'unisoft_assetsbundle_administrationstype';
    }
}
