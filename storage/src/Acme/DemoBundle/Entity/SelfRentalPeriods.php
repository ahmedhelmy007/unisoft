<?php

namespace Acme\DemoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\ExecutionContextInterface;

/**
 * SelfRentalPeriods
 *
 * @ORM\Table(name="SELF_RENTAL_PERIODS")
 * @ORM\Entity
 */
class SelfRentalPeriods
{
    /**
     * @var integer
     *
     * @ORM\Column(name="ID", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="SELFRENTAL_PERIODS_ID_SEQ", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="EN_NAME", type="string", length=255, nullable=true)
     */
    private $enName;

    /**
     * @var string
     *
     * @ORM\Column(name="AR_NAME", type="string", length=255, nullable=true)
     */
    private $arName;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="CREATED", type="datetime", nullable=true)
     */
    private $created;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="MODIFIED", type="datetime", nullable=true)
     */
    private $modified;

    /**
     * @var integer
     *
     * @ORM\Column(name="NUMBER_OF_UNITS", type="integer", nullable=true)
     */
    private $numberOfUnits;

    /**
     * @var string
     *
     * @ORM\Column(name="UNIT", type="string", length=20, nullable=true)
     */
    private $unit;

    /**
     * @ORM\ManyToMany(targetEntity="SelfStores", mappedBy="rentalPeriods")
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
     * Set arName
     *
     * @param string $arName
     * @return SelfRentalPeriods
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
     * Set created
     *
     * @param \DateTime $created
     * @return SelfRentalPeriods
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
     * Set enName
     *
     * @param string $enName
     * @return SelfRentalPeriods
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
     * Set modified
     *
     * @param \DateTime $modified
     * @return SelfRentalPeriods
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
     * Set numberOfUnits
     *
     * @param integer $numberOfUnits
     * @return SelfRentalPeriods
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
     * Set unit
     *
     * @param string $unit
     * @return SelfRentalPeriods
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

}