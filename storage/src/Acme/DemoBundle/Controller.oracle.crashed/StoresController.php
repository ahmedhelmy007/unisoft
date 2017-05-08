<?php

namespace Acme\DemoBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Acme\DemoBundle\Entity\SelfStores;
use Acme\DemoBundle\Form\SelfStoresType;

/**
 *Stores controller.
 *
 * @Route("/stores")
 */
class StoresController extends Controller
{
    /**
     * Lists allStores entities.
     *
     * @Route("/", name="stores")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('AcmeDemoBundle:SelfStores')->findAll();

        return array(
            'entities' => $entities,
        );
    }

    /**
     * Finds and displays a SelfStores entity.
     *
     * @Route("/{id}/show", name="selfstores_show")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AcmeDemoBundle:SelfStores')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find SelfStores entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to create a new SelfStores entity.
     *
     * @Route("/new", name="selfstores_new")
     * @Template()
     */
    public function newAction()
    {
        $entity = new SelfStores();
        $form   = $this->createForm(new SelfStoresType(), $entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a new SelfStores entity.
     *
     * @Route("/create", name="selfstores_create")
     * @Method("POST")
     * @Template("AcmeDemoBundle:SelfStores:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity  = new SelfStores();
        $form = $this->createForm(new SelfStoresType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('selfstores_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Displays a form to edit an existing SelfStores entity.
     *
     * @Route("/{id}/edit", name="selfstores_edit")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AcmeDemoBundle:SelfStores')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find SelfStores entity.');
        }

        $editForm = $this->createForm(new SelfStoresType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Edits an existing SelfStores entity.
     *
     * @Route("/{id}/update", name="selfstores_update")
     * @Method("POST")
     * @Template("AcmeDemoBundle:SelfStores:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AcmeDemoBundle:SelfStores')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find SelfStores entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new SelfStoresType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('selfstores_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Deletes a SelfStores entity.
     *
     * @Route("/{id}/delete", name="selfstores_delete")
     * @Method("POST")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('AcmeDemoBundle:SelfStores')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find SelfStores entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('selfstores'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
}
