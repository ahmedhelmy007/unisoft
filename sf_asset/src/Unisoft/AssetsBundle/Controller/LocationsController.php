<?php

namespace Unisoft\AssetsBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Unisoft\AssetsBundle\Entity\Locations;
use Unisoft\AssetsBundle\Form\LocationsType;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Symfony\Component\Security\Acl\Domain\ObjectIdentity;
use Symfony\Component\Security\Acl\Domain\UserSecurityIdentity;
use Symfony\Component\Security\Acl\Permission\MaskBuilder;

/**
 * Locations controller.
 *
 * @Route("/Locations")
 */
class LocationsController extends Controller {

    /**
     * Lists all Locations entities.
     *
     * @Route("/", name="Locations")
     * @Template()
     */
    public function indexAction() {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('UnisoftAssetsBundle:Locations')->findAll();
////        // creating the ACL
        $entity = $em->getRepository('UnisoftAssetsBundle:Locations')->find(1);
        $builder = new MaskBuilder();
        $builder
                ->add('edit')
                ->add('delete')
                ->add('undelete');
        $mask = $builder->get(); // int(29)        
//$this->createAcl($entity, $mask);

    
        return array(
            'entities' => $entities,
        );
    }

    /**
     * Finds and displays a Locations entity.
     *
     * @Route("/{id}/show", name="Locations_show")
     * @Template()
     */
    public function showAction($id) {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('UnisoftAssetsBundle:Locations')->find($id);

        $this->checkAcl($entity, 'view');

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Locations entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity' => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to create a new Locations entity.
     *
     * @Route("/new", name="Locations_new")
     * @Template()
     */
    public function newAction() {
        $entity = new Locations();
        $form = $this->createForm(new LocationsType(), $entity);

        return array(
            'entity' => $entity,
            'form' => $form->createView(),
        );
    }

    /**
     * Creates a new Locations entity.
     *
     * @Route("/create", name="Locations_create")
     * @Method("POST")
     * @Template("UnisoftAssetsBundle:Locations:new.html.twig")
     */
    public function createAction(Request $request) {
        $entity = new Locations();
        $form = $this->createForm(new LocationsType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();
            //MASK_CREATE || MASK_EDIT || MASK_VIEW || MASK_DELETE || MASK_OWNER
            $this->createAcl($entity,MaskBuilder::MASK_CREATE);
      
        $this->get('session')->getFlashBag()->add('notice', 'Well done! location Successfuly Created');
            return $this->redirect($this->generateUrl('Locations_show', array('id' => $entity->getId())));
        }

       

        return array(
            'entity' => $entity,
            'form' => $form->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Locations entity.
     *
     * @Route("/{id}/edit", name="Locations_edit")
     * @Template()
     */
    public function editAction($id) {
        $em = $this->getDoctrine()->getManager();
      
        $entity = $em->getRepository('UnisoftAssetsBundle:Locations')->find($id);


        $this->checkAcl($entity, 'EDIT');

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Locations entity.');
        }

        $editForm = $this->createForm(new LocationsType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

//         $securityContext = $this->get('security.context');
//
//        // check for edit access
//        if (false === $securityContext->isGranted('EDIT', $entity))
//        {
//            throw new AccessDeniedException();
//        }
        
        return array(
            'entity' => $entity,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Edits an existing Locations entity.
     *
     * @Route("/{id}/update", name="Locations_update")
     * @Method("POST")
     * @Template("UnisoftAssetsBundle:Locations:edit.html.twig")
     */
    public function updateAction(Request $request, $id) {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('UnisoftAssetsBundle:Locations')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Locations entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new LocationsType(), $entity);
        $editForm->bind($request);
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
            $this->get('session')->getFlashBag()->add('notice1', 'Well done! You successfully deleted');
            return $this->redirect($this->generateUrl('Locations_edit', array('id' => $id)));
        }

        return array(
            'entity' => $entity,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Deletes a Locations entity.
     *
     * @Route("/{id}/delete", name="Locations_delete")
     * @Method("POST")
     */
    public function deleteAction(Request $request, $id) {
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('UnisoftAssetsBundle:Locations')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Locations entity.');
            }

//              $securityContext = $this->get('security.context');
//                  // check for edit access
//        if (false === $securityContext->isGranted('CREATE', $entity))
//        {
//            throw new AccessDeniedException();
//        }
            $em->remove($entity);
            $em->flush();
            $this->get('session')->getFlashBag()->add('notice1', 'Well done! You successfully deleted');
        }

        return $this->redirect($this->generateUrl('Locations'));
    }

    private function createDeleteForm($id) {
        return $this->createFormBuilder(array('id' => $id))
                        ->add('id', 'hidden')
                        ->getForm()
        ;
    }

    /**
     * Displays a form to create a new Locations entity.
     *
     * @Route("/test", name="Locations_test")
     */
    public function testAction() {
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('UnisoftAssetsBundle:Locations')->find(1);
//        $this->createAcl($entity,MaskBuilder::MASK_OPERATOR);
        $this->checkAcl($entity, 'OPERATOR');
        return new Response('hello');
    }

    /**
     * Displays a form to create a new Locations entity.
     *
     * @Route("/test2", name="Locations_test2")
     */
    public function test2Action() {
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('UnisoftAssetsBundle:Locations')->find(1);
//        $this->createAcl($entity,MaskBuilder::MASK_OPERATOR);
//        $this->checkAcl($entity, 'OPERATOR');
//
//        if (false === $this->get('security.context')->isGranted('ROLE_ADMIN')) {
//            throw new AccessDeniedException();
//        }

//        $securityContext = $this->get('security.context');
//        $user = $securityContext->getToken()->getUser();

        if (false === $this->get('security.context')->isGranted('ROLE_EDITOR')) {
            throw new AccessDeniedException();
        }
        return new Response('hello');
    }

    private function createAcl($entity = null, $mask = MaskBuilder::MASK_OWNER) {
        $aclProvider = $this->get('security.acl.provider');
        $objectIdentity = ObjectIdentity::fromDomainObject($entity);
            $acl = $aclProvider->createAcl($objectIdentity);
        // update the acl
//        $acl = $aclProvider->findAcl($objectIdentity);

        // retrieving the security identity of the currently logged-in user
        $securityContext = $this->get('security.context');
        $user = $securityContext->getToken()->getUser();
        $securityIdentity = UserSecurityIdentity::fromAccount($user);
        // grant owner access MaskBuilder::MASK_OWNER
        $acl->insertObjectAce($securityIdentity, $mask);
        $aclProvider->updateAcl($acl);
    }

    private function checkAcl($entity = null, $granted = null) {
        $securityContext = $this->get('security.context');

        // check for edit access
        if (false === $securityContext->isGranted($granted, $entity)) {
            throw new AccessDeniedException();
        }
    }

}
