<?php

namespace Unisoft\AssetsBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Unisoft\AssetsBundle\Entity\Assets;
use Unisoft\AssetsBundle\Entity\EmployeeAssets;
use Unisoft\AssetsBundle\Form\AssetsType;
use Unisoft\AssetsBundle\Form\ModiffyownerType;
use Unisoft\AssetsBundle\Form\UploadType;
use Symfony\Component\HttpFoundation\Response;
use Unisoft\AssetsBundle\Form\SearchFieldType;

/**
 * Assets controller.
 *
 * @Route("/assets")
 */
class AssetsController extends Controller {

    /**
     * Lists all Assets entities.
     *
     * @Route("/", name="assets")
     * @Template()
     */
    public function indexAction() {

        $breadcrumbs = $this->get("white_october_breadcrumbs");
        $breadcrumbs->clear();
        $breadcrumbs->addItem("Home", $this->get("router")->generate("home"), 'icon-home');
        $breadcrumbs->addItem("Assets", $this->get("router")->generate("assets"));

        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('UnisoftAssetsBundle:Assets')->findAll();

        return array(
            'entities' => $entities,
        );
    }

    /**
     * Json1.
     *
     * @Route("/{id}/json1", name="assets_json1")
     */
    public function json1($id) {
        $repository = $this->getDoctrine()->getRepository('UnisoftAssetsBundle:Categories');
        $query = $repository->createQueryBuilder('category')->where('category.parent = :parent_id')->setParameter('parent_id', $id)->getQuery();
        //            ->orderBy('p.price', 'ASC')
        $entity = $query->getArrayResult();
        return new Response(json_encode($entity), 200, array('Content-Type' => 'text/plain'));
    }

