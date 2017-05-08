<?php

namespace Unisoft\AssetsBundle\Form;
use Doctrine\ORM\EntityRepository;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;


class ModiffyownerType extends AbstractType
{
    
    public function __construct(array $options=array())
{
  $this->options = $options;
}
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
         //$roles = array(1=>"Distance",2=>"Period");
        $image=(isset($this->options['entity'])) ? $this->options['entity']->getEmployee()->getImage() : "";
        $empCode=(isset($this->options['entity'])) ? $this->options['entity']->getEmployee()->getEmpCode() : "";
        $department=(isset($this->options['entity'])) ? $this->options['entity']->getEmployee()->getDepartment()->getName() : "";
        $assetSerial=(isset($this->options['entity'])) ? $this->options['entity']->getAsset()->getAssetSerial() : "";
        $move_id=(isset($this->options['move_id'])) ? $this->options['move_id'] : "0";
        $builder
            ->add('moveId','text',array('data'=>$move_id))
            ->add('note','textarea',array('data'=>''))
            ->add('employee','entity', array('class'=>'Unisoft\AssetsBundle\Entity\Employees', 'property'=>'name','label'=> 'OwnerShip' ))
//            ->add('asset','entity', array('class'=>'Unisoft\AssetsBundle\Entity\Assets', 'property'=>'assetSerial','label'=> 'assetSerial' ))    
            ->add('image','text', array('property_path' => false,'data'=>$image))
                ->add('empCode','text', array('property_path' => false,'data'=>$empCode))
                ->add('department','text', array('property_path' => false,'data'=>$department))
                ->add('assetSerial','text', array('property_path' => false,'data'=>$assetSerial))
//            ->add('employeeObj', new EmployeesType())
//            ->add('asset', new AssetsType())

        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Unisoft\AssetsBundle\Entity\EmployeeAssets'
        ));
    }

    public function getName()
    {
        return 'unisoft_assetsbundle_modiffyownertype';
    }
}
