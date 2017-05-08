<?php

namespace Acme\DemoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * AuthorizedPersons
 *
 * @ORM\Table(name="authorized_persons")
 * @ORM\Entity
 */
class AuthorizedPersons
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
     * @ORM\Column(name="name", type="string", length=150, nullable=true)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="civil_id", type="string", length=45, nullable=true)
     */
    private $civilId;

    /**
     * @var string
     *
     * @ORM\Column(name="phone", type="string", length=45, nullable=true)
     */
    private $phone;

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
     * @return AuthorizedPersons
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
     * Set civilId
     *
     * @param string $civilId
     * @return AuthorizedPersons
     */
    public function setCivilId($civilId)
    {
        $this->civilId = $civilId;
    
        return $this;
    }

    /**
     * Get civilId
     *
     * @return string 
     */
    public function getCivilId()
    {
        return $this->civilId;
    }

    /**
     * Set phone
     *
     * @param string $phone
     * @return AuthorizedPersons
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;
    
        return $this;
    }

    /**
     * Get phone
     *
     * @return string 
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * Set agreement
     *
     * @param \Acme\DemoBundle\Entity\Agreements $agreement
     * @return AuthorizedPersons
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