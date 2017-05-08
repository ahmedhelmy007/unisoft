<?php

namespace Acme\DemoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Acme\DemoBundle\Form\ContactType;

// these import the "@Route" and "@Template" annotations
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

// to enable Securing Resources
use JMS\SecurityExtraBundle\Annotation\Secure;

class DemoController extends Controller
{
    /**
     * @Route("/", name="_demo")
     * @Template()
     */
    public function indexAction()
    {
        return array();
        
        //use Symfony\Component\HttpFoundation\Response;
        //$name = $request->query->get('name');
        //return new Response('Hello '.$name, 200, array('Content-Type' => 'text/plain'));
        //return new Response('<html><body>Hello '.$name.'!</body></html>');
        
        //The generateUrl() is the same method as the path() function used in the templates. 
        //It takes the route name and an array of parameters as arguments and returns the associated friendly URL.
        //return $this->redirect($this->generateUrl('_demo_hello', array('name' => 'Lucas')));
        
        //You can also easily forward the action to another one with the forward() method. 
        //Internally, Symfony makes a "sub-request", and returns the Response object from that sub-request:
        //$response = $this->forward('AcmeDemoBundle:Hello:fancy', array('name' => $name, 'color' => 'green'));
        
        // GET/POST
        //Besides the values of the routing placeholders, the controller also has access to the Request object:
        //$request = $this->getRequest();
        //$request->query->get('page'); // get a $_GET parameter
        //$request->request->get('page'); // get a $_POST parameter
        
        // Sessions
        //$session = $this->getRequest()->getSession();
        // store an attribute for reuse during a later user request
        //$session->set('foo', 'bar');
        // in another controller for another request
        //$foo = $session->get('foo');
        // use a default value if the key doesn't exist
        //$filters = $session->get('filters', array());
        //
        // store a message for the very next request (in a controller)
        //This is useful when you need to set a success message before redirecting the user to another page (which will then show the message).
        //$session->getFlashBag()->add('notice', 'Congratulations, your action succeeded!');

       
    }

    /**
     * @Route("/hello/{name}", name="_demo_hello")
     * @Template()
     */
    public function helloAction($name)
    {
        return array('name' => $name);
    }
    
    /**
     * @Route("/helloXml/{name}", defaults={"_format"="xml"},  name="_demo_helloXml")
     * @Template()
     * 
     * Note: By using the request format (as defined by the _format value), Symfony2 
     * automatically selects the right template, here hello.xml.twig:
     */
    public function helloXmlAction($name)
    {
        return array('name' => $name);
    }
    
    /**
     * @Route("/helloMix/{name}.{_format}", defaults={"_format"="html"}, requirements={"_format"="html|xml|json"}, name="_demo_helloMix")
     * @Template()
     * 
     * The requirements entry defines regular expressions that placeholders must match.
     */
    public function helloMixAction($name)
    {
        return array('name' => $name);
    }
    
    /**
     * @Route("/hello/admin/{name}", name="_demo_secured_hello_admin")
     * You can also force the action to require a given role by using the (at)Secure annotation on the controller
     * @Secure(roles="ROLE_ADMIN")
     * @Template()
     * 
     */
    public function helloAdminAction($name)
    {
        return array('name' => $name);
    }

    /**
     * @Route("/contact", name="_demo_contact")
     * @Template()
     */
    public function contactAction()
    {
        $form = $this->get('form.factory')->create(new ContactType());

        $request = $this->get('request');
        if ('POST' == $request->getMethod()) {
            $form->bindRequest($request);
            if ($form->isValid()) {
                $mailer = $this->get('mailer');
                // .. setup a message and send it
                // http://symfony.com/doc/current/cookbook/email.html

                $this->get('session')->setFlash('notice', 'Message sent!');

                return new RedirectResponse($this->generateUrl('_demo'));
            }
        }

        return array('form' => $form->createView());
    }
}
