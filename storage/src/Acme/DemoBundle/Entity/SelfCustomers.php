<?php

namespace Acme\DemoBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * SelfCustomers
 *
 * @ORM\HasLifecycleCallbacks()
 * @ORM\Table(name="SELF_CUSTOMERS")
 * @ORM\Entity(repositoryClass="Acme\DemoBundle\Entity\SfServicesRepository")
 * @UniqueEntity(fields="customerNo"  , message="Customer Number Has This figure registered system before")
 */
class SelfCustomers
{
    /**
     * @var integer
     *
     * @ORM\Column(name="ID", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="SELFCUSTOMERS_ID_SEQ", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="ADDRESS", type="string", length=45, nullable=true)
     */
    private $address;

    /**
     * @var string
     *
     * @ORM\Column(name="AR_NAME", type="string", length=150, nullable=true)
     */
    private $arName;

    /**
     * @var string
     *
     * @ORM\Column(name="CIVIL_ID", type="string", length=45, nullable=true)
     */
    private $civilId;

    /**
     * @var string
     *
     * @ORM\Column(name="CONTACT_MOBILE", type="string", length=45, nullable=true)
     */
    private $contactMobile;

    /**
     * @var string
     *
     * @ORM\Column(name="CONTACT_PERSON", type="string", length=45, nullable=true)
     */
    private $contactPerson;

