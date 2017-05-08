<?php

namespace Acme\DemoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\ExecutionContextInterface;

/**
 * RentalPeriods
 *
 * @ORM\Table(name="rental_periods")
 * @ORM\Entity
 */
class RentalPeriods
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
     * @ORM\Column(name="en_name", type="string", length=50, nullable=true)
     */
    private $enName;

    /**
     * @var string
     *
     * @ORM\Column(name="ar_name", type="string", length=50, nullable=true)
     */
    private $arName;

    /**
     * @var string
     *
     * @ORM\Column(name="unit", type="string", length=10, nullable=true)
     */
    private $unit;

    /**
     * @var integer
     *
     * @ORM\Column(name="number_of_units", type="integer", nullable=true)
     */
    private $numberOfUnits;

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
     * @ORM\ManyToMany(targetEntity="Stores", mappedBy="rentalPeriods")
     */
    private $stores;
    
    public function __construct()
    {
        $this->stores = new ArrayCollection();
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
     * Set enName
     *
     * @param string $enName
     * @return RentalPeriods
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
     * @return RentalPeriods
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
     * Set unit
     *
     * @param string $unit
     * @return RentalPeriods
     */
    public function setUnit($unit)
    {
        $this->unit = $unit;
    
        return $this;
    }

    /**
     * Get unit
     *
     * @return string 
     */
    public function getUnit()
    {
        return $this->unit;
    }

    /**
     * Set numberOfUnits
     *
     * @param integer $numberOfUnits
     * @return RentalPeriods
     */
    public function setNumberOfUnits($numberOfUnits)
    {
        $this->numberOfUnits = $numberOfUnits;
    
        return $this;
    }

    /**
     * Get numberOfUnits
     *
     * @return integer 
     */
    public function getNumberOfUnits()
    {
        return $this->numberOfUnits;
    }

    /**
     * Set created
     *
     * @param \DateTime $created
     * @return RentalPeriods
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
     * @return RentalPeriods
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
    
    public function getStores() {
        return $this->stores;
    }

    public function setStores($stores) {
        $this->stores = $stores;
    }


}