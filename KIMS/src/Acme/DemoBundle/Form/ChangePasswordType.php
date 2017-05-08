<?php

namespace Acme\DemoBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ChangePasswordType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('password', 'repeated', array(
                    'type' => 'password',
                    'invalid_message' => 'كلمة المرور يجب ان تكون متطابقة',
                    'options' => array('attr' => array('class' => 'password-field')),
                    'required' => true,
                    'first_options' => array('label' => 'كلمة المرور', 'attr' => array('placeholder' => 'كلمة المرور')),
                    'second_options' => array('label' => 'تاكيد كلمة المرور', 'attr' => array('placeholder' => 'تاكيد كلمة المرور'))))
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
