<?php

namespace Unisoft\AssetsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * Employees
 *
 * @ORM\Table(name="employees")
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 * @ORM\Entity(repositoryClass="Unisoft\AssetsBundle\Entity\SfServicesRepository")
 */
class Employees {

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=true)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="employee_no", type="string", length=40, nullable=true)
     */
    private $employeeNo;

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
     * @var string
     *
     * @ORM\Column(name="civil_id", type="string", length=45, nullable=true)
     */
    private $civilId;

    /**
     * @var string
     *
     * @ORM\Column(name="passport_id", type="string", length=45, nullable=true)
     */
    private $passportId;

    /**
     * @var string
     *
     * @ORM\Column(name="cell_phone", type="string", length=45, nullable=true)
     */
    private $cellPhone;

    /**
     * @var string
     *
     * @ORM\Column(name="cell_phone_code", type="string", length=5, nullable=true)
     */
    private $cellPhoneCode;

    /**
     * @var string
     *
     * @ORM\Column(name="telephone", type="string", length=45, nullable=true)
     */
    private $telephone;

    /**
     * @var string
     *
     * @ORM\Column(name="telephone_code", type="string", length=5, nullable=true)
     */
    private $telephoneCode;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=45, nullable=true)
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="address", type="string", length=45, nullable=true)
     */
    private $address;

    /**
     * @var string
     * @Assert\File(maxSize = "1024k",maxSizeMessage = "File too larg", groups={"uploadByAjax"},mimeTypes = {
      "image/png",
      "image/pjpeg",
      "image/jpeg",
      "image/gif"
      }, mimeTypesMessage = "Please upload a valid Image")
     */
    private $image;

    /**
     * @var String
     * @ORM\Column(name="image", type="string", length=200, nullable=true)
     */
    private $imageName;

     /**
     * @var \Cost
     *
     * @ORM\ManyToOne(targetEntity="Cost")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="cost_center_id", referencedColumnName="id")
     * })
     */
    private $costCenter;

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
     * @var \Departments
     *
     * @ORM\ManyToOne(targetEntity="Departments")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="department_id", referencedColumnName="id")
     * })
     */
    private $department;

    /**
     * @var \Position
     *
     * @ORM\ManyToOne(targetEntity="Position")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="position_id", referencedColumnName="id")
     * })
     */
    private $position;

    /**
     * @var \Sectors
     *
     * @ORM\ManyToOne(targetEntity="Sectors")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="sector_id", referencedColumnName="id")
     * })
     */
    private $sector;

    /**
     * @var \Administrations
     *
     * @ORM\ManyToOne(targetEntity="Administrations")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="administration_id", referencedColumnName="id")
     * })
     */
    private $administration;

    /**
     * @var boolean
     *
     * @ORM\Column(name="active", type="boolean", nullable=false)
     */
    private $active;

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set employeeNo
     *
     * @param string $employeeNo
     * @return Employees
     */
    public function setEmployeeNo($employeeNo) {
        $this->employeeNo = $employeeNo;
        return $this;
    }

    /**
     * Get empCode
     *
     * @return string 
     */
    public function getEmployeeNo() {
        return $this->employeeNo;
    }

    /**
     * Set enName
     *
     * @param string $enName
     * @return Departments
     */
    public function setEnName($en_name) {
        $this->enName = $en_name;

        return $this;
    }

    /**
     * Get en_name
     *
     * @return string 
     */
    public function getEnName() {
        return $this->enName;
    }

    /**
     * Set arName
     *
     * @param string $ar_name
     * @return Departments
     */
    public function setArName($ar_name) {
        $this->arName = $ar_name;

        return $this;
    }

    /**
     * Get ar_name
     *
     * @return string 
     */
    public function getArName() {
        return $this->arName;
    }

    /**
     * Set civilId
     *
     * @param string $civilId
     * @return Employees
     */
    public function setCivilId($civilId) {
        $this->civilId = $civilId;

        return $this;
    }

    /**
     * Get civilId
     *
     * @return string 
     */
    public function getCivilId() {
        return $this->civilId;
    }

    /**
     * Set passportId
     *
     * @param string $passportId
     * @return Employees
     */
    public function setPassportId($passportId) {
        $this->passportId = $passportId;

        return $this;
    }

    /**
     * Get passportId
     *
     * @return string 
     */
    public function getPassportId() {
        return $this->passportId;
    }

    /**
     * Set cellPhone
     *
     * @param string $cellPhone
     * @return Employees
     */
    public function setCellPhone($cellPhone) {
        $this->cellPhone = $cellPhone;

        return $this;
    }

    /**
     * Get cellPhone
     *
     * @return string 
     */
    public function getCellPhone() {
        return $this->cellPhone;
    }

    /**
     * Set telephone
     *
     * @param string $telephone
     * @return Employees
     */
    public function setTelephone($telephone) {
        $this->telephone = $telephone;

        return $this;
    }

    /**
     * Get telephone
     *
     * @return string 
     */
    public function getTelephone() {
        return $this->telephone;
    }

    /**
     * Set email
     *
     * @param string $email
     * @return Employees
     */
    public function setEmail($email) {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string 
     */
    public function getEmail() {
        return $this->email;
    }

    /**
     * Set address
     *
     * @param string $address
     * @return Employees
     */
    public function setAddress($address) {
        $this->address = $address;

        return $this;
    }

    /**
     * Get address
     *
     * @return string 
     */
    public function getAddress() {
        return $this->address;
    }

    /**
     * Set image
     *
     * @param string $image
     * @return Employees
     */
    public function setImage($image) {
        $this->image = $image;

        return $this;
    }

    /**
     * Get image
     *
     * @return string 
     */
    public function getImage() {
        return $this->image;
    }

    /**
     * Set imageName
     *
     * @param string $imageName
     * @return Assets
     */
    public function setImageName($image) {
        $this->imageName = $image;

        return $this;
    }

    /**
     * Get imageName
     *
     * @return string 
     */
    public function getImageName() {
        return $this->imageName;
    }

    /**
     * Set costCenter
     *
     * @param string $costCenter
     * @return Employees
     */
    public function setCostCenter($costCenter) {
        $this->costCenter = $costCenter;

        return $this;
    }

    /**
     * Get costCenter
     *
     * @return string 
     */
    public function getCostCenter() {
        return $this->costCenter;
    }

    /**
     * Set created
     *
     * @param \DateTime $created
     * @return Employees
     */
    public function setCreated($created) {
        $this->created = $created;

        return $this;
    }

    /**
     * Get created
     *
     * @return \DateTime 
     */
    public function getCreated() {
        return $this->created;
    }

    /**
     * Set modified
     *
     * @param \DateTime $modified
     * @return Employees
     */
    public function setModified($modified) {
        $this->modified = $modified;

        return $this;
    }

    /**
     * Get modified
     *
     * @return \DateTime 
     */
    public function getModified() {
        return $this->modified;
    }

    /**
     * Set department
     *
     * @param \Unisoft\AssetsBundle\Entity\Departments $department
     * @return Employees
     */
    public function setDepartment(\Unisoft\AssetsBundle\Entity\Departments $department = null) {
        $this->department = $department;

        return $this;
    }

    /**
     * Get department
     *
     * @return \Unisoft\AssetsBundle\Entity\Departments 
     */
    public function getDepartment() {
        return $this->department;
    }

    /**
     * Set position
     *
     * @param \Unisoft\AssetsBundle\Entity\Position $position
     * @return Employees
     */
    public function setPosition(\Unisoft\AssetsBundle\Entity\Position $position = null) {
        $this->position = $position;

        return $this;
    }

    /**
     * Get position
     *
     * @return \Unisoft\AssetsBundle\Entity\Position 
     */
    public function getPosition() {
        return $this->position;
    }

    /**
     * Set sector
     *
     * @param \Unisoft\AssetsBundle\Entity\Sectors $sector
     * @return Employees
     */
    public function setSector(\Unisoft\AssetsBundle\Entity\Sectors $sector = null) {
        $this->sector = $sector;

        return $this;
    }

    /**
     * Get sector
     *
     * @return \Unisoft\AssetsBundle\Entity\Sectors 
     */
    public function getSector() {
        return $this->sector;
    }

    /**
     * Set administration
     *
     * @param \Unisoft\AssetsBundle\Entity\Administrations $administration
     * @return Employees
     */
    public function setAdministration(\Unisoft\AssetsBundle\Entity\Administrations $administration = null) {
        $this->administration = $administration;

        return $this;
    }

    /**
     * Get administration
     *
     * @return \Unisoft\AssetsBundle\Entity\Administrations 
     */
    public function getAdministration() {
        return $this->administration;
    }

    /**
     * Set active
     *
     * @param boolean $active
     * @return Assets
     */
    public function setActive($active) {
        $this->active = $active;

        return $this;
    }

    /**
     * Get active
     *
     * @return boolean 
     */
    public function getActive() {
        return $this->active;
    }

    /**
     * Get cellPhoneCode
     *
     * @return string 
     */
    public function getCellPhoneCode() {
        return $this->cellPhoneCode;
    }

    /**
     * Get telephoneCode
     *
     * @return string 
     */
    public function getTelephoneCode() {
        return $this->telephoneCode;
    }

    /**
     * Set cellPhoneCode
     *
     * @param string $cellPhoneCode
     * @return Employees
     */
    public function setCellPhoneCode($cellPhoneCode) {
        $this->cellPhoneCode = $cellPhoneCode;
    }

    /**
     * Set telephoneCode
     *
     * @param string $telephoneCode
     * @return Employees
     */
    public function setTelephoneCode($telephoneCode) {
        $this->telephoneCode = $telephoneCode;
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

    //upload image file
    public function getFullImagePath() {
        return null === $this->imageName ? null : $this->getUploadRootDir() . $this->imageName;
    }

    protected function getUploadRootDir() {
        // the absolute directory path where uploaded documents should be saved
        return $this->getTmpUploadRootDir() . "/";
    }

    protected function getTmpUploadRootDir() {
        // the absolute directory path where uploaded documents should be saved
        return __DIR__ . '/../../../../web/upload/';
    }

    /**
     * ORM\PrePersist()
     * ORM\PreUpdate()
     */
    public function uploadImage() {
        // the file property can be empty if the field is not required
        if (null === $this->image) {
            return;
        }
        $imageName = uniqid() . "." . $this->image->guessExtension();
        $this->image->move($this->getUploadRootDir(), $imageName);
        $this->setImage($imageName);
    }

    /**
     * 
     */
    //@ORM\PostPersist()
    public function moveImage() {
        if (null === $this->image) {
            return;
        }
        if (!is_dir($this->getUploadRootDir())) {
            mkdir($this->getUploadRootDir());
        }
        copy($this->getTmpUploadRootDir() . $this->image, $this->getFullImagePath());
        unlink($this->getTmpUploadRootDir() . $this->image);
    }

    /**
     * @ORM\PreRemove()
     */
    public function removeImage() {
        if (file_exists($this->getFullImagePath()))
            unlink($this->getFullImagePath());
//        rmdir($this->getUploadRootDir());
    }

}