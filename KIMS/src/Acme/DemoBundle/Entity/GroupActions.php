<?php

namespace Acme\DemoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="group_actions")
 * @ORM\Entity()
 */
class GroupActions
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
     * @var \Group
     *
     * @ORM\ManyToOne(targetEntity="Group")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="group_id", referencedColumnName="id")
     * })
     */
    private $group;
 

    public function __construct()
    {
      
    }
    
    public function getId() {
        return $this->id;
    }

    public function getAction() {
        return $this->action;
    }
    
    public function setAction($action) {
        $this->action = $action;
    }


    public function getGroup() {
        return $this->group;
    }




}
