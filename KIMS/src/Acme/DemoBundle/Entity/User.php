<?php

namespace Acme\DemoBundle\Entity;

use Symfony\Component\Security\Core\User\UserInterface,
    Symfony\Component\Security\Core\Encoder\MessageDigestPasswordEncoder;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;

/**
 * User
 *
 * @ORM\Table(name="user")
 * @ORM\Entity(repositoryClass="Acme\DemoBundle\Entity\UserRepository")
 */
class User implements UserInterface, \Serializable {

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
     * @ORM\Column(name="username", type="string", length=255, nullable=false)
     */
    private $username;

    /**
     * @var string
     *
     * @ORM\Column(name="password", type="string", length=255, nullable=false)
     */
    private $password;

    /**
     * @var string
     *
     * @ORM\Column(name="full_name", type="string", length=255, nullable=false)
     */
    private $fullName;

    /**
     * @ORM\ManyToMany(targetEntity="Group", inversedBy="users")
     *
     */
    private $roles;

    /**
     * @ORM\ManyToMany(targetEntity="Group", inversedBy="users", cascade={"persist"})
     */
    protected $userRoles;

    /**
     * @ORM\ManyToMany(targetEntity="AclActions", inversedBy="users")
     *
     */
    private $aclActions;

    public function __construct() {
        $this->roles = new ArrayCollection();
        $this->userRoles = new ArrayCollection();
    }

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set username
     *
     * @param string $username
     * @return User
     */
    public function setUsername($username) {
        $this->username = $username;

        return $this;
    }

    /**
     * Get username
     *
     * @return string 
     */
    public function getUsername() {
        return $this->username;
    }

    /**
     * Set password
     *
     * @param string $password
     * @return User
     */
    public function setPassword($password) {
        if(!empty($password)){
        $encoder = new MessageDigestPasswordEncoder('sha1');
        $password = $encoder->encodePassword($password, $this->getSalt());
        }
        $this->password = $password;
    }

    /**
     * Get password
     *
     * @return string 
     */
    public function getPassword() {
        return $this->password;
    }

    /**
     * Set firstName
     *
     * @param string $firstName
     * @return User
     */
    public function setFullName($fullName) {
        $this->fullName = $fullName;

        return $this;
    }

    /**
     * Get fullName
     *
     * @return string 
     */
    public function getFullName() {
        return $this->fullName;
    }

    public function getRoles() {
        return $this->roles->toArray();
//         return array('ROLE_test2');
    }

    public function setRoles($roles) {
        $this->roles = $roles;
    }

    public function getRoles2() {
        return $this->roles;
    }

    function getUserRoles() {
        return $this->userRoles;
    }

    public function setRoles2($roles) {
        $this->roles = $roles;
    }

    public function getAclActions() {
        return $this->aclActions;
    }

    public function getAclActionsArray() {

        $this->aclActions->toArray();
        $actions_arr = array();
        foreach ($this->aclActions as $key => $aclAction) {
            array_push($actions_arr, $aclAction->getAction());
        }

        return $actions_arr;
    }
    
    public function getRoleActions() {
      $rolesActions=array();
       $roles=$this->roles->toArray();
      foreach ($roles as $key => $role) {
          $roleActions=$role->getAclActions();
          foreach ($roleActions as $keyAction => $action) {
               array_push($rolesActions, $action->getAction());
          }
      }
      return array_unique($rolesActions);
    }

    public function setAclActions($aclActions) {
        $this->aclActions = $aclActions;
    }
    
    public function getAllActions() {
      $allActions=array();
       $rolesActions=$this->getRoleActions();
       $userActions=$this->getAclActionsArray();
       $allActions=array_merge($rolesActions, $userActions);
       return array_unique($allActions);
    }

    /**
     * Returns the salt that was originally used to encode the password.
     *
     * This can return null if the password was not encoded using a salt.
     *
     * @return string The salt
     */
    public function getSalt() {
        
    }

    /**
     * Removes sensitive data from the user.
     *
     * This is important if, at any given point, sensitive information like
     * the plain-text password is stored on this object.
     *
     * @return void
     */
    public function eraseCredentials() {
        
    }

    public function serialize() {

        return serialize(array(
                    $this->id,
                    $this->password,
                    $this->username
                ));
    }

    public function unserialize($serialized) {
        list(
                $this->id,
                $this->password,
                $this->username
                ) = unserialize($serialized);
    }

}