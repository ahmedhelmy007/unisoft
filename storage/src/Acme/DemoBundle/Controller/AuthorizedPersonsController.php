<?php

namespace Acme\DemoBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Acme\DemoBundle\Entity\AuthorizedPersons;
use Acme\DemoBundle\Form\AuthorizedPersonsType;

/**
 * AuthorizedPersons controller.
 *
 * @Route("/AuthorizedPersons")
 */
class AuthorizedPersonsController extends Controller
{
    /**
     * Lists all AuthorizedPersons entities.
     *
     * @Route("/", name="AuthorizedPersons")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('AcmeDemoBundle:AuthorizedPersons')->findAll();

        return array(
            'entities' => $entities,
        );
    }

    /**
     * Finds and displays a AuthorizedPersons entity.
     *
     * @Route("/{id}/show", name="AuthorizedPersons_show")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AcmeDemoBundle:AuthorizedPersons')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find AuthorizedPersons entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to create a new AuthorizedPersons entity.
     *
     * @Route("/new", name="AuthorizedPersons_new")
     * @Template()
     */
    public function newAction()
    {
        $entity = new AuthorizedPersons();
        $form   = $this->createForm(new AuthorizedPersonsType(), $entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a new AuthorizedPersons entity.
     *
     * @Route("/create", name="AuthorizedPersons_create")
     * @Method("POST")
     * @Template("AcmeDemoBundle:AuthorizedPersons:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity  = new AuthorizedPersons();
        $form = $this->createForm(new AuthorizedPersonsType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('AuthorizedPersons_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Displays a form to edit an existing AuthorizedPersons entity.
     *
     * @Route("/{id}/edit", name="AuthorizedPersons_edit")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AcmeDemoBundle:AuthorizedPersons')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find AuthorizedPersons entity.');
        }

        $editForm = $this->createForm(new AuthorizedPersonsType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Edits an existing AuthorizedPersons entity.
     *
     * @Route("/{id}/update", name="AuthorizedPersons_update")
     * @Method("POST")
     * @Template("AcmeDemoBundle:AuthorizedPersons:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AcmeDemoBundle:AuthorizedPersons')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find AuthorizedPersons entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new AuthorizedPersonsType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('AuthorizedPersons_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Deletes a AuthorizedPersons entity.
     *
     * @Route("/{id}/delete", name="AuthorizedPersons_delete")
   
     */
   public function deleteAction(Request $request, $id) {

        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('AcmeDemoBundle:AuthorizedPersons')->find($id);
        if (!$entity) {
            throw $this->createNotFoundException('Unable to find User entity.');
        }
        $em->remove($entity);
        $em->flush();
        $this->get('session')->getFlashBag()->add('notice', 'Well done! You successfully Delete');

        return $this->redirect($this->generateUrl('agreements_edit', array('id' => $entity->getAgreement()->getId())));
    }

    private function createDeleteForm($id) {
        return $this->createFormBuilder(array('id' => $id))
                        ->add('id', 'hidden')
                        ->getForm()
        ;
    }
}
