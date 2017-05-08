<?php

namespace Acme\DemoBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Acme\DemoBundle\Entity\User;
use Acme\DemoBundle\Form\UserType;
use JMS\SecurityExtraBundle\Annotation\Secure;
use Symfony\Component\Security\Core\SecurityContext;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

/**
 * User controller.
 *
 * @Route("/User")
 */
class UserController extends Controller
{
    /**
     * @Route("/login", name="_user_login")
     * @Template()
     */
    public function loginAction()
    {
        if ($this->get('request')->attributes->has(SecurityContext::AUTHENTICATION_ERROR)) {
            $error = $this->get('request')->attributes->get(SecurityContext::AUTHENTICATION_ERROR);
        } else {
            $error = $this->get('request')->getSession()->get(SecurityContext::AUTHENTICATION_ERROR);
        }
       
        return array(
            'last_username' => $this->get('request')->getSession()->get(SecurityContext::LAST_USERNAME),
            'error'         => $error,
        );
    }

    /**
     * @Route("/login_check", name="_security_check")
     */
    public function securityCheckAction()
    {
        
        // The security layer will intercept this request
    }

    /**
     * @Route("/logout", name="_user_logout")
     */
    public function logoutAction()
    {
        // The security layer will intercept this request
    }
    
    /**
     * Lists all User entities.
     *
     * @Route("/list", name="User_list")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        
        $entities = $em->getRepository('AcmeDemoBundle:User')->findAll();
     

        return array(
            'entities' => $entities,
           
        );
    }

    /**
     * Finds and displays a User entity.
     *
     * @Route("/{id}/show", name="User_show")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AcmeDemoBundle:User')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find User entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to create a new User entity.
     *
     * @Route("/", name="User")
     * @Template()
     */
    public function newAction()
    {
        $entity = new User();
        $form   = $this->createForm(new UserType(), $entity);
        
        $em = $this->getDoctrine()->getManager();
        $entities = $em->getRepository('AcmeDemoBundle:User')->findAll();
        
        $deleteForm = $this->createDeleteForm(0);

        return array(
            'entity' => $entity,
            'entities'=>$entities,
            'form'   => $form->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Creates a new User entity.
     *
     * @Route("/create", name="User_create")
     * @Method("POST")
     * @Template("AcmeDemoBundle:User:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity  = new User();
        $form = $this->createForm(new UserType(), $entity);
        $form->bind($request);
        
        $em = $this->getDoctrine()->getManager();
        $entities = $em->getRepository('AcmeDemoBundle:User')->findAll();
        
        $deleteForm = $this->createDeleteForm(0);
        
        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();
            
            $this->get('session')->getFlashBag()->add('notice', 'تم اضافة المستخدم');
           
            return $this->redirect($this->generateUrl('User'));
        }

        return array(
            'entity' => $entity,
            'entities'=>$entities,
            'form'   => $form->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing User entity.
     *
     * @Route("/{id}/edit", name="User_edit")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AcmeDemoBundle:User')->find($id);
        $entities = $em->getRepository('AcmeDemoBundle:User')->findAll();
        if (!$entity) {
            throw $this->createNotFoundException('Unable to find User entity.');
        }
        $editForm = $this->createForm(new \Acme\DemoBundle\Form\ProfileType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'entities'=>$entities,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
 
    /**
     * Edits an existing User entity.
     *
     * @Route("/{id}/update", name="User_update")
     * @Method("POST")
     * @Template("AcmeDemoBundle:User:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em=$this->getDoctrine()->getManager();

        $entity = $em->getRepository('AcmeDemoBundle:User')->find($id);
        $entities = $em->getRepository('AcmeDemoBundle:User')->findAll();

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find User entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new \Acme\DemoBundle\Form\ProfileType(), $entity);
        $editForm->bind($request);
        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();
            $this->get('session')->getFlashBag()->add('notice', 'تم عديل بيانات المستخدم');
            return $this->redirect($this->generateUrl('User_edit',array('id'=>$id)));
        }

        return array(
            'entity'      => $entity,
            'entities'=>$entities,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    
    /**
     * Displays a form to edit an existing User entity.
     *
     * @Route("/{id}/change_pssword", name="User_change_pass")
     * @Template()
     */
    public function change_psswordAction(Request $request,$id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AcmeDemoBundle:User')->find($id);
        $entities = $em->getRepository('AcmeDemoBundle:User')->findAll();
        if (!$entity) {
            throw $this->createNotFoundException('Unable to find User entity.');
        }
        $editForm = $this->createForm(new \Acme\DemoBundle\Form\ChangePasswordType(), $entity);

        // Update entity
        if ($request->getMethod() == 'POST') {
            $editForm->bind($request);
            if ($editForm->isValid()) {
                $em->persist($entity);
                $em->flush();
                $this->get('session')->getFlashBag()->add('notice', 'تم تعديل بيانات المستخدم');
                return $this->redirect($this->generateUrl('User'));
            }
        }
        
        return array(
            'entity'      => $entity,
            'entities'=>$entities,
            'edit_form'   => $editForm->createView(),
        );
    }

    /**
     * Deletes a User entity.
     *
     * @Route("/{id}/delete", name="User_delete")
     */
    public function deleteAction(Request $request, $id)
    {
        
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('AcmeDemoBundle:User')->find($id);
            if (!$entity) {
                throw $this->createNotFoundException('Unable to find User entity.');
            }
            $em->remove($entity);
            $em->flush();
         $this->get('session')->getFlashBag()->add('notice', 'تم حذف المستخدم');
        return $this->redirect($this->generateUrl('User'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }

}
