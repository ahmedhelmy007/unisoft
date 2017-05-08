<?php

namespace Unisoft\AssetsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * Vendors
 *
 * @ORM\Table(name="vendors")
 * @ORM\Entity
 * @UniqueEntity(fields="vendorNo"  , message="Sorry, The Vendor Number Has This figure registered system before.")
 * @UniqueEntity(fields="arName"    , message="Sorry, There Is a Previous Record With The Same Arabic Name.")
 * @UniqueEntity(fields="enName"    , message="Sorry, There Is a Previous Record With The Same English Name.")
 * @UniqueEntity(fields="faxNo"     , message="Sorry, The Fax Number entrance already keepers .")
 * @UniqueEntity(fields="phoneNo"   , message="Sorry, The Phone Number entrance already keepers .")
 * @UniqueEntity(fields="eMail"     , message="Sorry, This e-mail address is owned by another vendor.")
 * @UniqueEntity(fields="accountNo" , message="Sorry, The Account Number entrance already keepers .")
 * @ORM\Entity(repositoryClass="Unisoft\AssetsBundle\Entity\SfServicesRepository")
  */
class Vendors
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
     * @var integer
     *
     * @ORM\Column(name="vendor_no", type="integer", unique=true,  nullable=false)
     */
    private $vendorNo;

    /**
     * @var string
     *
     * @ORM\Column(name="ar_name", type="string", length=50, unique=true,  nullable=false)
     */
    private $arName;

    /**
     * @var string
     *
     * @ORM\Column(name="en_name", type="string", length=50, unique=true, nullable=false)
     */
    private $enName;

    /**
     * @var string
     *
     * @ORM\Column(name="country", type="string", length=20, nullable=false)
     */
    private $country;

    /**
     * @var string
     *
     * @ORM\Column(name="fax_no", type="string", length=11, unique=true, nullable=false)
     */
    private $faxNo;

    /**
     * @var string
     *
     * @ORM\Column(name="phone_no", type="string", length=15, unique=true, nullable=false)
     */
    private $phoneNo;

    /**
     * @var string
     *
     * @ORM\Column(name="e_mail", type="string", length=50,unique=true, nullable=false)
     */
    private $eMail;

    /**
     * @var string
     *
     * @ORM\Column(name="website", type="string", length=100, nullable=false)
     */
    private $website;

    /**
     * @var string
     *
     * @ORM\Column(name="importing_fields", type="string", length=200, nullable=false)
     */
    private $importingFields;

    /**
     * @var string
     *
     * @ORM\Column(name="authorized", type="string", length=100, nullable=false)
     */
    private $authorized;

    /**
     * @var string
     *
     * @ORM\Column(name="account_manager", type="string", length=50, nullable=false)
     */
    private $accountManager;

    /**
     * @var integer
     *
     * @ORM\Column(name="account_no", type="integer", unique=true, nullable=false)
     */
    private $accountNo;


    /**
     * @var string
     *
     * @ORM\Column(name="code_phone", type="string", length=4, nullable=false)
     */
    private $codePhone;

    /**
     * @var string
     *
     * @ORM\Column(name="code_fax", type="string", length=4, nullable=false)
     */
    private $codeFax;



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
     * Set vendorNo
     *
     * @param integer $vendorNo
     * @return Vendors
     */
    public function setVendorNo($vendorNo)
    {
        $this->vendorNo = $vendorNo;
    
        return $this;
    }

    /**
     * Get vendorNo
     *
     * @return integer 
     */
    public function getVendorNo()
    {
        return $this->vendorNo;
    }

    /**
     * Set arName
     *
     * @param string $arName
     * @return Vendors
     */
    public function setArName($arName)
    {
        $this->arName = $arName;
    
        return $this;
    }

    /**
     * Get arName
     *
     * @return string 
     */
    public function getArName()
    {
        return $this->arName;
    }

    /**
     * Set enName
     *
     * @param string $enName
     * @return Vendors
     */
    public function setEnName($enName)
    {
        $this->enName = $enName;
    
        return $this;
    }

    /**
     * Get enName
     *
     * @return string 
     */
    public function getEnName()
    {
        return $this->enName;
    }

    /**
     * Set country
     *
     * @param string $country
     * @return Vendors
     */
    public function setCountry($country)
    {
        $this->country = $country;
    
        return $this;
    }

    /**
     * Get country
     *
     * @return string 
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * Set faxNo
     *
     * @param string $faxNo
     * @return Vendors
     */
    public function setFaxNo($faxNo)
    {
        $this->faxNo = $faxNo;
    
        return $this;
    }

    /**
     * Get faxNo
     *
     * @return string 
     */
    public function getFaxNo()
    {
        return $this->faxNo;
    }

    /**
     * Set phoneNo
     *
     * @param string $phoneNo
     * @return Vendors
     */
    public function setPhoneNo($phoneNo)
    {
        $this->phoneNo = $phoneNo;
    
        return $this;
    }

    /**
     * Get phoneNo
     *
     * @return string 
     */
    public function getPhoneNo()
    {
        return $this->phoneNo;
    }

    /**
     * Set eMail
     *
     * @param string $eMail
     * @return Vendors
     */
    public function setEMail($eMail)
    {
        $this->eMail = $eMail;
    
        return $this;
    }

    /**
     * Get eMail
     *
     * @return string 
     */
    public function getEMail()
    {
        return $this->eMail;
    }

    /**
     * Set website
     *
     * @param string $website
     * @return Vendors
     */
    public function setWebsite($website)
    {
        $this->website = $website;
    
        return $this;
    }

    /**
     * Get website
     *
     * @return string 
     */
    public function getWebsite()
    {
        return $this->website;
    }

    /**
     * Set importingFields
     *
     * @param string $importingFields
     * @return Vendors
     */
    public function setImportingFields($importingFields)
    {
        $this->importingFields = $importingFields;
    
        return $this;
    }

    /**
     * Get importingFields
     *
     * @return string 
     */
    public function getImportingFields()
    {
        return $this->importingFields;
    }

    /**
     * Set authorized
     *
     * @param string $authorized
     * @return Vendors
     */
    public function setAuthorized($authorized)
    {
        $this->authorized = $authorized;
    
        return $this;
    }

    /**
     * Get authorized
     *
     * @return string 
     */
    public function getAuthorized()
    {
        return $this->authorized;
    }

    /**
     * Set accountManager
     *
     * @param string $accountManager
     * @return Vendors
     */
    public function setAccountManager($accountManager)
    {
        $this->accountManager = $accountManager;
    
        return $this;
    }

    /**
     * Get accountManager
     *
     * @return string 
     */
    public function getAccountManager()
    {
        return $this->accountManager;
    }

    /**
     * Set accountNo
     *
     * @param integer $accountNo
     * @return Vendors
     */
    public function setAccountNo($accountNo)
    {
        $this->accountNo = $accountNo;
    
        return $this;
    }

    /**
     * Get accountNo
     *
     * @return integer 
     */
    public function getAccountNo()
    {
        return $this->accountNo;
    }

    /**
     * Set codePhone
     *
     * @param string $codePhone
     * @return Vendors
     */
    public function setCodePhone($codePhone)
    {
        $this->codePhone = $codePhone;
    
        return $this;
    }

    /**
     * Get codePhone
     *
     * @return string 
     */
    public function getCodePhone()
    {
        return $this->codePhone;
    }

    /**
     * Set codeFax
     *
     * @param string $codeFax
     * @return Vendors
     */
    public function setCodeFax($codeFax)
    {
        $this->codeFax = $codeFax;
    
        return $this;
    }

    /**
     * Get codeFax
     *
     * @return string 
     */
    public function getCodeFax()
    {
        return $this->codeFax;
    }
}