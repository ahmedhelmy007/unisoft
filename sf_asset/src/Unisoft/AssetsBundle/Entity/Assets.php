<?php

namespace Unisoft\AssetsBundle\Entity;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * Assets
 *
 * @ORM\Table(name="assets")
 * @ORM\HasLifecycleCallbacks
 * @UniqueEntity(fields="assetSerial", message="Sorry, this assetSerial  is already in use."))
 * @UniqueEntity(fields="manualCode", message="Sorry, this manualCode  is already in use."))
 * @ORM\Entity
 * @ORM\Entity(repositoryClass="Unisoft\AssetsBundle\Entity\SearchRepository")
 */
class Assets
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="asset_serial", type="string", length=30, nullable=false)
     */
    private $assetSerial;

    /**
     * @var string
     *
     * @ORM\Column(name="manual_code", type="string", length=40, nullable=false)
     */
    private $manualCode;

    /**
     * @var string
     *
     * @ORM\Column(name="english_name", type="string", length=50, nullable=true)
     */
    private $englishName;

    /**
     * @var string
     *
     * @ORM\Column(name="arabic_name", type="string", length=50, nullable=true)
     */
    private $arabicName;
    /**
     * @var integer
     *
     * @ORM\Column(name="model", type="integer", nullable=true)
     */
    private $model;

    /**
     * @var string
     *
     * @ORM\Column(name="depreciation_rate", type="string", nullable=true)
     */
    private $depreciationRate;

    /**
     * @var string
     *
     * @ORM\Column(name="asset_account_no", type="string", length=50, nullable=true)
     */
    private $assetAccountNo;

    /**
     * @var string
     *
     * @ORM\Column(name="accumulated_dep_acc_no", type="string", length=50, nullable=true)
     */
    private $accumulatedDepAccNo;

    /**
     * @var string
     *
     * @ORM\Column(name="depreciation_expenses_acc_no", type="string", length=50, nullable=true)
     */
    private $depreciationExpensesAccNo;

    /**
     * @var string
     *
     * @ORM\Column(name="profit_loss_on_sale_of_assets_acc_no", type="string", length=50, nullable=true)
     */
    private $profitLossOnSaleOfAssetsAccNo;

    /**
     * @var integer
     *
     * @ORM\Column(name="purchase_invoice_no", type="integer", nullable=true)
     */
    private $purchaseInvoiceNo;

    /**
     * @var integer
     *
     * @ORM\Column(name="quantity", type="integer", nullable=true)
     */
    private $quantity;

    /**
     * @var string
     *
     * @ORM\Column(name="purchase_date", type="string", nullable=true)
     */
    private $purchaseDate;

    /**
     * @var integer
     *
     * @ORM\Column(name="cost", type="integer", nullable=true)
     */
    private $cost;

    /**
     * @var integer
     *
     * @ORM\Column(name="warranty_count", type="integer", nullable=true)
     */
    private $warrantyCount;

    /**
     * @var string
     *
     * @ORM\Column(name="purchase_value", type="string", length=45, nullable=true)
     */
    private $purchaseValue;

    /**
     * @var string
     * @ORM\Column(name="current_year_o_b_depreciation_value", type="string", nullable=true)
     */
    private $currentYearOBDepreciationValue;

    /**
     * @var string
     *
     * @ORM\Column(name="current_year_depreciation_value", type="string", nullable=true)
     */
    private $currentYearDepreciationValue;

    /**
     * @var string
     *
     * @ORM\Column(name="value_changes", type="string", nullable=true)
     */
    private $valueChanges;

    /**
     * @var string
     *
     * @ORM\Column(name="asset_value", type="string", nullable=true)
     */
    private $assetValue;

    /**
     * @var integer
     *@Assert\File(maxSize = "1024k",maxSizeMessage = "File too larg", groups={"uploadByAjax"},mimeTypes = {
          "image/png",
          "image/pjpeg",
          "image/jpeg",
          "image/gif"
        }, mimeTypesMessage = "Please upload a valid Image")
     *
     */
    private $image;
    
    /**
     * @var String
     * @ORM\Column(name="image", type="string", length=200, nullable=true)
     */
    private $imageName;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text", nullable=true)
     */
    private $description;

    /**
     * @var boolean
     *
     * @ORM\Column(name="submitted_to_depreciation", type="boolean", nullable=true)
     */
    private $submittedToDepreciation;

    /**
     * @var boolean
     *
     * @ORM\Column(name="asset_status", type="boolean", nullable=true)
     */
    private $assetStatus;

    /**
     * @var string
     *
     * @ORM\Column(name="automatic_barcode", type="string", length=30, nullable=true)
     */
    private $automaticBarcode;

    /**
     * @var string
     *
     * @ORM\Column(name="barcode", type="string", length=50, nullable=true)
     */
    private $barcode;

    /**
     * @var string
     *
     * @ORM\Column(name="rfid", type="string", length=50, nullable=true)
     */
    private $rfid;

    /**
     * @var \Employees
     *
     * @ORM\ManyToOne(targetEntity="Employees")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="guardianship_id", referencedColumnName="id")
     * })
     */
    private $guardianship;
    /**
     * @var \Employees
     *
     * @ORM\ManyToOne(targetEntity="Employees")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="guardianship_id", referencedColumnName="id")
     * })
     */
    private $employee;

    /**
     * @var \Locations
     *
     * @ORM\ManyToOne(targetEntity="Locations")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="location_id", referencedColumnName="id")
     * })
     */
    private $location;

    /**
     * @var \Manufacturers
     *
     * @ORM\ManyToOne(targetEntity="Manufacturers")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="manufacturer_id", referencedColumnName="id")
     * })
     */
    private $manufacturer;

    /**
     * @var \Vendors
     *
     * @ORM\ManyToOne(targetEntity="Vendors")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="vendor_id", referencedColumnName="id")
     * })
     */
    private $vendor;

    /**
     * @var \AssetUnits
     *
     * @ORM\ManyToOne(targetEntity="AssetUnits")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="unit_id", referencedColumnName="id")
     * })
     */
    private $unit;

    /**
     * @var \Currencies
     *
     * @ORM\ManyToOne(targetEntity="Currencies")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="currency_id", referencedColumnName="id")
     * })
     */
    private $currency;

    

  
    
     /**
     * @var \WarrantyTypes
     * @ORM\ManyToOne(targetEntity="Unisoft\AssetsBundle\Entity\WarrantyTypes")
     * @ORM\JoinColumn(name="warranty_type", referencedColumnName="id", nullable=false)
     */
    
    private $warrantyType;
    /**
     * @var \WarrantyUnits
     *
     * @ORM\ManyToOne(targetEntity="WarrantyUnits")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="warranty_unit", referencedColumnName="id")
     * })
     */
    private $warrantyUnit;
 /**
     * @var \WarrantyUnits2
     *
     * @ORM\ManyToOne(targetEntity="WarrantyUnits")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="warranty_unit2", referencedColumnName="id")
     * })
     */
    private $warrantyUnit2;
    /**
     * @var \DepreciationMethods
     *
     * @ORM\ManyToOne(targetEntity="DepreciationMethods")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="depreciation_method", referencedColumnName="id")
     * })
     */
    private $depreciationMethod;

    /**
     * @var \Categories
     *
     * @ORM\ManyToOne(targetEntity="Categories")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="category_id", referencedColumnName="id")
     * })
     */
    private $category;

    /**
     * @var \Categories
     *
     * @ORM\ManyToOne(targetEntity="Categories")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="brand_id", referencedColumnName="id")
     * })
     */
    private $brand;

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set assetSerial
     *
     * @param string $assetSerial
     * @return Assets
     */
    public function setAssetSerial($assetSerial)
    {
        $this->assetSerial = $assetSerial;
    
        return $this;
    }

    /**
     * Get assetSerial
     *
     * @return string 
     */
    public function getAssetSerial()
    {
        return $this->assetSerial;
    }

     /**
     * Set $ns_textbox_0
     *
     * @param integer $ns_textbox_0
     * @return Assets
     */
    public function setNs_textbox_0($ns_textbox_0)
    {
        $this->ns_textbox_0 = $ns_textbox_0;
    
        return $this;
    }

    /**
     * Get ns_textbox_0
     *
     * @return integer 
     */
    public function getNs_textbox_0()
    {
        return $this->ns_textbox_0;
    }
    
    /**
     * Set manualCode
     *
     * @param string $manualCode
     * @return Assets
     */
    public function setManualCode($manualCode)
    {
        $this->manualCode = $manualCode;
    
        return $this;
    }

    /**
     * Get manualCode
     *
     * @return string 
     */
    public function getManualCode()
    {
        return $this->manualCode;
    }

    /**
     * Set englishName
     *
     * @param string $englishName
     * @return Assets
     */
    public function setEnglishName($englishName)
    {
        $this->englishName = $englishName;
    
        return $this;
    }

    /**
     * Get englishName
     *
     * @return string 
     */
    public function getEnglishName()
    {
        return $this->englishName;
    }

    /**
     * Set arabicName
     *
     * @param string $arabicName
     * @return Assets
     */
    public function setArabicName($arabicName)
    {
        $this->arabicName = $arabicName;
    
        return $this;
    }

    /**
     * Get arabicName
     *
     * @return string 
     */
    public function getArabicName()
    {
        return $this->arabicName;
    }

    /**
     * Set model
     *
     * @param integer $model
     * @return Assets
     */
    public function setModel($model)
    {
        $this->model = $model;
    
        return $this;
    }

    /**
     * Get model
     *
     * @return integer 
     */
    public function getModel()
    {
        return $this->model;
    }

    /**
     * Set depreciationRate
     *
     * @param integer $depreciationRate
     * @return Assets
     */
    public function setDepreciationRate($depreciationRate)
    {
        $this->depreciationRate = $depreciationRate;
    
        return $this;
    }

    /**
     * Get depreciationRate
     *
     * @return integer 
     */
    public function getDepreciationRate()
    {
        return $this->depreciationRate;
    }

    /**
     * Set assetAccountNo
     *
     * @param string $assetAccountNo
     * @return Assets
     */
    public function setAssetAccountNo($assetAccountNo)
    {
        $this->assetAccountNo = $assetAccountNo;
    
        return $this;
    }

    /**
     * Get assetAccountNo
     *
     * @return string 
     */
    public function getAssetAccountNo()
    {
        return $this->assetAccountNo;
    }

    /**
     * Set accumulatedDepAccNo
     *
     * @param string $accumulatedDepAccNo
     * @return Assets
     */
    public function setAccumulatedDepAccNo($accumulatedDepAccNo)
    {
        $this->accumulatedDepAccNo = $accumulatedDepAccNo;
    
        return $this;
    }

    /**
     * Get accumulatedDepAccNo
     *
     * @return string 
     */
    public function getAccumulatedDepAccNo()
    {
        return $this->accumulatedDepAccNo;
    }

    /**
     * Set depreciationExpensesAccNo
     *
     * @param string $depreciationExpensesAccNo
     * @return Assets
     */
    public function setDepreciationExpensesAccNo($depreciationExpensesAccNo)
    {
        $this->depreciationExpensesAccNo = $depreciationExpensesAccNo;
    
        return $this;
    }

    /**
     * Get depreciationExpensesAccNo
     *
     * @return string 
     */
    public function getDepreciationExpensesAccNo()
    {
        return $this->depreciationExpensesAccNo;
    }

    /**
     * Set profitLossOnSaleOfAssetsAccNo
     *
     * @param string $profitLossOnSaleOfAssetsAccNo
     * @return Assets
     */
    public function setProfitLossOnSaleOfAssetsAccNo($profitLossOnSaleOfAssetsAccNo)
    {
        $this->profitLossOnSaleOfAssetsAccNo = $profitLossOnSaleOfAssetsAccNo;
    
        return $this;
    }

    /**
     * Get profitLossOnSaleOfAssetsAccNo
     *
     * @return string 
     */
    public function getProfitLossOnSaleOfAssetsAccNo()
    {
        return $this->profitLossOnSaleOfAssetsAccNo;
    }

    /**
     * Set purchaseInvoiceNo
     *
     * @param integer $purchaseInvoiceNo
     * @return Assets
     */
    public function setPurchaseInvoiceNo($purchaseInvoiceNo)
    {
        $this->purchaseInvoiceNo = $purchaseInvoiceNo;
    
        return $this;
    }

    /**
     * Get purchaseInvoiceNo
     *
     * @return integer 
     */
    public function getPurchaseInvoiceNo()
    {
        return $this->purchaseInvoiceNo;
    }

    /**
     * Set quantity
     *
     * @param integer $quantity
     * @return Assets
     */
    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;
    
        return $this;
    }

    /**
     * Get quantity
     *
     * @return integer 
     */
    public function getQuantity()
    {
        return $this->quantity;
    }

    /**
     * Set purchaseDate
     *
     * @param \DateTime $purchaseDate
     * @return Assets
     */
    public function setPurchaseDate($purchaseDate)
    {
        $this->purchaseDate = $purchaseDate;
    
        return $this;
    }

    /**
     * Get purchaseDate
     *
     * @return \DateTime 
     */
    public function getPurchaseDate()
    {
        return $this->purchaseDate;
    }

    /**
     * Set cost
     *
     * @param integer $cost
     * @return Assets
     */
    public function setCost($cost)
    {
        $this->cost = $cost;
    
        return $this;
    }

    /**
     * Get cost
     *
     * @return integer 
     */
    public function getCost()
    {
        return $this->cost;
    }

    /**
     * Set warrantyCount
     *
     * @param integer $warrantyCount
     * @return Assets
     */
    public function setWarrantyCount($warrantyCount)
    {
        $this->warrantyCount = $warrantyCount;
    
        return $this;
    }

    /**
     * Get warrantyCount
     *
     * @return integer 
     */
    public function getWarrantyCount()
    {
        return $this->warrantyCount;
    }
