<?php

namespace Unisoft\AssetsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * Position
 *
 * @ORM\Table(name="position")
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 * @UniqueEntity(fields="positionNo"  , message="Sorry, The Position Number Has This figure registered system before")
 * @UniqueEntity(fields="arName"    , message="Sorry, There Is a Previous Record With The Same Arabic Name.")
 * @UniqueEntity(fields="enName"    , message="Sorry, There Is a Previous Record With The Same English Name.")
 * @ORM\Entity(repositoryClass="Unisoft\AssetsBundle\Entity\SfServicesRepository")
 */
class Position
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
     * @ORM\Column(name="position_no", type="integer", unique=true,  nullable=false)
     */
    private $positionNo;

    /**
     * @var string
     *
     * @ORM\Column(name="en_name", type="string", length=50, nullable=true)
     */
    private $enName;
    
    /**
     * @var string
     *
     * @ORM\Column(name="ar_name", type="string", length=50, nullable=true)
     */
    private $arName;

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
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set departmentNo
     *
     * @param integer $positionNo
     * @return Position
     */
    public function setPositionNo($positionNo)
    {
        $this->positionNo = $positionNo;
    
        return $this;
    }

    /**
     * Get positionNo
     *
     * @return integer 
     */
    public function getPositionNo()
    {
        return $this->positionNo;
    }

    /**
     * Set enName
     *
     * @param string $enName
     * @return Departments
     */
    public function setEnName($en_name)
    {
        $this->enName = $en_name;
    
        return $this;
    }

    /**
     * Get en_name
     *
     * @return string 
     */
    public function getEnName()
    {
        return $this->enName;
    }
    
    /**
     * Set arName
     *
     * @param string $ar_name
     * @return Departments
     */
    public function setArName($ar_name)
    {
        $this->arName = $ar_name;
    
        return $this;
    }

    /**
     * Get ar_name
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
     * @return Position
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
     * @return Position
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
     * @ORM\PrePersist
     */
    //@ORM\PostPersist()
    public function setCreatedValue() {
        if (null === $this->id) {
            $this->created = new \DateTime();
        }
        $this->modified = new \DateTime();
    }
    
    
}