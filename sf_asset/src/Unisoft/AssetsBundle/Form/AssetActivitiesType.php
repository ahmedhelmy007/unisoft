<?php

namespace Unisoft\AssetsBundle\Form;
use Doctrine\ORM\EntityRepository;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class AssetActivitiesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        //to see list of all Built-in Field Types: http://symfony.com/doc/current/book/forms.html
        $builder
            ->add('changeInValue', 'text', array('label'=> 'Change In Value'))
//            ->add('changeDate', 'text', array('label'=> 'change Date'))
            ->add('notes', 'textarea', array('label'=> 'Notes'))
            ->add('asset', 'entity', array('class'=>'Unisoft\AssetsBundle\Entity\Assets', 'property'=>'arabic_name', ))
        ;
    }

    public function getDefaultOptions(array $options)
    {
        
        $options = parent::getDefaultOptions($options);
        //one of two ways to prevent csrf_protection. from: http://stackoverflow.com/questions/9887451
        //$options['csrf_protection'] = false;

        return $options;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Unisoft\AssetsBundle\Entity\AssetActivities'
        ));
    }

    public function getName()
    {
        return 'unisoft_assetsbundle_assetactivitiestype';
    }
}
