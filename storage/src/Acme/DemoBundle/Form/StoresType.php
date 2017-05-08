<?php

namespace Acme\DemoBundle\Form;

use Doctrine\ORM\EntityRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

use Symfony\Component\Form\Event\DataEvent;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Form\FormEvents;

class StoresType extends AbstractType {
//
//    private $data_options;
//
//    public function __construct(array $data_options) {
//        $this->data_options = $data_options;
//    }

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $subscriber = new AddNameFieldSubscriber($builder->getFormFactory());
        
        $builder
                ->add('name','text', array('attr' => array('placeholder' => 'Name','title'=>'Name')))
                ->add('hieght','text', array('attr' => array('placeholder' => 'Hieght','title'=>'Hieght')))
                ->add('width','text', array('attr' => array('placeholder' => 'Width','title'=>'Width')))
                ->add('length','text', array('attr' => array('placeholder' => 'Length','title'=>'Length')))
                ->add('size','text', array('attr' => array('placeholder' => 'Size','title'=>'Size')))
//                ->add('status')
                ->add('status', 'choice', array(
    'choices'   => array('1' => 'Available', '2' => 'Rented', '3' => 'Resevation', '4' => 'Delay', '5' => 'Not Available', '6' => 'Company use'),
    'required'  => false,
))
//                ->add('rentalPeriods','entity', array('class'=>'Acme\DemoBundle\Entity\RentalPeriods', 'property'=>'enName', 'query_builder'=>function(EntityRepository $er) {
//                return $er->createQueryBuilder('rental_periods')->where('rental_periods.id=1');}, ))
                ->add('storesRentalperiods', 'collection', array(
                    'type' => new StoresRentalperiodsType(),
                    'allow_add' => true,
                    'allow_delete' => true,
                    'prototype' => true,
                    'prototype_name' => 'StoresRentalperiods__price__',
                    'options' => array(
                    // options on the rendered TagTypes
                    ),
                ))
//            ->add('created')
//            ->add('modified')
//                ->add('rentalPeriods', 'entity', array(
//                    'multiple' => true,
//                    'expanded' => true,
//                    'property' => 'enName',
//                    'class' => 'Acme\DemoBundle\Entity\RentalPeriods',
//                ))
        ;
$builder->addEventSubscriber($subscriber);

//        for ($i = 1; $i <= 3; $i++) {
////              $storesRentalperiod = new \Acme\DemoBundle\Entity\StoresRentalperiods();
////$builder->get('storesRentalperiods')->add('storesRentalperiods', new StoresRentalperiodsType($storesRentalperiod));
//        }
//        print_r(sizeof($this->data_options['rental_periods_objs']));
//        print_r(sizeof($this->data_options['store']->getStoresRentalperiods()));
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'Acme\DemoBundle\Entity\SelfStores'
        ));
    }

    public function getName() {
        return 'acme_demobundle_storestype';
    }

}


class AddNameFieldSubscriber implements EventSubscriberInterface
{
    private $factory;

    public function __construct(FormFactoryInterface $factory)
    {
        $this->factory = $factory;
    }

    public static function getSubscribedEvents()
    {
        // Tells the dispatcher that you want to listen on the form.pre_set_data
        // event and that the preSetData method should be called.
        return array(FormEvents::PRE_SET_DATA => 'preSetData');
    }

    public function preSetData(DataEvent $event)
    {
        $data = $event->getData();
        $form = $event->getForm();
        if (null === $data) {
            return;
        }

//        print_r(sizeof($data->get()));
       
    }
}