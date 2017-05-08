<?php

namespace Acme\DemoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="user_actions")
 * @ORM\Entity()
 */
class UserActions
{
    /**
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(name="action", type="string", length=30)
     */
    private $action;
    
    /**
     * @var \User
     *
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     * })
     */
    private $user;
 

    public function __construct()
    {
      
    }
    
    public function getId() {
        return $this->id;
    }

    public function getAction() {
        return $this->action;
    }
    
    public function getUser() {
        return $this->user;
    }

    public function setUser($user) {
        $this->user = $user;
    }






}
