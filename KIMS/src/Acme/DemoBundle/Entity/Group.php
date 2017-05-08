<?php

namespace Acme\DemoBundle\Entity;

use Symfony\Component\Security\Core\Role\RoleInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="groups")
 * @ORM\Entity()
 */
class Group implements RoleInterface
{
    /**
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(name="name", type="string", length=30)
     */
    private $name;

    /**
     * @ORM\Column(name="role", type="string", length=20, unique=true)
     */
    private $role;

    /**
     * @ORM\ManyToMany(targetEntity="User", mappedBy="roles")
     */
    private $users;
    
    /**
     * @ORM\OneToMany(targetEntity="GroupActions", mappedBy="group")
     */
    public $actions;
    
    /**
     * @ORM\OneToMany(targetEntity="UserActions", mappedBy="user")
     */
    public $userActions;
    
    /**
     * @ORM\ManyToMany(targetEntity="AclActions", inversedBy="group")
     *
     */
    private $aclActions;

    public function __construct()
    {
        $this->users = new ArrayCollection();
        $this->actions = new ArrayCollection();
        $this->userActions = new ArrayCollection();
    }

    // ... getters and setters for each property

    /**
     * @see RoleInterface
     */
    public function getRole()
    {
        return $this->role;
    }
    
    public function getId() {
        return $this->id;
    }

    public function getActions() {
        $this->actions->toArray();
        $actions_arr=array();
        foreach ($this->actions as $key => $value) {
            array_push($actions_arr, $value->getAction());
        }
        
        $userActions=$this->getUserActions();
        $actions_arr=array_merge($actions_arr, $userActions);
        return $actions_arr;
    }

    public function getUserActions() {
        $this->userActions->toArray();
        $actions_arr=array();
        foreach ($this->userActions as $key => $value) {
            array_push($actions_arr, $value->getAction());
        }
        
        return $actions_arr;
    }
    public function getName() {
        return $this->name;
    }

    public function setName($name) {
        $this->name = $name;
    }

    public function getUsers() {
        return $this->users;
    }

    public function setUsers($users) {
        $this->users = $users;
    }
    
    public function getAclActions() {
        return $this->aclActions->toArray();
    }

    public function setAclActions($aclActions) {
        $this->aclActions = $aclActions;
    }





}
