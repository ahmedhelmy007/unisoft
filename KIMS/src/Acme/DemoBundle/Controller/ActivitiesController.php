<?php

namespace Acme\DemoBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Acme\DemoBundle\Entity\Activities;
use Acme\DemoBundle\Form\ActivitiesType;
use Acme\DemoBundle\Entity\Doors;
use Acme\DemoBundle\Form\DoorsType;

/**
 * Activities controller.
 *
 * @Route("/Activities")
 */
class ActivitiesController extends Controller {

    /**
     * Lists all Activities entities.
     *
     * @Route("/", name="Activities")
     * @Template()
     */
    public function indexAction() {
        $em = $this->getDoctrine()->getManager();



        $entities = $em->getRepository('AcmeDemoBundle:Activities')->findAll();
        $entitys = new Doors();
        $entitiess = $em->getRepository('AcmeDemoBundle:Doors')->findByperant(null);

        $entity = new Activities();
        $form = $this->createForm(new ActivitiesType(), $entity);

        return array(
            'entities' => $entities,
            'entitiess' => $entitiess,
            'entitys' => $entitys,
            'entity' => $entity,
            'form' => $form->createView(),
        );
    }

    /**
     * Finds and displays a Activities entity.
     *
     * @Route("/{id}/show", name="Activities_show")
     * @Template()
     */
    public function showAction($id) {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AcmeDemoBundle:Activities')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Activities entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity' => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to create a new Activities entity.
     *
     * @Route("/new", name="Activities_new")
     * @Template()
     */
    public function newAction() {
        $entity = new Activities();
        $form = $this->createForm(new ActivitiesType(), $entity);

        return array(
            'entity' => $entity,
            'form' => $form->createView(),
        );
    }

    /**
     * Creates a new Activities entity.
     *
     * @Route("/{id}/create", name="Activities_create")
     * @Method("POST")
     * @Template("AcmeDemoBundle:Activities:index.html.twig")
     */
    public function createAction(Request $request, $id) {
        $em = $this->getDoctrine()->getManager();
        $entity = new Activities();
        $form = $this->createForm(new ActivitiesType(), $entity);

        if ($request->getMethod() == 'POST') {
            $form->bind($request);
            if ($form->isValid()) {
            $em->persist($entity);
            $em->flush();
            $this->get('session')->getFlashBag()->add('notice', 'تم أضافة الحركة ');
            return $this->redirect($this->generateUrl('Activities_edit', array('id' => $id)));
        }
        }

        return array(
            'entity' => $entity,
            'form' => $form->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Activities entity.
     *
     * @Route("/{id}/edit", name="Activities_edit")
     * @Template()
     */
    public function editAction(Request $request, $id) {
        $em = $this->getDoctrine()->getManager();

        $entity = new Activities();
        $entitys = $em->getRepository('AcmeDemoBundle:Doors')->find($id);
        $entitiess = $em->getRepository('AcmeDemoBundle:Doors')->findByperant(null);


//        if (!$entity) {
//            throw $this->createNotFoundException('Unable to find Activities entity.');
//        }
        //   $editForm = $this->createForm(new ActivitiesType(), $entity);
        $editForm = $this->createFormBuilder($entitys)
                ->add('name', 'text', array('disabled' => 'disabled'))
                ->add('subName', 'text', array('disabled' => 'disabled'))
                ->add('balance')
                ->add('price')
                ->add('date')
                ->add('perant', 'entity', array('class' => 'Acme\DemoBundle\Entity\Doors',
                    'property' => 'name',
                    'disabled' => 'disabled',))
                ->getForm();
        $form = $this->createForm(new ActivitiesType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        $repository = $this->getDoctrine()
                ->getRepository('AcmeDemoBundle:Activities');
        $query = $repository->createQueryBuilder('p')
                ->where('p.activeId = :id')
                ->setParameter('id', $entitys->getId())
                ->getQuery();
        $sub_entity = $query->getArrayResult();
// Update entity
        if ($request->getMethod() == 'POST') {
            $form->bind($request);
            if ($form->isValid()) {
            $em->persist($entity);
            $em->flush();
  $this->get('session')->getFlashBag()->add('notice', 'تم أضافة الحركة ');
            return $this->redirect($this->generateUrl('Activities_edit', array('id' => $id)));
        }
        }
        
        return array(
            'entity' => $entity,
            'entitiess' => $entitiess,
            'entitys' => $entitys,
            'sub_entity' => $sub_entity,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
            'form' => $form->createView(),
        );
    }

    /**
     * Edits an existing Activities entity.
     *
     * @Route("/{id}/update", name="Activities_update")
     * @Method("POST")
     * @Template("AcmeDemoBundle:Activities:edit.html.twig")
     */
    public function updateAction(Request $request, $id) {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AcmeDemoBundle:Activities')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Activities entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new ActivitiesType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('Activities_edit', array('id' => $id)));
        }

        return array(
            'entity' => $entity,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Deletes a Doors entity.
     *
     * @Route("/{id}/delete", name="Activities_delete")

     */
    public function deleteAction(Request $request, $id) {

        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('AcmeDemoBundle:Activities')->find($id);
        $activeId=$entity->getActiveId();
        if (!$entity) {
            throw $this->createNotFoundException('Unable to find User entity.');
        }
        $em->remove($entity);
        $em->flush();
              $this->get('session')->getFlashBag()->add('notice', 'تم حذف الحركة');

        return $this->redirect($this->generateUrl('Activities_edit', array('id' => $activeId)));
    }

    private function createDeleteForm($id) {
        return $this->createFormBuilder(array('id' => $id))
                        ->add('id', 'hidden')
                        ->getForm()
        ;
    }

    /**
     * Displays a form to edit an existing Activities entity.
     *
     * @Route("/{id}/editor", name="Activities_editor")
     * @Template()
     */
    public function editorAction(Request $request, $id) {
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('AcmeDemoBundle:Activities')->find($id);
        $entitiess = $em->getRepository('AcmeDemoBundle:Doors')->findByperant(null);
        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Activities entity.');
        }

        $editForm = $this->createForm(new ActivitiesType(), $entity);

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
                return $this->redirect($this->generateUrl('Activities_editor', array('id' => $id)));
            }
        }

        return array(
            'entity' => $entity,
            'entitiess' => $entitiess,
            'edit_form' => $editForm->createView(),
        );
    }

    /**
     * Edits an existing Activities entity.
     *
     * @Route("/{id}/updateor", name="Activities_updateor")
     * @Method("POST")
     * @Template("AcmeDemoBundle:Activities:index.html.twig")
     */
    public function updateorAction(Request $request, $id) {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AcmeDemoBundle:Activities')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Activities entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new ActivitiesType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('Activities_editor', array('id' => $id)));
        }

        return array(
            'entity' => $entity,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

}

