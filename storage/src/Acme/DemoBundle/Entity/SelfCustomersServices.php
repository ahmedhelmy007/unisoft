<?php

namespace Acme\DemoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * SelfCustomersServices
 *
 * @ORM\Table(name="SELFCUSTOMERS_SERVICES")
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks
 */
class SelfCustomersServices
{
    /**
     * @var integer
     *
     * @ORM\Id
     * @ORM\Column(name="ID", type="integer", nullable=false)"})
     */
    //     * @ORM\Column(name="ID", type="integer", nullable=false, options={"default"="nextval('SELFCUSTOMERS_SERVICES_ID_SEQ'::regclass)"})
    //     * @ORM\GeneratedValue(strategy="NONE")
    //     * @ORM\SequenceGenerator(sequenceName="SELFCUSTOMERS_SERVICES_ID_SEQ", allocationSize=100, initialValue=1)

    private $id;


    private static $staticId=78;
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
     * @var \SelfServices
     *
     * @ORM\ManyToOne(targetEntity="SelfServices")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="SERVICES_ID", referencedColumnName="ID")
     * })
     */
    private $services;

    /**
     * @var \SelfCustomers
     *
     * @ORM\ManyToOne(targetEntity="SelfCustomers")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="CUSTOMERS_ID", referencedColumnName="ID")
     * })
     */
    private $customers;
    
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
     * @return SelfcustomersSelfservices
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
     * @return SelfcustomersSelfservices
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
     * Set selfservices
     *
     * @param \Acme\DemoBundle\Entity\SelfServices $selfservices
     * @return SelfcustomersSelfservices
     */
    public function setServices(\Acme\DemoBundle\Entity\SelfServices $services = null)
    {
        $this->services = $services;
    
        return $this;
    }

    /**
     * Get selfservices
     *
     * @return \Acme\DemoBundle\Entity\SelfServices 
     */
    public function getServices()
    {
        return $this->services;
    }

    /**
     * Set selfcustomers
     *
     * @param \Acme\DemoBundle\Entity\SelfCustomers $selfcustomers
     * @return SelfcustomersSelfservices
     */
    public function setCustomers(\Acme\DemoBundle\Entity\SelfCustomers $customers = null)
    {
        $this->customers = $customers;
    
        return $this;
    }

    /**
     * Get selfcustomers
     *
     * @return \Acme\DemoBundle\Entity\SelfCustomers 
     */
    public function getCustomers()
    {
        return $this->customers;
    }

    /**
     * Set modified
     *
     * @ORM\PrePersist
     * @ORM\PreUpdate
     * @return SelfCustomersServices
     */
    public function testPrePersist()
    {
        exit('end.......');
        self::$staticId++;
        $this->id = self::$staticId;
    
        return $this;
    }
}