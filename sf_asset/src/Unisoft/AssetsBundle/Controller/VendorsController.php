<?php

namespace Unisoft\AssetsBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Unisoft\AssetsBundle\Entity\Vendors;
use Unisoft\AssetsBundle\Form\VendorsType;
use Unisoft\AssetsBundle\Form\SearchFieldType;
use Symfony\Component\HttpFoundation\Response;

/**
 * Vendors controller.
 *
 * @Route("/Vendors")
 */
class VendorsController extends Controller {

    /**
     * Lists all Vendors entities.
     *
     * @Route("/", name="Vendors")
     * @Template()
     */
    public function indexAction() {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('UnisoftAssetsBundle:Vendors')->findAll();
     
        
        return array(
            'entities' => $entities,
         
        );
    }

    /**
     * Finds and displays a Vendors entity.
     *
     * @Route("/{id}/show", name="Vendors_show")
     * @Template()
     */
    public function showAction($id) {
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('UnisoftAssetsBundle:Vendors')->find($id);
        $em->persist($entity);
        $em->flush();
      
        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Vendors entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity' => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to create a new Vendors entity.
     *
     * @Route("/new", name="Vendors_new")
     * @Template()
     */
    public function newAction() {
       $entity = new Vendors();
        $em = $this->getDoctrine()->getManager();
        $max = $em->createQuery('SELECT MAX(e.id) FROM UnisoftAssetsBundle:Vendors e')
        ->getSingleScalarResult();
         $max++;
       $entity->setVendorNo($max);
       $form = $this->createForm(new VendorsType($max), $entity);
              
        return array(
            'entity' => $entity,
            'form' => $form->createView(),
        );
    }

    /**
     * Creates a new Vendors entity.
     *
     * @Route("/create", name="Vendors_create")
     * @Method("POST")
     * @Template("UnisoftAssetsBundle:Vendors:new.html.twig")
     */
    public function createAction(Request $request) {
        $entity = new Vendors();
            $form = $this->createForm(new VendorsType(), $entity);
      
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
           $this->get('session')->getFlashBag()->add('notice', 'Well done! vendor Successfuly Created');
            return $this->redirect($this->generateUrl('Vendors'));
        }

        return array(
            'entity' => $entity,
            'form' => $form->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Vendors entity.
     *
     * @Route("/{id}/edit", name="Vendors_edit")
     * @Template()
     */
    public function editAction($id) {
     
       
        
        $em = $this->getDoctrine()->getManager();
           
        $entity = $em->getRepository('UnisoftAssetsBundle:Vendors')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Vendors entity.');
        }
      
        $repository = $this->getDoctrine()
       ->getRepository('UnisoftAssetsBundle:Vendors');
         $query = $repository->createQueryBuilder('p')
            ->where('p.id > :id')
            ->setParameter('id', $entity->getId() )
            ->orderBy('p.id', 'ASC')
            ->setMaxResults('1')
            ->getQuery();
          $next = $query->getArrayResult();
          
          
         $repositorys = $this->getDoctrine()
       ->getRepository('UnisoftAssetsBundle:Vendors');
         $querys = $repositorys->createQueryBuilder('p')
            ->where('p.id < :id')
            ->setParameter('id', $entity->getId() )
            ->orderBy('p.id', 'DESC')
            ->setMaxResults('1')
            ->getQuery();
          $Previous = $querys->getArrayResult();
       //////////////////////////////////////////////////////////////////////   
        $repositoryse = $this->getDoctrine()
       ->getRepository('UnisoftAssetsBundle:Vendors');
         $queryse = $repositoryse->createQueryBuilder('p')
            ->orderBy('p.id', 'ASC')
            ->setMaxResults('1')
            ->getQuery();
          $first = $queryse->getArrayResult();
          
           $repositoryser = $this->getDoctrine()
       ->getRepository('UnisoftAssetsBundle:Vendors');
         $queryser = $repositoryser->createQueryBuilder('p')
            ->orderBy('p.id', 'DESC')
            ->setMaxResults('1')
            ->getQuery();
          $end = $queryser->getArrayResult();
              
        
         $editForm = $this->createFormBuilder($entity)
            ->add('vendorNo','text',array('label'=>  'Vendor Number','disabled'=>'disabled'))
            ->add('arName' ,'text',array('label'=>  'Arabic Name', 'attr' => array('placeholder' => 'Arabic Name')))
            ->add('enName' ,'text',array('label'=>  'English Name', 'attr' => array('placeholder' => 'English Name')))
            ->add('country' ,'text',array('label'=>  'Country', 'attr' => array('placeholder' => 'Country')))
            ->add('codeFax' ,'text',array('label'=>  'Code Fax' , 'attr' => array('placeholder' => 'Code Fax'))) 
            ->add('faxNo' ,'text',array('label'=>  'Fax Number', 'attr' => array('placeholder' => 'Fax Number')))
            ->add('codePhone' ,'text',array('label'=>  'Code Phone', 'attr' => array('placeholder' => 'Code Phone')))
            ->add('phoneNo' ,'text',array('label'=>  'Phone Number', 'attr' => array('placeholder' => 'Phone Number')))
            ->add('eMail','text',array('label'=>  'E-mail' , 'attr' => array('placeholder' => 'E-mail')))
            ->add('website' ,'text',array('label'=>  'Web-Site' , 'attr' => array('placeholder' => 'Web-Site')))
            ->add('importingFields' ,'text',array('label'=>  'Importing Fields', 'attr' => array('placeholder' => 'Importing Fields') ))
            ->add('authorized' ,'text',array('label'=>  'Authorized', 'attr' => array('placeholder' => 'Authorized')))
            ->add('accountManager','text',array('label'=>  'Account Manager', 'attr' => array('placeholder' => 'Account Manager')))
            ->add('accountNo' ,'text',array('label'=>  'Account Number', 'attr' => array('placeholder' => 'Account Number')))
                 ->getForm();
        
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity' => $entity,
            'next' =>$next,
            'Previous' =>$Previous,
            'end'  =>$end,
            'first'  =>$first,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
           
        );
    }

