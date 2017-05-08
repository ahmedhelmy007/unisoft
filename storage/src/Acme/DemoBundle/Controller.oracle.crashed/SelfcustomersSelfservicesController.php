<?php

namespace Acme\DemoBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Acme\DemoBundle\Entity\SelfcustomersSelfservices;

/**
 * SelfcustomersSelfservices controller.
 *
 * @Route("/selfcustomersselfservices")
 */
class SelfcustomersSelfservicesController extends Controller
{
    /**
     * Lists all SelfcustomersSelfservices entities.
     *
     * @Route("/", name="selfcustomersselfservices")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('AcmeDemoBundle:SelfcustomersSelfservices')->findAll();

        return array(
            'entities' => $entities,
        );
    }

    /**
     * Finds and displays a SelfcustomersSelfservices entity.
     *
     * @Route("/{id}/show", name="selfcustomersselfservices_show")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AcmeDemoBundle:SelfcustomersSelfservices')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find SelfcustomersSelfservices entity.');
        }

        return array(
            'entity'      => $entity,
        );
    }

}
