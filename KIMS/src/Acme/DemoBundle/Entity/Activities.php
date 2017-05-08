<?php

namespace Acme\DemoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Activities
 *
 * @ORM\Table(name="activities")
 * @ORM\Entity
 */
class Activities
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
     * @ORM\Column(name="date", type="string", length=50, nullable=false)
     */
    private $date;

    /**
     * @var string
     *
     * @ORM\Column(name="price", type="string", length=255, nullable=false)
     */
    private $price;

    /**
     * @var string
     *
     * @ORM\Column(name="statements", type="string", length=255, nullable=false)
     */
    private $statements;

    /**
     * @var integer
     *
     * @ORM\Column(name="active_id", type="integer", nullable=false)
     */
    private $activeId;


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
     * Set date
     *
     * @param \DateTime $date
     * @return Activities
     */
    public function setDate($date)
    {
        $this->date = $date;
    
        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime 
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set price
     *
     * @param string $price
     * @return Activities
     */
    public function setPrice($price)
    {
        $this->price = $price;
    
        return $this;
    }

    /**
     * Get price
     *
     * @return string 
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Set statements
     *
     * @param string $statements
     * @return Activities
     */
    public function setStatements($statements)
    {
        $this->statements = $statements;
    
        return $this;
    }

    /**
     * Get statements
     *
     * @return string 
     */
    public function getStatements()
    {
        return $this->statements;
    }

    /**
     * Set activeId
     *
     * @param integer $activeId
     * @return Activities
     */
    public function setActiveId($activeId)
    {
        $this->activeId = $activeId;
    
        return $this;
    }

    /**
     * Get activeId
     *
     * @return integer 
     */
    public function getActiveId()
    {
        return $this->activeId;
    }
}