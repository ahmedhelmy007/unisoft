<?php

namespace Acme\DemoBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class CustomersSearchType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('customerNo', 'text', array('label' => 'Customer No', 'attr' =>
                    array('class' => 'span2', 'placeholder' => 'Customer No')))
                ->add('enName', 'text', array('label' => 'Customer Name E', 'attr' =>
                    array('class' => 'span4', 'placeholder' => 'Customer Name E')))
                ->add('arName', 'text', array('label' => 'Customer Name A', 'attr' =>
                    array('class' => 'span4 input-left-top-margins', 'placeholder' => 'Customer Name A')))
                ->add('civilId', 'text', array('label' => 'Civil ID', 'attr' =>
                    array('class' => 'span2', 'placeholder' => 'Civil ID')))
                ->add('mobile', 'text', array('label' => 'Mobile No.', 'attr' =>
                    array('class' => 'span2', 'placeholder' => 'Mobile No.')))
                ->add('phone', 'text', array('label' => 'Phone No.', 'attr' =>
                    array('class' => 'span2', 'placeholder' => 'Phone No.')))
                ->add('nationality', 'entity', array(
                    'class' => 'Acme\DemoBundle\Entity\SelfNationalities',
                    'property' => 'en_name',
                    'required' => false,
                    'empty_value' => '--Select--',
                    'attr' =>
                    array('class' => 'span2')
                        )
                )
                ->add('contactPerson', 'text', array('label' => 'Contact Person', 'attr' =>
                    array('class' => 'span4', 'placeholder' => 'Contact Person')))
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'Acme\DemoBundle\Entity\SelfCustomers'
        ));
    }

    public function getName() {
        return 'acme_demobundle_customerstype';
    }

}