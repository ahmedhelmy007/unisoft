<?php

namespace Acme\DemoBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Acme\DemoBundle\Entity\Doors;
use Acme\DemoBundle\Form\DoorsType;

/**
 * Doors controller.
 *
 * @Route("/Doors")
 */
class DoorsController extends Controller {

    /**
     * Lists all Doors entities.
     *
     * @Route("/", name="Doors")
     * @Template()
     */
    public function indexAction() {
        $em = $this->getDoctrine()->getManager();
        $entity = new Doors();


        $form = $this->createForm(new DoorsType(), $entity);
       
       
        $editForm = $this->createForm(new DoorsType(), $entity);
        $deleteForm = $this->createDeleteForm(0);
      //  $entities = $em->getRepository('AcmeDemoBundle:Doors')->findByperant(null);
        
         $repositorys = $this->getDoctrine()
                ->getRepository('AcmeDemoBundle:Doors');
        $querys = $repositorys->createQueryBuilder('p')               
                ->where('p.perant  IS NULL')
                ->andWhere('p.proId IS NULL')
               // ->setParameter('id', $entity->getId())
                ->getQuery();
        $entities = $querys->getArrayResult();
        

        $repository = $this->getDoctrine()
                ->getRepository('AcmeDemoBundle:Doors');
        $query = $repository->createQueryBuilder('p')
                ->where('p.perant = :id')
                ->setParameter('id', $entity->getId())
                ->getQuery();
        $sub_entity = $query->getArrayResult();


        return array(
            'entities' => $entities,
            'entity' => $entity,
            'sub_entity' => $sub_entity,
            'form' => $form->createView(),
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Finds and displays a Doors entity.
     *
     * @Route("/{id}/show", name="Doors_show")
     * @Template()
     */
    public function showAction($id) {
        $em = $this->getDoctrine()->getManager();


        $entity = $em->getRepository('AcmeDemoBundle:Doors')->find($id);
        


        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Doors entity.');
        }
        $form = $this->createForm(new DoorsType(), $entity);
        $editForm = $this->createForm(new DoorsType(), $entity);
        $entities = $em->getRepository('AcmeDemoBundle:Doors')->findByperant(null);
        
        
        $repositorys = $this->getDoctrine()
                ->getRepository('AcmeDemoBundle:Doors');
        $querys = $repositorys->createQueryBuilder('p')
                ->select('COUNT(p.id)')
                ->where('p.proId = :id')
                ->setParameter('id', $entity->getId())
                ->getQuery();
       
               
              $total = $querys->getSingleScalarResult();
        $pro_entity = $querys->getArrayResult();
        
        if( $total > 0){
           $repositorys = $this->getDoctrine()
                ->getRepository('AcmeDemoBundle:Doors');
        $querys = $repositorys->createQueryBuilder('p')               
                ->where('p.proId = :id')
                ->setParameter('id', $entity->getId())
                ->getQuery();
        $pro_entity = $querys->getArrayResult();
        return $this->render('AcmeDemoBundle:Doors:show.html.twig',array(
           'entities' => $entities,
            'pro_entity' => $pro_entity,
            'entity' => $entity,
            'form' => $form->createView(),
            'edit_form' => $editForm->createView(),
        ));
        }else{
           $repository = $this->getDoctrine()
                ->getRepository('AcmeDemoBundle:Doors');
        $query = $repository->createQueryBuilder('p')
                ->where('p.perant = :id')
                ->setParameter('id', $entity->getId())
                ->getQuery();
        $sub_entity = $query->getArrayResult();
           
        return $this->render('AcmeDemoBundle:Doors:show1.html.twig',array(
     
           'entities' => $entities,
           'sub_entity' => $sub_entity,
           'entity' => $entity,
           'form' => $form->createView(),
           'edit_form' => $editForm->createView(),
         
           
        ));
        }
        

       
    }

    
    
    /**
     * Finds and displays a Doors entity.
     *
     * @Route("/{id}/adminCpshow", name="Doors_adminCpshow")
     * @Template("AcmeDemoBundle:Doors:adminCpshow.html.twig")
     */
    public function adminCpshowAction($id) {
        $em = $this->getDoctrine()->getManager();


        $entity = $em->getRepository('AcmeDemoBundle:Doors')->find($id);
        


        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Doors entity.');
        }
        $form = $this->createForm(new DoorsType(), $entity);
        $editForm = $this->createForm(new DoorsType(), $entity);
        $entities = $em->getRepository('AcmeDemoBundle:Doors')->findByperant(null);
        
               
      
           $repositorys = $this->getDoctrine()
                ->getRepository('AcmeDemoBundle:Doors');
        $querys = $repositorys->createQueryBuilder('p')               
                ->where('p.proId = :id')
                ->setParameter('id', $entity->getId())
                ->getQuery();
        $pro_entity = $querys->getArrayResult();
        return array(
           'entities' => $entities,
            'pro_entity' => $pro_entity,
            'entity' => $entity,
            'form' => $form->createView(),
            'edit_form' => $editForm->createView(),
       );

    }

    
    
 
    /**
     * Displays a form to create a new Doors entity.
     *
     * @Route("/{id}/programs", name="Doors_programs")
     * @Template("AcmeDemoBundle:Doors:programs.html.twig")
     */
    public function programsAction($id) {
       
         $em = $this->getDoctrine()->getManager();
         $entity = $em->getRepository('AcmeDemoBundle:Doors')->find($id);
       
       $form = $this->createForm(new DoorsType(), $entity);
       $entities = $em->getRepository('AcmeDemoBundle:Doors')->findByperant(null);


        return array(
            'entity' => $entity,
            'entities' => $entities,
            'form' => $form->createView(),
        );
    }
    
    
    
