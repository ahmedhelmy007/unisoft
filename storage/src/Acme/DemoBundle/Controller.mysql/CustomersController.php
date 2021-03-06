<?php

namespace Acme\DemoBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Acme\DemoBundle\Entity\Customers;
use Acme\DemoBundle\Form\CustomersType;
use Acme\DemoBundle\Form\CustomersSearchType;

/**
 * Customers controller.
 *
 * @Route("/customers")
 */
class CustomersController extends Controller
{
    /**
     * Lists all Customers entities.
     *
     * @Route("/list", name="customers")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('AcmeDemoBundle:Customers')->findAll();

        return array(
            'entities' => $entities,
        );
    }

    /**
     * Finds and displays a Customers entity.
     *
     * @Route("/{id}/show", name="customers_show")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AcmeDemoBundle:Customers')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Customers entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to create a new Customers entity.
     *
     * @Route("/", name="customers_new")
     * @Template()
     */
    public function newAction()
    {
        $em = $this->getDoctrine()->getManager();
        $entity = new Customers();
        $max=$em->getRepository('AcmeDemoBundle:Customers')
                ->getMaxtId('Customers','customerNo');
        $entity->setCustomerNo($max);
        $form   = $this->createForm(new CustomersType(), $entity);
        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a new Customers entity.
     *
     * @Route("/create", name="customers_create")
     * @Method("POST")
     * @Template("AcmeDemoBundle:Customers:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity  = new Customers();
        $form = $this->createForm(new CustomersType(), $entity);
        $form->bind($request);

        // validate the entity and return the validation errors in notice
            $errorMsg = "";
            $errors = $this->container->get('validator')->validate($entity);
            if (count($errors)) {
                foreach ($errors as $error) {
                    $errorMsg.=$error->getMessage() . "\r\n";
                }
                $this->get('session')->getFlashBag()->add('notice2', $errorMsg);
            }
            
        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();
            $this->get('session')->getFlashBag()->add('notice', 'Well done! Customer Successfuly Saved');
            return $this->redirect($this->generateUrl('customers_edit', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Customers entity.
     *
     * @Route("/{id}/edit", name="customers_edit")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AcmeDemoBundle:Customers')->find($id);
        $pagingWidget=$em->getRepository('AcmeDemoBundle:Customers')
                ->getPagingWidget('Customers', $entity->getId());

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Customers entity.');
        }

        $editForm = $this->createForm(new CustomersType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
            'pagingWidget' =>$pagingWidget,
        );
    }

    /**
     * Edits an existing Customers entity.
     *
     * @Route("/{id}/update", name="customers_update")
     * @Method("POST")
     * @Template("AcmeDemoBundle:Customers:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AcmeDemoBundle:Customers')->find($id);
        
        $pagingWidget=$em->getRepository('AcmeDemoBundle:Customers')
                ->getPagingWidget('Customers', $entity->getId());

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Customers entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new CustomersType(), $entity);
        $editForm->bind($request);
        
        
        // validate the entity and return the validation errors in notice
            $errorMsg = "";
            $errors = $this->container->get('validator')->validate($entity);
            if (count($errors)) {
                foreach ($errors as $error) {
                    $errorMsg.=$error->getMessage() . "\r\n";
                }
                $this->get('session')->getFlashBag()->add('notice2', $errorMsg);
            }

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();
            $this->get('session')->getFlashBag()->add('notice', 'Well done! Customer Successfuly Saved');
            return $this->redirect($this->generateUrl('customers_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
            'pagingWidget' =>$pagingWidget,
        );
    }

    /**
     * Deletes a Customers entity.
     *
     * @Route("/{id}/delete", name="customers_delete")
     * @Method("POST")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('AcmeDemoBundle:Customers')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Customers entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('customers'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
    
    /**
     * Edits an existing Stores entity.
     *
     * @Route("/search", name="customers_search")
     * @Template()
     */
    public function searchAction(Request $request) {
         
        $em = $this->getDoctrine()->getManager();
        $entities = array();
        $form = $this->get('form.factory')->create(new CustomersSearchType());

//       $request = $this->get('request');
        if ($request->getMethod() == 'POST') {
            $form->bindRequest($request);
       $customerNo = $form['customerNo']->getData();
       $enName = $form['enName']->getData();
       $arName = $form['arName']->getData();
       $civilId = $form['civilId']->getData();
       $mobile = $form['mobile']->getData();
       $phone = $form['phone']->getData();
       $nationality = $form['nationality']->getData();
       $contactPerson = $form['contactPerson']->getData();
      

        $sql = 'SELECT s FROM AcmeDemoBundle:Customers s';
            $sql.=' where 1=1';
            if (!empty($customerNo))
                $sql.=' and s.customerNo = :customerNo';
            if (!empty($enName))
                $sql.=' and s.enName like :enName';
            if (!empty($arName))
                $sql.=' and s.arName like :arName';
            if (!empty($civilId))
                $sql.=' and s.civilId = :civilId';
            if (!empty($mobile))
                $sql.=' and s.mobile = :mobile';
            if (!empty($phone))
                $sql.=' and s.phone = :phone';
            if (!empty($nationality))
                $sql.=' and s.nationality = :nationality';
            if (!empty($contactPerson))
                $sql.=' and s.contactPerson like :contactPerson';
            $sql.=' ORDER BY s.id DESC';

            $parameters = $em->createQuery($sql);
            if (!empty($customerNo))
                $parameters->setParameter('customerNo', $customerNo);
            if (!empty($enName))
            $parameters->setParameter('enName', '%'.$enName.'%');
            if (!empty($arName))
            $parameters->setParameter('arName', '%'.$arName.'%');
            if (!empty($civilId))
                $parameters->setParameter('civilId', $civilId);
            if (!empty($mobile))
                $parameters->setParameter('mobile', $mobile);
            if (!empty($phone))
                $parameters->setParameter('phone', $phone);
            if (!empty($nationality))
                $parameters->setParameter('nationality', $nationality);
            if (!empty($contactPerson))
            $parameters->setParameter('contactPerson', '%'.$contactPerson.'%');
            
            $entities = $parameters->getResult();
        }
//
        return array(
            'entities' => $entities,
            'form' => $form->createView(),
        );
    }
}
