<?php

namespace Acme\DemoBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Acme\DemoBundle\Entity\Agreements;
use Acme\DemoBundle\Entity\Stores;
use Acme\DemoBundle\Entity\Services;
use Acme\DemoBundle\Entity\Customers;
use Acme\DemoBundle\Form\AgreementsType;
use Acme\DemoBundle\Form\AgreementsSearchType;
use Symfony\Component\HttpFoundation\Response;
use Acme\DemoBundle\Entity\ItemsDescription;
use Acme\DemoBundle\Form\ItemsDescriptionType;

/**
 * Agreements controller.
 *
 * @Route("/agreements")
 */
class AgreementsController extends Controller {

    /**
     * Lists all Agreements entities.
     *
     * @Route("/", name="agreements")
     * @Template()
     */
    public function indexAction() {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('AcmeDemoBundle:Agreements')->findAll();

        return array(
            'entities' => $entities,
        );
    }

    /**
     * Finds and displays a Agreements entity.
     *
     * @Route("/{id}/show", name="agreements_show")
     * @Template()
     */
    public function showAction($id) {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AcmeDemoBundle:Agreements')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Agreements entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity' => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to create a new Agreements entity.
     *
     * @Route("/{customer_id}/new", name="agreements_new")
     * @Template()
     */
    public function newAction($customer_id = 0) {
        $em = $this->getDoctrine()->getManager();
        $entity = new Agreements();
        $entity->setAgreementNo($this->getNewSerial(1));
        $entities = array();

        $Customers = new Customers();
        //if get customer id fill the customer form with customer info
        if ($customer_id > 0) {
            $Customers = $em->getRepository('AcmeDemoBundle:Customers')->find($customer_id);
        }
        $entity->setCustomer($Customers);

        $pagingWidget = $em->getRepository('AcmeDemoBundle:Agreements')
                ->getPagingWidget('Agreements', 0, 1);

        // set the avalabale stores
        $this->setAgreementStores($entity);

        $form = $this->createForm(new AgreementsType(), $entity);

        return array(
            'entity' => $entity,
            'form' => $form->createView(),
            'customer_id' => $customer_id,
            'pagingWidget' => $pagingWidget,
            'entities' => $entities,
        );
    }

    /**
     * Creates a new Agreements entity.
     *
     * @Route("/{customer_id}/create", name="agreements_create")
     * @Method("POST")
     * @Template("AcmeDemoBundle:Agreements:new.html.twig")
     */
    public function createAction(Request $request, $customer_id) {
        $em = $this->getDoctrine()->getManager();
        $entity = new Agreements();
        $entities = array();
        $this->setAgreementStores($entity);


        $Customers = new Customers();
        //if get customer id fill the customer form with customer info
        if ($customer_id > 0) {
            $Customers = $em->getRepository('AcmeDemoBundle:Customers')->find($customer_id);
        }
        $entity->setCustomer($Customers);

        $form = $this->createForm(new AgreementsType(), $entity);
        $pagingWidget = $em->getRepository('AcmeDemoBundle:Agreements')
                ->getPagingWidget('Agreements', 0, $entity->getAgreementType());
        $form->bind($request);


        // check if Quotation No is uniqe
        $this->checkIsUniqeEntityCreate($entity);

        // validate the entity and return error Msg
        $errorMsg = $this->getValidatorError($entity);

        foreach ($entity->getItemsDescription() as $key => $item) {
            $item->setAgreement($entity);
        }

        if ($form->isValid() && empty($errorMsg)) {
            // calc the quotation value and discount
            $agreementValue = $this->setAgreementValue($entity);

            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();
            $this->get('session')->getFlashBag()->add('notice', 'Well done! Agreement Successfuly Saved');
            return $this->redirect($this->generateUrl('agreements_edit', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form' => $form->createView(),
            'customer_id' => $customer_id,
            'pagingWidget' => $pagingWidget,
            'entities' => $entities,
        );
    }

    /**
     * Displays a form to edit an existing Agreements entity.
     *
     * @Route("/{id}/edit", name="agreements_edit")
     * @Template()
     */
    public function editAction($id) {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AcmeDemoBundle:Agreements')->find($id);
        $oldentity = clone $entity;

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Agreements entity.');
        }
        $entities = $em->getRepository('AcmeDemoBundle:ItemsDescription')->findByagreement($id);
        $Authorized = $em->getRepository('AcmeDemoBundle:AuthorizedPersons')->findByagreement($id);

        $oldAgreementType = $entity->getAgreementType();

        $pagingWidget = $em->getRepository('AcmeDemoBundle:Agreements')
                ->getPagingWidget('Agreements', $entity->getId(), 1);

        // set the avalabale stores
        $this->setAgreementStores($entity);

        if ($entity->getAgreementType() == 0 && $entity->getAgreementId() != NULL) {
            throw $this->createNotFoundException('This Quotations already has Agreement # ' . $entity->getAgreementId());
        }

        $editForm = $this->createForm(new AgreementsType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        $request = $this->get('request');
        if ($request->getMethod() == 'POST') {
            // check if Quotation has agreement
//            if ($this->checkIfHasAgreement($entity))
//                return $this->redirect($this->generateUrl('quotations_edit', array('id' => $entity->getId())));

            $editForm->bind($request);
            // check if Quotation No is uniqe
            $this->checkIsUniqeEntity($entity);

            // validate the entity and return error Msg
            $errorMsg = $this->getValidatorError($entity);

            foreach ($entity->getItemsDescription() as $key => $item) {
                $item->setAgreement($entity);
            }
            if ($editForm->isValid() && empty($errorMsg)) {
                if (isset($_POST['Save'])) {
                    $agreementType = $entity->getAgreementType();

                    // check if the entity was agreement and try to save as Quotation
                    if ($this->checkIsAccessible($entity))
                        return $this->redirect($this->generateUrl('agreements_edit', array('id' => $entity->getId())));
                    // calc the quotation value and discount
                    $agreementValue = $this->setAgreementValue($entity);


                    // check if the Quotation changed to agreement then clone the object
                    // and save it as agreement object
                    if ($agreementType == 1 && $oldAgreementType == 0) {
                        $agreementId = $this->convartQuotationToAgreement($entity, $entities);
                        $entity->setAgreementId($agreementId);
                        $entity->setAgreementType(0);
                        $entity->setTransactionType('');

//                        $oldentity->setAgreementId($agreementId);
//                        $this->get('session')->getFlashBag()->add('notice', 'Well done! agreements Successfuly Saved');
//                        $em->persist($entity);
//                        $em->flush();
                        $id = $agreementId;
                    }

                    $this->get('session')->getFlashBag()->add('notice', 'Well done! agreements Successfuly Saved');
                    $em->persist($entity);
                    $em->flush();
                }
                return $this->redirect($this->generateUrl('agreements_edit', array('id' => $id)));
            }
        }

        return array(
            'entity' => $entity,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
            'pagingWidget' => $pagingWidget,
            'entities' => $entities,
            'Authorized' => $Authorized,
        );
    }

    public function convartQuotationToAgreement($entity, $entities) {
        $em = $this->getDoctrine()->getManager();
        // close agrement object and set agreement no
        $newentity = clone $entity;
//         print_r(sizeof($newentity->getStore()));
        $newentity->cloneStores($entities);

        // set the agreement number serial
        $newentity->setAgreementNo($this->getNewSerial(1));
        $agreementType2 = $newentity->getAgreementType();
        $em->persist($newentity);
        $em->flush();
        $agreementId = $newentity->getId();
        return $agreementId;
    }

    public function saveEntity($entity, $oldAgreementType) {
        $em = $this->getDoctrine()->getManager();
        $agreementType = $entity->getAgreementType();
        if ($agreementType == 0 && $oldAgreementType == 1) {
            $this->get('session')->getFlashBag()->add('notice1', 'cant change agreement to Quotation');
            $this->redirect($this->generateUrl('agreements_edit', array('id' => $entity->getId())));
        }
        // check if the Quotation changed to agreement then clone the object
        // and save it as agreement object
        if ($agreementType == 1 && $oldAgreementType == 0) {
            // close agrement object and set agreement no
            $newentity = clone $entity;
            // set the agreement number serial
            $newentity->setAgreementNo($this->getNewSerial(1));
            $agreementType2 = $newentity->getAgreementType();

            $em->persist($newentity);
            $em->flush();
            $agreementId = $newentity->getId();
            // set the old entity agreement type to 0 
            // and fill agreement id by the newer agreement id
            $entity->setAgreementType(0);
            $entity->setAgreementId($agreementId);
        }
        return $entity;
    }

    /**
     * Deletes a Agreements entity.
     *
     * @Route("/{id}/delete", name="agreements_delete")
     * @Method("POST")
     */
    public function deleteAction(Request $request, $id) {
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('AcmeDemoBundle:Agreements')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Agreements entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('agreements'));
    }

    private function createDeleteForm($id) {
        return $this->createFormBuilder(array('id' => $id))
                        ->add('id', 'hidden')
                        ->getForm()
        ;
    }

    private function getValidatorError($entity) {
        // validate the entity and return the validation errors in notice
        $errorMsg = "";
        $errors = $this->container->get('validator')->validate($entity, array('agreement'));
        if (count($errors)) {
            foreach ($errors as $error) {
                $errorMsg.=$error->getMessage() . "\r\n";
            }
            $this->get('session')->getFlashBag()->add('notice2', $errorMsg);
        }
        return $errorMsg;
    }

    /*
     * set the available stores to the entity
     * return entity
     */

    private function setAgreementStores($entity) {
        $repository = $this->getDoctrine()
                ->getRepository('AcmeDemoBundle:Stores');

        $query = $repository->createQueryBuilder('s')
                ->where('s.status = :status')
                ->setParameter('status', '1')
                ->getQuery();
        $stores = $query->getResult();
        $entity->setStores($stores);
        return $entity;
    }

    /*
     * check if the entity has agreement id before update
     * the entity
     * return True | False
     */

    private function checkIsAccessible($entity) {
       
        $evacuationDate = $entity->getEvacuationDate();
        if (!is_null($evacuationDate) && !empty($evacuationDate)) {
            $this->get('session')->getFlashBag()->add('notice2', 'Not accessible to save Agreement');
            return true;
        }
        return false;
    }

    /*
     * check if try to save agreement as Quotaion
     * return True | False
     */

    private function checkIsAgremment($agreementType, $oldAgreementType) {
        if ($agreementType == 0 && $oldAgreementType == 1) {
            $this->get('session')->getFlashBag()->add('notice2', 'Cant change Agreement to Quotation');
            return true;
        }
        return false;
    }

    /*
     * check if quotation number is uniqe
     * return entity
     */

    private function checkIsUniqeEntityCreate($entity) {
        $repository = $this->getDoctrine()
                ->getRepository('AcmeDemoBundle:Agreements');
        $query = $repository->createQueryBuilder('a')
                ->where('a.agreementNo = :agreementNo and a.agreementType = :agreementType')
                ->setParameter('agreementNo', $entity->getAgreementNo())
                ->setParameter('agreementType', $entity->getAgreementType())
                ->getQuery();
        $uniqeAgreement = $query->getResult();
        $entity->setUniqeAgreement(True);
        if (sizeof($uniqeAgreement) > 0) {
            $entity->setUniqeAgreement(False);
        }
        return $entity;
    }

    /*
     * check if quotation number is uniqe
     * return entity
     */

    private function checkIsUniqeEntity($entity) {
        $repository = $this->getDoctrine()
                ->getRepository('AcmeDemoBundle:Agreements');
        $query = $repository->createQueryBuilder('a')
                ->where('a.agreementNo = :agreementNo and a.agreementType = :agreementType and a.id != :id')
                ->setParameter('agreementNo', $entity->getAgreementNo())
                ->setParameter('agreementType', $entity->getAgreementType())
                ->setParameter('id', $entity->getId())
                ->getQuery();
        $uniqeAgreement = $query->getResult();
        $entity->setUniqeAgreement(True);
        if (sizeof($uniqeAgreement) > 0) {
            $entity->setUniqeAgreement(False);
        }
        return $entity;
    }

    /*
     * calc the qoutation total value and discound
     * return entity
     */

    public function setAgreementValue($entity, $roomSize = Null) {
        $em = $this->getDoctrine()->getManager();
        $totalSize = 0;
        $rentalValue = 0.00;
        if (!is_null($roomSize)) {
            $totalSize = $roomSize;
        } else {
            foreach ($entity->getStore() as $key => $store) {
                $totalSize+=$store->getSize();
            }
        }
//        $store= $em->getRepository('AcmeDemoBundle:Stores')->findBySize($totalSize);
        if ($totalSize == 0)
            throw $this->createNotFoundException('Unable to fetch store with total size: ' . $totalSize);

        $repository = $this->getDoctrine()
                ->getRepository('AcmeDemoBundle:Stores');

        $query = $repository->createQueryBuilder('s')
                ->where('s.size = :size')
                ->setParameter('size', $totalSize)
                ->setMaxResults(1)
                ->getQuery();
        $stores = $query->getResult();

        if (sizeof($stores) == 0)
            throw $this->createNotFoundException('Unable to fetch store with total size: ' . $totalSize);

        $repository = $this->getDoctrine()
                ->getRepository('AcmeDemoBundle:StoresRentalperiods');

        $query = $repository->createQueryBuilder('s')
                ->where('s.store = :store and s.period = :period')
                ->setParameter('store', $stores[0]->getId())
                ->setParameter('period', $entity->getRentalPeriod()->getId())
                ->setMaxResults(1)
                ->getQuery();
        $StoresRentalperiods = $query->getResult();

        $rentalValue = $StoresRentalperiods[0]->getPrice();
        $entity->setTotalArea($totalSize);
        $entity->setRentalValue((double) $rentalValue);

        $totalValue = ((double) $rentalValue +
                (double) $entity->getInsuranceValue() +
                (double) $entity->getOtherFees() +
                (double) $entity->getDepositValue());
        $entity->setTotalValue((double) $totalValue);

        $offerDiscound = (double) (($rentalValue * $entity->getDiscountPolicies()) / 100);
        $entity->setOfferDiscount($offerDiscound);
        $entity->setNetValue((double) ($entity->getTotalValue() - $offerDiscound - $entity->getOtherDiscount()));

        return $entity;
    }

    /*
     * generate the next Quotation Number or Agreement Number
     * return int
     */

    public function getNewSerial($AgreementType) {
        // get the max agreement number
        $em = $this->getDoctrine()->getManager();
        $max = $em->getRepository('AcmeDemoBundle:Agreements')
                ->getAgreementNo('Agreements', 'agreementNo', $AgreementType);
        return $max;
    }

    /**
     *
     * @Route("/searchByQuotation", name="agreements_searchByQuotationNo")
     * @Template()
     */
    public function searchByQuotationNoAction(Request $request) {
//        $query=$em->getRepository('AcmeDemoBundle:Agreements')
//    ->createQueryBuilder('a')
//    ->leftJoin('a.customer', 'c')
//    ->where(join($where_arry))
////    ->setParameter('agreement_id', 101)
//    ->getQuery()
        $em = $this->getDoctrine()->getManager();
        $entities = array();
        $form = $this->get('form.factory')->create(new AgreementsSearchType());

        if ($request->getMethod() == 'POST') {
            $form->bindRequest($request);
            $where_arry = $this->bulidSerchFields($form, 'where');
            $params_arry = $this->bulidSerchFields($form, 'params');

            $where_arry = join(' and ', $where_arry);

            $repository = $em->getRepository('AcmeDemoBundle:Agreements');
            $qb = $repository->createQueryBuilder('a');
            $joins = $qb->leftJoin('a.customer', 'c');
            $joins = $qb->leftJoin('a.store', 's');
            $whereVar = $joins->where($where_arry);
            foreach ($params_arry as $key => $value) {
                $parameter = $whereVar->setParameter($key, $value);
            }

            $query = $parameter->getQuery();
            $entities = $query->getResult();
            $agreementStatus = $form['agreementStatus']->getData();
            if (!is_null($agreementStatus)) {
                foreach ($entities as $key => $quotation) {
                    if ($quotation->getAgreementStatus() != $agreementStatus) {
                        unset($entities[$key]);
                    }
                }
            }
        }
//
        return array(
            'entities' => $entities,
            'form' => $form->createView(),
        );
    }

    /**
     *
     * @Route("/searchByCustomer", name="agreements_searchByCustomer")
     * @Template()
     */
    public function searchByCustomerAction(Request $request) {
        $em = $this->getDoctrine()->getManager();
        $entities = array();
        $form = $this->get('form.factory')->create(new \Acme\DemoBundle\Form\CustomersSearchType());

        if ($request->getMethod() == 'POST') {
            $form->bindRequest($request);
            $where_arry = $this->bulidSerchCustomerFields($form, 'where');
            $params_arry = $this->bulidSerchCustomerFields($form, 'params');

            $where_arry = join(' and ', $where_arry);

            $repository = $em->getRepository('AcmeDemoBundle:Customers');
            $qb = $repository->createQueryBuilder('c');
//            $joins = $qb->leftJoin('a.customer', 'c');
//            $joins = $qb->leftJoin('a.store', 's');
            $whereVar = $qb->where($where_arry);
            foreach ($params_arry as $key => $value) {
                $parameter = $whereVar->setParameter($key, $value);
            }

            $query = $parameter->getQuery();
            $entities = $query->getResult();
        }
//
        return array(
            'entities' => $entities,
            'form' => $form->createView(),
        );
    }

    public function bulidSerchFields($form, $arr) {
        $where_arry = array('a.agreementType=:agreementType');
        $params_arry = array();
        $params_arry['agreementType'] = '1';

        $agreementNo = $form['agreementNo']->getData();
        $agreementDate = $form['agreementDate']->getData();

        $agreementStatus = $form['agreementStatus']->getData();
        $startDate = $form['startDate']->getData();
        $endDate = $form['endDate']->getData();

        $rentalPeriod = $form['rentalPeriod']->getData();
        if (!is_null($rentalPeriod))
            $rentalPeriod_id = $rentalPeriod->getId();

        $store = $form['store']->getData();
        if (!is_null($store))
            $store_id = $store->getId();

        $customer = $form['customer']->getData();
        $enName = $customer->getEnName();
        $arName = $customer->getArName();


        if (!empty($agreementNo)) {
            array_push($where_arry, 'a.agreementNo = :agreementNo');
            $params_arry['agreementNo'] = $agreementNo;
        }
        if (!empty($agreementDate)) {
            array_push($where_arry, 'a.agreementDate = :agreementDate');
            $params_arry['agreementDate'] = $agreementDate->format('Y-m-d');
        }

        if (!empty($startDate)) {
            array_push($where_arry, 'a.startDate >= :startDate');
            $params_arry['startDate'] = $startDate->format('Y-m-d');
        }

        if (!empty($endDate)) {
            array_push($where_arry, 'a.endDate <= :endDate');
            $params_arry['endDate'] = $endDate->format('Y-m-d');
        }
        if (!empty($rentalPeriod_id)) {
            array_push($where_arry, 'a.rentalPeriod = :rentalPeriod');
            $params_arry['rentalPeriod'] = $rentalPeriod_id;
        }

        if (!empty($enName)) {
            array_push($where_arry, 'c.enName like :enName');
            $params_arry['enName'] = '%' . $enName . '%';
        }
        if (!empty($arName)) {
            array_push($where_arry, 'c.arName like :arName');
            $params_arry['arName'] = '%' . $arName . '%';
        }
        if (!empty($store_id)) {
            array_push($where_arry, 's.id = :store');
            $params_arry['store'] = $store_id;
        }

        if (!empty($agreementNo2)) {
            array_push($where_arry, 'c.customerNo = :customerNo');
            $params_arry['customerNo'] = $agreementNo;
        }

        if ($arr == 'where')
            return $where_arry;
        else
            return $params_arry;
    }

    public function bulidSerchCustomerFields($form, $arr) {
        $where_arry = array('1= :one');
        $params_arry = array();
        $params_arry['one'] = '1';

        $enName = $form['enName']->getData();
        $arName = $form['arName']->getData();

        $civilId = $form['civilId']->getData();
        $mobile = $form['mobile']->getData();
        $phone = $form['phone']->getData();

        $contactPerson = $form['contactPerson']->getData();


        if (!empty($civilId)) {
            array_push($where_arry, 'c.civilId = :civilId');
            $params_arry['civilId'] = $civilId;
        }
        if (!empty($mobile)) {
            array_push($where_arry, 'c.mobile = :mobile');
            $params_arry['mobile'] = $mobile;
        }

        if (!empty($phone)) {
            array_push($where_arry, 'c.phone = :phone');
            $params_arry['phone'] = $phone;
        }

        if (!empty($enName)) {
            array_push($where_arry, 'c.enName like :enName');
            $params_arry['enName'] = '%' . $enName . '%';
        }
        if (!empty($arName)) {
            array_push($where_arry, 'c.arName like :arName');
            $params_arry['arName'] = '%' . $arName . '%';
        }


        if ($arr == 'where')
            return $where_arry;
        else
            return $params_arry;
    }

    /**
     * Displays a form to edit an existing Agreements entity.
     *
     * @Route("/checkQuotationNo", name="agreements_checkQuotationNo")
     * @Template()
     */
    public function checkQuotationNoAction() {
        $quotationNo = $this->get('request')->request->get('quotationNo');
        //return new Response(json_encode(array("exist" => $quotationNo)));
        if (!empty($quotationNo)) {
            $repository = $this->getDoctrine()
                    ->getRepository('AcmeDemoBundle:Agreements');

            $query = $repository->createQueryBuilder('a')
                    ->where('a.agreementNo = :agreementNo and a.agreementType = :agreementType')
                    ->setParameter('agreementNo', $quotationNo)
                    ->setParameter('agreementType', 1)
                    ->setMaxResults(1)
                    ->getQuery();

            $agreement = $query->getResult();
            $request = $this->get('request');
//            if ($request->isXmlHttpRequest()) {
            if (sizeof($agreement) > 0) {
                $entity = $agreement[0];
                return new Response(json_encode(array("exist" => true, 'id' => $entity->getId(), 'no' => $entity->getAgreementNo())));
            } else {
                return new Response(json_encode(array("exist" => false)));
            }
//            }
        }
        return new Response(json_encode(array("exist" => false)));
    }

    /**
     *
     * @Route("/upateFormFields", name="agreements_upateFormFields")
     * @Template()
     */
    public function upateFormFieldsAction() {
        $em = $this->getDoctrine()->getManager();
        $rentalPeriodId = $this->get('request')->request->get('rentalPeriodId');
        $roomSize = $this->get('request')->request->get('roomSize');

        $discountPolicies = $this->get('request')->request->get('discountPolicies');
        $depositValue = $this->get('request')->request->get('depositValue');
        $insuranceValue = $this->get('request')->request->get('insuranceValue');
        $otherFees = $this->get('request')->request->get('otherFees');
        $otherDiscount = $this->get('request')->request->get('otherDiscount');
        $startDate = $this->get('request')->request->get('startDate');

        $entity = new Agreements();
        $entity->setDiscountPolicies($discountPolicies);
        $entity->setDepositValue($depositValue);
        $entity->setInsuranceValue($insuranceValue);
        $entity->setOtherFees($otherFees);
        $entity->setOtherDiscount($otherDiscount);
        if (!empty($startDate))
            $entity->setStartDate(new \DateTime($startDate));

        $rentalPeriods = $em->getRepository('AcmeDemoBundle:RentalPeriods')->find($rentalPeriodId);
        $entity->setRentalPeriod($rentalPeriods);

        try {
            $entity = $this->setAgreementValue($entity, $roomSize);
        } catch (Exception $exc) {
//            echo $exc->getTraceAsString();
            return new Response(json_encode(array('code' => 'error', 'msg' => 'Unable to fetch total room size')));
        }

        $enddDate = $entity->getEndDate();
        if (!is_null($enddDate))
            $enddDate = $enddDate->format('Y-m-d');

        return new Response(json_encode(array('code' => '200', 'fiels' => array(
                                "depositValue" => floatval($entity->getDepositValue()),
                                "rentalValue" => floatval($entity->getRentalValue()),
                                "insuranceValue" => floatval($entity->getInsuranceValue()),
                                "otherFees" => floatval($entity->getOtherFees()),
                                "totalValue" => floatval($entity->getTotalValue()),
                                "offerDiscount" => floatval($entity->getOfferDiscount()),
                                "otherDiscount" => floatval($entity->getOtherDiscount()),
                                "netValue" => floatval($entity->getNetValue()),
                                "totalArea" => floatval($roomSize),
                                "endDate" => $enddDate,
                                ))));
    }

}
