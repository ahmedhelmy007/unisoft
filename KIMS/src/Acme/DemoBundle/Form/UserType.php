<?php

namespace Acme\DemoBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class UserType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('username', 'text', array('label' => 'اسم الدخول', 'attr' => array('placeholder' => 'اسم الدخول')))
//        ->add('aclActions', 'collection', array('type' => new AclActionsType()))
                ->add('password', 'repeated', array(
                    'type' => 'password',
                    'invalid_message' => 'كلمة المرور يجب ان تكون متطابقة',
                    'options' => array('attr' => array('class' => 'password-field')),
                    'required' => true,
                    'first_options' => array('label' => 'كلمة المرور', 'attr' => array('placeholder' => 'كلمة المرور')),
                    'second_options' => array('label' => 'تاكيد كلمة المرور', 'attr' => array('placeholder' => 'تاكيد كلمة المرور'))))
                ->add('fullName', 'text', array('label' => 'الاسم', 'attr' => array('placeholder' => 'الاسم')))
                
                ->add('aclActions', 'entity', array(
                    'multiple' => true,
                    'expanded' => true,
                    'property' => 'Action',
                    'class' => 'Acme\DemoBundle\Entity\AclActions',
                ))
                ->add('roles2', 'entity', array(
                    'multiple' => true,
                    'expanded' => true,
                    'property' => 'role',
                    'class' => 'Acme\DemoBundle\Entity\Group',
                ))
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'Acme\DemoBundle\Entity\User',
//            'translation_domain' => 'messages'
        ));
    }

    public function getName() {
        return 'acme_demobundle_usertype';
    }

}
