<?php

namespace Unisoft\AssetsBundle\Entity;

use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Doctrine\ORM\Mapping as ORM;

/**
 * EmployeeAssets
 *
 * @ORM\Table(name="employee_assets")
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 * @UniqueEntity("moveId")
 */
class EmployeeAssets
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
     * @ORM\Column(name="move_id", type="integer", nullable=false)
     */
    private $moveId;

    /**
     * @var string
     *
     * @ORM\Column(name="note", type="text", nullable=true)
     */
    private $note;

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
     * @var \Employees
     *
     * @ORM\ManyToOne(targetEntity="Employees")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="employee_id", referencedColumnName="id")
     * })
     */
    private $employee;
    
    /*
     * @var \Employees
     *
     * @ORM\ManyToOne(targetEntity="Employees")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="employee_id", referencedColumnName="id")
     * })
     */
    private $employeeObj;

    /**
     * @var \Assets
     *
     * @ORM\ManyToOne(targetEntity="Assets")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="asset_id", referencedColumnName="id")
     * })
     */
    private $asset;



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
     * Set moveId
     *
     * @param integer $moveId
     * @return EmployeeAssets
     */
    public function setId($id)
    {
        $this->id = $id;
    
        return $this;
    }

    /**
     * Set moveId
     *
     * @param integer $moveId
     * @return EmployeeAssets
     */
    public function setMoveId($moveId)
    {
        $this->moveId = $moveId;
    
        return $this;
    }

    /**
     * Get moveId
     *
     * @return integer 
     */
    public function getMoveId()
    {
        return $this->moveId;
    }

    /**
     * Set note
     *
     * @param string $note
     * @return EmployeeAssets
     */
    public function setNote($note)
    {
        $this->note = $note;
    
        return $this;
    }

    /**
     * Get note
     *
     * @return string 
     */
    public function getNote()
    {
        return $this->note;
    }

    /**
     * Set created
     *
     * @param \DateTime $created
     * @return EmployeeAssets
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
     * @return EmployeeAssets
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
     * Set employee
     *
     * @param \Unisoft\AssetsBundle\Entity\Employees $employee
     * @return EmployeeAssets
     */
    public function setEmployee(\Unisoft\AssetsBundle\Entity\Employees $employee = null)
    {
        $this->employee = $employee;
    
        return $this;
    }

    /**
     * Get employee
     *
     * @return \Unisoft\AssetsBundle\Entity\Employees 
     */
    public function getEmployee()
    {
        return $this->employee;
    }
    
    /**
     * Set employee
     *
     * @param \Unisoft\AssetsBundle\Entity\Employees $employee
     * @return EmployeeAssets
     */
    public function setEmployeeObj(\Unisoft\AssetsBundle\Entity\Employees $employee = null)
    {
        $this->employeeObj = $employee;
    
        return $this;
    }

    /**
     * Get employee
     *
     * @return \Unisoft\AssetsBundle\Entity\Employees 
     */
    public function getEmployeeObj()
    {
        return $this->employeeObj;
    }

    /**
     * Set asset
     *
     * @param \Unisoft\AssetsBundle\Entity\Assets $asset
     * @return EmployeeAssets
     */
    public function setAsset(\Unisoft\AssetsBundle\Entity\Assets $asset = null)
    {
        $this->asset = $asset;
    
        return $this;
    }

    /**
     * Get asset
     *
     * @return \Unisoft\AssetsBundle\Entity\Assets 
     */
    public function getAsset()
    {
        return $this->asset;
    }
    
    /**
     * @ORM\PrePersist
     */
    public function setCreatedValue() {
        if (null === $this->id) {
            $this->created = new \DateTime();
        }
        $this->modified = new \DateTime();
    }
}