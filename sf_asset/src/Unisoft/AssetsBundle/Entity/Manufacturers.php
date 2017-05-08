<?php

namespace Unisoft\AssetsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * Manufacturers
 *
 * @ORM\Table(name="manufacturers")
 * @ORM\Entity
 * @UniqueEntity(fields="manufacturerNo"  , message="Sorry, The Manufacturer Number Has This figure registered system before.")
 * @UniqueEntity(fields="arName"          , message="Sorry, There Is a Previous Record With The Same Arabic Name.")
 * @UniqueEntity(fields="enName"          , message="Sorry, There Is a Previous Record With The Same English Name.")
 * @UniqueEntity(fields="faxNo"           , message="Sorry, The Fax Number entrance already keepers .")
 * @UniqueEntity(fields="phoneNo"         , message="Sorry, The Phone Number entrance already keepers .")
 * @UniqueEntity(fields="eMail"           , message="Sorry, This e-mail address is owned by another vendor.")
 * @ORM\Entity(repositoryClass="Unisoft\AssetsBundle\Entity\SfServicesRepository")
 */
class Manufacturers
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
     * @ORM\Column(name="manufacturer_No", type="integer", unique=true, nullable=false)
     */
    private $manufacturerNo;

    /**
     * @var string
     *
     * @ORM\Column(name="ar_name", type="string", length=50, unique=true, nullable=false)
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
     * @ORM\Column(name="phone_no", type="string", length=11, unique=true, nullable=false)
     */
    private $phoneNo;

    /**
     * @var string
     *
     * @ORM\Column(name="e_mail", type="string", length=50, unique=true, nullable=false)
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
     * @ORM\Column(name="manufacturing_fields", type="string", length=200, nullable=false)
     */
    private $manufacturingFields;

    /**
     * @var string
     *
     * @ORM\Column(name="Manufacturing_Manager", type="string", length=50, nullable=false)
     */
    private $manufacturingManager;

    /**
     * @var string
     *
     * @ORM\Column(name="Regional_Manager", type="string", length=50, nullable=false)
     */
    private $regionalManager;

    /**
     * @var string
     *
     * @ORM\Column(name="Authorized_Agent", type="string", length=50, nullable=false)
     */
    private $authorizedAgent;

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
     * Set manufacturerNo
     *
     * @param integer $manufacturerNo
     * @return Manufacturers
     */
    public function setManufacturerNo($manufacturerNo)
    {
        $this->manufacturerNo = $manufacturerNo;
    
        return $this;
    }

    /**
     * Get manufacturerNo
     *
     * @return integer 
     */
    public function getManufacturerNo()
    {
        return $this->manufacturerNo;
    }

    /**
     * Set arName
     *
     * @param string $arName
     * @return Manufacturers
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
     * @return Manufacturers
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
     * @return Manufacturers
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
     * @return Manufacturers
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
     * @return Manufacturers
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
     * @return Manufacturers
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
     * @return Manufacturers
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
     * Set manufacturingFields
     *
     * @param string $manufacturingFields
     * @return Manufacturers
     */
    public function setManufacturingFields($manufacturingFields)
    {
        $this->manufacturingFields = $manufacturingFields;
    
        return $this;
    }

    /**
     * Get manufacturingFields
     *
     * @return string 
     */
    public function getManufacturingFields()
    {
        return $this->manufacturingFields;
    }

    /**
     * Set manufacturingManager
     *
     * @param string $manufacturingManager
     * @return Manufacturers
     */
    public function setManufacturingManager($manufacturingManager)
    {
        $this->manufacturingManager = $manufacturingManager;
    
        return $this;
    }

    /**
     * Get manufacturingManager
     *
     * @return string 
     */
    public function getManufacturingManager()
    {
        return $this->manufacturingManager;
    }

    /**
     * Set regionalManager
     *
     * @param string $regionalManager
     * @return Manufacturers
     */
    public function setRegionalManager($regionalManager)
    {
        $this->regionalManager = $regionalManager;
    
        return $this;
    }

    /**
     * Get regionalManager
     *
     * @return string 
     */
    public function getRegionalManager()
    {
        return $this->regionalManager;
    }

    /**
     * Set authorizedAgent
     *
     * @param string $authorizedAgent
     * @return Manufacturers
     */
    public function setAuthorizedAgent($authorizedAgent)
    {
        $this->authorizedAgent = $authorizedAgent;
    
        return $this;
    }

    /**
     * Get authorizedAgent
     *
     * @return string 
     */
    public function getAuthorizedAgent()
    {
        return $this->authorizedAgent;
    }

    /**
     * Set codePhone
     *
     * @param string $codePhone
     * @return Manufacturers
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
     * @return Manufacturers
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