    /**
     * Finds and displays a Assets entity.
     *
     * @Route("/{id}/show", name="assets_show")
     * @Template()
     */
    public function showAction($id) {
        $em = $this->getDoctrine()->getManager();


        $entity = $em->getRepository('UnisoftAssetsBundle:Assets')->find($id);

        $em->persist($entity);
        $em->flush();

        $this->get('session')->getFlashBag()->add('notice', 'Well done! Asset Successfuly Created');
        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Assets entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity' => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Finds and displays a Assets entity.
     *
     * @Route("/{slug}/section", name="assets_section")
     * @Template()
     */
    public function sectionAction($slug = '') {

        return array(
            'entity' => $slug,
        );
    }

    /**
     * Displays a form to create a new Assets entity.
     *
     * @Route("/new", name="assets_new")
     * @Template()
     */
    public function newAction() {
        $entity = new Assets();
        $form = $this->createForm(new AssetsType(), $entity);
        $uploadForm = $this->createForm(new UploadType(), $entity);

        return array(
            'entity' => $entity,
            'form' => $form->createView(),
            'upload_form' => $uploadForm->createView(),
        );
    }

    /**
     * Creates a new Assets entity.
     *
     * @Route("/create", name="assets_create")
     * @Method("POST")
     * @Template("UnisoftAssetsBundle:Assets:new.html.twig")
     */
    public function createAction(Request $request) {
        $entity = new Assets();
        $form = $this->createForm(new AssetsType(), $entity);
        $uploadForm = $this->createForm(new UploadType(), $entity);
        $form->bind($request);
        $errorMsg = "";
        $errors = $this->container->get('validator')->validate($entity);

        if (count($errors)) {
            foreach ($errors as $error) {
                $errorMsg.=$error->getMessage() . "\r\n";
            }

            $this->get('session')->getFlashBag()->add('notice2', $errorMsg);
        }
        // exit();*/
        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
//            $entity->uploadImage();
            
            $em->persist($entity);
            $em->flush();



            return $this->redirect($this->generateUrl('assets_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form' => $form->createView(),
            'upload_form' => $uploadForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Assets entity.
     *
     * @Route("/{id}/edit", name="assets_edit")
     * @Template()
     */
    public function editAction($id) {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('UnisoftAssetsBundle:Assets')->find($id);
        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Assets entity.');
        }

        $max = $em->createQuery('SELECT MAX(e.id) FROM UnisoftAssetsBundle:EmployeeAssets e where e.asset=:asset_id')
                ->setParameter('asset_id', $entity->getId())
                ->getSingleScalarResult();

        $employee_name = "";
        $history_id = 0;
        if ($max) {
            $EmployeeAssetsEntity = $em->getRepository('UnisoftAssetsBundle:EmployeeAssets')->find($max);
            if ($EmployeeAssetsEntity->getEmployee() != NULL)
                $employee_name = $EmployeeAssetsEntity->getEmployee()->getEnName();
            $history_id = $EmployeeAssetsEntity->getId();
        }

        $editForm = $this->createForm(new AssetsType(array('employee_name' => $employee_name)), $entity);
        $deleteForm = $this->createDeleteForm($id);
        $uploadForm = $this->createForm(new UploadType(), $entity);

        return array(
            'entity' => $entity,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
            'upload_form' => $uploadForm->createView(),
            'history_id' => $history_id,
        );
    }

    /**
     * Displays a form to edit an existing Assets entity.
     *
     * @Route("/{id}/{asset_id}/modiffyowner", name="assets_modiffyowner")
     * @Template()
     */
    public function modiffyownerAction(Request $request, $id, $asset_id) {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('UnisoftAssetsBundle:EmployeeAssets')->find($id);
//        if (!$entity)
//            throw $this->createNotFoundException('Unable to find entity.');

        $max = $this->getMaxMoveId();
        $editForm = $this->createForm(new ModiffyownerType(array('entity' => $entity, 'move_id' => $max)), $entity);
        $entity_id = 0;
        if ($entity)
            $entity_id = $entity->getId();

        return array(
            'entity_id' => $entity_id,
            'asset_id' => $asset_id,
            'edit_form' => $editForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Assets entity.
     *
     * @Route("/{id}/{asset_id}/modiffyownersave", name="assets_modiffyownersave")
     * @Method("POST")
     * @Template("UnisoftAssetsBundle:Assets:modiffyowner.html.twig")
     */
    public function modiffyownersaveAction(Request $request, $id, $asset_id) {
//        if ($this->getRequest()->isXmlHttpRequest())
        $entity = new EmployeeAssets();
        $em = $this->getDoctrine()->getManager();
        if ($id != 0) {
            $old_entity = $em->getRepository('UnisoftAssetsBundle:EmployeeAssets')->find($id);
            $form = $this->createForm(new ModiffyownerType(array('entity' => $old_entity)), $entity);
            $form->bind($request);

            $old_id = $old_entity->getEmployee()->getId();
            $new_id = $entity->getEmployee()->getId();
            if ($new_id == $old_id) {
                $return = json_encode(array("error" => 1, "modiffyed" => 0, "msg" => 'you set the asset to the same owner')); //jscon encode the array
                return new Response($return, 200, array('Content-Type' => 'application/json'));
            }
        } else {
            $form = $this->createForm(new ModiffyownerType(), $entity);
            $form->bind($request);
        }
        
        $errors = $this->container->get('validator')->validate($entity);
            $errorMsg = "error: ";
            if (count($errors)) {
                foreach ($errors as $error) {
                    $errorMsg.=$error->getMessage() . "\r\n";
                }
                
                $return = json_encode(array("error" => 1, "modiffyed" => 0, "msg" => $errorMsg));
            return new Response($return, 200, array('Content-Type' => 'application/json'));
            }


        $new_name = $entity->getEmployee()->getName();
        $asset_entity = $em->getRepository('UnisoftAssetsBundle:Assets')->find($asset_id);
        $entity->setAsset($asset_entity);
            $em->persist($entity);
            $em->flush();
            $return = json_encode(array("error" => 0, "modiffyed" => 1, 'value' => $new_name, 'new_id' => $entity->getId(), "msg" => 'successfully Owner changed')); //jscon encode the array
            return new Response($return, 200, array('Content-Type' => 'application/json'));

        return array(
            'entity_id' => $id,
            'asset_id' => $asset_id,
            'edit_form' => $form->createView(),
        );
    }

    /**
     * Edits an existing Assets entity.
     *
     * @Route("/{id}/update", name="assets_update")
     * @Method("POST")
     * @Template("UnisoftAssetsBundle:Assets:edit.html.twig")
     */
    public function updateAction(Request $request, $id) {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('UnisoftAssetsBundle:Assets')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Assets entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new AssetsType(), $entity);
        $uploadForm = $this->createForm(new UploadType(), $entity);
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
            $guardianship_id = $entity->getGuardianship()->getId();
            $asset_id = $entity->getId();
            $max = $em->createQuery('SELECT MAX(e.id) FROM UnisoftAssetsBundle:EmployeeAssets e where e.asset=:asset_id')
                    ->setParameter('asset_id', $asset_id)
                    ->getSingleScalarResult();

            $EmployeeAssetsEntity = $em->getRepository('UnisoftAssetsBundle:EmployeeAssets')->find($max);
            $employee_id = $EmployeeAssetsEntity->getEmployee()->getId();
            $employee_name = $EmployeeAssetsEntity->getEmployee()->getName();
//            if($guardianship_id !=$employee_id){
//                $EmployeeAssets=new EmployeeAssets();
//                $EmployeeAssets->setAsset($entity);
//                $EmployeeAssets->setEmployee($entity->getGuardianship());
//                $em->persist($EmployeeAssets);
//                $em->flush();
//            }

            $em->persist($entity);
            $em->flush();
            $this->get('session')->getFlashBag()->add('notice1', 'Well done! You successfully Update');
            //  return $this->redirect($this->generateUrl('assets_edit', array('id' => $id)));
        }

        return array(
            'entity' => $entity,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
            'upload_form' => $uploadForm->createView(),
        );
    }

    /**
     * Edits an existing Assets entity.
     *
     * @Route("/upload", name="assets_upload")
     * @Method("POST")
     */
    public function uploadAction(Request $request) {

        $entity = new Assets();
        $form = $this->createForm(new UploadType(), $entity);
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

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity->uploadImage();
            $return = array("error" => 0, "imageName" => $entity->getImage());
            $return = json_encode($return); //jscon encode the array
            return new Response($return, 200, array('Content-Type' => 'application/json'));
        }
    }

    /**
     * Deletes a Assets entity.
     *
     * @Route("/{id}/delete", name="assets_delete")
     * @Method("POST")
     */
    public function deleteAction(Request $request, $id) {

        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('UnisoftAssetsBundle:Assets')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Assets entity.');
            }

            $em->remove($entity);
            $em->flush();
            $this->get('session')->getFlashBag()->add('notice1', 'Well done! You successfully deleted');
        }

        return $this->redirect($this->generateUrl('assets'));
    }

    private function createDeleteForm($id) {
        return $this->createFormBuilder(array('id' => $id))
                        ->add('id', 'hidden')
                        ->getForm()
        ;
    }

    /**
     * @Route("/{keyword}/{filed}/search", name="assets_search")
     * @Template("UnisoftAssetsBundle:Assets:search.html.twig")
     */
    public function searchAction($keyword = "", $filed = "") {
        $entities = NULL;

        $form = $this->get('form.factory')->create(new SearchFieldType());
        $request = $this->get('request');
        if ($request->getMethod() == 'POST') {
            $form->bindRequest($request);
            $data = $form->getData();
            $keyword = $data['keyword'];
        }

        $em = $this->getDoctrine()->getManager();
        $result = $em->getRepository('UnisoftAssetsBundle:Assets')
                ->findByField('Assets', $filed, $keyword);

        return array('keyword' => $keyword,
            'entities' => $result,
            'filed' => $filed,
            'form' => $form->createView()
        );
    }

    private function getMaxMoveId() {
        $em = $this->getDoctrine()->getManager();
        $max = $em->createQuery('SELECT MAX(e.moveId) FROM UnisoftAssetsBundle:EmployeeAssets e')
                ->getSingleScalarResult();
        $max++;
        return $max;
    }

}
