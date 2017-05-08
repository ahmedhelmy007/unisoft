<?php

namespace Unisoft\AssetsBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Unisoft\AssetsBundle\Entity\Departments;
use Unisoft\AssetsBundle\Form\DepartmentsType;
use Unisoft\AssetsBundle\Form\SearchFieldType;

/**
 * Departments controller.
 *
 * @Route("/departments")
 */
class DepartmentsController extends Controller
{
    /**
     * Lists all Departments entities.
     *
     * @Route("/", name="departments")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('UnisoftAssetsBundle:Departments')->findAll();

        return array(
            'entities' => $entities,
        );
    }

    /**
     * Finds and displays a Departments entity.
     *
     * @Route("/{id}/show", name="departments_show")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('UnisoftAssetsBundle:Departments')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Departments entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to create a new Departments entity.
     *
     * @Route("/new", name="departments_new")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Departments();
        $em = $this->getDoctrine()->getManager();
        $max=$em->getRepository('UnisoftAssetsBundle:Departments')
                ->getMaxtId('Departments');
        
       $entity->setDepartmentNo($max);
        $form   = $this->createForm(new DepartmentsType(), $entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a new Departments entity.
     *
     * @Route("/create", name="departments_create")
     * @Method("POST")
     * @Template("UnisoftAssetsBundle:Departments:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity  = new Departments();
        $form = $this->createForm(new DepartmentsType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('departments'));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Departments entity.
     *
     * @Route("/{id}/edit", name="departments_edit")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('UnisoftAssetsBundle:Departments')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Departments entity.');
        }

        $pagingWidget=$em->getRepository('UnisoftAssetsBundle:Departments')
                ->getPagingWidget('Departments', $entity->getId());
        
        $editForm = $this->createForm(new DepartmentsType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
            'pagingWidget' =>$pagingWidget,
        );
    }

    /**
     * Edits an existing Departments entity.
     *
     * @Route("/{id}/update", name="departments_update")
     * @Method("POST")
     * @Template("UnisoftAssetsBundle:Departments:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('UnisoftAssetsBundle:Departments')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Departments entity.');
        }

        $pagingWidget=$em->getRepository('UnisoftAssetsBundle:Departments')
                ->getPagingWidget('Departments', $entity->getId());
        
        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new DepartmentsType(), $entity);
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
            return $this->redirect($this->generateUrl('departments'));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
            'pagingWidget' =>$pagingWidget,
        );
    }

    /**
     * Deletes a Departments entity.
     *
     * @Route("/{id}/delete", name="departments_delete")
     * @Method("POST")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('UnisoftAssetsBundle:Departments')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Departments entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('departments'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
}
