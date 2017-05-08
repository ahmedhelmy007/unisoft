<?php

namespace Acme\DemoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * StoresRentalperiods
 *
 * @ORM\Table(name="stores_rentalperiods")
 * @ORM\Entity
 */
class StoresRentalperiods
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
     * @var float
     *
     * @ORM\Column(name="price", type="float", nullable=true)
     */
    private $price;

    /**
     * @var \Stores
     *
     * @ORM\ManyToOne(targetEntity="Stores")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="stores_id", referencedColumnName="id")
     * })
     */
    private $store;

    /**
     * @var \RentalPeriods
     *
     * @ORM\ManyToOne(targetEntity="RentalPeriods")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="rentalperiods_id", referencedColumnName="id")
     * })
     */
    private $period;

    
    /**
     * @var \stores
     *
     * @ORM\ManyToOne(targetEntity="Stores")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="stores_id", referencedColumnName="id")
     * })
     */
    private $stores;

    public function __construct()
    {
//        $this->stores = new ArrayCollection();
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
     * Set price
     *
     * @param float $price
     * @return StoresRentalperiods
     */
    public function setPrice($price)
    {
        $this->price = $price;
    
        return $this;
    }

    /**
     * Get price
     *
     * @return float 
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Set store
     *
     * @param \Acme\DemoBundle\Entity\Stores $store
     * @return StoresRentalperiods
     */
    public function setStore(\Acme\DemoBundle\Entity\Stores $store = null)
    {
        $this->store = $store;
    
        return $this;
    }

    /**
     * Get store
     *
     * @return \Acme\DemoBundle\Entity\Stores 
     */
    public function getStore()
    {
        return $this->store;
    }

    /**
     * Set period
     *
     * @param \Acme\DemoBundle\Entity\RentalPeriods $period
     * @return StoresRentalperiods
     */
    public function setPeriod(\Acme\DemoBundle\Entity\RentalPeriods $period = null)
    {
        $this->period = $period;
    
        return $this;
    }

    /**
     * Get period
     *
     * @return \Acme\DemoBundle\Entity\RentalPeriods 
     */
    public function getPeriod()
    {
        return $this->period;
    }
    
    public function getStores() {
        return $this->stores;
    }

    public function setStores($stores) {
        $this->stores = $stores;
    }

   public function __toString()
{
    return  (string) $this->getPrice();
}


}