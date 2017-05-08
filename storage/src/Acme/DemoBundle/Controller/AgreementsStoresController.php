<?php

namespace Acme\DemoBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Acme\DemoBundle\Entity\AgreementsStores;
use Acme\DemoBundle\Form\AgreementsStoresType;

/**
 * AgreementsStores controller.
 *
 * @Route("/AgreementsStores")
 */
class AgreementsStoresController extends Controller
{
    /**
     * Lists all AgreementsStores entities.
     *
     * @Route("/", name="AgreementsStores")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('AcmeDemoBundle:AgreementsStores')->findAll();

        return array(
            'entities' => $entities,
        );
    }

    /**
     * Finds and displays a AgreementsStores entity.
     *
     * @Route("/{id}/show", name="AgreementsStores_show")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AcmeDemoBundle:AgreementsStores')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find AgreementsStores entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to create a new AgreementsStores entity.
     *
     * @Route("/new", name="AgreementsStores_new")
     * @Template()
     */
    public function newAction()
    {
        $entity = new AgreementsStores();
        $form   = $this->createForm(new AgreementsStoresType(), $entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a new AgreementsStores entity.
     *
     * @Route("/create", name="AgreementsStores_create")
     * @Method("POST")
     * @Template("AcmeDemoBundle:AgreementsStores:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity  = new AgreementsStores();
        $form = $this->createForm(new AgreementsStoresType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('AgreementsStores_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Displays a form to edit an existing AgreementsStores entity.
     *
     * @Route("/{id}/edit", name="AgreementsStores_edit")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AcmeDemoBundle:AgreementsStores')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find AgreementsStores entity.');
        }

        $editForm = $this->createForm(new AgreementsStoresType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Edits an existing AgreementsStores entity.
     *
     * @Route("/{id}/update", name="AgreementsStores_update")
     * @Method("POST")
     * @Template("AcmeDemoBundle:AgreementsStores:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AcmeDemoBundle:AgreementsStores')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find AgreementsStores entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new AgreementsStoresType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('AgreementsStores_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Deletes a AgreementsStores entity.
     *
     * @Route("/{id}/delete", name="AgreementsStores_delete")
     * @Method("POST")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('AcmeDemoBundle:AgreementsStores')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find AgreementsStores entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('AgreementsStores'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
}
