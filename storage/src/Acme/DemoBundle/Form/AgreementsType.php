<?php

namespace Acme\DemoBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;


class AgreementsType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('agreementNo')
                
                ->add('quotaionNo', 'text', array("mapped" => false,))
                ->add('agreementType', 'choice', array(
                    'choices' => array('1' => 'Storage agreement', '0' => 'Customer Quotation'),
                    'required' => false,
                ))
                ->add('transactionType', 'choice', array(
                    'choices' => array('New' => 'New', 'Renew' => 'Renew','Evacuation'=>'Evacuation'),
                    'expanded' => true,
                ))
                ->add('agreementId')
                ->add('agreementDate', 'date', array(
                    'widget' => 'single_text',
                    'format' => 'yyyy-MM-dd',
                ))
                ->add('customer',new CustomersAgreementType())
//                ->add('discountPolicies')
                ->add('discountPolicies', 'choice', array(
                    'choices' => array('5' => '5%', '10' => '10%','15'=>'15%','20'=>'20%'),
                    'required' => false,
                ))
                ->add('startDate')
                ->add('endDate')
                ->add('evacuationDate')
                ->add('totalArea')
                ->add('rentalValue')
                ->add('insuranceValue')
                ->add('depositValue')
                ->add('otherFees')
                ->add('totalValue')
                ->add('offerDiscount')
                ->add('otherDiscount')
                ->add('netValue')
                ->add('created')
                ->add('modified')
//                ->add('customer', 'entity', array(
//                    'class' => 'Acme\DemoBundle\Entity\Customers',
//                    'property' => 'en_name',
//                    'required' => false,
//                    'attr' =>
//                    array('class' => 'span2', 'label' => 'Customers')
//                        )
//                )
                ->add('service', 'entity', array(
                    'class' => 'Acme\DemoBundle\Entity\Services',
                    'property' => 'en_name',
                    'required' => false,
                    'attr' =>
                    array('class' => 'span2', 'label' => 'Services')
                        )
                )
                ->add('sales', 'entity', array(
                    'class' => 'Acme\DemoBundle\Entity\SalesPerson',
                    'property' => 'en_name',
                    'required' => false,
                    'attr' =>
                    array('class' => 'span2', 'label' => 'sales')
                        )
                )
                
                ->add('rentalPeriod', 'entity', array(
                    'class' => 'Acme\DemoBundle\Entity\RentalPeriods',
                    'property' => 'en_name',
                    'required' => false,
                    'attr' =>
                    array('class' => 'span2', 'label' => 'sales')
                        )
                )
                ->add('itemsDescription','collection', array(
                    'type' => new ItemsDescriptionType(),
                    'allow_add' => true,
                    'allow_delete' => true,
                    'prototype' => true,
                    'by_reference' => false,
                    
                    ))
                
                
                 ->add('authorizedPersons','collection', array(
                    'type' => new AuthorizedPersonsType(),
                    'allow_add' => true,
                    'allow_delete' => true,
                    'prototype' => true,
                    'by_reference' => false,
                    
                    ))
        ;
        
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'Acme\DemoBundle\Entity\Agreements'
        ));
    }

    public function getName() {
        return 'acme_demobundle_agreementstype';
    }

}
