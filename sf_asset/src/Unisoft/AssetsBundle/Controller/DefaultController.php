<?php

namespace Unisoft\AssetsBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('UnisoftAssetsBundle:Default:index.html.twig', array('name' => $name));
    }
}
