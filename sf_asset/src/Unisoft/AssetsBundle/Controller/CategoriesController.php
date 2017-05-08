<?php

namespace Unisoft\AssetsBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Unisoft\AssetsBundle\Entity\Categories;
use Unisoft\AssetsBundle\Form\CategoriesType;
use Symfony\Component\HttpFoundation\Session\Session;

/**
 * Categories controller.
 *
 * @Route("/Categories")
 */
class CategoriesController extends Controller {

    /**
     * Lists all Categories entities.
     *
     * @Route("/", name="Categories")
     * @Template()
     */
    public function indexAction() {
        $em = $this->getDoctrine()->getManager();
        $entity = new Categories();

        $id=0;
        $form = $this->createForm(new CategoriesType(), $entity);
        $editForm = $this->createForm(new CategoriesType(), $entity);
        $deleteForm = $this->createDeleteForm($id);
        
Routing.generate('route_id', '/* your params */');        
     

        $entities = $em->getRepository('UnisoftAssetsBundle:Categories')->findByParent(1);
     
       
        return array(
            'entities' => $entities,
            'form' => $form->createView(),
            'edit_form' => $editForm->createView(),
            'entity' => $entity,
             'delete_form' => $deleteForm->createView(),
           
        );
    }

     /**
     * Json.
     *
     * @Route("/{id}/json", name="Categories_json")
     */
    public function json($id){
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('UnisoftAssetsBundle:Categories')->find($id);
        $par=$entity->getParent();
        $arr=array();
        $arr['id']=$entity->getId();
        $arr['CategoryNo']=$entity->getCategoryNo();
        $arr['englishMame']=$entity->getEnglishMame();
        $arr['ArabicName']=$entity->getArabicName();
        $arr['Parent']=$par->getId();
    
        return new Response(json_encode($arr), 200, array('Content-Type' => 'text/plain'));

    }
    
    /**
     * Finds and displays a Categories entity.
     *
     * @Route("/{id}/show", name="Categories_show")
     * @Template()
     */
    public function showAction($id) {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('UnisoftAssetsBundle:Categories')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Categories entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity' => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to create a new Categories entity.
     *
     * @Route("/new", name="Categories_new")
     * @Template()
     */
    public function newAction() {
        $entity = new Categories();
        $form = $this->createForm(new CategoriesType(), $entity);

        return array(
            'entity' => $entity,
            'form' => $form->createView(),
        );
    }

    /**
     * Creates a new Categories entity.
     *
     * @Route("/create", name="Categories_create")
     * @Method("POST")
     * @Template("UnisoftAssetsBundle:Categories:new.html.twig")
     */
    public function createAction(Request $request) {
        $entity = new Categories();
        $form = $this->createForm(new CategoriesType(), $entity);
        $form->bind($request);
       
        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

             $this->get('session')->getFlashBag()->add('notice', 'Well done! You successfully Create');
             
            return $this->redirect($this->generateUrl('Categories'));
        }
        return array(
            'entity' => $entity,
            'form' => $form->createView(),
            
        );
    }
       
    /**
     * Displays a form to edit an existing Categories entity.
     *
     * @Route("/{id}/edit", name="Categories_edit")
     * @Template()
     */
    public function editAction($id) {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('UnisoftAssetsBundle:Categories')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Categories entity.');
        }

        $editForm = $this->createForm(new CategoriesType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity' => $entity,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Edits an existing Categories entity.
     *
     * @Route("/{id}/update", name="Categories_update")
     * @Method("POST")
     * @Template("UnisoftAssetsBundle:Categories:edit.html.twig")
     */
    public function updateAction(Request $request, $id) {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('UnisoftAssetsBundle:Categories')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Categories entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new CategoriesType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();
            $this->get('session')->getFlashBag()->add('notice', 'Well done! You successfully Update');
            return $this->redirect($this->generateUrl('Categories', array('id' => $id)));
        }

        return array(
            'entity' => $entity,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Deletes a Categories entity.
     *
     * @Route("/{id}/delete", name="Categories_delete")
     * @Method("POST")
     */
    public function deleteAction(Request $request, $id) {
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('UnisoftAssetsBundle:Categories')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Categories entity.');
            }

            $em->remove($entity);
            $em->flush();
        }
        $this->get('session')->getFlashBag()->add('notice', 'Well done! You successfully Delete');
        return $this->redirect($this->generateUrl('Categories'));
    }

    private function createDeleteForm($id) {
        return $this->createFormBuilder(array('id' => $id))
                        ->add('id', 'hidden')
                        ->getForm()
        ;
    }

}
