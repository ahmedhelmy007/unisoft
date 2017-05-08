<?php

namespace Acme\DemoBundle\Entity;

use Symfony\Component\Security\Core\Role\RoleInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="acl_actions")
 * @ORM\Entity()
 */
class AclActions
{
    /**
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(name="action", type="string", length=200, unique=true)
     */
    private $action;
    

    /**
     * @ORM\ManyToMany(targetEntity="User", mappedBy="aclActions")
     */
    private $users;
    
    /**
     * @ORM\ManyToMany(targetEntity="Group", mappedBy="aclActions")
     */
    private $group;
    
    

    public function __construct()
    {
        $this->users = new ArrayCollection();
    }

    // ... getters and setters for each property

    
    
    public function getId() {
        return $this->id;
    }
    public function getAction() {
        return $this->action;
    }

    public function setAction($action) {
        $this->action = $action;
    }

}
