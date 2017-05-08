<?php

namespace Acme\DemoBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Acme\DemoBundle\Entity\Nationalities;
use Acme\DemoBundle\Form\NationalitiesType;

/**
 * Nationalities controller.
 *
 * @Route("/Nationalities")
 */
class NationalitiesController extends Controller
{
    /**
     * Lists all Nationalities entities.
     *
     * @Route("/", name="Nationalities")
     * @Template()
     */
    public function indexAction()
    {
        $entity = new Nationalities();
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('AcmeDemoBundle:Nationalities')->findAll();
        $form   = $this->createForm(new NationalitiesType(), $entity);

        
        return array(
            'entities' => $entities,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Nationalities entity.
     *
     * @Route("/{id}/show", name="Nationalities_show")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AcmeDemoBundle:Nationalities')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Nationalities entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to create a new Nationalities entity.
     *
     * @Route("/new", name="Nationalities_new")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Nationalities();
        $form   = $this->createForm(new NationalitiesType(), $entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a new Nationalities entity.
     *
     * @Route("/create", name="Nationalities_create")
     * @Method("POST")
     * @Template("AcmeDemoBundle:Nationalities:index.html.twig")
     */
    public function createAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $entity  = new Nationalities();
        $form = $this->createForm(new NationalitiesType(), $entity);
        $entities = $em->getRepository('AcmeDemoBundle:Nationalities')->findAll();
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
               return $this->redirect($this->generateUrl('Nationalities'));
            }
            $em->persist($entity);
            $em->flush();
            $this->get('session')->getFlashBag()->add('notice', 'Well done! Nationalities Successfuly Created');
            return $this->redirect($this->generateUrl('Nationalities'));
        }

        return array(
            'entity' => $entity,
            'entities' => $entities,
            'form'   => $form->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Nationalities entity.
     *
     * @Route("/{id}/edit", name="Nationalities_edit")
     * @Template()
     */
    public function editAction(Request $request,$id)
    {
        $em = $this->getDoctrine()->getManager();
        $entities = $em->getRepository('AcmeDemoBundle:Nationalities')->findAll();
        $entity = $em->getRepository('AcmeDemoBundle:Nationalities')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Nationalities entity.');
        }

        $editForm = $this->createForm(new NationalitiesType(), $entity);
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
               return $this->redirect($this->generateUrl('Nationalities_edit', array('id' => $id)));
            }    
            $em->persist($entity);
            $em->flush();
            $this->get('session')->getFlashBag()->add('notice', 'Well done! You successfully Update');
            return $this->redirect($this->generateUrl('Nationalities'));
        }
        }

        return array(
            'entities' => $entities,
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Edits an existing Nationalities entity.
     *
     * @Route("/{id}/update", name="Nationalities_update")
     * @Method("POST")
     * @Template("AcmeDemoBundle:Nationalities:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AcmeDemoBundle:Nationalities')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Nationalities entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new NationalitiesType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('Nationalities_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

  
     /**
     * Deletes a RentalPeriods entity.
     *
     * @Route("/{id}/delete", name="Nationalities_delete")

     */
    public function deleteAction(Request $request, $id) {

        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('AcmeDemoBundle:Nationalities')->find($id);
        if (!$entity) {
            throw $this->createNotFoundException('Unable to find User entity.');
        }
        $em->remove($entity);
        $em->flush();
         $this->get('session')->getFlashBag()->add('notice', 'Well done! You successfully Delete');
        

        return $this->redirect($this->generateUrl('Nationalities'));
    }

    private function createDeleteForm($id) {
        return $this->createFormBuilder(array('id' => $id))
                        ->add('id', 'hidden')
                        ->getForm()
        ;
    }
    
}