    /**
     * @var string
     *
     * @ORM\Column(name="CONTACT_PHONE", type="string", length=45, nullable=true)
     */
    private $contactPhone;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="CREATED", type="datetime", nullable=true)
     */
    private $created;

    /**
     * @var integer
     *
     * @ORM\Column(name="CUSTOMER_NO", type="integer", nullable=true)
     */
    private $customerNo;

    /**
     * @var string
     *
     * @ORM\Column(name="EMAIL", type="string", length=45, nullable=true)
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="EN_NAME", type="string", length=150, nullable=true)
     */
    private $enName;

    /**
     * @var string
     *
     * @ORM\Column(name="FAX", type="string", length=45, nullable=true)
     */
    private $fax;

    /**
     * @var string
     *
     * @ORM\Column(name="FLAT", type="string", length=45, nullable=true)
     */
    private $flat;

    /**
     * @var string
     *
     * @ORM\Column(name="FLOOR", type="string", length=45, nullable=true)
     */
    private $floor;

    /**
     * @var string
     *
     * @ORM\Column(name="GADA", type="string", length=45, nullable=true)
     */
    private $gada;

    /**
     * @var string
     *
     * @ORM\Column(name="GENDER", type="string", length=45, nullable=true)
     */
    private $gender;

    /**
     * @var string
     *
     * @ORM\Column(name="HOUSE", type="string", length=45, nullable=true)
     */
    private $house;

    /**
     * @var string
     *
     * @ORM\Column(name="MOBILE", type="string", length=45, nullable=true)
     */
    private $mobile;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="MODIFIED", type="datetime", nullable=true)
     */
    private $modified;

    /**
     * @var string
     *
     * @ORM\Column(name="NOTES", type="string", length=45, nullable=true)
     */
    private $notes;

    /**
     * @var string
     *
     * @ORM\Column(name="PART", type="string", length=45, nullable=true)
     */
    private $part;

    /**
     * @var string
     *
     * @ORM\Column(name="PHONE", type="string", length=45, nullable=true)
     */
    private $phone;

    /**
     * @var string
     *
     * @ORM\Column(name="REGION", type="string", length=45, nullable=true)
     */
    private $region;

    /**
     * @var string
     *
     * @ORM\Column(name="STREET", type="string", length=45, nullable=true)
     */
    private $street;

    /**
     * @var \SelfNationalities
     *
     * @ORM\ManyToOne(targetEntity="SelfNationalities")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="NATIONALITY_ID", referencedColumnName="ID")
     * })
     */
    private $nationality;
    
    /**
     * Owning Side
     * 
     * @ORM\ManyToMany(targetEntity="SelfServices")
     * @ORM\JoinTable(name="SELF_CUSTOMERS_SERVICES",
     *      joinColumns={@ORM\JoinColumn(name="CUSTOMERS_ID", referencedColumnName="ID")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="SERVICES_ID", referencedColumnName="ID")}
     * )
     */
    private $services;

    /**
     * @ORM\OneToMany(targetEntity="SelfCustomersServices", mappedBy="customer123s", cascade={"persist"})
     * used for insert multiple Rentalperiods with price
     */
    private $customersServices;

    public function __construct()
    {
        $this->services = new ArrayCollection();
#        $this->agreement = new ArrayCollection();
    }

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
     * Set address
     *
     * @param string $address
     * @return SelfCustomers
     */
    public function setAddress($address)
    {
        $this->address = $address;
    
        return $this;
    }

    /**
     * Get address
     *
     * @return string 
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * Set arName
     *
     * @param string $arName
     * @return SelfCustomers
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
     * Set civilId
     *
     * @param string $civilId
     * @return SelfCustomers
     */
    public function setCivilId($civilId)
    {
        $this->civilId = $civilId;
    
        return $this;
    }

    /**
     * Get civilId
     *
     * @return string 
     */
    public function getCivilId()
    {
        return $this->civilId;
    }

    /**
     * Set contactMobile
     *
     * @param string $contactMobile
     * @return SelfCustomers
     */
    public function setContactMobile($contactMobile)
    {
        $this->contactMobile = $contactMobile;
    
        return $this;
    }

    /**
     * Get contactMobile
     *
     * @return string 
     */
    public function getContactMobile()
    {
        return $this->contactMobile;
    }

    /**
     * Set contactPerson
     *
     * @param string $contactPerson
     * @return SelfCustomers
     */
    public function setContactPerson($contactPerson)
    {
        $this->contactPerson = $contactPerson;
    
        return $this;
    }

    /**
     * Get contactPerson
     *
     * @return string 
     */
    public function getContactPerson()
    {
        return $this->contactPerson;
    }

    /**
     * Set contactPhone
     *
     * @param string $contactPhone
     * @return SelfCustomers
     */
    public function setContactPhone($contactPhone)
    {
        $this->contactPhone = $contactPhone;
    
        return $this;
    }

    /**
     * Get contactPhone
     *
     * @return string 
     */
    public function getContactPhone()
    {
        return $this->contactPhone;
    }

    /**
     * Set created
     *
     * @param \DateTime $created
     * @return SelfCustomers
     */
    public function setCreated($created)
    {
        $this->created = $created;
    
        return $this;
    }

    /**
     * Get created
     *
     * @return \DateTime 
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * Set customerNo
     *
     * @param integer $customerNo
     * @return SelfCustomers
     */
    public function setCustomerNo($customerNo)
    {
        $this->customerNo = $customerNo;
    
        return $this;
    }

    /**
     * Get customerNo
     *
     * @return integer 
     */
    public function getCustomerNo()
    {
        return $this->customerNo;
    }

    /**
     * Set email
     *
     * @param string $email
     * @return SelfCustomers
     */
    public function setEmail($email)
    {
        $this->email = $email;
    
        return $this;
    }

    /**
     * Get email
     *
     * @return string 
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set enName
     *
     * @param string $enName
     * @return SelfCustomers
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
     * Set fax
     *
     * @param string $fax
     * @return SelfCustomers
     */
    public function setFax($fax)
    {
        $this->fax = $fax;
    
        return $this;
    }

    /**
     * Get fax
     *
     * @return string 
     */
    public function getFax()
    {
        return $this->fax;
    }

    /**
     * Set flat
     *
     * @param string $flat
     * @return SelfCustomers
     */
    public function setFlat($flat)
    {
        $this->flat = $flat;
    
        return $this;
    }

    /**
     * Get flat
     *
     * @return string 
     */
    public function getFlat()
    {
        return $this->flat;
    }

    /**
     * Set floor
     *
     * @param string $floor
     * @return SelfCustomers
     */
    public function setFloor($floor)
    {
        $this->floor = $floor;
    
        return $this;
    }

    /**
     * Get floor
     *
     * @return string 
     */
    public function getFloor()
    {
        return $this->floor;
    }

    /**
     * Set gada
     *
     * @param string $gada
     * @return SelfCustomers
     */
    public function setGada($gada)
    {
        $this->gada = $gada;
    
        return $this;
    }

    /**
     * Get gada
     *
     * @return string 
     */
    public function getGada()
    {
        return $this->gada;
    }

    /**
     * Set gender
     *
     * @param string $gender
     * @return SelfCustomers
     */
    public function setGender($gender)
    {
        $this->gender = $gender;
    
        return $this;
    }

    /**
     * Get gender
     *
     * @return string 
     */
    public function getGender()
    {
        return $this->gender;
    }

    /**
     * Set house
     *
     * @param string $house
     * @return SelfCustomers
     */
    public function setHouse($house)
    {
        $this->house = $house;
    
        return $this;
    }

    /**
     * Get house
     *
     * @return string 
     */
    public function getHouse()
    {
        return $this->house;
    }

    /**
     * Set mobile
     *
     * @param string $mobile
     * @return SelfCustomers
     */
    public function setMobile($mobile)
    {
        $this->mobile = $mobile;
    
        return $this;
    }

    /**
     * Get mobile
     *
     * @return string 
     */
    public function getMobile()
    {
        return $this->mobile;
    }

    /**
     * Set modified
     *
     * @param \DateTime $modified
     * @return SelfCustomers
     */
    public function setModified($modified)
    {
        $this->modified = $modified;
    
        return $this;
    }

    /**
     * Get modified
     *
     * @return \DateTime 
     */
    public function getModified()
    {
        return $this->modified;
    }

    /**
     * Set notes
     *
     * @param string $notes
     * @return SelfCustomers
     */
    public function setNotes($notes)
    {
        $this->notes = $notes;
    
        return $this;
    }

    /**
     * Get notes
     *
     * @return string 
     */
    public function getNotes()
    {
        return $this->notes;
    }

    /**
     * Set part
     *
     * @param string $part
     * @return SelfCustomers
     */
    public function setPart($part)
    {
        $this->part = $part;
    
        return $this;
    }

    /**
     * Get part
     *
     * @return string 
     */
    public function getPart()
    {
        return $this->part;
    }

    /**
     * Set phone
     *
     * @param string $phone
     * @return SelfCustomers
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;
    
        return $this;
    }

    /**
     * Get phone
     *
     * @return string 
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * Set region
     *
     * @param string $region
     * @return SelfCustomers
     */
    public function setRegion($region)
    {
        $this->region = $region;
    
        return $this;
    }

    /**
     * Get region
     *
     * @return string 
     */
    public function getRegion()
    {
        return $this->region;
    }

    /**
     * Set street
     *
     * @param string $street
     * @return SelfCustomers
     */
    public function setStreet($street)
    {
        $this->street = $street;
    
        return $this;
    }

    /**
     * Get street
     *
     * @return string 
     */
    public function getStreet()
    {
        return $this->street;
    }

    /**
     * Set nationality
     *
     * @param \Acme\DemoBundle\Entity\SelfNationalities $nationality
     * @return SelfCustomers
     */
    public function setNationality(\Acme\DemoBundle\Entity\SelfNationalities $nationality = null)
    {
        $this->nationality = $nationality;
    
        return $this;
    }

    /**
     * Get nationality
     *
     * @return \Acme\DemoBundle\Entity\SelfNationalities 
     */
    public function getNationality()
    {
        return $this->nationality;
    }
    
    public function getServices() {
        return $this->services;
    }

    public function setServices($services) {
        $this->services = $services;
    }

//    public function getCustomersServices() {
//        return $this->customersServices;
//    }
//
//    public function setCustomersServices($customersServices) {
//        $this->customersServices = $customersServices;
//    }

}