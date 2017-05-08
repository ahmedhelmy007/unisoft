<?php

namespace Acme\DemoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Vouchers
 *
 * @ORM\Table(name="vouchers")
 * @ORM\Entity
 */
class Vouchers
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
     * @ORM\Column(name="months_serial", type="integer", nullable=true)
     */
    private $monthsSerial;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="due_date", type="date", nullable=true)
     */
    private $dueDate;

    /**
     * @var float
     *
     * @ORM\Column(name="voucher_value", type="float", nullable=true)
     */
    private $voucherValue;

    /**
     * @var integer
     *
     * @ORM\Column(name="posting_status", type="integer", nullable=false)
     */
    private $postingStatus;

    /**
     * @var integer
     *
     * @ORM\Column(name="evacuation_type", type="integer", nullable=false)
     */
    private $evacuationType;

    /**
     * @var integer
     *
     * @ORM\Column(name="voucher_type", type="integer", nullable=true)
     */
    private $voucherType;

    /**
     * @var integer
     *
     * @ORM\Column(name="branch_id", type="integer", nullable=true)
     */
    private $branchId;

    /**
     * @var integer
     *
     * @ORM\Column(name="voucher_id", type="integer", nullable=true)
     */
    private $voucherId;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="voucher_date", type="date", nullable=true)
     */
    private $voucherDate;

    /**
     * @var float
     *
     * @ORM\Column(name="discound_value", type="float", nullable=false)
     */
    private $discoundValue;

    /**
     * @var float
     *
     * @ORM\Column(name="net_value", type="float", nullable=false)
     */
    private $netValue;

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
     * Set monthsSerial
     *
     * @param integer $monthsSerial
     * @return Vouchers
     */
    public function setMonthsSerial($monthsSerial)
    {
        $this->monthsSerial = $monthsSerial;
    
        return $this;
    }

    /**
     * Get monthsSerial
     *
     * @return integer 
     */
    public function getMonthsSerial()
    {
        return $this->monthsSerial;
    }

    /**
     * Set dueDate
     *
     * @param \DateTime $dueDate
     * @return Vouchers
     */
    public function setDueDate($dueDate)
    {
        $this->dueDate = $dueDate;
    
        return $this;
    }

    /**
     * Get dueDate
     *
     * @return \DateTime 
     */
    public function getDueDate()
    {
        return $this->dueDate;
    }

    /**
     * Set voucherValue
     *
     * @param float $voucherValue
     * @return Vouchers
     */
    public function setVoucherValue($voucherValue)
    {
        $this->voucherValue = $voucherValue;
    
        return $this;
    }

    /**
     * Get voucherValue
     *
     * @return float 
     */
    public function getVoucherValue()
    {
        return $this->voucherValue;
    }

    /**
     * Set postingStatus
     *
     * @param integer $postingStatus
     * @return Vouchers
     */
    public function setPostingStatus($postingStatus)
    {
        $this->postingStatus = $postingStatus;
    
        return $this;
    }

    /**
     * Get postingStatus
     *
     * @return integer 
     */
    public function getPostingStatus()
    {
        return $this->postingStatus;
    }

    /**
     * Set evacuationType
     *
     * @param integer $evacuationType
     * @return Vouchers
     */
    public function setEvacuationType($evacuationType)
    {
        $this->evacuationType = $evacuationType;
    
        return $this;
    }

    /**
     * Get evacuationType
     *
     * @return integer 
     */
    public function getEvacuationType()
    {
        return $this->evacuationType;
    }

    /**
     * Set voucherType
     *
     * @param integer $voucherType
     * @return Vouchers
     */
    public function setVoucherType($voucherType)
    {
        $this->voucherType = $voucherType;
    
        return $this;
    }

    /**
     * Get voucherType
     *
     * @return integer 
     */
    public function getVoucherType()
    {
        return $this->voucherType;
    }

    /**
     * Set branchId
     *
     * @param integer $branchId
     * @return Vouchers
     */
    public function setBranchId($branchId)
    {
        $this->branchId = $branchId;
    
        return $this;
    }

    /**
     * Get branchId
     *
     * @return integer 
     */
    public function getBranchId()
    {
        return $this->branchId;
    }

    /**
     * Set voucherId
     *
     * @param integer $voucherId
     * @return Vouchers
     */
    public function setVoucherId($voucherId)
    {
        $this->voucherId = $voucherId;
    
        return $this;
    }

    /**
     * Get voucherId
     *
     * @return integer 
     */
    public function getVoucherId()
    {
        return $this->voucherId;
    }

    /**
     * Set voucherDate
     *
     * @param \DateTime $voucherDate
     * @return Vouchers
     */
    public function setVoucherDate($voucherDate)
    {
        $this->voucherDate = $voucherDate;
    
        return $this;
    }

    /**
     * Get voucherDate
     *
     * @return \DateTime 
     */
    public function getVoucherDate()
    {
        return $this->voucherDate;
    }

    /**
     * Set discoundValue
     *
     * @param float $discoundValue
     * @return Vouchers
     */
    public function setDiscoundValue($discoundValue)
    {
        $this->discoundValue = $discoundValue;
    
        return $this;
    }

    /**
     * Get discoundValue
     *
     * @return float 
     */
    public function getDiscoundValue()
    {
        return $this->discoundValue;
    }

    /**
     * Set netValue
     *
     * @param float $netValue
     * @return Vouchers
     */
    public function setNetValue($netValue)
    {
        $this->netValue = $netValue;
    
        return $this;
    }

    /**
     * Get netValue
     *
     * @return float 
     */
    public function getNetValue()
    {
        return $this->netValue;
    }

    /**
     * Set agreement
     *
     * @param \Acme\DemoBundle\Entity\Agreements $agreement
     * @return Vouchers
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