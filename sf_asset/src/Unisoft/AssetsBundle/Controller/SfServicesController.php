<?php

namespace Unisoft\AssetsBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Unisoft\AssetsBundle\Entity\Administrations;
use Unisoft\AssetsBundle\Form\AdministrationsType;
use Unisoft\AssetsBundle\Form\SearchFieldType;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

/**
 * SfServices controller.
 *
 * @Route("/SfServices")
 */
class SfServicesController extends Controller {

    /**
     * Lists all Administrations entities.
     *
     * @Route("/", name="SfServices")
     * @Template()
     */
    public function indexAction() {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('UnisoftAssetsBundle:Administrations')->findAll();

        return array(
            'entities' => $entities,
        );
    }

    /**
     * @Route("/{entity}/{keyword}/{filed}/search", name="SfServices_search")
     * @Template()
     */
    public function searchAction($entity = "", $keyword = "", $filed = "") {

        $entity_fields = $this->getSearchFields($entity, $filed);
        $form = $this->get('form.factory')->create(new SearchFieldType());
        $request = $this->get('request');
        if ($request->getMethod() == 'POST') {
            $form->bindRequest($request);
            $data = $form->getData();
            $keyword = $data['keyword'];
        }

        $em = $this->getDoctrine()->getManager();
        $result = $em->getRepository('UnisoftAssetsBundle:'.$entity)
                ->findByField($entity, $filed, $keyword);

        return array('keyword' => $keyword,
            'entities' => $result,
            'filed' => $filed,
            'entity' => $entity,
            'entity_fields' => $entity_fields,
            'redirect_url' => $this->getSearchRedirct($entity),
            'form' => $form->createView()
        );
    }

    /**
     * @Route("/{entity_name}/{id}/print", name="SfServices_print")
     * @Template()
     */
    public function printAction($entity_name, $id) {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('UnisoftAssetsBundle:'.$entity_name)->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find '.$entity_name.' entity.');
        }
$entityNameSpace='Unisoft\AssetsBundle\Entity\\';
$entityNameSpace.=$entity_name;
        $MetaData = $em->getClassMetadata($entityNameSpace);
        $fields = array();
        foreach ($MetaData->fieldNames as $value) {
            if ($value != 'id' && $value != 'created' && $value != 'modified')
                $fields[$value] = $entity->{'get' . ucfirst($value)}();
//            $fields[$value] ="";
        }
        print_r($fields);
        $formType = $this->getFormType($entity_name);
        $editForm = $this->createForm(new $formType, $entity);
        return array(
            'entity' => $entity,
            'edit_form' => $editForm->createView(),
            'properties' => $fields,
            'print_title' => $this->get('translator')->trans($entity_name . ' list', array(), 'messages'),
        );
    }

    private function getSearchFields($entity = "", $filed = "") {
        $entity_allows = array(
            'Administrations' => array(
                'administrationNo' => $this->get('translator')->trans('Administration Number', array(), 'messages'),
                'enName' => $this->get('translator')->trans('English Name', array(), 'messages'),
            ),
            'Vendors' => array(
                'vendorNo' => $this->get('translator')->trans('Vendor Number', array(), 'messages'),
                'accountNo' => $this->get('translator')->trans('Account Number', array(), 'messages'),
                'enName' => $this->get('translator')->trans('English Name', array(), 'messages'),
            ),
            'Manufacturers' => array(
                'manufacturerNo' => $this->get('translator')->trans('Manufacturer Number', array(), 'messages'),
                'enName' => $this->get('translator')->trans('English Name', array(), 'messages'),
            ),
            'Departments' => array(
                'departmentNo' => $this->get('translator')->trans('Departments Number', array(), 'messages'),
                'enName' => $this->get('translator')->trans('English Name', array(), 'messages'),
            ),
            'Position' => array(
                'positionNo' => $this->get('translator')->trans('Position Number', array(), 'messages'),
                'enName' => $this->get('translator')->trans('English Name', array(), 'messages'),
            ),
            'Employees' => array(
                'employeeNo' => $this->get('translator')->trans('Position Number', array(), 'messages'),
                'enName' => $this->get('translator')->trans('English Name', array(), 'messages'),
            ),
        );

        if (isset($entity_allows[$entity]) && isset($entity_allows[$entity][$filed])) {
            return $entity_allows[$entity];
        } else {
            throw new AccessDeniedException('invalid entity or field name');
        }
    }

    private function getSearchRedirct($entity = "") {
        $entity_redirct = array(
            'Administrations' => 'administrations_edit',
            'Vendors' => 'Vendors_edit',
            'Manufacturers' => 'Manufacturers_edit',
            'Departments' => 'departments_edit',
            'Position' => 'position_edit',
            'Employees' => 'Employees_edit',
        );

        if (isset($entity_redirct[$entity])) {
            return $entity_redirct[$entity];
        } else {
            throw new AccessDeniedException('invalid entity Redirect');
        }
    }

    // add form type path for print 
    private function getFormType($entity = "") {
        $entity_redirct = array(
            'Administrations' => 'Unisoft\AssetsBundle\Form\AdministrationsType',
            'Vendors' => 'Unisoft\AssetsBundle\Form\VendorsType',
            'Manufacturers' => 'Unisoft\AssetsBundle\Form\ManufacturersType',
            'Cost' => 'Unisoft\AssetsBundle\Form\CostType',
            'Departments' => 'Unisoft\AssetsBundle\Form\DepartmentsType',
            'Position' => 'Unisoft\AssetsBundle\Form\PositionType',
            'Employees' => 'Unisoft\AssetsBundle\Form\EmployeesType',
        );

        if (isset($entity_redirct[$entity])) {
            return $entity_redirct[$entity];
        } else {
            throw new AccessDeniedException('invalid FormType');
        }
    }

}
