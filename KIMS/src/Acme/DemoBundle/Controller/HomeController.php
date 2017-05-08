<?php

namespace Acme\DemoBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

/**
 * Locations controller.
 *
 * @Route("/home")
 */
class HomeController extends Controller
{
    /**
     * Lists all Locations entities.
     *
     * @Route("/", name="home")
     * @Template()
     */
    public function indexAction()
    {
        return array();
    }
    
    
    /**
     *
     * @Route("/administrative", name="home_administrative")
     * @Template()
     */
    public function administrativeAction()
    {
        return array();
    }
    
    
}
