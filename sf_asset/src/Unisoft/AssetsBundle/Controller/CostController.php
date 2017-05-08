<?php

namespace Unisoft\AssetsBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Unisoft\AssetsBundle\Entity\Cost;
use Unisoft\AssetsBundle\Form\CostType;

/**
 * Cost controller.
 *
 * @Route("/Cost")
 */
class CostController extends Controller
{
    /**
     * Lists all Cost entities.
     *
     * @Route("/", name="Cost")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('UnisoftAssetsBundle:Cost')->findAll();

        return array(
            'entities' => $entities,
        );
    }

    /**
     * Finds and displays a Cost entity.
     *
     * @Route("/{id}/show", name="Cost_show")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('UnisoftAssetsBundle:Cost')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Cost entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to create a new Cost entity.
     *
     * @Route("/new", name="Cost_new")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Cost();
         $em = $this->getDoctrine()->getManager();
         $max = $em->createQuery('SELECT MAX(e.id) FROM UnisoftAssetsBundle:Cost e')
        ->getSingleScalarResult();
         $max++;
        
       $entity->setCostCenterNo($max);
        $form   = $this->createForm(new CostType(), $entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a new Cost entity.
     *
     * @Route("/create", name="Cost_create")
     * @Method("POST")
     * @Template("UnisoftAssetsBundle:Cost:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity  = new Cost();
        $form = $this->createForm(new CostType(), $entity);
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

            return $this->redirect($this->generateUrl('Cost', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Cost entity.
     *
     * @Route("/{id}/edit", name="Cost_edit")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('UnisoftAssetsBundle:Cost')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Cost entity.');
        }
         $pagingWidget=$em->getRepository('UnisoftAssetsBundle:Cost')
                ->getPagingWidget('Cost', $entity->getId());

         $editForm = $this->createFormBuilder($entity)
            ->add('costCenterNo','text',array('label'=>  'Cost Center Number','disabled'=>'disabled'))
            ->add('arName' ,'text',array('label'=>  'Arabic Name', 'attr' => array('placeholder' => 'Arabic Name')))
            ->add('enName' ,'text',array('label'=>  'English Name', 'attr' => array('placeholder' => 'English Name')))
                 ->getForm();
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
            'pagingWidget' =>$pagingWidget,
        );
    }

    /**
     * Edits an existing Cost entity.
     *
     * @Route("/{id}/update", name="Cost_update")
     * @Method("POST")
     * @Template("UnisoftAssetsBundle:Cost:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('UnisoftAssetsBundle:Cost')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Cost entity.');
        }
        
        $pagingWidget=$em->getRepository('UnisoftAssetsBundle:Cost')
                ->getPagingWidget('Cost', $entity->getId());

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createFormBuilder($entity)
            ->add('costCenterNo','text',array('label'=>  'Cost Center Number','disabled'=>'disabled'))
            ->add('arName' ,'text',array('label'=>  'Arabic Name', 'attr' => array('placeholder' => 'Arabic Name')))
            ->add('enName' ,'text',array('label'=>  'English Name', 'attr' => array('placeholder' => 'English Name')))
                 ->getForm();
        $editForm->bind($request);
        
        $errorMsg="";
         $errors = $this->container->get('validator')->validate($entity);
         
                if(count($errors)){
                   foreach ($errors as $error) {
                       $errorMsg.=$this->get('translator')->trans($error->getMessage(), array(), 'validators')."\r\n";
                      
            }
              
              $this->get('session')->getFlashBag()->add('notice2',$errorMsg);
           
          
              }

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('Cost', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
            'pagingWidget' =>$pagingWidget,
        );
    }

    /**
     * Deletes a Cost entity.
     *
     * @Route("/{id}/delete", name="Cost_delete")
     * @Method("POST")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('UnisoftAssetsBundle:Cost')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Cost entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('Cost'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
}
