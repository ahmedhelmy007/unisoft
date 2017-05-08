<?php

namespace Acme\DemoBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Acme\DemoBundle\Entity\SalesPerson;
use Acme\DemoBundle\Form\SalesPersonType;

/**
 * SalesPerson controller.
 *
 * @Route("/SalesPerson")
 */
class SalesPersonController extends Controller
{
    /**
     * Lists all SalesPerson entities.
     *
     * @Route("/", name="SalesPerson")
     * @Template()
     */
    public function indexAction()
    {
        $entity = new SalesPerson();
        $em = $this->getDoctrine()->getManager();

         $entities = $em->getRepository('AcmeDemoBundle:SalesPerson')->findAll();
         $form   = $this->createForm(new SalesPersonType(), $entity);

        return array(
            'entities' => $entities,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a SalesPerson entity.
     *
     * @Route("/{id}/show", name="SalesPerson_show")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AcmeDemoBundle:SalesPerson')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find SalesPerson entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to create a new SalesPerson entity.
     *
     * @Route("/new", name="SalesPerson_new")
     * @Template()
     */
    public function newAction()
    {
        $entity = new SalesPerson();
        $form   = $this->createForm(new SalesPersonType(), $entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a new SalesPerson entity.
     *
     * @Route("/create", name="SalesPerson_create")
     * @Method("POST")
     * @Template("AcmeDemoBundle:SalesPerson:index.html.twig")
     */
    public function createAction(Request $request)
    {
        
        $entity  = new SalesPerson();
        $em = $this->getDoctrine()->getManager();
        $entities = $em->getRepository('AcmeDemoBundle:SalesPerson')->findAll();
        $form = $this->createForm(new SalesPersonType(), $entity);
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
            
            $enName = $form->get('enName')->getData();
            $arName = $form->get('arName')->getData();
              if (empty($arName)) {
                
                $entity->setArName($enName);
            }  elseif(empty($enName)) {
                 $entity->setEnName($arName);
            }
            
            if(empty($enName) && empty($arName)){
               $this->get('session')->getFlashBag()->add('notice2', 'You Should write one column to completely create');
               return $this->redirect($this->generateUrl('SalesPerson'));
            }
            $em->persist($entity);
            $em->flush();
 $this->get('session')->getFlashBag()->add('notice', 'Well done! Sales Person Successfuly Created');
            return $this->redirect($this->generateUrl('SalesPerson'));
        }

        return array(
            'entity' => $entity,
            'entities' => $entities,
            'form'   => $form->createView(),
        );
    }

    /**
     * Displays a form to edit an existing SalesPerson entity.
     *
     * @Route("/{id}/edit", name="SalesPerson_edit")
     * @Template()
     */
    public function editAction(Request $request,$id)
    {
        $em = $this->getDoctrine()->getManager();
        $entities = $em->getRepository('AcmeDemoBundle:SalesPerson')->findAll();
        $entity = $em->getRepository('AcmeDemoBundle:SalesPerson')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find SalesPerson entity.');
        }

        $editForm = $this->createForm(new SalesPersonType(), $entity);
        $deleteForm = $this->createDeleteForm($id);
        
         if ($request->getMethod() == 'POST') {
            $editForm->bind($request);
             $errorMsg="";
         $errors = $this->container->get('validator')->validate($entity);
         
                if(count($errors)){
                   foreach ($errors as $error) {
                       $errorMsg.=$error->getMessage()."\r\n";
                      
            }
              
              $this->get('session')->getFlashBag()->add('notice2',$errorMsg);
           
          
              }  
            if ($editForm->isValid()) {
                  $enName = $editForm->get('enName')->getData();
            $arName = $editForm->get('arName')->getData();
              if (empty($arName)) {
                
                $entity->setArName($enName);
            }  elseif(empty($enName)) {
                 $entity->setEnName($arName);
            }
             if(empty($enName) && empty($arName)){
               $this->get('session')->getFlashBag()->add('notice2', 'You Should write one column to completely update');
               return $this->redirect($this->generateUrl('SalesPerson_edit', array('id' => $id)));
            }    
            $em->persist($entity);
            $em->flush();
            $this->get('session')->getFlashBag()->add('notice', 'Well done! You successfully Update');
            return $this->redirect($this->generateUrl('SalesPerson'));
        }
        }

        return array(
            'entity'      => $entity,
            'entities' => $entities,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Edits an existing SalesPerson entity.
     *
     * @Route("/{id}/update", name="SalesPerson_update")
     * @Method("POST")
     * @Template("AcmeDemoBundle:SalesPerson:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AcmeDemoBundle:SalesPerson')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find SalesPerson entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new SalesPersonType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('SalesPerson_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Deletes a SalesPerson entity.
     *
     * @Route("/{id}/delete", name="SalesPerson_delete")
     
     */
    public function deleteAction(Request $request, $id) {

        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('AcmeDemoBundle:SalesPerson')->find($id);
        if (!$entity) {
            throw $this->createNotFoundException('Unable to find User entity.');
        }
        $em->remove($entity);
        $em->flush();
        $this->get('session')->getFlashBag()->add('notice', 'Well done! You successfully Delete');

        return $this->redirect($this->generateUrl('SalesPerson'));
    }

    private function createDeleteForm($id) {
        return $this->createFormBuilder(array('id' => $id))
                        ->add('id', 'hidden')
                        ->getForm()
        ;
    }

}
