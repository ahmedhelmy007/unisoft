<?php

namespace Acme\DemoBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Doctrine\ORM\EntityRepository;

class ProfileType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('username', 'text', array('label' => 'اسم الدخول', 'attr' => array('placeholder' => 'اسم الدخول')))
                ->add('fullName', 'text', array('label' => 'الاسم', 'attr' => array('placeholder' => 'الاسم')))
                
                ->add('aclActions', 'entity', array(
                    'multiple' => true,
                    'expanded' => true,
                    'property' => 'Action',
                    'class' => 'Acme\DemoBundle\Entity\AclActions',
                ))
<<<<<<< .mine
                ->add('roles', 'entity', array(
=======
//                ->add('userRoles', 'entity', array(
//                    'class' => 'Acme\DemoBundle\Entity\Group',
//                    'property' => 'role',
//                    'multiple' => true,
//                    'expanded' => true,
//                    'required' => false,
//                    'query_builder' => function(EntityRepository $er) {
//                        return $er->createQueryBuilder('g')
//                                  ->orderBy('g.role', 'ASC');
//                    }
//                ))
                ->add('userRoles', 'entity', array(
>>>>>>> .r69
                    'multiple' => true,
                    'expanded' => true,
                    'property' => 'role',
                    'class' => 'Acme\DemoBundle\Entity\Group',
                ))
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'Acme\DemoBundle\Entity\User'
        ));
    }

    public function getName() {
        return 'acme_demobundle_usertype';
    }

}
