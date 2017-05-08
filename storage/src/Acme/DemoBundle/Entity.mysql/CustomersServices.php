<?php

namespace Acme\DemoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CustomersServices
 *
 * @ORM\HasLifecycleCallbacks()
 * @ORM\Table(name="customers_services")
 * @ORM\Entity
 */
class CustomersServices
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
     * @var \Customers
     *
     * @ORM\ManyToOne(targetEntity="Customers")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="customers_id", referencedColumnName="id")
     * })
     */
    private $customers;

    /**
     * @var \Services
     *
     * @ORM\ManyToOne(targetEntity="Services")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="services_id", referencedColumnName="id")
     * })
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
     * Set created
     *
     * @ORM\PrePersist
     * @param \DateTime $created
     * @return CustomersServices
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
     * @return CustomersServices
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
     * Set customers
     *
     * @param \Acme\DemoBundle\Entity\Customers $customers
     * @return CustomersServices
     */
    public function setCustomers(\Acme\DemoBundle\Entity\Customers $customers = null)
    {
        $this->customers = $customers;
    
        return $this;
    }

    /**
     * Get customers
     *
     * @return \Acme\DemoBundle\Entity\Customers 
     */
    public function getCustomers()
    {
        return $this->customers;
    }

    /**
     * Set services
     *
     * @param \Acme\DemoBundle\Entity\Services $services
     * @return CustomersServices
     */
    public function setServices(\Acme\DemoBundle\Entity\Services $services = null)
    {
        $this->services = $services;
    
        return $this;
    }

    /**
     * Get services
     *
     * @return \Acme\DemoBundle\Entity\Services 
     */
    public function getServices()
    {
        return $this->services;
    }
}