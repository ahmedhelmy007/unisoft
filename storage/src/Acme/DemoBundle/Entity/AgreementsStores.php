<?php

namespace Acme\DemoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * AgreementsStores
 *
 * @ORM\Table(name="agreements_stores")
 * @ORM\Entity
 */
class AgreementsStores
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
     * @var \Agreements
     *
     * @ORM\ManyToOne(targetEntity="Agreements")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="agreement_id", referencedColumnName="id")
     * })
     */
    private $agreement;

    /**
     * @var \Stores
     *
     * @ORM\ManyToOne(targetEntity="Stores")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="store_id", referencedColumnName="id")
     * })
     */
    private $store;



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
     * Set agreement
     *
     * @param \Acme\DemoBundle\Entity\Agreements $agreement
     * @return AgreementsStores
     */
    public function setAgreement(\Acme\DemoBundle\Entity\Agreements $agreement = null)
    {
        $this->agreement = $agreement;
    
        return $this;
    }

    /**
     * Get agreement
     *
     * @return \Acme\DemoBundle\Entity\Agreements 
     */
    public function getAgreement()
    {
        return $this->agreement;
    }

    /**
     * Set store
     *
     * @param \Acme\DemoBundle\Entity\Stores $store
     * @return AgreementsStores
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
}