<?php

namespace Unisoft\AssetsBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Unisoft\AssetsBundle\Entity\WarrantyUnits;
use Unisoft\AssetsBundle\Form\WarrantyUnitsType;

/**
 * WarrantyUnits controller.
 *
 * @Route("/WarrantyUnits")
 */
class WarrantyUnitsController extends Controller
{
    /**
     * Lists all WarrantyUnits entities.
     *
     * @Route("/", name="WarrantyUnits")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('UnisoftAssetsBundle:WarrantyUnits')->findAll();

        return array(
            'entities' => $entities,
        );
    }

    /**
     * Finds and displays a WarrantyUnits entity.
     *
     * @Route("/{id}/show", name="WarrantyUnits_show")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('UnisoftAssetsBundle:WarrantyUnits')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find WarrantyUnits entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to create a new WarrantyUnits entity.
     *
     * @Route("/new", name="WarrantyUnits_new")
     * @Template()
     */
    public function newAction()
    {
        $entity = new WarrantyUnits();
        $form   = $this->createForm(new WarrantyUnitsType(), $entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a new WarrantyUnits entity.
     *
     * @Route("/create", name="WarrantyUnits_create")
     * @Method("POST")
     * @Template("UnisoftAssetsBundle:WarrantyUnits:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity  = new WarrantyUnits();
        $form = $this->createForm(new WarrantyUnitsType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('WarrantyUnits_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Displays a form to edit an existing WarrantyUnits entity.
     *
     * @Route("/{id}/edit", name="WarrantyUnits_edit")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('UnisoftAssetsBundle:WarrantyUnits')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find WarrantyUnits entity.');
        }

        $editForm = $this->createForm(new WarrantyUnitsType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Edits an existing WarrantyUnits entity.
     *
     * @Route("/{id}/update", name="WarrantyUnits_update")
     * @Method("POST")
     * @Template("UnisoftAssetsBundle:WarrantyUnits:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('UnisoftAssetsBundle:WarrantyUnits')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find WarrantyUnits entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new WarrantyUnitsType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('WarrantyUnits_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Deletes a WarrantyUnits entity.
     *
     * @Route("/{id}/delete", name="WarrantyUnits_delete")
     * @Method("POST")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('UnisoftAssetsBundle:WarrantyUnits')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find WarrantyUnits entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('WarrantyUnits'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
}
