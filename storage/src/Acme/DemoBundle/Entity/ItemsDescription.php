<?php

namespace Acme\DemoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;


/**
 * ItemsDescription
 *
 * @ORM\Table(name="items_description")
 * @ORM\Entity
 */
class ItemsDescription
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
     * @ORM\Column(name="description", type="text", nullable=true)
     */
    private $description;

    /**
     * @var \Agreements
     *
     * @ORM\ManyToOne(targetEntity="Agreements")
     * @ORM\JoinColumns({
     * @ORM\JoinColumn(name="agreement_id", referencedColumnName="id")
     * })
     */
    private $agreement;



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
     * Set description
     *
     * @param string $description
     * @return ItemsDescription
     */
    public function setDescription($description)
    {
        $this->description = $description;
    
        return $this;
    }

    /**
     * Get description
     *
     * @return string 
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set agreement
     *
     * @param \Acme\DemoBundle\Entity\Agreements $agreement
     * @return ItemsDescription
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
}