<?php

namespace Acme\DemoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Agreements
 *
 * @ORM\Table(name="agreements")
 * @ORM\Entity
 */
class Agreements
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
     * @ORM\Column(name="agreement_no", type="integer", nullable=true)
     */
    private $agreementNo;

    /**
     * @var integer
     *
     * @ORM\Column(name="agreement_type", type="integer", nullable=true)
     */
    private $agreementType;

    /**
     * @var string
     *
     * @ORM\Column(name="transaction_type", type="string", length=45, nullable=true)
     */
    private $transactionType;

    /**
     * @var integer
     *
     * @ORM\Column(name="agreement_id", type="integer", nullable=true)
     */
    private $agreementId;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="agreement_date", type="date", nullable=true)
     */
    private $agreementDate;

    /**
     * @var string
     *
     * @ORM\Column(name="discount_policies", type="string", length=45, nullable=true)
     */
    private $discountPolicies;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="start_date", type="date", nullable=true)
     */
    private $startDate;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="end_date", type="date", nullable=true)
     */
    private $endDate;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="evacuation_date", type="date", nullable=true)
     */
    private $evacuationDate;

    /**
     * @var float
     *
     * @ORM\Column(name="total_area", type="float", nullable=true)
     */
    private $totalArea;

    /**
     * @var float
     *
     * @ORM\Column(name="rental_value", type="float", nullable=true)
     */
    private $rentalValue;

    /**
     * @var float
     *
     * @ORM\Column(name="insurance_value", type="float", nullable=true)
     */
    private $insuranceValue;

    /**
     * @var float
     *
     * @ORM\Column(name="deposit_value", type="float", nullable=true)
     */
    private $depositValue;

    /**
     * @var float
     *
     * @ORM\Column(name="other_fees", type="float", nullable=true)
     */
    private $otherFees;

    /**
     * @var float
     *
     * @ORM\Column(name="total_value", type="float", nullable=true)
     */
    private $totalValue;

    /**
     * @var float
     *
     * @ORM\Column(name="offer_discount", type="float", nullable=true)
     */
    private $offerDiscount;

    /**
     * @var float
     *
     * @ORM\Column(name="other_discount", type="float", nullable=true)
     */
    private $otherDiscount;

    /**
     * @var float
     *
     * @ORM\Column(name="net_value", type="float", nullable=true)
     */
    private $netValue;

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
     * @var \Customers
     *
     * @ORM\ManyToOne(targetEntity="Customers")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="customer_id", referencedColumnName="id")
     * })
     */
    private $customer;

    /**
     * @var \Services
     *
     * @ORM\ManyToOne(targetEntity="Services")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="service_id", referencedColumnName="id")
     * })
     */
    private $service;

    /**
     * @var \SalesPerson
     *
     * @ORM\ManyToOne(targetEntity="SalesPerson")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="sales_id", referencedColumnName="id")
     * })
     */
    private $sales;

    /**
     * @var \RentalPeriods
     *
     * @ORM\ManyToOne(targetEntity="RentalPeriods")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="rental_period_id", referencedColumnName="id")
     * })
     */
    private $rentalPeriod;
    
    
    private $agreementStatus;



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
     * Set agreementNo
     *
     * @param integer $agreementNo
     * @return Agreements
     */
    public function setAgreementNo($agreementNo)
    {
        $this->agreementNo = $agreementNo;
    
        return $this;
    }

    /**
     * Get agreementNo
     *
     * @return integer 
     */
    public function getAgreementNo()
    {
        return $this->agreementNo;
    }

    /**
     * Set agreementType
     *
     * @param integer $agreementType
     * @return Agreements
     */
    public function setAgreementType($agreementType)
    {
        $this->agreementType = $agreementType;
    
        return $this;
    }

    /**
     * Get agreementType
     *
     * @return integer 
     */
    public function getAgreementType()
    {
        return $this->agreementType;
    }

    /**
     * Set transactionType
     *
     * @param string $transactionType
     * @return Agreements
     */
    public function setTransactionType($transactionType)
    {
        $this->transactionType = $transactionType;
    
        return $this;
    }

    /**
     * Get transactionType
     *
     * @return string 
     */
    public function getTransactionType()
    {
        return $this->transactionType;
    }

    /**
     * Set agreementId
     *
     * @param integer $agreementId
     * @return Agreements
     */
    public function setAgreementId($agreementId)
    {
        $this->agreementId = $agreementId;
    
        return $this;
    }

    /**
     * Get agreementId
     *
     * @return integer 
     */
    public function getAgreementId()
    {
        return $this->agreementId;
    }

    /**
     * Set agreementDate
     *
     * @param \DateTime $agreementDate
     * @return Agreements
     */
    public function setAgreementDate($agreementDate)
    {
        $this->agreementDate = $agreementDate;
    
        return $this;
    }

    /**
     * Get agreementDate
     *
     * @return \DateTime 
     */
    public function getAgreementDate()
    {
        return $this->agreementDate;
    }

    /**
     * Set discountPolicies
     *
     * @param string $discountPolicies
     * @return Agreements
     */
    public function setDiscountPolicies($discountPolicies)
    {
        $this->discountPolicies = $discountPolicies;
    
        return $this;
    }

    /**
     * Get discountPolicies
     *
     * @return string 
     */
    public function getDiscountPolicies()
    {
        return $this->discountPolicies;
    }

    /**
     * Set startDate
     *
     * @param \DateTime $startDate
     * @return Agreements
     */
    public function setStartDate($startDate)
    {
        $this->startDate = $startDate;
    
        return $this;
    }

    /**
     * Get startDate
     *
     * @return \DateTime 
     */
    public function getStartDate()
    {
        return $this->startDate;
    }

    /**
     * Set endDate
     *
     * @param \DateTime $endDate
     * @return Agreements
     */
    public function setEndDate($endDate)
    {
        $this->endDate = $endDate;
    
        return $this;
    }

    /**
     * Get endDate
     *
     * @return \DateTime 
     */
    public function getEndDate()
    {
        return $this->endDate;
    }

    /**
     * Set evacuationDate
     *
     * @param \DateTime $evacuationDate
     * @return Agreements
     */
    public function setEvacuationDate($evacuationDate)
    {
        $this->evacuationDate = $evacuationDate;
    
        return $this;
    }

    /**
     * Get evacuationDate
     *
     * @return \DateTime 
     */
    public function getEvacuationDate()
    {
        return $this->evacuationDate;
    }

    /**
     * Set totalArea
     *
     * @param float $totalArea
     * @return Agreements
     */
    public function setTotalArea($totalArea)
    {
        $this->totalArea = $totalArea;
    
        return $this;
    }

    /**
     * Get totalArea
     *
     * @return float 
     */
    public function getTotalArea()
    {
        return $this->totalArea;
    }

    /**
     * Set rentalValue
     *
     * @param float $rentalValue
     * @return Agreements
     */
    public function setRentalValue($rentalValue)
    {
        $this->rentalValue = $rentalValue;
    
        return $this;
    }

    /**
     * Get rentalValue
     *
     * @return float 
     */
    public function getRentalValue()
    {
        return $this->rentalValue;
    }

    /**
     * Set insuranceValue
     *
     * @param float $insuranceValue
     * @return Agreements
     */
    public function setInsuranceValue($insuranceValue)
    {
        $this->insuranceValue = $insuranceValue;
    
        return $this;
    }

    /**
     * Get insuranceValue
     *
     * @return float 
     */
    public function getInsuranceValue()
    {
        return $this->insuranceValue;
    }

    /**
     * Set depositValue
     *
     * @param float $depositValue
     * @return Agreements
     */
    public function setDepositValue($depositValue)
    {
        $this->depositValue = $depositValue;
    
        return $this;
    }

    /**
     * Get depositValue
     *
     * @return float 
     */
    public function getDepositValue()
    {
        return $this->depositValue;
    }

    /**
     * Set otherFees
     *
     * @param float $otherFees
     * @return Agreements
     */
    public function setOtherFees($otherFees)
    {
        $this->otherFees = $otherFees;
    
        return $this;
    }

    /**
     * Get otherFees
     *
     * @return float 
     */
    public function getOtherFees()
    {
        return $this->otherFees;
    }

    /**
     * Set totalValue
     *
     * @param float $totalValue
     * @return Agreements
     */
    public function setTotalValue($totalValue)
    {
        $this->totalValue = $totalValue;
    
        return $this;
    }

    /**
     * Get totalValue
     *
     * @return float 
     */
    public function getTotalValue()
    {
        return $this->totalValue;
    }

    /**
     * Set offerDiscount
     *
     * @param float $offerDiscount
     * @return Agreements
     */
    public function setOfferDiscount($offerDiscount)
    {
        $this->offerDiscount = $offerDiscount;
    
        return $this;
    }

    /**
     * Get offerDiscount
     *
     * @return float 
     */
    public function getOfferDiscount()
    {
        return $this->offerDiscount;
    }

    /**
     * Set otherDiscount
     *
     * @param float $otherDiscount
     * @return Agreements
     */
    public function setOtherDiscount($otherDiscount)
    {
        $this->otherDiscount = $otherDiscount;
    
        return $this;
    }

    /**
     * Get otherDiscount
     *
     * @return float 
     */
    public function getOtherDiscount()
    {
        return $this->otherDiscount;
    }

    /**
     * Set netValue
     *
     * @param float $netValue
     * @return Agreements
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
     * Set created
     *
     * @param \DateTime $created
     * @return Agreements
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
     * @return Agreements
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
     * Set customer
     *
     * @param \Acme\DemoBundle\Entity\Customers $customer
     * @return Agreements
     */
    public function setCustomer(\Acme\DemoBundle\Entity\Customers $customer = null)
    {
        $this->customer = $customer;
    
        return $this;
    }

    /**
     * Get customer
     *
     * @return \Acme\DemoBundle\Entity\Customers 
     */
    public function getCustomer()
    {
        return $this->customer;
    }

    /**
     * Set service
     *
     * @param \Acme\DemoBundle\Entity\Services $service
     * @return Agreements
     */
    public function setService(\Acme\DemoBundle\Entity\Services $service = null)
    {
        $this->service = $service;
    
        return $this;
    }

    /**
     * Get service
     *
     * @return \Acme\DemoBundle\Entity\Services 
     */
    public function getService()
    {
        return $this->service;
    }

    /**
     * Set sales
     *
     * @param \Acme\DemoBundle\Entity\SalesPerson $sales
     * @return Agreements
     */
    public function setSales(\Acme\DemoBundle\Entity\SalesPerson $sales = null)
    {
        $this->sales = $sales;
    
        return $this;
    }

    /**
     * Get sales
     *
     * @return \Acme\DemoBundle\Entity\SalesPerson 
     */
    public function getSales()
    {
        return $this->sales;
    }

    /**
     * Set rentalPeriod
     *
     * @param \Acme\DemoBundle\Entity\RentalPeriods $rentalPeriod
     * @return Agreements
     */
    public function setRentalPeriod(\Acme\DemoBundle\Entity\RentalPeriods $rentalPeriod = null)
    {
        $this->rentalPeriod = $rentalPeriod;
    
        return $this;
    }

    /**
     * Get rentalPeriod
     *
     * @return \Acme\DemoBundle\Entity\RentalPeriods 
     */
    public function getRentalPeriod()
    {
        return $this->rentalPeriod;
    }
    
    public function getAgreementStatus() {
        
         $this->agreementStatus =$this->getAgreementByType($this->getAgreementType());
        
        return $this->agreementStatus;
    }

    public function setAgreementStatus($agreementStatus) {
        $this->agreementStatus = $agreementStatus;
    }
    
    public function getAgreementByType($agreementType){
        if($agreementType==0){
            if($this->getAgreementId()==0)
            return "مفتوح";
            else
            return "منفذ";
        }else{
            return "New";
        }
        
    }


}