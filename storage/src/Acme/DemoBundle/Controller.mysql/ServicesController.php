<?php

namespace Acme\DemoBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Acme\DemoBundle\Entity\Services;
use Acme\DemoBundle\Form\ServicesType;

/**
 * Services controller.
 *
 * @Route("/services")
 */
class ServicesController extends Controller
{
    /**
     * Lists all Services entities.
     *
     * @Route("/", name="services")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('AcmeDemoBundle:Services')->findAll();

        return array(
            'entities' => $entities,
        );
    }

    /**
     * Finds and displays a Services entity.
     *
     * @Route("/{id}/show", name="services_show")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AcmeDemoBundle:Services')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Services entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to create a new Services entity.
     *
     * @Route("/new", name="services_new")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Services();
        $form   = $this->createForm(new ServicesType(), $entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a new Services entity.
     *
     * @Route("/create", name="services_create")
     * @Method("POST")
     * @Template("AcmeDemoBundle:Services:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity  = new Services();
        $form = $this->createForm(new ServicesType(), $entity);
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
     * Displays a form to edit an existing Services entity.
     *
     * @Route("/{id}/edit", name="services_edit")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AcmeDemoBundle:Services')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Services entity.');
        }

        $editForm = $this->createForm(new ServicesType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Edits an existing Services entity.
     *
     * @Route("/{id}/update", name="services_update")
     * @Method("POST")
     * @Template("AcmeDemoBundle:Services:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AcmeDemoBundle:Services')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Services entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new ServicesType(), $entity);
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
     * Deletes a Services entity.
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
            $entity = $em->getRepository('AcmeDemoBundle:Services')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Services entity.');
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
