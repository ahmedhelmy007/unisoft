<?php

namespace Acme\DemoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * Customers
 *
 * @ORM\HasLifecycleCallbacks()
 * @ORM\Table(name="customers")
 * @ORM\Entity
 * @ORM\Entity(repositoryClass="Acme\DemoBundle\Entity\SfServicesRepository")
 * @UniqueEntity(fields="customerNo"  , message="Customer Number Has This figure registered system before")
 */
class Customers
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
     * @ORM\Column(name="customer_no", type="integer", nullable=true)
     */
    private $customerNo;

    /**
     * @var string
     *
     * @ORM\Column(name="en_name", type="string", length=150, nullable=true)
     */
    private $enName;

    /**
     * @var string
     *
     * @ORM\Column(name="ar_name", type="string", length=150, nullable=true)
     */
    private $arName;

    /**
     * @var string
     *
     * @ORM\Column(name="civil_id", type="string", length=45, nullable=true)
     */
    private $civilId;

    /**
     * @var string
     *
     * @ORM\Column(name="mobile", type="string", length=45, nullable=true)
     */
    private $mobile;

    /**
     * @var string
     *
     * @ORM\Column(name="phone", type="string", length=45, nullable=true)
     */
    private $phone;

    /**
     * @var string
     *
     * @ORM\Column(name="fax", type="string", length=45, nullable=true)
     */
    private $fax;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=45, nullable=true)
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="gender", type="string", length=45, nullable=true)
     */
    private $gender;

    /**
     * @var string
     *
     * @ORM\Column(name="contact_person", type="string", length=45, nullable=true)
     */
    private $contactPerson;

    /**
     * @var string
     *
     * @ORM\Column(name="contact_mobile", type="string", length=45, nullable=true)
     */
    private $contactMobile;

    /**
     * @var string
     *
     * @ORM\Column(name="contact_phone", type="string", length=45, nullable=true)
     */
    private $contactPhone;

    /**
     * @var string
     *
     * @ORM\Column(name="address", type="string", length=255, nullable=true)
     */
    private $address;

    /**
     * @var string
     *
     * @ORM\Column(name="region", type="string", length=45, nullable=true)
     */
    private $region;

    /**
     * @var string
     *
     * @ORM\Column(name="part", type="string", length=45, nullable=true)
     */
    private $part;

    /**
     * @var string
     *
     * @ORM\Column(name="gada", type="string", length=45, nullable=true)
     */
    private $gada;

    /**
     * @var string
     *
     * @ORM\Column(name="street", type="string", length=45, nullable=true)
     */
    private $street;

    /**
     * @var string
     *
     * @ORM\Column(name="house", type="string", length=45, nullable=true)
     */
    private $house;

    /**
     * @var string
     *
     * @ORM\Column(name="floor", type="string", length=45, nullable=true)
     */
    private $floor;

    /**
     * @var string
     *
     * @ORM\Column(name="flat", type="string", length=45, nullable=true)
     */
    private $flat;

    /**
     * @var string
     *
     * @ORM\Column(name="notes", type="string", length=45, nullable=true)
     */
    private $notes;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created", type="datetime", nullable=true)
     */
    private $created;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="modified", type="datetime", nullable=true)
     */
    private $modified;

    /**
     * @var \Nationalities
     *
     * @ORM\ManyToOne(targetEntity="Nationalities")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="nationality_id", referencedColumnName="id")
     * })
     */
    private $nationality;
    
    /**
     * @ORM\ManyToMany(targetEntity="Services", inversedBy="customers")
     */
    private $services;


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
     * Set customerNo
     *
     * @param integer $customerNo
     * @return Customers
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
     * Set enName
     *
     * @param string $enName
     * @return Customers
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
     * Set arName
     *
     * @param string $arName
     * @return Customers
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
     * @return Customers
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
     * Set mobile
     *
     * @param string $mobile
     * @return Customers
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
     * Set phone
     *
     * @param string $phone
     * @return Customers
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
     * Set fax
     *
     * @param string $fax
     * @return Customers
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
     * Set email
     *
     * @param string $email
     * @return Customers
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
     * Set gender
     *
     * @param string $gender
     * @return Customers
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
     * Set contactPerson
     *
     * @param string $contactPerson
     * @return Customers
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
     * Set contactMobile
     *
     * @param string $contactMobile
     * @return Customers
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
     * Set contactPhone
     *
     * @param string $contactPhone
     * @return Customers
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
     * Set address
     *
     * @param string $address
     * @return Customers
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
     * Set region
     *
     * @param string $region
     * @return Customers
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
     * Set part
     *
     * @param string $part
     * @return Customers
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
     * Set gada
     *
     * @param string $gada
     * @return Customers
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
     * Set street
     *
     * @param string $street
     * @return Customers
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
     * Set house
     *
     * @param string $house
     * @return Customers
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
     * Set floor
     *
     * @param string $floor
     * @return Customers
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
     * Set flat
     *
     * @param string $flat
     * @return Customers
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
     * Set notes
     *
     * @param string $notes
     * @return Customers
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
     * Set created
     *
     * @ORM\PrePersist
     * @param \DateTime $created
     * @return Customers
     */
    public function setCreated($created='')
    {
        $this->created = new \DateTime();
    
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
     * Set modified
     *
     * @ORM\PrePersist
     * @ORM\PreUpdate
     * @param \DateTime $modified
     * @return Customers
     */
    public function setModified($modified='')
    {
        $this->modified = new \DateTime();
    
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
     * Set nationality
     *
     * @param \Acme\DemoBundle\Entity\Nationalities $nationality
     * @return Customers
     */
    public function setNationality(\Acme\DemoBundle\Entity\Nationalities $nationality = null)
    {
        $this->nationality = $nationality;
    
        return $this;
    }

    /**
     * Get nationality
     *
     * @return \Acme\DemoBundle\Entity\Nationalities 
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

 /**
 * Remove service
 *
 * @param service $service
 */
public function removeService($service)
{
    $key = $this->services->indexOf($service);

    if($key!==FALSE) 
    {
        $this->services->remove($key);
    }
}

}