///
    /**
     * Set purchaseValue
     *
     * @param string $purchaseValue
     * @return Assets
     */
    public function setPurchaseValue($purchaseValue)
    {
        $this->purchaseValue = $purchaseValue;
    
        return $this;
    }

    /**
     * Get purchaseValue
     *
     * @return string 
     */
    public function getPurchaseValue()
    {
        return $this->purchaseValue;
    }

    /**
     * Set currentYearOBDepreciationValue
     *
     * @param integer $currentYearOBDepreciationValue
     * @return Assets
     */
    public function setCurrentYearOBDepreciationValue($currentYearOBDepreciationValue)
    {
        $this->currentYearOBDepreciationValue = $currentYearOBDepreciationValue;
    
        return $this;
    }

    /**
     * Get currentYearOBDepreciationValue
     *
     * @return integer 
     */
    public function getCurrentYearOBDepreciationValue()
    {
        return $this->currentYearOBDepreciationValue;
    }

    /**
     * Set currentYearDepreciationValue
     *
     * @param integer $currentYearDepreciationValue
     * @return Assets
     */
    public function setCurrentYearDepreciationValue($currentYearDepreciationValue)
    {
        $this->currentYearDepreciationValue = $currentYearDepreciationValue;
    
        return $this;
    }

    /**
     * Get currentYearDepreciationValue
     *
     * @return integer 
     */
    public function getCurrentYearDepreciationValue()
    {
        return $this->currentYearDepreciationValue;
    }

    /**
     * Set valueChanges
     *
     * @param integer $valueChanges
     * @return Assets
     */
    public function setValueChanges($valueChanges)
    {
        $this->valueChanges = $valueChanges;
    
        return $this;
    }

    /**
     * Get valueChanges
     *
     * @return integer 
     */
    public function getValueChanges()
    {
        return $this->valueChanges;
    }

    /**
     * Set assetValue
     *
     * @param integer $assetValue
     * @return Assets
     */
    public function setAssetValue($assetValue)
    {
        $this->assetValue = $assetValue;
    
        return $this;
    }

    /**
     * Get assetValue
     *
     * @return integer 
     */
    public function getAssetValue()
    {
        return $this->assetValue;
    }

    /**
     * Set image
     *
     * @param string $image
     * @return Assets
     */
    public function setImage($image)
    {
        $this->image = $image;
    
        return $this;
    }
    
    /**
     * Set imageName
     *
     * @param string $imageName
     * @return Assets
     */
    public function setImageName($image)
    {
        $this->imageName = $image;
    
        return $this;
    }

    /**
     * Get image
     *
     * @return string 
     */
    public function getImage()
    {
        return $this->image;
    }
    
    /**
     * Get imageName
     *
     * @return string 
     */
    public function getImageName()
    {
        return $this->imageName;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return Assets
     */
    public function setDescription($description)
    {
        $this->description = $description;
    
        return $this;
    }

    /**
     * Get description
     *
     * @return string 
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set submittedToDepreciation
     *
     * @param boolean $submittedToDepreciation
     * @return Assets
     */
    public function setSubmittedToDepreciation($submittedToDepreciation)
    {
        $this->submittedToDepreciation = $submittedToDepreciation;
    
        return $this;
    }

    /**
     * Get submittedToDepreciation
     *
     * @return boolean 
     */
    public function getSubmittedToDepreciation()
    {
        return $this->submittedToDepreciation;
    }

    /**
     * Set assetStatus
     *
     * @param boolean $assetStatus
     * @return Assets
     */
    public function setAssetStatus($assetStatus)
    {
        $this->assetStatus = $assetStatus;
    
        return $this;
    }

    /**
     * Get assetStatus
     *
     * @return boolean 
     */
    public function getAssetStatus()
    {
        return $this->assetStatus;
    }

    
    /**
     * Set automaticBarcode
     *
     * @param string $automaticBarcode
     * @return Assets
     */
    public function setAutomaticBarcode($automaticBarcode)
    {
        $this->automaticBarcode = $automaticBarcode;
    
        return $this;
    }

    /**
     * Get automaticBarcode
     *
     * @return string 
     */
    public function getAutomaticBarcode()
    {
        return $this->automaticBarcode;
    }

    /**
     * Set barcode
     *
     * @param string $barcode
     * @return Assets
     */
    public function setBarcode($barcode)
    {
        $this->barcode = $barcode;
    
        return $this;
    }

    /**
     * Get barcode
     *
     * @return string 
     */
    public function getBarcode()
    {
        return $this->barcode;
    }

    /**
     * Set rfid
     *
     * @param string $rfid
     * @return Assets
     */
    public function setRfid($rfid)
    {
        $this->rfid = $rfid;
    
        return $this;
    }

    /**
     * Get rfid
     *
     * @return string 
     */
    public function getRfid()
    {
        return $this->rfid;
    }

    /**
     * Set guardianship
     *
     * @param \Unisoft\AssetsBundle\Entity\Employees $guardianship
     * @return Assets
     */
    public function setGuardianship(\Unisoft\AssetsBundle\Entity\Employees $guardianship = null)
    {
        $this->guardianship = $guardianship;
    
        return $this;
    }

    /**
     * Get guardianship
     *
     * @return \Unisoft\AssetsBundle\Entity\Employees 
     */
    public function getGuardianship()
    {
        return $this->guardianship;
    }
    
    /**
     * Set guardianship
     *
     * @param \Unisoft\AssetsBundle\Entity\Employees $guardianship
     * @return Assets
     */
    public function setEmployee(\Unisoft\AssetsBundle\Entity\Employees $employee = null)
    {
        $this->employee = $employee;
    
        return $this;
    }

    /**
     * Get guardianship
     *
     * @return \Unisoft\AssetsBundle\Entity\Employees 
     */
    public function getEmployee()
    {
        return $this->employee;
    }

    /**
     * Set location
     *
     * @param \Unisoft\AssetsBundle\Entity\Locations $location
     * @return Assets
     */
    public function setLocation(\Unisoft\AssetsBundle\Entity\Locations $location = null)
    {
        $this->location = $location;
    
        return $this;
    }

    /**
     * Get location
     *
     * @return \Unisoft\AssetsBundle\Entity\Locations 
     */
    public function getLocation()
    {
        return $this->location;
    }

    /**
     * Set manufacturer
     *
     * @param \Unisoft\AssetsBundle\Entity\Manufacturers $manufacturer
     * @return Assets
     */
    public function setManufacturer(\Unisoft\AssetsBundle\Entity\Manufacturers $manufacturer = null)
    {
        $this->manufacturer = $manufacturer;
    
        return $this;
    }

    /**
     * Get manufacturer
     *
     * @return \Unisoft\AssetsBundle\Entity\Manufacturers 
     */
    public function getManufacturer()
    {
        return $this->manufacturer;
    }

    /**
     * Set vendor
     *
     * @param \Unisoft\AssetsBundle\Entity\Vendors $vendor
     * @return Assets
     */
    public function setVendor(\Unisoft\AssetsBundle\Entity\Vendors $vendor = null)
    {
        $this->vendor = $vendor;
    
        return $this;
    }

    /**
     * Get vendor
     *
     * @return \Unisoft\AssetsBundle\Entity\Vendors 
     */
    public function getVendor()
    {
        return $this->vendor;
    }

    /**
     * Set unit
     *
     * @param \Unisoft\AssetsBundle\Entity\AssetUnits $unit
     * @return Assets
     */
    public function setUnit(\Unisoft\AssetsBundle\Entity\AssetUnits $unit = null)
    {
        $this->unit = $unit;
    
        return $this;
    }

    /**
     * Get unit
     *
     * @return \Unisoft\AssetsBundle\Entity\AssetUnits 
     */
    public function getUnit()
    {
        return $this->unit;
    }

    /**
     * Set currency
     *
     * @param \Unisoft\AssetsBundle\Entity\Currencies $currency
     * @return Assets
     */
    public function setCurrency(\Unisoft\AssetsBundle\Entity\Currencies $currency = null)
    {
        $this->currency = $currency;
    
        return $this;
    }

    /**
     * Get currency
     *
     * @return \Unisoft\AssetsBundle\Entity\Currencies 
     */
    public function getCurrency()
    {
        return $this->currency;
    }
/**
     * Set warrantyUnit2
     *
     * @param \Unisoft\AssetsBundle\Entity\WarrantyUnits $warrantyUnit2
     * @return Assets
     */
    public function setWarrantyUnit2(\Unisoft\AssetsBundle\Entity\WarrantyUnits $warrantyUnit2 = null)
    {
        $this->warrantyUnit2 = $warrantyUnit2;
    
        return $this;
    }

      /**
     * Get warrantyUnit2
     *
     * @return \Unisoft\AssetsBundle\Entity\WarrantyUnits 
     */
    public function getWarrantyUnit2()
    {
        return $this->warrantyUnit2;
    }
    
    /**
     * Set warrantyType
     *
     * @param integer $warrantyType
     * @return Assets
     */
    public function setWarrantyType( $warrantyType = null)
    {
        $this->warrantyType = $warrantyType;
    
        return $this;
    }

    /**
     * Get warrantyType
     *
     * @return integer
     */
    public function getWarrantyType()
    {
        return $this->warrantyType;
    }

    /**
     * Set warrantyUnit
     *
     * @param \Unisoft\AssetsBundle\Entity\WarrantyUnits $warrantyUnit
     * @return Assets
     */
    public function setWarrantyUnit(\Unisoft\AssetsBundle\Entity\WarrantyUnits $warrantyUnit = null)
    {
        $this->warrantyUnit = $warrantyUnit;
    
        return $this;
    }

    /**
     * Get warrantyUnit
     *
     * @return \Unisoft\AssetsBundle\Entity\WarrantyUnits 
     */
    public function getWarrantyUnit()
    {
        return $this->warrantyUnit;
    }
    
    public function setDepreciationMethod(\Unisoft\AssetsBundle\Entity\DepreciationMethods $depreciationMethod = null)
    {
        $this->depreciationMethod = $depreciationMethod;
    
        return $this;
    }

    /**
     * Get depreciationMethod
     *
     * @return \Unisoft\AssetsBundle\Entity\DepreciationMethods 
     */
    public function getDepreciationMethod()
    {
        return $this->depreciationMethod;
    }

    /**
     * Set category
     *
     * @param \Unisoft\AssetsBundle\Entity\Categories $category
     * @return Assets
     */
    public function setCategory(\Unisoft\AssetsBundle\Entity\Categories $category = null)
    {
        $this->category = $category;
    
        return $this;
    }

    /**
     * Get category
     *
     * @return \Unisoft\AssetsBundle\Entity\Categories 
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * Set brand
     *
     * @param \Unisoft\AssetsBundle\Entity\Categories $brand
     * @return Assets
     */
    public function setBrand(\Unisoft\AssetsBundle\Entity\Categories $brand = null)
    {
        $this->brand = $brand;
    
        return $this;
    }

    /**
     * Get brand
     *
     * @return \Unisoft\AssetsBundle\Entity\Categories 
     */
    public function getBrand()
    {
        return $this->brand;
    }
    
    
    //upload image file
    public function getFullImagePath() {
        return null === $this->imageName ? null : $this->getUploadRootDir(). $this->imageName;
    }

    protected function getUploadRootDir() {
        // the absolute directory path where uploaded documents should be saved
        return $this->getTmpUploadRootDir()."/";
    }

    protected function getTmpUploadRootDir() {
        // the absolute directory path where uploaded documents should be saved
        return __DIR__ . '/../../../../web/upload/';
    }

    /**
     * @ORM\PrePersist()
     * @ORM\PreUpdate()
     */
    public function uploadImage() {
        // the file property can be empty if the field is not required
        if (null === $this->image) {
            return;
        }
        $imageName=uniqid().".".$this->image->guessExtension();
        $this->image->move($this->getUploadRootDir(), $imageName);
        $this->setImage($imageName);
    }
    
    /**
     * 
     */
    //@ORM\PostPersist()
    public function moveImage()
    {
        if (null === $this->image) {
            return;
        }
        if(!is_dir($this->getUploadRootDir())){
            mkdir($this->getUploadRootDir());
        }
        copy($this->getTmpUploadRootDir().$this->image, $this->getFullImagePath());
        unlink($this->getTmpUploadRootDir().$this->image);
    }

    /**
     * @ORM\PreRemove()
     */
    public function removeImage()
    {
        if (file_exists($this->getFullImagePath()))
        unlink($this->getFullImagePath());
//        rmdir($this->getUploadRootDir());
    }
    public function __toString()
    {
        return strval($this->warrantyType);
    }
}