<?php

namespace Acme\DemoBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;


/**
 * SelfStores
 *
 * @ORM\Table(name="SELF_STORES")
 * @ORM\Entity
 */
class SelfStores
{
    /**
     * @var integer
     *
     * @ORM\Column(name="ID", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="SELFSTORES_ID_SEQ", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="CREATED", type="datetime", nullable=true)
     */
    private $created;

    /**
     * @var string
     *
     * @ORM\Column(name="HIEGHT", type="string", length=45, nullable=true)
     */
    private $hieght;

    /**
     * @var string
     *
     * @ORM\Column(name="LENGTH", type="string", length=45, nullable=true)
     */
    private $length;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="MODIFIED", type="datetime", nullable=true)
     */
    private $modified;

    /**
     * @var string
     *
     * @ORM\Column(name="NAME", type="string", length=45, nullable=true)
     */
    private $name;

    /**
     * Owning Side
     * 
     * @ORM\ManyToMany(targetEntity="SelfRentalPeriods")
     * @ORM\JoinTable(name="SELF_STORES_RENTALPERIODS",
     *      joinColumns={@ORM\JoinColumn(name="STORES_ID", referencedColumnName="ID")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="RENTALPERIODS_ID", referencedColumnName="ID")}
     * )
     * used for insert multiple Rentalperiods as ManyToMany
     */
    private $rentalPeriods;

    /**
     * @ORM\OneToMany(targetEntity="SelfStoresRentalperiods", mappedBy="stores", cascade={"persist"})
     * used for insert multiple Rentalperiods with price
     */
    private $storesRentalperiods;
    
    /**
    * @ORM\OneToMany(targetEntity="SelfStoresRentalperiods", mappedBy="stores", cascade={"remove"})
     * used for delete multiple Rentalperiods
     */
    private $storesRentalperiods2;
    
#    /**
#     * @ORM\ManyToMany(targetEntity="Agreements", mappedBy="store")
#     */
#    private $agreement;
    
    public function __construct()
    {
        $this->storesRentalperiods = new ArrayCollection();
#        $this->agreement = new ArrayCollection();
    }


    /**
     * @var string
     *
     * @ORM\Column(name="ROOM_SIZE", type="string", length=45, nullable=true)
     */
    private $size;

    /**
     * @var string
     *
     * @ORM\Column(name="STATUS", type="string", length=45, nullable=true)
     */
    private $status;

    /**
     * @var string
     *
     * @ORM\Column(name="WIDTH", type="string", length=45, nullable=true)
     */
    private $width;


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
     * Set created
     *
     * @param \DateTime $created
     * @return SelfStores
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
     * Set hieght
     *
     * @param string $hieght
     * @return SelfStores
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
     * Set length
     *
     * @param string $length
     * @return SelfStores
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
     * Set modified
     *
     * @param \DateTime $modified
     * @return SelfStores
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

    /**
     * Set name
     *
     * @param string $name
     * @return SelfStores
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
     * Set size
     *
     * @param string $size
     * @return SelfStores
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
     * @return SelfStores
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
     * Set width
     *
     * @param string $width
     * @return SelfStores
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
}