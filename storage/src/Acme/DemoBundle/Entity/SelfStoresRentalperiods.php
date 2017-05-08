<?php

namespace Acme\DemoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * SelfStoresRentalperiods
 *
 * @ORM\Table(name="SELF_STORES_RENTALPERIODS")
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks
 */
class SelfStoresRentalperiods
{
    /**
     * @var integer
     *
     * @ORM\Column(name="ID", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="SELFSTORES_RENTAL_ID_SEQ", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var float
     *
     * @ORM\Column(name="PRICE", type="float", nullable=true)
     */
    private $price;

    /**
     * @var \SelfStores
     *
     * @ORM\ManyToOne(targetEntity="SelfStores")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="STORES_ID", referencedColumnName="ID")
     * })
     */
    private $stores;

    /**
     * @var \SelfRentalPeriods
     *
     * @ORM\ManyToOne(targetEntity="SelfRentalPeriods")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="RENTALPERIODS_ID", referencedColumnName="ID")
     * })
     */
    private $rentalPeriods;

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
     * @return SelfStoresRentalperiods
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
     * Set stores
     *
     * @param \Acme\DemoBundle\Entity\SelfStores $stores
     * @return SelfStoresRentalperiods
     */
    public function setStores(\Acme\DemoBundle\Entity\SelfStores $stores = null)
    {
        $this->stores = $stores;
    
        return $this;
    }

    /**
     * Get stores
     *
     * @return \Acme\DemoBundle\Entity\SelfStores 
     */
    public function getStores()
    {
        return $this->stores;
    }

    /**
     * Set rentalperiods
     *
     * @param \Acme\DemoBundle\Entity\SelfRentalPeriods $rentalperiods
     * @return SelfStoresRentalperiods
     */
    public function setPeriod(\Acme\DemoBundle\Entity\SelfRentalPeriods $rentalperiods = null)
    {
        $this->rentalPeriods = $rentalperiods;
    
        return $this;
    }

    /**
     * Get rentalperiods
     *
     * @return \Acme\DemoBundle\Entity\SelfRentalPeriods 
     */
    public function getPeriod()
    {
        return $this->rentalPeriods;
    }
    
}