<?php

namespace Unisoft\AssetsBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Unisoft\AssetsBundle\Entity\Locations;
use Unisoft\AssetsBundle\Form\LocationsType;

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
    
}