    /**
     * Displays a form to create a new Doors entity.
     *
     * @Route("/{id}/new", name="Doors_new")
     * @Template()
     */
    public function newAction($id) {
       
         $em = $this->getDoctrine()->getManager();
         $entity = $em->getRepository('AcmeDemoBundle:Doors')->find($id);
       
        $form = $this->createForm(new DoorsType(), $entity);
       $entities = $em->getRepository('AcmeDemoBundle:Doors')->findByperant(null);


        return array(
            'entity' => $entity,
            'entities' => $entities,
            'form' => $form->createView(),
        );
    }

    /**
     * Creates a new Doors entity.
     *
     * @Route("/create", name="Doors_create")
     * @Method("POST")
     * @Template("AcmeDemoBundle:Doors:new.html.twig")
     */
    public function createAction(Request $request) {
        $entity = new Doors();
        $em = $this->getDoctrine()->getManager();
        $entities = $em->getRepository('AcmeDemoBundle:Doors')->findByperant(null);
      
        $form = $this->createForm(new DoorsType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('Doors'));
        }
        

        return array(
            'entity' => $entity,
            'entities' => $entities,
            'form' => $form->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Doors entity.
     *
     * @Route("/{id}/edit", name="Doors_edit")
     * @Template()
     */
    public function editAction(Request $request, $id) {
//        $aclActions= $this->get('acme.demo.kims_service')->isAllowMethod();
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AcmeDemoBundle:Doors')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Doors entity.');
        }
        $entities = $em->getRepository('AcmeDemoBundle:Doors')->findByperant(null);
        $form = $this->createForm(new DoorsType(), $entity);
       $editForm = $this->createFormBuilder($entity)
            ->add('name', 'text', array('attr' => array('placeholder' => 'الابواب')))
            ->add('subName','text',array('disabled'=>'disabled'))
            ->add('balance')
            ->add('price','text',array('attr' => array('value' => 0)))   
            ->add('date')
            ->add('perant','entity', array('disabled'=>'disabled',
                'class'=>   'Acme\DemoBundle\Entity\Doors',
                'property'=>'name',
                'empty_value' => 'الاختيار',
                'required' => false,
                'query_builder'=>function( $er) {
               return $er->createQueryBuilder('Doors')->where('Doors.perant IS NULL');} ))
                 ->getForm();
        $deleteForm = $this->createDeleteForm($id);

        $repository = $this->getDoctrine()
                ->getRepository('AcmeDemoBundle:Doors');
        $query = $repository->createQueryBuilder('p')
                ->where('p.perant = :id')
                ->setParameter('id', $entity->getId())
                ->getQuery();
        $sub_entity = $query->getArrayResult();
        
