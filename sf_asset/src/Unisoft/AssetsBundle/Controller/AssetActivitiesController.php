<?php

namespace Unisoft\AssetsBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Unisoft\AssetsBundle\Entity\AssetActivities;
use Unisoft\AssetsBundle\Form\AssetActivitiesType;

/**
 * AssetActivities controller.
 *
 * @Route("/activities")
 */
class AssetActivitiesController extends Controller
{
    /**
     * Lists all AssetActivities entities.
     *
     * @Route("/", name="activities")
     * @Template()
     */
    public function indexAction()
    {
        $breadcrumbs = $this->get("white_october_breadcrumbs");
        $breadcrumbs->clear();
        $breadcrumbs->addItem("Home", $this->get("router")->generate("home"), 'icon-home');
        $breadcrumbs->addItem("Activities", $this->get("router")->generate("activities"));
        
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('UnisoftAssetsBundle:AssetActivities')->findAll();

        return array(
            'entities' => $entities,
        );
    }

    /**
     * Finds and displays a AssetActivities entity.
     *
     * @Route("/{id}/show", name="activities_show")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('UnisoftAssetsBundle:AssetActivities')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find AssetActivities entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to create a new AssetActivities entity.
     *
     * @Route("/new", name="activities_new")
     * @Template()
     */
    public function newAction()
    {
        $entity = new AssetActivities();
        $form   = $this->createForm(new AssetActivitiesType(), $entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a new AssetActivities entity.
     *
     * @Route("/create", name="activities_create")
     * @Method("POST")
     * @Template("UnisoftAssetsBundle:AssetActivities:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity  = new AssetActivities();
        $form = $this->createForm(new AssetActivitiesType(), $entity);
        $form->bind($request);
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

            //return $this->redirect($this->generateUrl('activities_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Displays a form to edit an existing AssetActivities entity.
     *
     * @Route("/{id}/edit", name="activities_edit")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('UnisoftAssetsBundle:AssetActivities')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find AssetActivities entity.');
        }

        $editForm = $this->createForm(new AssetActivitiesType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    
    /**
     *
     * @Route("/{id}/test", name="activities_test")
     * @Template()
     */
    public function testAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('UnisoftAssetsBundle:AssetActivities')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find AssetActivities entity.');
        }

        $editForm = $this->createFormBuilder($entity, array('csrf_protection' => false))
                ->add('changeInValue', 'text', array('label'=> 'Change In Value'))
                ->add('id', 'hidden')
                ->getForm();
        
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    
    /**
     * Edits an existing AssetActivities entity.
     *
     * @Route("/{id}/testUpdate", name="activities_testUpdate")
     * @Template("UnisoftAssetsBundle:AssetActivities:test.html.twig")
     */
    public function testUpdateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('UnisoftAssetsBundle:AssetActivities')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find AssetActivities entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createFormBuilder($entity, array('csrf_protection' => false))
                ->add('changeInValue', 'text', array('label'=> 'Change In Value'))
                ->getForm();
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('activities_test', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    
    /**
     * Edits an existing AssetActivities entity.
     *
     * @Route("/{id}/update", name="activities_update")
     * @Method("POST")
     * @Template("UnisoftAssetsBundle:AssetActivities:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('UnisoftAssetsBundle:AssetActivities')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find AssetActivities entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new AssetActivitiesType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('activities_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Deletes a AssetActivities entity.
     *
     * @Route("/{id}/delete", name="activities_delete")
     * @Method("POST")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('UnisoftAssetsBundle:AssetActivities')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find AssetActivities entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('activities'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
}
