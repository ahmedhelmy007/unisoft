<?php

namespace Unisoft\AssetsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * WarrantyUnits2
 *
 * @ORM\Table(name="warranty_units2")
 * @ORM\Entity
 */
class WarrantyUnits2
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
     * @ORM\Column(name="name", type="string", length=45, nullable=true)
     */
    private $name;

    /**
     * @var \WarrantyTypes
     *
     * @ORM\ManyToOne(targetEntity="WarrantyTypes")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="warranty_type_id", referencedColumnName="id")
     * })
     */
    private $warrantyType;



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
     * @return WarrantyUnits2
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
     * Set warrantyType
     *
     * @param \Unisoft\AssetsBundle\Entity\WarrantyTypes $warrantyType
     * @return WarrantyUnits2
     */
    public function setWarrantyType(\Unisoft\AssetsBundle\Entity\WarrantyTypes $warrantyType = null)
    {
        $this->warrantyType = $warrantyType;
    
        return $this;
    }

    /**
     * Get warrantyType
     *
     * @return \Unisoft\AssetsBundle\Entity\WarrantyTypes 
     */
    public function getWarrantyType()
    {
        return $this->warrantyType;
    }
}