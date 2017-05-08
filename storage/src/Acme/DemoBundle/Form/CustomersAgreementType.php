<?php

namespace Acme\DemoBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Form\Event\DataEvent;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Form\FormEvents;

class CustomersAgreementType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $subscriber = new AddNameFieldSubscriber($builder->getFormFactory());
        $builder->addEventSubscriber($subscriber);
        $builder
//            ->add('customerNo', 'text', array( 'label'=> 'Customer Number', 'attr'=> 
//               array('class'  => 'span2','placeholder'=>'Customer Number')))
                ->add('enName', 'text', array('label' => 'Customer Name E', 'read_only' => true, 'attr' =>
                    array('class' => 'span5', 'placeholder' => 'Customer Name E')))
                ->add('arName', 'text', array('label' => 'Customer Name A', 'read_only' => true, 'attr' =>
                    array('class' => 'span5 input-left-top-margins', 'placeholder' => 'Customer Name A')))
                ->add('civilId', 'text', array('label' => 'Civil ID', 'read_only' => true, 'attr' =>
                    array('class' => 'span2', 'placeholder' => 'Civil ID')))
                ->add('mobile', 'text', array('label' => 'Mobile No.', 'read_only' => true, 'attr' =>
                    array('class' => 'span2', 'placeholder' => 'Mobile No.')))
                ->add('phone', 'text', array('label' => 'Phone No.', 'read_only' => true, 'attr' =>
                    array('class' => 'span2', 'placeholder' => 'Phone No.')))
                ->add('fax', 'text', array('label' => 'Fax No.', 'read_only' => true, 'attr' =>
                    array('class' => 'span2', 'placeholder' => 'Fax No.')))
                ->add('email', 'text', array('label' => 'Email Address', 'read_only' => true, 'attr' =>
                    array('class' => 'span5', 'placeholder' => 'Email Address')))
                ->add('nationality', 'entity', array(
                    'class' => 'Acme\DemoBundle\Entity\SelfNationalities',
                    'property' => 'en_name',
                    'disabled' => true,
                    'empty_value' => '--Select--',
                    'required' => false,
                    //'query_builder'=>function(EntityRepository $er) {
                    //    return $er->createQueryBuilder('Doors')->where('Doors.perant IS NULL');} 
                    'attr' =>
                    array('class' => 'span2', 'label' => 'Nationality')
                        )
                )
                ->add('gender', 'choice', array(
                    'choices' => array('Male' => 'Male', 'Female' => 'Female'),
                    'required' => false,
                    'disabled'=>true
                ))
                ->add('address', 'text', array('label' => 'Address','read_only'=>true, 'attr' =>
                    array('class' => 'span10', 'placeholder' => 'Address')))

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

class AddNameFieldSubscriber implements EventSubscriberInterface {

    private $factory;

    public function __construct(FormFactoryInterface $factory) {
        $this->factory = $factory;
    }

    public static function getSubscribedEvents() {
        // Tells the dispatcher that you want to listen on the form.pre_set_data
        // event and that the preSetData method should be called.
        return array(FormEvents::PRE_SET_DATA => 'preSetData');
    }

    public function preSetData(DataEvent $event) {
        $data = $event->getData();
        $form = $event->getForm();
        if (null === $data) {
            return;
        }


        $field_op = array();
        $field_op['label'] = 'Customer No';
//        $field_op['class']='span2';
//        $field_op['placeholder']='Customer Number';
        if ($data->getId())
            $field_op['read_only'] = true;

        $form->add($this->factory->createNamed('customerNo', 'text', null, $field_op));
//        if (!$data->getId()) {
//            $form->add($this->factory->createNamed('administrationNo','text', null, array('label'=>  'Administration Number')));
//        }else{
//            $form->add($this->factory->createNamed('administrationNo','text', null, array(
//                'label'=>  'Administration Number',
//                'read_only'=>true)
//                    ));
//        }
    }

}