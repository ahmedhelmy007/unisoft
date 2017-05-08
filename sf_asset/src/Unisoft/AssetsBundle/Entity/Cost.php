<?php

namespace Unisoft\AssetsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Cost
 *
 * @ORM\Table(name="cost")
 * @ORM\Entity
 * @ORM\Entity(repositoryClass="Unisoft\AssetsBundle\Entity\SfServicesRepository")
 */
class Cost
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
     * @var integer
     *
     * @ORM\Column(name="Cost_center_no", type="integer", nullable=false)
     */
    private $costCenterNo;

    /**
     * @var string
     *
     * @ORM\Column(name="ar_name", type="string", length=50, nullable=false)
     */
    private $arName;

    /**
     * @var string
     *
     * @ORM\Column(name="en_name", type="string", length=50, nullable=false)
     */
    private $enName;



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
     * Set costCenterNo
     *
     * @param integer $costCenterNo
     * @return Cost
     */
    public function setCostCenterNo($costCenterNo)
    {
        $this->costCenterNo = $costCenterNo;
    
        return $this;
    }

    /**
     * Get costCenterNo
     *
     * @return integer 
     */
    public function getCostCenterNo()
    {
        return $this->costCenterNo;
    }

    /**
     * Set arName
     *
     * @param string $arName
     * @return Cost
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
     * Set enName
     *
     * @param string $enName
     * @return Cost
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
}