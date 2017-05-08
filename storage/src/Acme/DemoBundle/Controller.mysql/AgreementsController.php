<?php

namespace Acme\DemoBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Acme\DemoBundle\Entity\Agreements;
use Acme\DemoBundle\Form\AgreementsType;

/**
 * Agreements controller.
 *
 * @Route("/agreements")
 */
class AgreementsController extends Controller
{
    /**
     * Lists all Agreements entities.
     *
     * @Route("/", name="agreements")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('AcmeDemoBundle:Agreements')->findAll();

        return array(
            'entities' => $entities,
        );
    }

    /**
     * Finds and displays a Agreements entity.
     *
     * @Route("/{id}/show", name="agreements_show")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AcmeDemoBundle:Agreements')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Agreements entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to create a new Agreements entity.
     *
     * @Route("/new", name="agreements_new")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Agreements();
        $form   = $this->createForm(new AgreementsType(), $entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a new Agreements entity.
     *
     * @Route("/create", name="agreements_create")
     * @Method("POST")
     * @Template("AcmeDemoBundle:Agreements:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity  = new Agreements();
        $form = $this->createForm(new AgreementsType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('agreements_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Agreements entity.
     *
     * @Route("/{id}/edit", name="agreements_edit")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AcmeDemoBundle:Agreements')->find($id);
        $cos=$entity->getCustomer();
        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Agreements entity.');
        }

        $editForm = $this->createForm(new AgreementsType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Edits an existing Agreements entity.
     *
     * @Route("/{id}/update", name="agreements_update")
     * @Method("POST")
     * @Template("AcmeDemoBundle:Agreements:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AcmeDemoBundle:Agreements')->find($id);
        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Agreements entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new AgreementsType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();
//            exit;
            return $this->redirect($this->generateUrl('agreements_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Deletes a Agreements entity.
     *
     * @Route("/{id}/delete", name="agreements_delete")
     * @Method("POST")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('AcmeDemoBundle:Agreements')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Agreements entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('agreements'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
}
