<?php

namespace Acme\DemoBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Acme\DemoBundle\Entity\SelfCustomers;

/**
 * Customers controller.
 *
 * @Route("/customers")
 */
class CustomersController extends Controller
{
    /**
     * Lists all Customers entities.
     *
     * @Route("/", name="customers")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('AcmeDemoBundle:SelfCustomers')->findAll();

        return array(
            'entities' => $entities,
        );
    }

    /**
     * Finds and displays a SelfCustomers entity.
     *
     * @Route("/{id}/show", name="selfcustomers_show")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AcmeDemoBundle:SelfCustomers')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find SelfCustomers entity.');
        }

        return array(
            'entity'      => $entity,
        );
    }

}
