<?php

namespace Unisoft\AssetsBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Unisoft\AssetsBundle\Entity\DepreciationMethods;
use Unisoft\AssetsBundle\Form\DepreciationMethodsType;

/**
 * DepreciationMethods controller.
 *
 * @Route("/DepreciationMethods")
 */
class DepreciationMethodsController extends Controller
{
    /**
     * Lists all DepreciationMethods entities.
     *
     * @Route("/", name="DepreciationMethods")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('UnisoftAssetsBundle:DepreciationMethods')->findAll();

        return array(
            'entities' => $entities,
        );
    }

    /**
     * Finds and displays a DepreciationMethods entity.
     *
     * @Route("/{id}/show", name="DepreciationMethods_show")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('UnisoftAssetsBundle:DepreciationMethods')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find DepreciationMethods entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to create a new DepreciationMethods entity.
     *
     * @Route("/new", name="DepreciationMethods_new")
     * @Template()
     */
    public function newAction()
    {
        $entity = new DepreciationMethods();
        $form   = $this->createForm(new DepreciationMethodsType(), $entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a new DepreciationMethods entity.
     *
     * @Route("/create", name="DepreciationMethods_create")
     * @Method("POST")
     * @Template("UnisoftAssetsBundle:DepreciationMethods:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity  = new DepreciationMethods();
        $form = $this->createForm(new DepreciationMethodsType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('DepreciationMethods_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Displays a form to edit an existing DepreciationMethods entity.
     *
     * @Route("/{id}/edit", name="DepreciationMethods_edit")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('UnisoftAssetsBundle:DepreciationMethods')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find DepreciationMethods entity.');
        }

        $editForm = $this->createForm(new DepreciationMethodsType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Edits an existing DepreciationMethods entity.
     *
     * @Route("/{id}/update", name="DepreciationMethods_update")
     * @Method("POST")
     * @Template("UnisoftAssetsBundle:DepreciationMethods:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('UnisoftAssetsBundle:DepreciationMethods')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find DepreciationMethods entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new DepreciationMethodsType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('DepreciationMethods_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Deletes a DepreciationMethods entity.
     *
     * @Route("/{id}/delete", name="DepreciationMethods_delete")
     * @Method("POST")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('UnisoftAssetsBundle:DepreciationMethods')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find DepreciationMethods entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('DepreciationMethods'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
}
