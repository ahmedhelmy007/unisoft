<?php

namespace Unisoft\AssetsBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Unisoft\AssetsBundle\Entity\Employees;
use Unisoft\AssetsBundle\Form\EmployeesType;
use Unisoft\AssetsBundle\Form\UploadType;
use Symfony\Component\HttpFoundation\Response;
use Unisoft\AssetsBundle\Form\SearchFieldType;

/**
 * Employees controller.
 *
 * @Route("/Employees")
 */
class EmployeesController extends Controller
{
    /**
     * Lists all Employees entities.
     *
     * @Route("/", name="Employees")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('UnisoftAssetsBundle:Employees')->findAll();

        return array(
            'entities' => $entities,
        );
    }

    /**
     * Finds and displays a Employees entity.
     *
     * @Route("/{id}/show", name="Employees_show")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('UnisoftAssetsBundle:Employees')->find($id);
       $em->persist($entity);
        $em->flush();
       
        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Employees entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to create a new Employees entity.
     *
     * @Route("/new", name="Employees_new")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Employees();
        $form   = $this->createForm(new EmployeesType(), $entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a new Employees entity.
     *
     * @Route("/create", name="Employees_create")
     * @Method("POST")
     * @Template("UnisoftAssetsBundle:Employees:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity  = new Employees();
        $form = $this->createForm(new EmployeesType(), $entity);
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
            $this->get('session')->getFlashBag()->add('notice', 'Well done! Employee Successfuly Created');
            return $this->redirect($this->generateUrl('Employees_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Employees entity.
     *
     * @Route("/{id}/edit", name="Employees_edit")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('UnisoftAssetsBundle:Employees')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Employees entity.');
        }
        
        $pagingWidget=$em->getRepository('UnisoftAssetsBundle:Administrations')
                ->getPagingWidget('Administrations', $entity->getId());
        
        $sql='SELECT s FROM UnisoftAssetsBundle:EmployeeAssets s where s.id in(SELECT max(m.id) as max_id FROM UnisoftAssetsBundle:EmployeeAssets m group by m.asset) and s.employee=:id';
         $assetsEntity=$em->createQuery($sql)
                 ->setParameter('id', $id)
            ->getResult();

        $editForm = $this->createForm(new EmployeesType(), $entity);
        $deleteForm = $this->createDeleteForm($id);
//        $uploadForm = $this->createForm(new \Unisoft\AssetsBundle\Form\EmpUploadType(), $entity);
        $uploadForm = $this->createFormBuilder($entity)
                ->add('image', 'file', array('data_class' => NULL))
                ->getForm();

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
            'upload_form' => $uploadForm->createView(),
            'pagingWidget' =>$pagingWidget,
             'assetsEntity'=>$assetsEntity,
        );
    }

    /**
     * Edits an existing Employees entity.
     *
     * @Route("/{id}/update", name="Employees_update")
     * @Method("POST")
     * @Template("UnisoftAssetsBundle:Employees:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('UnisoftAssetsBundle:Employees')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Employees entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new EmployeesType(), $entity);
        $editForm->bind($request);
        $errorMsg="";
         $errors = $this->container->get('validator')->validate($entity);
         
                if(count($errors)){
                   foreach ($errors as $error) {
                       $errorMsg.=$error->getMessage()."\r\n";
                      
            }
              
              $this->get('session')->getFlashBag()->add('notice2',$errorMsg);
           
          
              }  
              
              $pagingWidget=$em->getRepository('UnisoftAssetsBundle:Administrations')
                ->getPagingWidget('Administrations', $entity->getId());
        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();
         $this->get('session')->getFlashBag()->add('notice1', 'Well done! You successfully Update');
            return $this->redirect($this->generateUrl('Employees'));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
            'pagingWidget' =>$pagingWidget,
        );
    }

    /**
     * Deletes a Employees entity.
     *
     * @Route("/{id}/delete", name="Employees_delete")
     * @Method("POST")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('UnisoftAssetsBundle:Employees')->find($id);
            $entity->setActive(0);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Employees entity.');
            }

            $em->persist($entity);
//            $em->remove($entity);
            $em->flush();
             $this->get('session')->getFlashBag()->add('notice1', 'Well done! You successfully deactivated');
        }

        return $this->redirect($this->generateUrl('Employees'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
    
    /**
     * Edits an existing Assets entity.
     *
     * @Route("/upload", name="Employees_upload")
     * @Method("POST")
     */
    public function uploadAction(Request $request) {

        $entity = new Employees();
        $form = $this->createFormBuilder($entity, array('csrf_protection' => false))
                ->add('image', 'file', array('data_class' => NULL))
                ->getForm();;
        $form->bind($request);

        $errors = $this->container->get('validator')->validate($entity, array('uploadByAjax'));
        $errorMsg = "";
        if (count($errors)) {
            foreach ($errors as $error) {
                $errorMsg.=$error->getMessage() . "\r\n";
            }
            $return = array("error" => 1, "msg" => $errorMsg);
            $return = json_encode($return); //jscon encode the array
            return new Response($return, 200, array('Content-Type' => 'application/json'));
        }
        
//        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity->uploadImage();

//            return new Response(json_encode(array("error" => 1, "msg" => 'ok')), 200, array('Content-Type' => 'application/json'));
            $return = array("error" => 0, "imageName" => $entity->getImage());
            $return = json_encode($return); //jscon encode the array
            return new Response($return, 200, array('Content-Type' => 'application/json'));
//        }
    }
    
    /**
     * @Route("/{entity_name}/{id}/print", name="Employees_print")
     * @Template()
     */
    public function printAction($entity_name, $id) {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('UnisoftAssetsBundle:Employees')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Employees entity.');
        }
        $editForm = $this->createForm(new EmployeesType(), $entity);
        
        $sql='SELECT s FROM UnisoftAssetsBundle:EmployeeAssets s where s.id in(SELECT max(m.id) as max_id FROM UnisoftAssetsBundle:EmployeeAssets m group by m.asset) and s.employee=:id';
         $assetsEntity=$em->createQuery($sql)
                 ->setParameter('id', $id)
            ->getResult();
         
        return array(
            'entity' => $entity,
            'assetsEntity'=>$assetsEntity,
            'edit_form' => $editForm->createView(),
            'print_title' => $this->get('translator')->trans('Employee', array(), 'messages'),
        );
    }
}
