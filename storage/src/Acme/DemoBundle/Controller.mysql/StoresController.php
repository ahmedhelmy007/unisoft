<?php

namespace Acme\DemoBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Acme\DemoBundle\Entity\Stores;
use Acme\DemoBundle\Entity\StoresRentalperiods;
use Acme\DemoBundle\Form\StoresType;
use Acme\DemoBundle\Form\StoresSearchType;
use Symfony\Component\HttpFoundation\Response;
/**
 * Stores controller.
 *
 * @Route("/stores")
 */
class StoresController extends Controller {

    /**
     * Lists all Stores entities.
     *
     * @Route("/", name="stores")
     * @Template()
     */
    public function indexAction(Request $request) {
        $em = $this->getDoctrine()->getManager();
        $entity = new Stores();
        $entities = $em->getRepository('AcmeDemoBundle:Stores')->findAll();
        $rental_periods_objs = $em->getRepository('AcmeDemoBundle:RentalPeriods')->findAll();
        $form = $this->createForm(new StoresType(), $entity);
        $search_form = $this->createForm(new StoresSearchType(), $entity);

        if ($request->getMethod() == 'POST') {
            $search_form->bindRequest($request);
            $name = $search_form['name']->getData();
            $size = $search_form['size']->getData();
            $status = $search_form['status']->getData();

            $sql = 'SELECT s FROM AcmeDemoBundle:Stores s';
            $sql.=' where 1=1';
            if (!empty($name))
                $sql.='and s.name like :param';
            if (!empty($size))
                $sql.=' and s.size = :size';
            if (!empty($status))
                $sql.=' and s.status = :status';
            $sql.=' ORDER BY s.id DESC';

            $parameters = $em->createQuery($sql);
            if (!empty($name))
                $parameters->setParameter('param', '%' . $name . '%');
            if (!empty($size))
                $parameters->setParameter('size', $size);
            if (!empty($status))
                $parameters->setParameter('status', $status);
            $entities = $parameters->getResult();
        }

        return array(
            'entities' => $entities,
            'rental_periods_objs' => $rental_periods_objs,
            'form' => $form->createView(),
            'search_form' => $search_form->createView(),
            'form_errors' => '0',
        );
    }

