<?php

namespace Unisoft\AssetsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * AssetActivities
 *
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 * @ORM\Table(name="asset_activities")
 */
class AssetActivities
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
     * @var float
     *
     * @ORM\Column(name="change_in_value", type="string", length=20, nullable=true)
     */
    private $changeInValue;

    /** @var \Datetime
     *
     * @ORM\Column(name="change_date", type="datetime", length=18, nullable=true)
     */
    private $changeDate;

    /**
     * @var string
     *
     * @ORM\Column(name="notes", type="text", nullable=true)
     */
    private $notes;

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
     * Set changeInValue
     *
     * @param float $changeInValue
     * @return AssetActivities
     */
    public function setChangeInValue($changeInValue)
    {
        $this->changeInValue = $changeInValue;
    
        return $this;
    }

    /**
     * Get changeInValue
     *
     * @return float 
     */
    public function getChangeInValue()
    {
        return $this->changeInValue;
    }

    /**
     * Set changeDate
     *
     * @param \DateTime $changeDate
     * @return AssetActivities
     */
    public function setChangeDate($changeDate)
    {
        $this->changeDate = $changeDate;
    
        return $this;
    }

    /**
     * Get changeDate
     *
     * @return \DateTime 
     */
    public function getChangeDate()
    {
        return $this->changeDate;
    }

    /**
     * Set notes
     *
     * @param string $notes
     * @return AssetActivities
     */
    public function setNotes($notes)
    {
        $this->notes = $notes;
    
        return $this;
    }

    /**
     * Get notes
     *
     * @return string 
     */
    public function getNotes()
    {
        return $this->notes;
    }

    /**
     * Set asset
     *
     * @param \Unisoft\AssetsBundle\Entity\Assets $asset
     * @return AssetActivities
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
    
    public function __toString()
    {
        return 'ahmed __toString';
    }
    
    /**
     * @ORM\PrePersist
     * Lifecycle Callback that called before persisting the object in database
     */
    public function setInitChangeDate()
    {
        $this->setChangeDate( new \DateTime());
    }
}