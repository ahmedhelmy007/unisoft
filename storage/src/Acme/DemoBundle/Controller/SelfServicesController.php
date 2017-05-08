<?php

namespace Acme\DemoBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Acme\DemoBundle\Entity\SelfServices;
use Acme\DemoBundle\Form\SelfServicesType;

/**
 * SelfServices controller.
 *
 * @Route("/services")
 */
class SelfServicesController extends Controller
{
    /**
     * Lists all SelfServices entities.
     *
     * @Route("/", name="services")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('AcmeDemoBundle:SelfServices')->findAll();

        return array(
            'entities' => $entities,
        );
    }

    /**
     * Finds and displays a SelfServices entity.
     *
     * @Route("/{id}/show", name="services_show")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AcmeDemoBundle:SelfServices')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find SelfServices entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to create a new SelfServices entity.
     *
     * @Route("/new", name="services_new")
     * @Template()
     */
    public function newAction()
    {
        $entity = new SelfServices();
        $form   = $this->createForm(new SelfServicesType(), $entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a new SelfServices entity.
     *
     * @Route("/create", name="services_create")
     * @Method("POST")
     * @Template("AcmeDemoBundle:SelfServices:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity  = new SelfServices();
        $form = $this->createForm(new SelfServicesType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('services_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Displays a form to edit an existing SelfServices entity.
     *
     * @Route("/{id}/edit", name="services_edit")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AcmeDemoBundle:SelfServices')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find SelfServices entity.');
        }

        $editForm = $this->createForm(new SelfServicesType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Edits an existing SelfServices entity.
     *
     * @Route("/{id}/update", name="services_update")
     * @Method("POST")
     * @Template("AcmeDemoBundle:SelfServices:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AcmeDemoBundle:SelfServices')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find SelfServices entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new SelfServicesType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('services_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Deletes a SelfServices entity.
     *
     * @Route("/{id}/delete", name="services_delete")
     * @Method("POST")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('AcmeDemoBundle:SelfServices')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find SelfServices entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('services'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
}
