<?php

namespace Acme\DemoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Doors
 *
 * @ORM\Table(name="doors")
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 * 
 */
class Doors
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
     * @ORM\Column(name="name", type="string", length=255, nullable=true)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="sub_name", type="string", length=255, nullable=true)
     */
    private $subName;

    /**
     * @var string
     *
     * @ORM\Column(name="pro_name", type="string", length=255, nullable=true)
     */
    private $proName;

    /**
     * @var string
     *
     * @ORM\Column(name="balance", type="string", length=255, nullable=true)
     */
    private $balance;

    /**
     * @var string
     *
     * @ORM\Column(name="price", type="string", length=255, nullable=true)
     */
    private $price;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="datetime", nullable=false)
     */
    private $date;

    /**
     *  @var \Doors
     * @ORM\ManyToOne(targetEntity="Doors", inversedBy="childs")
     * @ORM\JoinColumns({
     * @ORM\JoinColumn(name="perant", referencedColumnName="id")
     *  })
     */
    private $perant;


    /**
     * @var integer
     *
     * @ORM\Column(name="pro_id", type="integer", nullable=true)
     */
    private $proId;

/**
     * Constructor
     */
    public function __construct()
    {
        $this->childs = new ArrayCollection();
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
     * @return Doors
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
     * Set subName
     *
     * @param string $subName
     * @return Doors
     */
    public function setSubName($subName)
    {
        $this->subName = $subName;
    
        return $this;
    }

    /**
     * Get subName
     *
     * @return string 
     */
    public function getSubName()
    {
        return $this->subName;
    }

    /**
     * Set proName
     *
     * @param string $proName
     * @return Doors
     */
    public function setProName($proName)
    {
        $this->proName = $proName;
    
        return $this;
    }

    /**
     * Get proName
     *
     * @return string 
     */
    public function getProName()
    {
        return $this->proName;
    }

    /**
     * Set balance
     *
     * @param string $balance
     * @return Doors
     */
    public function setBalance($balance)
    {
        $this->balance = $balance;
    
        return $this;
    }

    /**
     * Get balance
     *
     * @return string 
     */
    public function getBalance()
    {
        return $this->balance;
    }

    /**
     * Set price
     *
     * @param string $price
     * @return Doors
     */
    public function setPrice($price)
    {
        $this->price = $price;
    
        return $this;
    }

    /**
     * Get price
     *
     * @return string 
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     * @return Doors
     */
    public function setDate($date)
    {
        $this->date = $date;
    
        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime 
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set perant
     *
     * @param integer $perant
     * @return Doors
     */
    public function setPerant($perant)
    {
        $this->perant = $perant;
    
        return $this;
    }

    /**
     * Get perant
     *
     * @return integer 
     */
    public function getPerant()
    {
        return $this->perant;
    }

    /**
     * Set proId
     *
     * @param integer $proId
     * @return Doors
     */
    public function setProId($proId)
    {
        $this->proId = $proId;
    
        return $this;
    }

    /**
     * Get proId
     *
     * @return integer 
     */
    public function getProId()
    {
        return $this->proId;
    }
}