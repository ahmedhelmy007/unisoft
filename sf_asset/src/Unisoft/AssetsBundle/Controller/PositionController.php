<?php

namespace Unisoft\AssetsBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Unisoft\AssetsBundle\Entity\Position;
use Unisoft\AssetsBundle\Form\PositionType;

/**
 * Position controller.
 *
 * @Route("/position")
 */
class PositionController extends Controller
{
    /**
     * Lists all Position entities.
     *
     * @Route("/", name="position")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('UnisoftAssetsBundle:Position')->findAll();

        return array(
            'entities' => $entities,
        );
    }

    /**
     * Finds and displays a Position entity.
     *
     * @Route("/{id}/show", name="position_show")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('UnisoftAssetsBundle:Position')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Position entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to create a new Position entity.
     *
     * @Route("/new", name="position_new")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Position();
        $em = $this->getDoctrine()->getManager();
        $max=$em->getRepository('UnisoftAssetsBundle:Position')
                ->getMaxtId('Position');
        
       $entity->setPositionNo($max);
        $form   = $this->createForm(new PositionType(), $entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a new Position entity.
     *
     * @Route("/create", name="position_create")
     * @Method("POST")
     * @Template("UnisoftAssetsBundle:Position:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity  = new Position();
        $form = $this->createForm(new PositionType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('position'));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Position entity.
     *
     * @Route("/{id}/edit", name="position_edit")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('UnisoftAssetsBundle:Position')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Position entity.');
        }
        
        $pagingWidget=$em->getRepository('UnisoftAssetsBundle:Position')
                ->getPagingWidget('Position', $entity->getId());

        $editForm = $this->createForm(new PositionType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
            'pagingWidget' =>$pagingWidget,
        );
    }

    /**
     * Edits an existing Position entity.
     *
     * @Route("/{id}/update", name="position_update")
     * @Method("POST")
     * @Template("UnisoftAssetsBundle:Position:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('UnisoftAssetsBundle:Position')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Position entity.');
        }
        
        $pagingWidget=$em->getRepository('UnisoftAssetsBundle:Position')
                ->getPagingWidget('Position', $entity->getId());

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new PositionType(), $entity);
        $editForm->bind($request);
        
        $errorMsg="";
         $errors = $this->container->get('validator')->validate($entity);
                if(count($errors)){
                   foreach ($errors as $error) {
                       $errorMsg.=$this->get('translator')->trans($error->getMessage(), array(), 'validators')."\r\n";
                      
            }$this->get('session')->getFlashBag()->add('notice2',$errorMsg);
              }

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();
            $this->get('session')->getFlashBag()->add('notice1', 'Well done! You successfully Update');
            return $this->redirect($this->generateUrl('position_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
            'pagingWidget' =>$pagingWidget,
        );
    }

    /**
     * Deletes a Position entity.
     *
     * @Route("/{id}/delete", name="position_delete")
     * @Method("POST")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('UnisoftAssetsBundle:Position')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Position entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('position'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
}
