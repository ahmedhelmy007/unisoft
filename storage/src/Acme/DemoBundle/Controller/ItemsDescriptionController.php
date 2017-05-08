<?php

namespace Acme\DemoBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Acme\DemoBundle\Entity\ItemsDescription;
use Acme\DemoBundle\Form\ItemsDescriptionType;

/**
 * ItemsDescription controller.
 *
 * @Route("/ItemsDescription")
 */
class ItemsDescriptionController extends Controller
{
    /**
     * Lists all ItemsDescription entities.
     *
     * @Route("/", name="ItemsDescription")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('AcmeDemoBundle:ItemsDescription')->findAll();

        return array(
            'entities' => $entities,
        );
    }

    /**
     * Finds and displays a ItemsDescription entity.
     *
     * @Route("/{id}/show", name="ItemsDescription_show")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AcmeDemoBundle:ItemsDescription')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find ItemsDescription entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to create a new ItemsDescription entity.
     *
     * @Route("/new", name="ItemsDescription_new")
     * @Template()
     */
    public function newAction()
    {
        $entity = new ItemsDescription();
        $form   = $this->createForm(new ItemsDescriptionType(), $entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a new ItemsDescription entity.
     *
     * @Route("/create", name="ItemsDescription_create")
     * @Method("POST")
     * @Template("AcmeDemoBundle:ItemsDescription:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity  = new ItemsDescription();
        $form = $this->createForm(new ItemsDescriptionType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('ItemsDescription_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Displays a form to edit an existing ItemsDescription entity.
     *
     * @Route("/{id}/edit", name="ItemsDescription_edit")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AcmeDemoBundle:ItemsDescription')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find ItemsDescription entity.');
        }

        $editForm = $this->createForm(new ItemsDescriptionType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Edits an existing ItemsDescription entity.
     *
     * @Route("/{id}/update", name="ItemsDescription_update")
     * @Method("POST")
     * @Template("AcmeDemoBundle:ItemsDescription:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AcmeDemoBundle:ItemsDescription')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find ItemsDescription entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new ItemsDescriptionType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('ItemsDescription_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Deletes a ItemsDescription entity.
     *
     * @Route("/{id}/delete", name="ItemsDescription_delete")
    
     */
    public function deleteAction(Request $request, $id) {

        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('AcmeDemoBundle:ItemsDescription')->find($id);
        if (!$entity) {
            throw $this->createNotFoundException('Unable to find User entity.');
        }
        $em->remove($entity);
        $em->flush();
        $this->get('session')->getFlashBag()->add('notice', 'Well done! You successfully Delete');

        return $this->redirect($this->generateUrl('quotations_edit', array('id' => $entity->getAgreement()->getId())));
    }

    private function createDeleteForm($id) {
        return $this->createFormBuilder(array('id' => $id))
                        ->add('id', 'hidden')
                        ->getForm()
        ;
    }
}
