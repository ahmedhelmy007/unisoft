<?php

namespace Unisoft\AssetsBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Unisoft\AssetsBundle\Entity\Administrations;
use Unisoft\AssetsBundle\Form\AdministrationsType;


/**
 * Administrations controller.
 *
 * @Route("/administrations")
 */
class AdministrationsController extends Controller
{
    /**
     * Lists all Administrations entities.
     *
     * @Route("/", name="administrations")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('UnisoftAssetsBundle:Administrations')->findAll();

        return array(
            'entities' => $entities,
        );
    }

    /**
     * Finds and displays a Administrations entity.
     *
     * @Route("/{id}/show", name="administrations_show")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('UnisoftAssetsBundle:Administrations')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Administrations entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to create a new Administrations entity.
     *
     * @Route("/new", name="administrations_new")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Administrations();
        $em = $this->getDoctrine()->getManager();
        $max=$em->getRepository('UnisoftAssetsBundle:Administrations')
                ->getMaxtId('Administrations');
        
       $entity->setAdministrationNo($max);
        $form   = $this->createForm(new AdministrationsType(), $entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a new Administrations entity.
     *
     * @Route("/create", name="administrations_create")
     * @Method("POST")
     * @Template("UnisoftAssetsBundle:Administrations:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity  = new Administrations();
        $form = $this->createForm(new AdministrationsType(), $entity);
        $form->bind($request);

        $errorMsg="";
         $errors = $this->container->get('validator')->validate($entity);
         
                if(count($errors)){
                   foreach ($errors as $error) {
                       $errorMsg.=$error->getMessage()."\r\n";
                      
            }
              
              $this->get('session')->getFlashBag()->add('notice2',$errorMsg);
 
          
              }
        
        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();
            $this->get('session')->getFlashBag()->add('notice', 'Well done! vendor Administration Created');
            return $this->redirect($this->generateUrl('administrations'));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Administrations entity.
     *
     * @Route("/{id}/edit", name="administrations_edit")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('UnisoftAssetsBundle:Administrations')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Administrations entity.');
        }

        $pagingWidget=$em->getRepository('UnisoftAssetsBundle:Administrations')
                ->getPagingWidget('Administrations', $entity->getId());
        
        $editForm = $this->createForm(new AdministrationsType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
            'pagingWidget' =>$pagingWidget,
        );
    }

    /**
     * Edits an existing Administrations entity.
     *
     * @Route("/{id}/update", name="administrations_update")
     * @Method("POST")
     * @Template("UnisoftAssetsBundle:Administrations:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('UnisoftAssetsBundle:Administrations')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Administrations entity.');
        }
        $pagingWidget=$em->getRepository('UnisoftAssetsBundle:Administrations')
                ->getPagingWidget('Administrations', $entity->getId());

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new AdministrationsType(), $entity);
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
            return $this->redirect($this->generateUrl('administrations'));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
            'pagingWidget' =>$pagingWidget,
        );
    }

    /**
     * Deletes a Administrations entity.
     *
     * @Route("/{id}/delete", name="administrations_delete")
     * @Method("POST")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('UnisoftAssetsBundle:Administrations')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Administrations entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('administrations'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
    
    
    
    /**
     * Displays a form to edit an existing Vendors entity.
     *
     * @Route("/{id}/print", name="administrations_print")
     * @Template()
     */
    public function printAction($id) {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('UnisoftAssetsBundle:Administrations')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Administrations entity.');
        }

         $editForm = $this->createForm(new AdministrationsType(), $entity);        
        
      
        return array(
            'entity' => $entity,
            'edit_form' => $editForm->createView(),
            
        );
    }
}
