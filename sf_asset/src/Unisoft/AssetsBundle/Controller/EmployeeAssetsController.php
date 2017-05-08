<?php

namespace Unisoft\AssetsBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Unisoft\AssetsBundle\Entity\EmployeeAssets;
use Unisoft\AssetsBundle\Form\EmployeeAssetsType;

/**
 * EmployeeAssets controller.
 *
 * @Route("/employeeAssets")
 */
class EmployeeAssetsController extends Controller
{
    /**
     * Lists all EmployeeAssets entities.
     *
     * @Route("/", name="employeeAssets")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('UnisoftAssetsBundle:EmployeeAssets')->findAll();

        return array(
            'entities' => $entities,
        );
    }

    /**
     * Finds and displays a EmployeeAssets entity.
     *
     * @Route("/{id}/show", name="employeeAssets_show")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('UnisoftAssetsBundle:EmployeeAssets')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find EmployeeAssets entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to create a new EmployeeAssets entity.
     *
     * @Route("/new", name="employeeAssets_new")
     * @Template()
     */
    public function newAction()
    {
        $entity = new EmployeeAssets();
        $form   = $this->createForm(new EmployeeAssetsType(), $entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a new EmployeeAssets entity.
     *
     * @Route("/create", name="employeeAssets_create")
     * @Method("POST")
     * @Template("UnisoftAssetsBundle:EmployeeAssets:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity  = new EmployeeAssets();
        $form = $this->createForm(new EmployeeAssetsType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('employeeAssets_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Displays a form to edit an existing EmployeeAssets entity.
     *
     * @Route("/{id}/edit", name="employeeAssets_edit")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('UnisoftAssetsBundle:EmployeeAssets')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find EmployeeAssets entity.');
        }

        $editForm = $this->createForm(new EmployeeAssetsType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Edits an existing EmployeeAssets entity.
     *
     * @Route("/{id}/update", name="employeeAssets_update")
     * @Method("POST")
     * @Template("UnisoftAssetsBundle:EmployeeAssets:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('UnisoftAssetsBundle:EmployeeAssets')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find EmployeeAssets entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new EmployeeAssetsType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('employeeAssets_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Deletes a EmployeeAssets entity.
     *
     * @Route("/{id}/delete", name="employeeAssets_delete")
     * @Method("POST")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('UnisoftAssetsBundle:EmployeeAssets')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find EmployeeAssets entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('employeeAssets'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
}
