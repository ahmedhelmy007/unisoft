<?php

namespace Acme\DemoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * SelfServices
 *
 * @ORM\Table(name="SELF_SERVICES")
 * @ORM\Entity
 */
class SelfServices
{
    /**
     * @var integer
     *
     * @ORM\Column(name="ID", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="SELFSERVICES_ID_SEQ", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="AR_NAME", type="string", length=45, nullable=true)
     */
    private $arName;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="CREATED", type="datetime", nullable=true)
     */
    private $created;

    /**
     * @var string
     *
     * @ORM\Column(name="EN_NAME", type="string", length=45, nullable=true)
     */
    private $enName;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="MODIFIED", type="datetime", nullable=true)
     */
    private $modified;
    
    /**
     * @ORM\ManyToMany(targetEntity="SelfCustomers", mappedBy="services")
     */
    private $customers;
    
    
    public function __construct()
    {
        $this->customers = new ArrayCollection();
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
     * Set arName
     *
     * @param string $arName
     * @return SelfServices
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
     * Set created
     *
     * @param \DateTime $created
     * @return SelfServices
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
     * Set enName
     *
     * @param string $enName
     * @return SelfServices
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

    /**
     * Set modified
     *
     * @param \DateTime $modified
     * @return SelfServices
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
    
    public function getCustomers() {
        return $this->customers;
    }

    public function setCustomers($customers) {
        $this->customers = $customers;
    }

    public function setId($id) {
        $this->id = $id;
    }

}

