<?php

namespace Unisoft\AssetsBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\SecurityContext;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use JMS\SecurityExtraBundle\Annotation\Secure;
use Symfony\Component\HttpFoundation\Session\Session;


/**
 *
 * @Route("/login")
 */
class LoginController extends Controller
{
    /**
     *
     * @Route("/", name="login")
     * @Template()
     */
    public function indexAction()
    {
        
        $request = $this->getRequest();
        $session = $request->getSession();
        
         if ($this->get('request')->attributes->has(SecurityContext::AUTHENTICATION_ERROR)) {
            $error = $this->get('request')->attributes->get(SecurityContext::AUTHENTICATION_ERROR);
        } else {
            $error = $this->get('request')->getSession()->get(SecurityContext::AUTHENTICATION_ERROR);
            $session->remove(SecurityContext::AUTHENTICATION_ERROR);
        }

        
        // $this->get('session')->getFlashBag()->add('notice', 'You Have Error Maybe Username or Password');
        
        return $this->render('UnisoftAssetsBundle::login.html.twig', array(
            // last username entered by the user
            'last_username' => $session->get(SecurityContext::LAST_USERNAME),
            'error'         => $error,
       
        ));
    }
    
     /**
     * @Route("/", name="security_check")
     */
    public function securityCheckAction()
    {
        // The security layer will intercept this request
    }
    
    
     /**
     * @Route("/logout", name="logout")
     */
    public function logoutAction()
    {
        // The security layer will intercept this request
    }
    
    
    
    
}
