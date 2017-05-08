<?php

namespace Acme\DemoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Stores
 *
 * @ORM\Table(name="stores")
 * @ORM\Entity
 */
class Stores
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
     * @ORM\Column(name="name", type="string", length=45, nullable=true)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="hieght", type="string", length=45, nullable=true)
     */
    private $hieght;

    /**
     * @var string
     *
     * @ORM\Column(name="width", type="string", length=45, nullable=true)
     */
    private $width;

    /**
     * @var string
     *
     * @ORM\Column(name="length", type="string", length=45, nullable=true)
     */
    private $length;

    /**
     * @var string
     *
     * @ORM\Column(name="size", type="string", length=45, nullable=true)
     */
    private $size;

    /**
     * @var string
     *
     * @ORM\Column(name="status", type="string", length=45, nullable=true)
     */
    private $status;

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
     * @ORM\ManyToMany(targetEntity="RentalPeriods", inversedBy="stores")
     * used for insert multiple Rentalperiods as ManyToMany
     */
    private $rentalPeriods;

    /**
     * @ORM\OneToMany(targetEntity="StoresRentalperiods", mappedBy="stores", cascade={"persist"})
     * used for insert multiple Rentalperiods with price
     */
    private $storesRentalperiods;
    
    /**
     * @ORM\OneToMany(targetEntity="StoresRentalperiods", mappedBy="stores", cascade={"remove"})
     * used for delete multiple Rentalperiods
     */
    private $storesRentalperiods2;
    
    /**
     * @ORM\ManyToMany(targetEntity="Agreements", mappedBy="store")
     */
    private $agreement;
    
    public function __construct()
    {
        $this->storesRentalperiods = new ArrayCollection();
        $this->agreement = new ArrayCollection();
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
     * Set name
     *
     * @param string $name
     * @return Stores
     */
    public function setName($name)
    {
        $this->name = $name;
    
        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set hieght
     *
     * @param string $hieght
     * @return Stores
     */
    public function setHieght($hieght)
    {
        $this->hieght = $hieght;
    
        return $this;
    }

    /**
     * Get hieght
     *
     * @return string 
     */
    public function getHieght()
    {
        return $this->hieght;
    }

    /**
     * Set width
     *
     * @param string $width
     * @return Stores
     */
    public function setWidth($width)
    {
        $this->width = $width;
    
        return $this;
    }

    /**
     * Get width
     *
     * @return string 
     */
    public function getWidth()
    {
        return $this->width;
    }

    /**
     * Set length
     *
     * @param string $length
     * @return Stores
     */
    public function setLength($length)
    {
        $this->length = $length;
    
        return $this;
    }

    /**
     * Get length
     *
     * @return string 
     */
    public function getLength()
    {
        return $this->length;
    }

    /**
     * Set size
     *
     * @param string $size
     * @return Stores
     */
    public function setSize($size)
    {
        $this->size = $size;
    
        return $this;
    }

    /**
     * Get size
     *
     * @return string 
     */
    public function getSize()
    {
        return $this->size;
    }

    /**
     * Set status
     *
     * @param string $status
     * @return Stores
     */
    public function setStatus($status)
    {
        $this->status = $status;
    
        return $this;
    }

    /**
     * Get status
     *
     * @return string 
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set created
     *
     * @param \DateTime $created
     * @return Stores
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
     * Set modified
     *
     * @param \DateTime $modified
     * @return Stores
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
    
    public function getRentalPeriods() {
        return $this->rentalPeriods;
    }

    public function setRentalPeriods($rentalPeriods) {
        $this->rentalPeriods = $rentalPeriods;
    }
    public function getStoresRentalperiods() {
        return $this->storesRentalperiods;
    }

    public function setStoresRentalperiods($storesRentalperiods) {
        $this->storesRentalperiods = $storesRentalperiods;
    }

    public function getStoresRentalperiods2() {
        return $this->storesRentalperiods2;
    }

    public function setStoresRentalperiods2($storesRentalperiods2) {
        $this->storesRentalperiods2 = $storesRentalperiods2;
    }

    public function getAgreement() {
        return $this->agreement;
    }

    public function setAgreement($agreement) {
        $this->agreement = $agreement;
    }




}