    /**
     * Edits an existing Vendors entity.
     *
     * @Route("/{id}/update", name="Vendors_update")
     * @Method("POST")
     * @Template("UnisoftAssetsBundle:Vendors:edit.html.twig")
     */
    public function updateAction(Request $request, $id) {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('UnisoftAssetsBundle:Vendors')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Vendors entity.');
        }
        
          $repository = $this->getDoctrine()
       ->getRepository('UnisoftAssetsBundle:Vendors');
         $query = $repository->createQueryBuilder('p')
            ->where('p.id > :id')
            ->setParameter('id', $entity->getId() )
            ->orderBy('p.id', 'ASC')
            ->setMaxResults('1')
            ->getQuery();
          $next = $query->getArrayResult();
          
          
         $repositorys = $this->getDoctrine()
       ->getRepository('UnisoftAssetsBundle:Vendors');
         $querys = $repositorys->createQueryBuilder('p')
            ->where('p.id < :id')
            ->setParameter('id', $entity->getId() )
            ->orderBy('p.id', 'DESC')
            ->setMaxResults('1')
            ->getQuery();
          $Previous = $querys->getArrayResult();
       //////////////////////////////////////////////////////////////////////   
        $repositoryse = $this->getDoctrine()
       ->getRepository('UnisoftAssetsBundle:Vendors');
         $queryse = $repositoryse->createQueryBuilder('p')
            ->orderBy('p.id', 'ASC')
            ->setMaxResults('1')
            ->getQuery();
          $first = $queryse->getArrayResult();
          
           $repositoryser = $this->getDoctrine()
       ->getRepository('UnisoftAssetsBundle:Vendors');
         $queryser = $repositoryser->createQueryBuilder('p')
            ->orderBy('p.id', 'DESC')
            ->setMaxResults('1')
            ->getQuery();
          $end = $queryser->getArrayResult();
              

        $deleteForm = $this->createDeleteForm($id);
         $editForm = $this->createFormBuilder($entity)
            ->add('vendorNo','text',array('label'=>  'Vendor Number','disabled'=>'disabled'))
            ->add('arName' ,'text',array('label'=>  'Arabic Name', 'attr' => array('placeholder' => 'Arabic Name')))
            ->add('enName' ,'text',array('label'=>  'English Name', 'attr' => array('placeholder' => 'English Name')))
            ->add('country' ,'text',array('label'=>  'Country', 'attr' => array('placeholder' => 'Country')))
            ->add('codeFax' ,'text',array('label'=>  'Code Fax' , 'attr' => array('placeholder' => 'Code Fax'))) 
            ->add('faxNo' ,'text',array('label'=>  'Fax Number', 'attr' => array('placeholder' => 'Fax Number')))
            ->add('codePhone' ,'text',array('label'=>  'Code Phone', 'attr' => array('placeholder' => 'Code Phone')))
            ->add('phoneNo' ,'text',array('label'=>  'Phone Number', 'attr' => array('placeholder' => 'Phone Number')))
            ->add('eMail','text',array('label'=>  'E-mail' , 'attr' => array('placeholder' => 'E-mail')))
            ->add('website' ,'text',array('label'=>  'Web-Site' , 'attr' => array('placeholder' => 'Web-Site')))
            ->add('importingFields' ,'text',array('label'=>  'Importing Fields', 'attr' => array('placeholder' => 'Importing Fields') ))
            ->add('authorized' ,'text',array('label'=>  'Authorized', 'attr' => array('placeholder' => 'Authorized')))
            ->add('accountManager','text',array('label'=>  'Account Manager', 'attr' => array('placeholder' => 'Account Manager')))
            ->add('accountNo' ,'text',array('label'=>  'Account Number', 'attr' => array('placeholder' => 'Account Number')))
                 ->getForm();
         
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
          $this->get('session')->getFlashBag()->add('notice1', 'Well done! You successfully Update');
            return $this->redirect($this->generateUrl('Vendors', array('id' => $id)));
        }

        return array(
            'entity' => $entity,
            'next' =>$next,
            'Previous' =>$Previous,
            'end'  =>$end,
            'first'  =>$first,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Deletes a Vendors entity.
     *
     * @Route("/{id}/delete", name="Vendors_delete")
     * @Method("POST")
     */
    public function deleteAction(Request $request, $id) {
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('UnisoftAssetsBundle:Vendors')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Vendors entity.');
            }

            $em->remove($entity);
            $em->flush();
             $this->get('session')->getFlashBag()->add('notice1', 'Well done! You successfully deleted');
        }

        return $this->redirect($this->generateUrl('Vendors'));
    }

    private function createDeleteForm($id) {
        return $this->createFormBuilder(array('id' => $id))
                        ->add('id', 'hidden')
                        ->getForm()
        ;
    }

    /**
     * Displays a form to edit an existing Vendors entity.
     *
     * @Route("/{id}/print", name="Vendors_print")
     * @Template()
     */
    public function printAction($id) {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('UnisoftAssetsBundle:Vendors')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Vendors entity.');
        }

         $editForm = $this->createForm(new VendorsType(), $entity);        
        
      
        return array(
            'entity' => $entity,
            'edit_form' => $editForm->createView(),
            
        );
    }


}
