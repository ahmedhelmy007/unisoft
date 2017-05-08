<?php

namespace Unisoft\AssetsBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

use Symfony\Component\Form\Event\DataEvent;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Form\FormEvents;

class DepartmentsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $subscriber = new AddNameFieldSubscriber($builder->getFormFactory());
        $builder->addEventSubscriber($subscriber);
        $builder
//            ->add('departmentNo')
            ->add('enName')
            ->add('arName')
            ->add('locationId')
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Unisoft\AssetsBundle\Entity\Departments',
            'translation_domain' => 'messages'
        ));
    }

    public function getName()
    {
        return 'unisoft_assetsbundle_departmentstype';
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

        // check if the product object is "new"
        $field_op=array();
        $field_op['label']='Department Number';
        if ($data->getId())
            $field_op['read_only']=true;
        
        $form->add($this->factory->createNamed('departmentNo','text', null, $field_op));
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