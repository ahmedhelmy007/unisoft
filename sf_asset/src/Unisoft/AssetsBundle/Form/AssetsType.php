<?php

namespace Unisoft\AssetsBundle\Form;
use Doctrine\ORM\EntityRepository;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Unisoft\AssetsBundle\Entity\EmployeeAssets;


class AssetsType extends AbstractType
{
    
    public function __construct(array $options=array())
{
  $this->options = $options;
}
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
         //$roles = array(1=>"Distance",2=>"Period");
        $employee_name=(isset($this->options['employee_name'])) ? $this->options['employee_name'] : "";
        $builder
           
            ->add('assetSerial','text',array('label'=> 'Asset Serial'))    
            ->add('manualCode','text',array('label'=> 'Manual Code'))
            ->add('englishName','text',array('label'=> 'English Name'))
            ->add('arabicName','text',array('label'=> 'Arabic Name'))
            ->add('model')
            ->add('depreciationRate','text',array('label'=> 'Depreciation Rate'))
            ->add('assetAccountNo','text',array('label'=> 'Asset Account No'))
            ->add('accumulatedDepAccNo','text',array('label'=> 'Accumulated Dep.Acc'))
            ->add('depreciationExpensesAccNo','text',array('label'=> 'Depreciation ExpensesAccNo'))
            ->add('profitLossOnSaleOfAssetsAccNo','text',array('label'=> 'profit Loss On Sale Of Assets AccNo'))
            ->add('purchaseInvoiceNo','text',array('label'=> 'purchase Invoice'))
            ->add('quantity','text',array('label'=> ''))
            ->add('purchaseDate', 'text',array( 'label'=> 'purchase Date','attr'=> 
               array(
               'class'  => 'fill-up','placeholder'=>'Date time picker')))
            ->add('cost','text',array('label'=> 'Cost Per Unit'))
            ->add('purchaseValue','text',array('label'=> 'purchase Value'))
            ->add('currentYearOBDepreciationValue','text',array('label'=> 'current Year O.B Depreciation Value'))
            ->add('currentYearDepreciationValue','text',array('label'=> 'current Year Depreciation Value'))
            ->add('valueChanges','text',array('label'=> 'Value Changes'))
            ->add('assetValue','text',array('label'=> 'Asset Value'))
            ->add('imageName','hidden')
            ->add('description')
            ->add('submittedToDepreciation')
            ->add('assetStatus')
            ->add('automaticBarcode','text',array('label'=> 'Automatic Barcode'))
            ->add('barcode','text',array('label'=> 'Barcode'))
            ->add('rfid','text',array('label'=> 'RFID'))
//            ->add('guardianship','entity', array('class'=>'Unisoft\AssetsBundle\Entity\Employees', 'property'=>'name','label'=> 'OwnerShip' ))
            ->add('guardianshipName','text', array('property_path' => false,'label'=> 'OwnerShip','data' => $employee_name))
            ->add('location','entity', array('class'=>'Unisoft\AssetsBundle\Entity\Locations', 'property'=>'name', ))
            ->add('manufacturer','entity', array('class'=>'Unisoft\AssetsBundle\Entity\Manufacturers', 'property'=>'enName' ))
            ->add('vendor','entity', array('class'=>'Unisoft\AssetsBundle\Entity\Vendors', 'property'=>'enName', ))
            ->add('unit','entity', array('class'=>'Unisoft\AssetsBundle\Entity\AssetUnits', 'property'=>'name', ))
            ->add('currency','entity', array('class'=>'Unisoft\AssetsBundle\Entity\Currencies', 'property'=>'name', ))
            ->add('warrantyType','entity',
                    array('class'=>'Unisoft\AssetsBundle\Entity\WarrantyTypes','property'=>'name','expanded'=>'true', 
                        'query_builder'=>
                        function(EntityRepository $er) {
                            return $er->createQueryBuilder('warrantyType');}) )
            ->add('warrantyCount','text',array('label'=> ''))
            ->add('warrantyUnit','entity', array('class'=>'Unisoft\AssetsBundle\Entity\WarrantyUnits', 'property'=>'name','label'=> '', 'query_builder'=>function(EntityRepository $er) {
                return $er->createQueryBuilder('warrantyUnit')->where('warrantyUnit.warrantyType=1');},))
            ->add('warrantyUnit2','entity', array('class'=>'Unisoft\AssetsBundle\Entity\WarrantyUnits', 'property'=>'name','label'=> '  ' , 'query_builder'=>function(EntityRepository $er) {
               return $er->createQueryBuilder('warrantyUnit2')->where('warrantyUnit2.warrantyType =2');},))
            ->add('depreciationMethod','entity', array('class'=>'Unisoft\AssetsBundle\Entity\DepreciationMethods', 'property'=>'name','label'=> 'depreciation Method' ))
            ->add('category','entity', array('class'=>'Unisoft\AssetsBundle\Entity\Categories', 'property'=>'english_mame', 'label'=>'Category'))
            ->add('brand','entity', array('class'=>'Unisoft\AssetsBundle\Entity\Categories', 'property'=>'english_mame', 'label'=>'Sub-Category'))
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Unisoft\AssetsBundle\Entity\Assets'
        ));
    }

    public function getName()
    {
        return 'unisoft_assetsbundle_assetstype';
    }
}
