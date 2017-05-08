<?php

namespace Acme\DemoBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Acme\DemoBundle\Entity\RentalPeriods;
use Acme\DemoBundle\Entity\StoresRentalperiods;
use Acme\DemoBundle\Form\RentalPeriodsType;

/**
 * RentalPeriods controller.
 *
 * @Route("/rentalperiods")
 */
class RentalPeriodsController extends Controller
{
    /**
     * Lists all RentalPeriods entities.
     *
     * @Route("/", name="rentalperiods")
     * @Template()
     */
    public function indexAction()
    {
        $entity = new RentalPeriods();
        $em = $this->getDoctrine()->getManager();
        
        $entities = $em->getRepository('AcmeDemoBundle:RentalPeriods')->findAll();
        $form = $this->createForm(new RentalPeriodsType(), $entity);
        

        return array(
            'entities' => $entities,
            'form'   => $form->createView(),
            
        );
    }

    /**
     * Finds and displays a RentalPeriods entity.
     *
     * @Route("/{id}/show", name="rentalperiods_show")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AcmeDemoBundle:RentalPeriods')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find RentalPeriods entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to create a new RentalPeriods entity.
     *
     * @Route("/new", name="rentalperiods_new")
     * @Template()
     */
    public function newAction()
    {
        $entity = new RentalPeriods();
        $form   = $this->createForm(new RentalPeriodsType(), $entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a new RentalPeriods entity.
     *
     * @Route("/create", name="rentalperiods_create")
     * @Method("POST")
     * @Template("AcmeDemoBundle:RentalPeriods:index.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity  = new RentalPeriods();
        $form = $this->createForm(new RentalPeriodsType(), $entity);
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
               return $this->redirect($this->generateUrl('rentalperiods'));
            }
                   
            $em->persist($entity);  
            $em->flush();
            $this->get('session')->getFlashBag()->add('notice', 'Well done! Rental Periods Successfuly Created');
            return $this->redirect($this->generateUrl('rentalperiods'));
        }
        $em = $this->getDoctrine()->getManager();
        $entities = $em->getRepository('AcmeDemoBundle:RentalPeriods')->findAll();
        return array(
            'entity' => $entity,
            'entities' => $entities,
            'form'   => $form->createView(),
        );
    }

    /**
     * Displays a form to edit an existing RentalPeriods entity.
     *
     * @Route("/{id}/edit", name="rentalperiods_edit")
     * @Template()
     */
    public function editAction(Request $request,$id)
    {
        $em = $this->getDoctrine()->getManager();
        $entities = $em->getRepository('AcmeDemoBundle:RentalPeriods')->findAll();
        $entity = $em->getRepository('AcmeDemoBundle:RentalPeriods')->find($id);
        $oldVal=$entity->getNumberOfUnits();

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find RentalPeriods entity.');
        }

        $editForm = $this->createForm(new RentalPeriodsType(), $entity);
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
               return $this->redirect($this->generateUrl('rentalperiods_edit', array('id' => $id)));
            }    
            
            $em->persist($entity);
            $em->flush();
            $this->get('session')->getFlashBag()->add('notice','Well done! You successfully Update');
            return $this->redirect($this->generateUrl('rentalperiods'));
        }else{
            $entity->setNumberOfUnits($oldVal);
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
     * Edits an existing RentalPeriods entity.
     *
     * @Route("/{id}/update", name="rentalperiods_update")
     * @Method("POST")
     * @Template("AcmeDemoBundle:RentalPeriods:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AcmeDemoBundle:RentalPeriods')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find RentalPeriods entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new RentalPeriodsType(), $entity);
        $editForm->bind($request);
        

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();
           
            return $this->redirect($this->generateUrl('rentalperiods', array('id' => $id)));
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
     * @Route("/{id}/delete", name="rentalperiods_delete")

     */
    public function deleteAction(Request $request, $id) {

        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('AcmeDemoBundle:RentalPeriods')->find($id);
        if (!$entity) {
            throw $this->createNotFoundException('Unable to find User entity.');
        }
        
         $repositorys = $this->getDoctrine()
                ->getRepository('AcmeDemoBundle:StoresRentalperiods');
         $querys = $repositorys->createQueryBuilder('p')               
                ->where('p.period = :id')
                ->andWhere('p.price  IS NOT NULL')
                ->setParameter('id', $entity->getId())
                ->getQuery();
         $pro_entity = $querys->getArrayResult();
       
       
         if($pro_entity){             
         $this->get('session')->getFlashBag()->add('notice2', 'Cannot Delete This column Because Found relation Other table ');
         }else{
             $em->remove($entity);
             $em->flush();
              $this->get('session')->getFlashBag()->add('notice', 'Well done! You successfully Delete');
         }
       
       
        

        return $this->redirect($this->generateUrl('rentalperiods'));
    }

    private function createDeleteForm($id) {
        return $this->createFormBuilder(array('id' => $id))
                        ->add('id', 'hidden')
                        ->getForm()
        ;
    }
}
