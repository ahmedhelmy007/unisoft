<?php
namespace Unisoft\AssetsBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class CategoriesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('categoryNo','text',array('label'=>  'Category Number ')) 
            ->add('englishMame','text',array('label'=> 'English Name '))
            ->add('arabicName','text',array('label'=>  'Arabic Name '))
            ->add('parent','entity', array('class'=>   'Unisoft\AssetsBundle\Entity\Categories', 'property'=>'english_mame', ))
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Unisoft\AssetsBundle\Entity\Categories'
        ));
    }

    public function getName()
    {
        return 'unisoft_assetsbundle_categoriestype';
    }
}