        // Update entity
        if ($request->getMethod() == 'POST') {
            $editForm->bind($request);
            if ($editForm->isValid()) {
                $em->persist($entity);
                $em->flush();
                return $this->redirect($this->generateUrl('Doors_edit', array('id' => $id)));
            }
        }
        return array(
            'entities' => $entities,
            'entity' => $entity,
            'sub_entity' => $sub_entity,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
            'form' => $form->createView(),
        );
    }

    /**
     * Edits an existing Doors entity.
     *
     * @Route("/{id}/update", name="Doors_update")
     * @Method("POST")
     * @Template("AcmeDemoBundle:Doors:edit.html.twig")
     */
    public function updateAction(Request $request, $id) {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AcmeDemoBundle:Doors')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Doors entity.');
        }
        $entities = $em->getRepository('AcmeDemoBundle:Doors')->findByperant(null);
        $form = $this->createForm(new DoorsType(), $entity);
        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createFormBuilder($entity)
            ->add('name')
            ->add('subName','text',array('disabled'=>'disabled'))
            ->add('balance')
            ->add('price','text',array('attr' => array('value' => 0)))   
            ->add('date')
            ->add('perant','entity', array('disabled'=>'disabled',
                'class'=>   'Acme\DemoBundle\Entity\Doors',
                'property'=>'name',
                'empty_value' => 'الاختيار',
                'required' => false,
                'query_builder'=>function( $er) {
               return $er->createQueryBuilder('Doors')->where('Doors.perant IS NULL');} ))
                 ->getForm();
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('Doors_edit', array('id' => $id)));
        }
        $repository = $this->getDoctrine()
                ->getRepository('AcmeDemoBundle:Doors');
        $query = $repository->createQueryBuilder('p')
                ->where('p.perant = :id')
                ->setParameter('id', $entity->getId())
                ->getQuery();
        $sub_entity = $query->getArrayResult();

        return array(
            'entities' => $entities,
            'sub_entity' => $sub_entity,
            'entity' => $entity,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
            'form' => $form->createView(),
        );
    }

    /**
     * Deletes a Doors entity.
     *
     * @Route("/{id}/delete", name="Doors_delete")

     */
    public function deleteAction(Request $request, $id) {

        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('AcmeDemoBundle:Doors')->find($id);
        if (!$entity) {
            throw $this->createNotFoundException('Unable to find User entity.');
        }
        $em->remove($entity);
        $em->flush();
        //      $this->get('session')->getFlashBag()->add('notice', 'تم حذف المستخدم');

        return $this->redirect($this->generateUrl('Doors'));
    }

    private function createDeleteForm($id) {
        return $this->createFormBuilder(array('id' => $id))
                        ->add('id', 'hidden')
                        ->getForm()
        ;
    }
     /**
     * Displays a form to edit an existing Doors entity.
     *
     * @Route("/{id}/editor", name="Doors_editor")
     * @Template()
     */
    public function editorAction(Request $request, $id) {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AcmeDemoBundle:Doors')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Doors entity.');
        }
        $entities = $em->getRepository('AcmeDemoBundle:Doors')->findByperant(null);
        $form = $this->createForm(new DoorsType(), $entity);
       
         $editForm = $this->createFormBuilder($entity)
            ->add('name','text',array('disabled'=>'disabled'))
            ->add('subName', 'text', array('attr' => array('placeholder' => 'المصروف')))
            ->add('balance', 'text', array('attr' => array('placeholder' => 'الموازنة')))
            ->add('price', 'text', array('attr' => array('placeholder' => 'السعر')))   
            ->add('date')
            ->add('perant','entity', array(
                'class'=>   'Acme\DemoBundle\Entity\Doors',
                'property'=>'name',
                'empty_value' => 'الاختيار',
                'required' => false,
                'query_builder'=>function($er) {
               return $er->createQueryBuilder('Doors')->where('Doors.perant IS NULL');} ))
                 ->getForm();
        
        
        $deleteForm = $this->createDeleteForm($id);

        $repository = $this->getDoctrine()
                ->getRepository('AcmeDemoBundle:Doors');
        $query = $repository->createQueryBuilder('p')
                ->where('p.perant = :id')
                ->setParameter('id', $entity->getId())
                ->getQuery();
        $sub_entity = $query->getArrayResult();
        
        // Update entity
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
                $em->persist($entity);
                $em->flush();
                $this->get('session')->getFlashBag()->add('notice1', 'تم عملية التعديل بنجاح');
                return $this->redirect($this->generateUrl('Doors_editor', array('id' => $id)));
            }
        }
        return array(
            'entities' => $entities,
            'entity' => $entity,
            'sub_entity' => $sub_entity,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
            'form' => $form->createView(),
        );
    }
    
    
    
     /**
     * Edits an existing Doors entity.
     *
     * @Route("/{id}/updator", name="Doors_updator")
     * @Method("POST")
     * @Template("AcmeDemoBundle:Doors:editor.html.twig")
     */
    public function updatorAction(Request $request, $id) {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AcmeDemoBundle:Doors')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Doors entity.');
        }
        $entities = $em->getRepository('AcmeDemoBundle:Doors')->findByperant(null);
        $form = $this->createForm(new DoorsType(), $entity);
        $deleteForm = $this->createDeleteForm($id);
       $editForm = $this->createFormBuilder($entity)
            ->add('name','text',array('disabled'=>'disabled'))
            ->add('subName')
            ->add('balance')
            ->add('price')   
            ->add('date')
            ->add('perant','entity', array(
                'class'=>   'Acme\DemoBundle\Entity\Doors',
                'property'=>'name',
                'empty_value' => 'الاختيار',
                'required' => false,
                'query_builder'=>function( $er) {
               return $er->createQueryBuilder('Doors')->where('Doors.perant IS NULL');} ))
                 ->getForm();
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('Doors_editor', array('id' => $id)));
        }
        $repository = $this->getDoctrine()
                ->getRepository('AcmeDemoBundle:Doors');
        $query = $repository->createQueryBuilder('p')
                ->where('p.perant = :id')
                ->setParameter('id', $entity->getId())
                ->getQuery();
        $sub_entity = $query->getArrayResult();

        return array(
            'entities' => $entities,
            'sub_entity' => $sub_entity,
            'entity' => $entity,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
            'form' => $form->createView(),
        );
    }
    
    
    /**
    
     *
     * @Route("/admincp", name="Doors_admincp")
     * @Template("AcmeDemoBundle:Doors:admincp.html.twig")
     */
  public function admincpAction() {
        $em = $this->getDoctrine()->getManager();
        $entity = new Doors();


        $form = $this->createForm(new DoorsType(), $entity);
       
       
        $editForm = $this->createForm(new DoorsType(), $entity);
        $deleteForm = $this->createDeleteForm(0);
      
         $repositorys = $this->getDoctrine()
                ->getRepository('AcmeDemoBundle:Doors');
        $querys = $repositorys->createQueryBuilder('p')               
                ->where('p.perant  IS NULL')
                ->andWhere('p.proId IS NULL')
               // ->setParameter('id', $entity->getId())
                ->getQuery();
        $entities = $querys->getArrayResult();

        $repository = $this->getDoctrine()
                ->getRepository('AcmeDemoBundle:Doors');
        $query = $repository->createQueryBuilder('p')
                ->where('p.perant = :id')
                ->setParameter('id', $entity->getId())
                ->getQuery();
        $sub_entity = $query->getArrayResult();


        return array(
            'entities' => $entities,
            'entity' => $entity,
            'sub_entity' => $sub_entity,
            'form' => $form->createView(),
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
   

     /**
     * Creates a new Doors entity.
     *
     * @Route("/addAdminCp", name="Doors_addAdminCp")
     
     * @Template("AcmeDemoBundle:Doors:addAdminCp.html.twig")
     */
    public function addAdminCpAction(Request $request) {
        $entity = new Doors();
        $em = $this->getDoctrine()->getManager();
        $entities = $em->getRepository('AcmeDemoBundle:Doors')->findByperant(null);
      
        $form = $this->createForm(new DoorsType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('Doors_admincp'));
        }
        

        return array(
            'entity' => $entity,
            'entities' => $entities,
            'form' => $form->createView(),
        );
    }
    
    
    
    /**
     * Finds and displays a Doors entity.
     *
     * @Route("/{id}/masroof", name="Doors_masroof")
     * @Template("AcmeDemoBundle:Doors:masroof.html.twig")
     */
    public function masroofAction($id) {
        $em = $this->getDoctrine()->getManager();


        $entity = $em->getRepository('AcmeDemoBundle:Doors')->find($id);
  
        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Doors entity.');
        }
        $form = $this->createForm(new DoorsType(), $entity);
        $editForm = $this->createForm(new DoorsType(), $entity);
     //   $entities = $em->getRepository('AcmeDemoBundle:Doors')->findByperant(null);
         $repository = $this->getDoctrine()
                ->getRepository('AcmeDemoBundle:Doors');
        $query = $repository->createQueryBuilder('p')
                ->where('p.perant = :id')
                ->setParameter('id', $entity->getId())
                ->getQuery();
        $sub_entity = $query->getArrayResult();
       
           
           
        return array(
     
        //   'entities' => $entities,
           'sub_entity' => $sub_entity,
           'entity' => $entity,
           'form' => $form->createView(),
           'edit_form' => $editForm->createView(),
         
           
        );
        }
        

       
    }

    

