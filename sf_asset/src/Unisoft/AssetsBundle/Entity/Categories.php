<?php

namespace Unisoft\AssetsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Categories
 *
 * @ORM\Table(name="categories")
 * @ORM\Entity
 */
class Categories
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
     * @ORM\Column(name="category_no", type="string", length=20, nullable=true)
     */
    private $categoryNo;

    /**
     * @var string
     *
     * @ORM\Column(name="english_mame", type="string", length=50, nullable=true)
     */
    private $englishMame;

    /**
     * @var string
     *
     * @ORM\Column(name="arabic_name", type="string", length=50, nullable=true)
     */
    private $arabicName;

    /**
     * @var \Categories
     *
     * @ORM\ManyToOne(targetEntity="Categories", inversedBy="childs")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="parent_id", referencedColumnName="id")
     * })
     */
    private $parent;
    
    
    /**
     * @ORM\OneToMany(targetEntity="Categories", mappedBy="parent")
     */
    public $childs;

/**
     * Constructor
     */
    public function __construct()
    {
        $this->childs = new ArrayCollection();
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
     * Set categoryNo
     *
     * @param string $categoryNo
     * @return Categories
     */
    public function setCategoryNo($categoryNo)
    {
        $this->categoryNo = $categoryNo;
    
        return $this;
    }

    /**
     * Get categoryNo
     *
     * @return string 
     */
    public function getCategoryNo()
    {
        return $this->categoryNo;
    }

    /**
     * Set englishMame
     *
     * @param string $englishMame
     * @return Categories
     */
    public function setEnglishMame($englishMame)
    {
        $this->englishMame = $englishMame;
    
        return $this;
    }

    /**
     * Get englishMame
     *
     * @return string 
     */
    public function getEnglishMame()
    {
        return $this->englishMame;
    }

    /**
     * Set arabicName
     *
     * @param string $arabicName
     * @return Categories
     */
    public function setArabicName($arabicName)
    {
        $this->arabicName = $arabicName;
    
        return $this;
    }

    /**
     * Get arabicName
     *
     * @return string 
     */
    public function getArabicName()
    {
        return $this->arabicName;
    }

    /**
     * Set parent
     *
     * @param \Unisoft\AssetsBundle\Entity\Categories $parent
     * @return Categories
     */
    public function setParent(\Unisoft\AssetsBundle\Entity\Categories $parent = null)
    {
        $this->parent = $parent;
    
        return $this;
    }

    /**
     * Get parent
     *
     * @return \Unisoft\AssetsBundle\Entity\Categories 
     */
    public function getParent()
    {
        return $this->parent;
    }
}