    /**
     * Finds and displays a Stores entity.
     *
     * @Route("/{id}/show", name="stores_show")
     * @Template()
     */
    public function showAction($id) {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AcmeDemoBundle:Stores')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Stores entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity' => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to create a new Stores entity.
     *
     * @Route("/new", name="stores_new")
     * @Template()
     */
    public function newAction() {
        $entity = new Stores();
        $form = $this->createForm(new StoresType(), $entity);

        return array(
            'entity' => $entity,
            'form' => $form->createView(),
        );
    }

    /**
     * Creates a new Stores entity.
     *
     * @Route("/create", name="stores_create")
     * @Method("POST")
     * @Template("AcmeDemoBundle:Stores:index.html.twig")
     */
    public function createAction(Request $request) {
        $em = $this->getDoctrine()->getManager();
        $entity = new Stores();
        $form = $this->createForm(new StoresType(), $entity);
        $form->bind($request);
        $entities = $em->getRepository('AcmeDemoBundle:Stores')->findAll();
        $rental_periods_objs = $em->getRepository('AcmeDemoBundle:RentalPeriods')->findAll();

        // validate the entity and return the validation errors in notice
        $errorMsg = "";
        $errors = $this->container->get('validator')->validate($entity);
        if (count($errors)) {
            foreach ($errors as $error) {
                $errorMsg.=$error->getMessage() . "\r\n";
            }
            $this->get('session')->getFlashBag()->add('notice2', $errorMsg);
        }

        $getRentalPeriods = $entity->getStoresRentalperiods();
        foreach ($getRentalPeriods as $key => $rentalPeriod) {
            $rentalPeriod->setStores($entity);
            $rentalPeriod->setStore($entity);
        }

        // save entity
        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();
            $this->get('session')->getFlashBag()->add('notice', 'Well done! Stores Successfuly Created');
            
            return new Response('<html><body>Hello!</body></html>');
            return $this->redirect($this->generateUrl('stores', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'entities' => $entities,
            'rental_periods_objs' => $rental_periods_objs,
            'form' => $form->createView(),
            'form_errors' => '1'
        );
    }

    /**
     * Displays a form to edit an existing Stores entity.
     *
     * @Route("/{id}/edit", name="stores_edit")
     * @Template()
     */
    public function editAction(Request $request, $id) {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AcmeDemoBundle:Stores')->find($id);
        $entities = $em->getRepository('AcmeDemoBundle:Stores')->findAll();
        $rental_periods_objs = $em->getRepository('AcmeDemoBundle:RentalPeriods')->findAll();

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Stores entity.');
        }

        $editForm = $this->createForm(new StoresType(array('rental_periods_objs' => $rental_periods_objs, 'store' => $entity)), $entity);
        $form = $this->createForm(new StoresType(), new Stores());
        $deleteForm = $this->createDeleteForm($id);

        if ($request->getMethod() == 'POST') {
            $editForm->bind($request);

            $getRentalPeriods = $entity->getStoresRentalperiods();

            // validate the entity and return the validation errors in notice
            $errorMsg = "";
            $errors = $this->container->get('validator')->validate($entity);
            if (count($errors)) {
                foreach ($errors as $error) {
                    $errorMsg.=$error->getMessage() . "\r\n";
                }
                $this->get('session')->getFlashBag()->add('notice2', $errorMsg);
            }
            // save entity
            if ($editForm->isValid()) {
                $em->persist($entity);
                $em->flush();
                $this->get('session')->getFlashBag()->add('notice', 'Well done! Stores Successfuly Saved');
                return $this->redirect($this->generateUrl('stores'));
            }
        }

        return array(
            'entity' => $entity,
            'edit_form' => $editForm->createView(),
            'form' => $form->createView(),
            'delete_form' => $deleteForm->createView(),
            'entities' => $entities,
            'rental_periods_objs' => $rental_periods_objs
        );
    }

    /**
     * Edits an existing Stores entity.
     *
     * @Route("/{id}/update", name="stores_update")
     * @Method("POST")
     * @Template("AcmeDemoBundle:Stores:edit.html.twig")
     */
    public function updateAction(Request $request, $id) {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AcmeDemoBundle:Stores')->find($id);
        $rental_periods_objs = $em->getRepository('AcmeDemoBundle:RentalPeriods')->findAll();

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Stores entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new StoresType(), $entity);
        $editForm->bind($request);
        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('stores_edit', array('id' => $id)));
        }

        return array(
            'entity' => $entity,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
            'rental_periods_objs' => $rental_periods_objs
        );
    }

    /**
     * Deletes a Stores entity.
     *
     * @Route("/{id}/delete", name="stores_delete")
     * Method("POST")
     */
    public function deleteAction(Request $request, $id) {
        $em = $this->getDoctrine()->getManager();
        
        $entity = $em->getRepository('AcmeDemoBundle:Stores')->find($id);
        $em->remove($entity);
        $em->flush();
        
        return $this->redirect($this->generateUrl('stores'));
    }

    private function createDeleteForm($id) {
        return $this->createFormBuilder(array('id' => $id))
                        ->add('id', 'hidden')
                        ->getForm()
        ;
    }

    /**
     * Edits an existing Stores entity.
     *
     * @Route("/search", name="stores_search")
     * Method("POST")
     * @Template()
     */
    public function searchAction(Request $request) {
        $em = $this->getDoctrine()->getManager();
        $entity = new Stores();
        $entities = array();
        $rental_periods_objs = $em->getRepository('AcmeDemoBundle:RentalPeriods')->findAll();
        $form = $this->createForm(new StoresType(), $entity);
        $search_form = $this->createForm(new StoresSearchType(), $entity);


if ($request->getMethod() == 'POST') {
            $search_form->bindRequest($request);
            $name = $search_form['name']->getData();
            $size = $search_form['size']->getData();
            $status = $search_form['status']->getData();

            $sql = 'SELECT s FROM AcmeDemoBundle:Stores s';
            $sql.=' where 1=1';
            if (!empty($name))
                $sql.='and s.name like :param';
            if (!empty($size))
                $sql.=' and s.size = :size';
            if (!empty($status))
                $sql.=' and s.status = :status';
            $sql.=' ORDER BY s.id DESC';

            $parameters = $em->createQuery($sql);
            if (!empty($name))
                $parameters->setParameter('param', '%' . $name . '%');
            if (!empty($size))
                $parameters->setParameter('size', $size);
            if (!empty($status))
                $parameters->setParameter('status', $status);
            $entities = $parameters->getResult();
        }
        return array(
            'entities' => $entities,
            'rental_periods_objs' => $rental_periods_objs,
            'form' => $form->createView(),
            'search_form' => $search_form->createView(),
            'form_errors' => '0',
        );
    }

}
