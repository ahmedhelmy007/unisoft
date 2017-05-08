<?php

namespace Unisoft\AssetsBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Unisoft\AssetsBundle\Entity\Manufacturers;
use Unisoft\AssetsBundle\Form\ManufacturersType;
use Unisoft\AssetsBundle\Form\SearchFieldType;


use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Show\ShowMapper;


/**
 * Manufacturers controller.
 *
 * @Route("/Manufacturers")
 */
class ManufacturersController extends Admin
{
    
        public function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            ->add('author')
            ->add('enabled')
            ->add('title')
            ->add('abstract')
            ->add('content')
            ->add('tags')
        ;
    }

    public function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->with('General')
                ->add('enabled', null, array('required' => false))
                ->add('author', 'sonata_type_model', array(), array('edit' => 'list'))
                ->add('title')
                ->add('abstract')
                ->add('content')
            ->end()
            ->with('Tags')
                ->add('tags', 'sonata_type_model', array('expanded' => true))
            ->end()
            ->with('Options', array('collapsed' => true))
                ->add('commentsCloseAt')
                ->add('commentsEnabled', null, array('required' => false))
            ->end()
        ;
    }

    public function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('title')
            ->add('author')
            ->add('enabled')
            ->add('tags')
            ->add('commentsEnabled')
        ;
    }

    public function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('title')
            ->add('enabled')
            ->add('tags', null, array('filter_field_options' => array('expanded' => true, 'multiple' => true)))
        ;
    }

    
    
    
    
    /**
     * Lists all Manufacturers entities.
     *
     * @Route("/", name="Manufacturers")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('UnisoftAssetsBundle:Manufacturers')->findAll();

        return array(
            'entities' => $entities,
        );
    }

    /**
     * Finds and displays a Manufacturers entity.
     *
     * @Route("/{id}/show", name="Manufacturers_show")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('UnisoftAssetsBundle:Manufacturers')->find($id);
        $em->persist($entity);
        $em->flush();
      
        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Manufacturers entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to create a new Manufacturers entity.
     *
     * @Route("/new", name="Manufacturers_new")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Manufacturers();
         $em = $this->getDoctrine()->getManager();
         $max = $em->createQuery('SELECT MAX(e.id) FROM UnisoftAssetsBundle:Manufacturers e')
        ->getSingleScalarResult();
         $max++;
        $entity->setManufacturerNo($max);
        $form   = $this->createForm(new ManufacturersType($max), $entity);
        

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a new Manufacturers entity.
     *
     * @Route("/create", name="Manufacturers_create")
     * @Method("POST")
     * @Template("UnisoftAssetsBundle:Manufacturers:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity  = new Manufacturers();
        $form = $this->createForm(new ManufacturersType(), $entity);
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
            $this->get('session')->getFlashBag()->add('notice', 'Well done! Manufacturer Successfuly Created');
            return $this->redirect($this->generateUrl('Manufacturers', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Manufacturers entity.
     *
     * @Route("/{id}/edit", name="Manufacturers_edit")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('UnisoftAssetsBundle:Manufacturers')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Manufacturers entity.');
        }

        $repository = $this->getDoctrine()
       ->getRepository('UnisoftAssetsBundle:Manufacturers');
         $query = $repository->createQueryBuilder('p')
            ->where('p.id > :id')
            ->setParameter('id', $entity->getId() )
            ->orderBy('p.id', 'ASC')
            ->setMaxResults('1')
            ->getQuery();
          $next = $query->getArrayResult();
          
          
         $repositorys = $this->getDoctrine()
       ->getRepository('UnisoftAssetsBundle:Manufacturers');
         $querys = $repositorys->createQueryBuilder('p')
            ->where('p.id < :id')
            ->setParameter('id', $entity->getId() )
            ->orderBy('p.id', 'DESC')
            ->setMaxResults('1')
            ->getQuery();
          $Previous = $querys->getArrayResult();
       //////////////////////////////////////////////////////////////////////   
        $repositoryse = $this->getDoctrine()
       ->getRepository('UnisoftAssetsBundle:Manufacturers');
         $queryse = $repositoryse->createQueryBuilder('p')
            ->orderBy('p.id', 'ASC')
            ->setMaxResults('1')
            ->getQuery();
          $first = $queryse->getArrayResult();
          
           $repositoryser = $this->getDoctrine()
       ->getRepository('UnisoftAssetsBundle:Manufacturers');
         $queryser = $repositoryser->createQueryBuilder('p')
            ->orderBy('p.id', 'DESC')
            ->setMaxResults('1')
            ->getQuery();
          $end = $queryser->getArrayResult();
        
        
        
         $editForm = $this->createFormBuilder($entity)
            ->add('manufacturerNo','text',array('label'=>  'Manufacturers Number','disabled'=>'disabled'))
            ->add('arName' ,'text',array('label'=>  'Arabic Name', 'attr' => array('placeholder' => 'Arabic Name')))
            ->add('enName' ,'text',array('label'=>  'English Name', 'attr' => array('placeholder' => 'English Name')))
            ->add('country' ,'text',array('label'=>  'Country', 'attr' => array('placeholder' => 'Country')))
            ->add('codeFax' ,'text',array('label'=>  'Code Fax' , 'attr' => array('placeholder' => 'Code Fax'))) 
            ->add('faxNo' ,'text',array('label'=>  'Fax Number', 'attr' => array('placeholder' => 'Fax Number')))
            ->add('codePhone' ,'text',array('label'=>  'Code Phone', 'attr' => array('placeholder' => 'Code Phone')))
            ->add('phoneNo' ,'text',array('label'=>  'Phone Number', 'attr' => array('placeholder' => 'Phone Number')))
            ->add('eMail','text',array('label'=>  'E-mail' , 'attr' => array('placeholder' => 'E-mail')))
            ->add('website' ,'text',array('label'=>  'Web-Site' , 'attr' => array('placeholder' => 'Web-Site')))
            ->add('manufacturingFields' ,'text',array('label'=>  'Mnufacturing Fields', 'attr' => array('placeholder' => 'Manufacturing Fields') ))
            ->add('manufacturingManager' ,'text',array('label'=>  'Manufacturing Manager', 'attr' => array('placeholder' => 'Manufacturing Manager')))
            ->add('regionalManager','text',array('label'=>  'Regional Manager', 'attr' => array('placeholder' => 'Regional Manager')))
            ->add('authorizedAgent' ,'text',array('label'=>  'Authorized Agent', 'attr' => array('placeholder' => 'Authorized Agent')))
                 ->getForm();
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'next' =>$next,
            'Previous' =>$Previous,
            'end'  =>$end,
            'first'  =>$first,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Edits an existing Manufacturers entity.
     *
     * @Route("/{id}/update", name="Manufacturers_update")
     * @Method("POST")
     * @Template("UnisoftAssetsBundle:Manufacturers:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('UnisoftAssetsBundle:Manufacturers')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Manufacturers entity.');
        }
        
           $repository = $this->getDoctrine()
       ->getRepository('UnisoftAssetsBundle:Manufacturers');
         $query = $repository->createQueryBuilder('p')
            ->where('p.id > :id')
            ->setParameter('id', $entity->getId() )
            ->orderBy('p.id', 'ASC')
            ->setMaxResults('1')
            ->getQuery();
          $next = $query->getArrayResult();
          
          
         $repositorys = $this->getDoctrine()
       ->getRepository('UnisoftAssetsBundle:Manufacturers');
         $querys = $repositorys->createQueryBuilder('p')
            ->where('p.id < :id')
            ->setParameter('id', $entity->getId() )
            ->orderBy('p.id', 'DESC')
            ->setMaxResults('1')
            ->getQuery();
          $Previous = $querys->getArrayResult();
       //////////////////////////////////////////////////////////////////////   
        $repositoryse = $this->getDoctrine()
       ->getRepository('UnisoftAssetsBundle:Manufacturers');
         $queryse = $repositoryse->createQueryBuilder('p')
            ->orderBy('p.id', 'ASC')
            ->setMaxResults('1')
            ->getQuery();
          $first = $queryse->getArrayResult();
          
           $repositoryser = $this->getDoctrine()
       ->getRepository('UnisoftAssetsBundle:Manufacturers');
         $queryser = $repositoryser->createQueryBuilder('p')
            ->orderBy('p.id', 'DESC')
            ->setMaxResults('1')
            ->getQuery();
          $end = $queryser->getArrayResult();
          
          

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createFormBuilder($entity)
            ->add('manufacturerNo','text',array('label'=>  'Manufacturer Number','disabled'=>'disabled'))
            ->add('arName' ,'text',array('label'=>  'Arabic Name', 'attr' => array('placeholder' => 'Arabic Name')))
            ->add('enName' ,'text',array('label'=>  'English Name', 'attr' => array('placeholder' => 'English Name')))
            ->add('country' ,'text',array('label'=>  'Country', 'attr' => array('placeholder' => 'Country')))
            ->add('codeFax' ,'text',array('label'=>  'Code Fax' , 'attr' => array('placeholder' => 'Code Fax'))) 
            ->add('faxNo' ,'text',array('label'=>  'Fax Number', 'attr' => array('placeholder' => 'Fax Number')))
            ->add('codePhone' ,'text',array('label'=>  'Code Phone', 'attr' => array('placeholder' => 'Code Phone')))
            ->add('phoneNo' ,'text',array('label'=>  'Phone Number', 'attr' => array('placeholder' => 'Phone Number')))
            ->add('eMail','text',array('label'=>  'E-mail' , 'attr' => array('placeholder' => 'E-mail')))
            ->add('website' ,'text',array('label'=>  'Web-Site' , 'attr' => array('placeholder' => 'Web-Site')))
            ->add('manufacturingFields' ,'text',array('label'=>  'Mnufacturing Fields', 'attr' => array('placeholder' => 'Manufacturing Fields') ))
            ->add('manufacturingManager' ,'text',array('label'=>  'Manufacturing Manager', 'attr' => array('placeholder' => 'Manufacturing Manager')))
            ->add('regionalManager','text',array('label'=>  'Regional Manager', 'attr' => array('placeholder' => 'Regional Manager')))
            ->add('authorizedAgent' ,'text',array('label'=>  'Authorized Agent', 'attr' => array('placeholder' => 'Authorized Agent')))
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
            return $this->redirect($this->generateUrl('Manufacturers', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'next' =>$next,
            'Previous' =>$Previous,
            'end'  =>$end,
            'first'  =>$first,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Deletes a Manufacturers entity.
     *
     * @Route("/{id}/delete", name="Manufacturers_delete")
     * @Method("POST")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('UnisoftAssetsBundle:Manufacturers')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Manufacturers entity.');
            }

            $em->remove($entity);
            $em->flush();
            $this->get('session')->getFlashBag()->add('notice1', 'Well done! You successfully deleted');
        }

        return $this->redirect($this->generateUrl('Manufacturers'));
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
     * @Route("/{id}/print", name="Manufacturers_print")
     * @Template()
     */
    public function printAction($id) {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('UnisoftAssetsBundle:Manufacturers')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Manufacturers entity.');
        }

         $editForm = $this->createForm(new ManufacturersType(), $entity);        
        
      
        return array(
            'entity' => $entity,
            'edit_form' => $editForm->createView(),
            
        );
    }
 
    
    
}
