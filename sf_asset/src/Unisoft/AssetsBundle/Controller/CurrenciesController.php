<?php

namespace Unisoft\AssetsBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Unisoft\AssetsBundle\Entity\Currencies;
use Unisoft\AssetsBundle\Form\CurrenciesType;

/**
 * Currencies controller.
 *
 * @Route("/currencies")
 */
class CurrenciesController extends Controller
{
    /**
     * Lists all Currencies entities.
     *
     * @Route("/", name="currencies")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('UnisoftAssetsBundle:Currencies')->findAll();

        return array(
            'entities' => $entities,
        );
    }

    /**
     * Finds and displays a Currencies entity.
     *
     * @Route("/{id}/show", name="currencies_show")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('UnisoftAssetsBundle:Currencies')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Currencies entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to create a new Currencies entity.
     *
     * @Route("/new", name="currencies_new")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Currencies();
        $form   = $this->createForm(new CurrenciesType(), $entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a new Currencies entity.
     *
     * @Route("/create", name="currencies_create")
     * @Method("POST")
     * @Template("UnisoftAssetsBundle:Currencies:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity  = new Currencies();
        $form = $this->createForm(new CurrenciesType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('currencies_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Currencies entity.
     *
     * @Route("/{id}/edit", name="currencies_edit")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('UnisoftAssetsBundle:Currencies')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Currencies entity.');
        }

        $editForm = $this->createForm(new CurrenciesType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Edits an existing Currencies entity.
     *
     * @Route("/{id}/update", name="currencies_update")
     * @Method("POST")
     * @Template("UnisoftAssetsBundle:Currencies:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('UnisoftAssetsBundle:Currencies')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Currencies entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new CurrenciesType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('currencies_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Deletes a Currencies entity.
     *
     * @Route("/{id}/delete", name="currencies_delete")
     * @Method("POST")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('UnisoftAssetsBundle:Currencies')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Currencies entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('currencies'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
}
