-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jun 19, 2013 at 06:57 PM
-- Server version: 5.5.16
-- PHP Version: 5.3.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `storage4`
--

-- --------------------------------------------------------

--
-- Table structure for table `agreements`
--

CREATE TABLE IF NOT EXISTS `agreements` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `agreement_no` int(11) DEFAULT NULL,
  `agreement_type` int(11) DEFAULT NULL,
  `transaction_type` varchar(45) DEFAULT NULL,
  `agreement_id` int(11) DEFAULT '0',
  `agreement_date` date DEFAULT NULL,
  `customer_id` int(11) DEFAULT NULL,
  `service_id` int(11) DEFAULT NULL,
  `sales_id` int(11) DEFAULT NULL,
  `discount_policies` varchar(45) DEFAULT NULL,
  `rental_period_id` int(11) DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `evacuation_date` date DEFAULT NULL,
  `total_area` float DEFAULT NULL,
  `rental_value` float DEFAULT NULL,
  `insurance_value` float DEFAULT NULL,
  `deposit_value` float DEFAULT NULL,
  `other_fees` float DEFAULT NULL,
  `total_value` float DEFAULT NULL,
  `offer_discount` float DEFAULT NULL,
  `other_discount` float DEFAULT NULL,
  `net_value` float DEFAULT NULL,
  `evacuation_type` varchar(45) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`),
  KEY `fk_agreements_1_idx` (`customer_id`),
  KEY `fk_agreements_2_idx` (`service_id`),
  KEY `fk_agreements_3_idx` (`sales_id`),
  KEY `fk_agreements_4_idx` (`rental_period_id`),
  KEY `index8` (`agreement_type`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=29 ;

--
-- Dumping data for table `agreements`
--

INSERT INTO `agreements` (`id`, `agreement_no`, `agreement_type`, `transaction_type`, `agreement_id`, `agreement_date`, `customer_id`, `service_id`, `sales_id`, `discount_policies`, `rental_period_id`, `start_date`, `end_date`, `evacuation_date`, `total_area`, `rental_value`, `insurance_value`, `deposit_value`, `other_fees`, `total_value`, `offer_discount`, `other_discount`, `net_value`, `evacuation_type`, `created`, `modified`) VALUES
(1, 1, 0, 'New', 6, '2008-01-01', 1, 3, 1, '10', 2, '2013-05-28', '2013-05-28', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(6, 1, 1, 'New', NULL, '2008-01-01', 1, 3, 1, '10', 2, '2013-05-25', '2013-05-25', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(7, 2, 1, 'New', NULL, '2013-05-26', 1, 3, 1, '5', 2, '2013-04-28', '2013-05-12', NULL, 3, 15, 0, 0, 0, 15, 0.75, 0, 14.25, NULL, NULL, NULL),
(8, 2, 0, 'New', NULL, '2013-05-26', 1, 3, 1, '5', 2, '2013-06-04', '2013-06-04', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(9, 3, 1, 'New', NULL, '2013-05-26', 2, 3, 1, '10', 1, '2013-06-04', '2013-06-05', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(10, 3, 0, 'New', 11, '2013-05-26', 2, 3, 1, '10', 3, '2013-06-03', '2013-06-03', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(11, 4, 1, 'New', NULL, '2013-05-26', 2, 3, 1, '10', 1, '2013-06-02', '2013-06-05', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(12, 4, 0, NULL, NULL, '2013-05-26', 1, 3, 1, '5', 3, '2013-05-28', '2013-06-28', NULL, 7, 15, 2.5, 3, NULL, 20.5, 0.75, 1.2, 18.55, NULL, NULL, NULL),
(15, 5, 0, '', 0, '2013-06-10', 2, 3, 1, '10', 2, '2013-05-26', '2013-06-09', NULL, 7, 12, 0, 0, 0, 12, 1.2, 0, 10.8, NULL, NULL, NULL),
(16, 6, 0, NULL, 0, '2013-06-10', 2, 3, 1, '10', 3, '2013-05-25', '2013-06-25', NULL, 3, 20, NULL, 1.2, 0, 21.2, 2, 0, 19.2, NULL, NULL, NULL),
(23, 6, 1, 'Renew', NULL, '2013-06-11', 2, 3, 1, '5', 1, '2013-05-26', '2013-06-02', NULL, 3, 10, 0, 0, 0, 10, 0.5, 0, 9.5, NULL, NULL, NULL),
(28, 7, 1, 'New', NULL, '2013-06-12', 2, 3, 1, '10', 3, '2013-05-26', '2013-08-23', '2013-06-12', 7, 15, 0, 0, 0, 15, 1.5, 0, 13.5, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `agreements_stores`
--

CREATE TABLE IF NOT EXISTS `agreements_stores` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `agreements_id` int(11) DEFAULT NULL,
  `stores_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`),
  KEY `fk_rented_stores_1_idx` (`stores_id`),
  KEY `fk_rented_stores_2_idx` (`agreements_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=37 ;

--
-- Dumping data for table `agreements_stores`
--

INSERT INTO `agreements_stores` (`id`, `agreements_id`, `stores_id`) VALUES
(1, 12, 1),
(7, 12, 2),
(12, 15, 1),
(13, 16, 1),
(14, 7, 1),
(15, 15, 2),
(35, 28, 1),
(36, 28, 2);

-- --------------------------------------------------------

--
-- Table structure for table `authorized_persons`
--

CREATE TABLE IF NOT EXISTS `authorized_persons` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `agreement_id` int(11) DEFAULT NULL,
  `name` varchar(150) DEFAULT NULL,
  `civil_id` varchar(45) DEFAULT NULL,
  `phone` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`),
  KEY `fk_authorized_persons_1_idx` (`agreement_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `centers`
--

CREATE TABLE IF NOT EXISTS `centers` (
  `ID` int(11) NOT NULL,
  `NAME` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `NAME_E` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `PRODS` int(11) DEFAULT NULL,
  `SMAN` int(11) DEFAULT NULL,
  `COST_CENTER` int(11) DEFAULT NULL,
  `ACC_BRANCH` int(11) DEFAULT NULL,
  `PHONE1` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `PHONE2` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `VADDRESS` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `PHONE` varchar(40) COLLATE utf8_unicode_ci DEFAULT NULL,
  `BNKCOMMACCNO` varchar(14) COLLATE utf8_unicode_ci DEFAULT NULL,
  `CNTR_SALESQTYCASH` int(11) DEFAULT '1',
  `CNTR_SALESQTYCREDIT` int(11) DEFAULT '1',
  `CNTR_SALESRQTYCASH` int(11) DEFAULT '1',
  `CNTR_SALESRQTYCREDIT` int(11) DEFAULT '1',
  `CNTR_SYSDATE` date DEFAULT NULL,
  `CNTR_CREDITCUSTOMER` int(11) DEFAULT NULL,
  `CASHSALES_CREDIT_ACC` varchar(14) COLLATE utf8_unicode_ci DEFAULT NULL,
  `PRINTER_NM` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `CNTR_CREDITNOTEACC` varchar(14) COLLATE utf8_unicode_ci DEFAULT NULL,
  `REGION` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL,
  `CENTER_TYPE` int(11) DEFAULT NULL,
  `DEFAULT_CURR` int(11) DEFAULT '1',
  `LOGO_PATH` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `LOGO_BLOB` blob,
  PRIMARY KEY (`ID`),
  KEY `FK_CENTERS_SMAN` (`SMAN`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE IF NOT EXISTS `customers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `customer_no` int(11) DEFAULT NULL,
  `en_name` varchar(150) DEFAULT NULL,
  `ar_name` varchar(150) DEFAULT NULL,
  `civil_id` varchar(45) DEFAULT NULL,
  `mobile` varchar(45) DEFAULT NULL,
  `phone` varchar(45) DEFAULT NULL,
  `fax` varchar(45) DEFAULT NULL,
  `email` varchar(45) DEFAULT NULL,
  `nationality_id` int(11) DEFAULT NULL,
  `gender` varchar(45) DEFAULT NULL,
  `contact_person` varchar(45) DEFAULT NULL,
  `contact_mobile` varchar(45) DEFAULT NULL,
  `contact_phone` varchar(45) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `region` varchar(45) DEFAULT NULL,
  `part` varchar(45) DEFAULT NULL,
  `gada` varchar(45) DEFAULT NULL,
  `street` varchar(45) DEFAULT NULL,
  `house` varchar(45) DEFAULT NULL,
  `floor` varchar(45) DEFAULT NULL,
  `flat` varchar(45) DEFAULT NULL,
  `notes` varchar(45) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `oracle_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`),
  UNIQUE KEY `customer_no_UNIQUE` (`customer_no`),
  KEY `fk_customers_1_idx` (`nationality_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `customer_no`, `en_name`, `ar_name`, `civil_id`, `mobile`, `phone`, `fax`, `email`, `nationality_id`, `gender`, `contact_person`, `contact_mobile`, `contact_phone`, `address`, `region`, `part`, `gada`, `street`, `house`, `floor`, `flat`, `notes`, `created`, `modified`, `oracle_id`) VALUES
(1, 101, 'Karim', 'كريم', '123456789012', '123', '123', '123', 'kkk@yahoo.com', 1, 'Male', 'kkk', '123', '123', 'Cairo', '1', '1', '1', 'street', '10', '2', '3', 'nnnn', '2013-05-26 14:32:11', '2013-06-05 11:17:05', 0),
(2, 102, 'Ahmed', 'ahmed', '123456789012', '123', '123', '123', 'kkk@yahoo.com', 1, 'Male', 'karim', '123', '123', 'Cairo', '1', '1', '1', 'street', '10', '2', '3', 'notes', '2013-06-12 20:01:51', '2013-06-18 13:23:26', 29);

-- --------------------------------------------------------

--
-- Table structure for table `customers2`
--

CREATE TABLE IF NOT EXISTS `customers2` (
  `ID` int(11) NOT NULL,
  `NAME` varchar(150) DEFAULT NULL,
  `CAT1` int(11) DEFAULT NULL,
  `CAT2` int(11) DEFAULT NULL,
  `CADDRESS` varchar(100) DEFAULT NULL,
  `TEL1` varchar(100) DEFAULT NULL,
  `TEL2` varchar(100) DEFAULT NULL,
  `FAX` varchar(100) DEFAULT NULL,
  `CONTACT` varchar(100) DEFAULT NULL,
  `CREDIT_LIMIT_FLAGE` int(11) DEFAULT NULL,
  `CREDIT_LIMIT` int(11) DEFAULT NULL,
  `CREDIT_DAYS` int(11) DEFAULT NULL,
  `SALES_MAN` int(11) DEFAULT NULL,
  `ACCNO` varchar(37) DEFAULT NULL,
  `DISCOUNT_CODE` int(11) DEFAULT NULL,
  `NAME_E` varchar(150) DEFAULT NULL,
  `TEL4` varchar(100) DEFAULT NULL,
  `JOP` varchar(30) DEFAULT NULL,
  `NATIONAL` varchar(30) DEFAULT NULL,
  `BEGIN_DATE` datetime DEFAULT NULL,
  `NOTES` varchar(4000) DEFAULT NULL,
  `CID` varchar(12) DEFAULT NULL,
  `SHOON` varchar(12) DEFAULT NULL,
  `TARKHES` varchar(12) DEFAULT NULL,
  `OP_BALANCE` int(11) DEFAULT NULL,
  `BALANCE` int(11) DEFAULT NULL,
  `TEMP1` int(11) DEFAULT NULL,
  `TEMP2` int(11) DEFAULT NULL,
  `TEMP3` int(11) DEFAULT NULL,
  `TEMP4` int(11) DEFAULT NULL,
  `EMAIL` varchar(100) DEFAULT NULL,
  `WEB_PAGE` varchar(100) DEFAULT NULL,
  `TEMP_DATE` datetime DEFAULT NULL,
  `TEMP_DATE2` datetime DEFAULT NULL,
  `CREDIT_DAYS_FLAGE` int(11) DEFAULT NULL,
  `COST_CENTER` int(11) DEFAULT NULL,
  `TO_DT` datetime DEFAULT NULL,
  `DATE_FLAGE` int(11) DEFAULT NULL,
  `DISCOUNT_RATIO` int(11) DEFAULT NULL,
  `AREA_CODE` varchar(20) DEFAULT NULL,
  `SECTOR` varchar(20) DEFAULT NULL,
  `GADA` varchar(20) DEFAULT NULL,
  `STREET` varchar(50) DEFAULT NULL,
  `HOUSE` varchar(50) DEFAULT NULL,
  `FLAT` varchar(20) DEFAULT NULL,
  `FLOOR` varchar(20) DEFAULT NULL,
  `ISBRANCH` int(11) DEFAULT NULL,
  `PCENTER` int(11) DEFAULT NULL,
  `INST_ACCEPTLESSTHANMINVAL` int(11) DEFAULT NULL,
  `OB_BALANCE_F` int(11) DEFAULT NULL,
  `OB_BALANCE_CURR` int(11) DEFAULT NULL,
  `CUST_MANID` varchar(20) DEFAULT NULL,
  `SECTION` int(11) DEFAULT NULL,
  `IS_STOP` int(11) DEFAULT NULL,
  `STOP_DATE` datetime DEFAULT NULL,
  `STOP_REASON` varchar(150) DEFAULT NULL,
  `STOP_USER` varchar(100) DEFAULT NULL,
  `ROUTE` int(11) DEFAULT NULL,
  `ACCOUNT_ID` int(11) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `customers_services`
--

CREATE TABLE IF NOT EXISTS `customers_services` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `customers_id` int(11) DEFAULT NULL,
  `services_id` int(11) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`),
  KEY `fk_customer_service_1_idx` (`customers_id`),
  KEY `fk_customer_service_2_idx` (`services_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `customers_services`
--

INSERT INTO `customers_services` (`id`, `customers_id`, `services_id`, `created`, `modified`) VALUES
(5, 2, 1, NULL, NULL),
(6, 1, 2, NULL, NULL),
(7, 1, 3, NULL, NULL),
(8, 2, 3, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `issue_1`
--

CREATE TABLE IF NOT EXISTS `issue_1` (
  `CODE` int(11) NOT NULL,
  `VDATE` datetime DEFAULT NULL,
  `SMAN` int(11) DEFAULT NULL,
  `PUR_ORDER` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `QUTAION` int(11) DEFAULT NULL,
  `PAYMENT` int(11) DEFAULT NULL,
  `DISCOUNT` int(11) DEFAULT NULL,
  `CUSTOMER_DATA` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `TOTAL` int(11) DEFAULT NULL,
  `CUSTOMER_NAME` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `USER_NO` int(11) DEFAULT NULL,
  `TIME_STAMP` datetime DEFAULT NULL,
  `PCENTER` int(11) NOT NULL,
  `NOTES_PRINT_FALGE` int(11) DEFAULT NULL,
  `BILNO` int(11) NOT NULL,
  `CUSTNO` int(11) DEFAULT NULL,
  `TEMPLET` int(11) DEFAULT NULL,
  `REV_OK` int(11) DEFAULT NULL,
  `LAYAWAY` int(11) DEFAULT NULL,
  `DELI_DATE` datetime DEFAULT NULL,
  `TERMS` int(11) DEFAULT NULL,
  `PAYED` int(11) DEFAULT NULL,
  `PAYED1` int(11) DEFAULT NULL,
  `PAYED2` int(11) DEFAULT NULL,
  `PAY_OK` int(11) DEFAULT NULL,
  `RESET_BILNO` int(11) DEFAULT NULL,
  `STEP1` int(11) DEFAULT NULL,
  `STEP2` int(11) DEFAULT NULL,
  `STEP3` int(11) DEFAULT NULL,
  `STEP4` int(11) DEFAULT NULL,
  `FROM_TYPE` int(11) DEFAULT NULL,
  `NOTE6` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `NOTE7` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `DRIVER_NAME` varchar(60) COLLATE utf8_unicode_ci DEFAULT NULL,
  `CAR_NO` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `LEAVE_TIME` datetime DEFAULT NULL,
  `NOTE1` varchar(40) COLLATE utf8_unicode_ci DEFAULT NULL,
  `NOTE2` varchar(40) COLLATE utf8_unicode_ci DEFAULT NULL,
  `NOTE3` varchar(40) COLLATE utf8_unicode_ci DEFAULT NULL,
  `NOTE4` varchar(40) COLLATE utf8_unicode_ci DEFAULT NULL,
  `NOTE5` varchar(40) COLLATE utf8_unicode_ci DEFAULT NULL,
  `VTIME` datetime DEFAULT NULL,
  `HAND_TIME` datetime DEFAULT NULL,
  `DRV_CODE` int(11) DEFAULT NULL,
  `CUST_NO` int(11) DEFAULT NULL,
  `RETURN_TIME` datetime DEFAULT NULL,
  `STEP5` int(11) DEFAULT NULL,
  `CASH_DELIVARY_ID` int(11) DEFAULT NULL,
  `RECIEVED_FLAGE` int(11) DEFAULT NULL,
  `AREA_CODE` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `SECTOR` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `GADA` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `STREET` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `HOUSE` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `FLAT` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `FLOOR` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `CUST_TEL` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `BNKCOMM` int(11) DEFAULT NULL,
  `PAYMENT2` int(11) DEFAULT NULL,
  `PAYMENT3` int(11) DEFAULT NULL,
  `P_DATE1` datetime DEFAULT NULL,
  `P_DATE2` datetime DEFAULT NULL,
  `P_DATE3` datetime DEFAULT NULL,
  `VISIT_NO` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `TEMP_DATE` datetime DEFAULT NULL,
  `TEL` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `PROD_ID` int(11) DEFAULT NULL,
  `EQUIPMENT_CODE` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `F11_PAYED` int(11) DEFAULT NULL,
  `COSTCENTER_ID` int(11) DEFAULT NULL,
  `XCODE` int(11) DEFAULT NULL,
  `CURR_ID` int(11) DEFAULT NULL,
  `CURR_RATE` int(11) DEFAULT NULL,
  `TOTAL_CUR` int(11) DEFAULT NULL,
  `DISCOUNT_CUR` int(11) DEFAULT NULL,
  `CONT_EQUIPMENT_CODE` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `SEC_ID` int(11) DEFAULT NULL,
  `SEC_CENTER` int(11) DEFAULT NULL,
  `KM_COUNT` int(11) DEFAULT NULL,
  `JOP_NO` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `CUST_PHONE1` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `CUST_PHONE2` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `CUST_ADD` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `CUST_REF` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `CUST_RESP` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `PRINTINGTIMES` int(11) DEFAULT NULL,
  `TOTAL_ACT_CATALOG_WEIGHT` int(11) DEFAULT NULL,
  `TOTAL_PRICE` int(11) DEFAULT NULL,
  `ADD_VOUCHER_USER` varchar(16) COLLATE utf8_unicode_ci DEFAULT NULL,
  `LUPDATE_VOUCHER_USER` varchar(16) COLLATE utf8_unicode_ci DEFAULT NULL,
  `INV_TYPE` int(11) DEFAULT NULL,
  `SHIFT_ID` int(11) DEFAULT NULL,
  `INV1` int(11) DEFAULT NULL,
  `INV2` int(11) DEFAULT NULL,
  `ENGINEER_COMMISSION` int(11) DEFAULT NULL,
  `ENGINEER_ID` int(11) DEFAULT NULL,
  `MANAGER_COMMISSION` int(11) DEFAULT NULL,
  `MANAGER_ID` int(11) DEFAULT NULL,
  `SALESMAN_COMMISSION` int(11) DEFAULT NULL,
  `SALESMAN_ID` int(11) DEFAULT NULL,
  `DELIVARY_METHOD_ID` int(11) DEFAULT NULL,
  `FORM_NO` int(11) DEFAULT NULL,
  `PRINT_OK` int(11) DEFAULT NULL,
  `SALES_COMMM` int(11) DEFAULT NULL,
  `ACCEPT_USER` varchar(16) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ACCOUNT_ITEM_CODE` int(11) DEFAULT NULL,
  `PURCHASE_ORDER_NO` int(11) DEFAULT NULL,
  `PURCHASE_ORDER_DATE` datetime DEFAULT NULL,
  `AUTO_ISSUE` int(11) DEFAULT NULL,
  `ROUND_FIGURE` int(11) DEFAULT NULL,
  `NOTES` varchar(4000) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ORDER_STAT` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `MACHINE_NO` int(11) DEFAULT NULL,
  `INSUR_REMAINING_AMT` int(11) DEFAULT NULL,
  `INSUR_REM` int(11) DEFAULT NULL,
  `DEPR_ACCNO` varchar(14) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`CODE`,`PCENTER`,`BILNO`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `issue_2`
--

CREATE TABLE IF NOT EXISTS `issue_2` (
  `ID` int(11) NOT NULL,
  `PRODS` int(11) DEFAULT NULL,
  `PRODN` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `QTY` float DEFAULT NULL,
  `PRICE` float DEFAULT NULL,
  `UDISC_P` int(11) DEFAULT NULL,
  `UNIT` int(11) DEFAULT NULL,
  `CONV` int(11) DEFAULT NULL,
  `UDISC` int(11) DEFAULT NULL,
  `CODE` int(11) NOT NULL,
  `PCENTER` int(11) NOT NULL,
  `ITEM_COST` int(11) DEFAULT NULL,
  `TEMP1` int(11) DEFAULT NULL,
  `MOVE` int(11) DEFAULT NULL,
  `NON_INVENT` int(11) DEFAULT NULL,
  `TOTAL` int(11) DEFAULT NULL,
  `BILNO` int(11) NOT NULL,
  `WARENTY` int(11) DEFAULT NULL,
  `WARENTY_DATE` datetime DEFAULT NULL,
  `LINE_NOTES` blob,
  `DISC2` int(11) DEFAULT NULL,
  `ISS_QTY` int(11) DEFAULT NULL,
  `TEMP2` int(11) DEFAULT NULL,
  `KIT_NO` int(11) DEFAULT NULL,
  `KIT_QTY` float DEFAULT NULL,
  `DI1` int(11) DEFAULT '0',
  `DI2` int(11) DEFAULT NULL,
  `DI3` int(11) DEFAULT NULL,
  `TEMP_QTY` int(11) DEFAULT '0',
  `ISS_PRODNAME` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `UNIT_NAME` varchar(25) COLLATE utf8_unicode_ci DEFAULT NULL,
  `PROD_ID` int(11) DEFAULT NULL,
  `CONV2` int(11) DEFAULT '1',
  `EXP_DATE` datetime DEFAULT NULL,
  `FREE_CLASS` int(11) DEFAULT NULL,
  `TEMP_PRICE` int(11) DEFAULT NULL,
  `PRICE1` float DEFAULT NULL,
  `UDISC1` int(11) DEFAULT NULL,
  `TOTAL1` int(11) DEFAULT NULL,
  `DISC21` int(11) DEFAULT NULL,
  `SMAN` int(11) DEFAULT NULL,
  `ITEMSORT` int(11) DEFAULT NULL,
  `COMPPRICEMANUALMOD` int(11) DEFAULT '0',
  `MARBLELINENOTES` blob,
  `DI_FLAGE` int(11) DEFAULT NULL,
  `LAYAWAY` int(11) DEFAULT '0',
  `CONT_EQUIPMENT_CODE` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `RELATED_BRANCH` int(11) DEFAULT NULL,
  `RELATED_CODE` int(11) DEFAULT NULL,
  `RELATED_BILLNO` int(11) DEFAULT NULL,
  `RELATED_ID` int(11) DEFAULT NULL,
  `ORIGINPARENTID` int(11) DEFAULT NULL,
  `CATALOG_WEIGHT` int(11) DEFAULT '0',
  `ACT_CATALOG_WEIGHT` int(11) DEFAULT '0',
  `CALC_AGAIN` int(11) DEFAULT '0',
  `BATCHNO` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ALTERATION_TYPE` int(11) DEFAULT NULL,
  `DELIVER_DATE` datetime DEFAULT NULL,
  `DELIVERD` int(11) DEFAULT '0',
  `CHECK_TAKEAWAY_DINNING` varchar(1) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ACHIEVE_RATIO1` int(11) DEFAULT '0',
  `ACHIEVE_RATIO2` int(11) DEFAULT '0',
  `ACHIEVE_RATIO3` int(11) DEFAULT '0',
  `PKT_NO` int(11) DEFAULT NULL,
  `QTY1` float DEFAULT '0',
  `START_FROM` int(11) DEFAULT '0',
  `END_TO` int(11) DEFAULT '0',
  `START_GROUP` int(11) DEFAULT NULL,
  `END_GROUP` int(11) DEFAULT NULL,
  `SER_QTY` float DEFAULT '0',
  `PROD_TYP` int(11) DEFAULT NULL,
  `WARENTY_TYPE` int(11) DEFAULT '1',
  `CUSTOMER_BARCODE` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `INV1` int(11) DEFAULT NULL,
  `INV2` int(11) DEFAULT NULL,
  `TYP` int(11) DEFAULT '0',
  `ADJUST_MOVE` int(11) DEFAULT NULL,
  `SHIPMENT_NO` int(11) DEFAULT NULL,
  `ITEM_LEVEL` int(11) DEFAULT NULL,
  `DISC2_TMP` int(11) DEFAULT NULL,
  `AVG_COST` int(11) DEFAULT NULL,
  PRIMARY KEY (`ID`,`CODE`,`PCENTER`,`BILNO`),
  KEY `FK_ISSUE_1_SMAN` (`SMAN`),
  KEY `FK_ISSUE_1_PCENTER` (`PCENTER`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE IF NOT EXISTS `items` (
  `PRODN` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `PRODNAME` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `PRODNAME_E` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `COUNTRY` int(11) DEFAULT NULL,
  `CAT1` int(11) DEFAULT NULL,
  `CAT2` int(11) DEFAULT NULL,
  `CAT3` int(11) DEFAULT NULL,
  `CAT4` int(11) DEFAULT NULL,
  `UNIT` int(11) DEFAULT NULL,
  `VENDOR_ITEM_NO` varchar(40) COLLATE utf8_unicode_ci DEFAULT NULL,
  `MIN_QTY` int(11) DEFAULT NULL,
  `ITEM_TYPE` int(11) DEFAULT NULL,
  `SAL_PRICE` int(11) DEFAULT NULL,
  `SAL_PRICE2` int(11) DEFAULT NULL,
  `SAL_PRICE3` int(11) DEFAULT NULL,
  `SAL_PRICE4` int(11) DEFAULT NULL,
  `COST` int(11) DEFAULT NULL,
  `NON_INVENTORY_ITEM` int(11) DEFAULT NULL,
  `LAST_ORDER_DATE` date DEFAULT NULL,
  `LAST_ORDER_PRICE` int(11) DEFAULT NULL,
  `REORDER_QTY` int(11) DEFAULT NULL,
  `MAX_QTY` int(11) DEFAULT NULL,
  `UNIT1` int(11) DEFAULT NULL,
  `PAR_CODE` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ITEM_COLOR` varchar(15) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ITEM_VOLUME` varchar(15) COLLATE utf8_unicode_ci DEFAULT NULL,
  `SAL_PRICE5` int(11) DEFAULT NULL,
  `LAST_SAL_DATE` date DEFAULT NULL,
  `LAST_ORDER_CURRANCY` int(11) DEFAULT NULL,
  `LAST_COST` int(11) DEFAULT NULL,
  `LAST_PUR_DATE` date DEFAULT NULL,
  `LAST_PUR_PRICE` int(11) DEFAULT '0',
  `LAST_PUR_CURRANCY` int(11) DEFAULT NULL,
  `ITEM_WAIGHT` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ITEM_SIZE` varchar(15) COLLATE utf8_unicode_ci DEFAULT NULL,
  `SAL_PRICE6` int(11) DEFAULT NULL,
  `VENDOR` int(11) DEFAULT NULL,
  `GROSSWEIGHT` int(11) DEFAULT NULL,
  `UNIT2` int(11) DEFAULT NULL,
  `ITEM_PIC` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `AVR_ON` int(11) DEFAULT NULL,
  `ISACTIVE` varchar(1) COLLATE utf8_unicode_ci DEFAULT 'Y',
  `HASEXPIARYDATE` varchar(1) COLLATE utf8_unicode_ci DEFAULT 'N',
  `EXPIREHANDLE` varchar(1) COLLATE utf8_unicode_ci DEFAULT 'A',
  `DISPENSEPOLICY` varchar(1) COLLATE utf8_unicode_ci DEFAULT 'F',
  `REP_ITEM` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `SAL_UNIT` int(11) DEFAULT NULL,
  `PUR_UNIT` int(11) DEFAULT NULL,
  `SIZE_CODE` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `SIZE_GROUP` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `COLOR_CODE` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `STYLE` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `FABRIC_NO` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `TREND` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ARTICLE` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `SEASON` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ORGINOK` int(11) DEFAULT NULL,
  `MANUFACTURER` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `NO_IN_BALLET` int(11) DEFAULT NULL,
  `PRODN_ORG` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `PRODN_ALT` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `FAMILY` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `IS_LWH` int(11) DEFAULT '0',
  `STOP_ITEM` int(11) DEFAULT '0',
  `STOP_CENTERS` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ITEM_THICKNESS` varchar(15) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ITEM_DIAMETER` varchar(15) COLLATE utf8_unicode_ci DEFAULT NULL,
  `CLR_CODE` int(11) DEFAULT NULL,
  `SZ_CODE` int(11) DEFAULT NULL,
  `ITMMAINCAT` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `STOP_ITEM_EXPEND` int(11) DEFAULT '0',
  `STOP_CENTERS_EXPEND` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `DI1` int(11) DEFAULT '1',
  `DI2` int(11) DEFAULT '1',
  `DI3` int(11) DEFAULT '1',
  `PROFIT_RATIO` int(11) DEFAULT '0',
  `CATALOG_WEIGHT` int(11) DEFAULT '0',
  `PUR_PRICE1` int(11) DEFAULT '0',
  `PUR_PRICE2` int(11) DEFAULT '0',
  `PUR_PRICE3` int(11) DEFAULT '0',
  `IDSERIAL_MUST` int(11) DEFAULT '0',
  `PREPARE_TIME` int(11) DEFAULT '0',
  `ITEM_BACKCOLOR` int(11) DEFAULT NULL,
  `MAX_ADD_ITEMS` int(11) DEFAULT '0',
  `MAX_ADD_ITEMS_2` int(11) DEFAULT '0',
  `SERV_TYP` int(11) DEFAULT '0',
  `HAVE_CABLESIZE` int(11) DEFAULT '0',
  `SIZE_CAT` int(11) DEFAULT NULL,
  `DEFALT_PRICE` int(11) DEFAULT '1',
  `MANF_YEAR` int(11) DEFAULT NULL,
  `COLOR_CAT` int(11) DEFAULT NULL,
  `STOP_ITEM_TRANSFER` int(11) DEFAULT '0',
  `STOP_CENTERS_TRANSFER` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ITEM_SERIAL_DIGITS` int(11) DEFAULT NULL,
  `ITEM_CLASS_FROM` int(11) DEFAULT '0',
  `ITEM_CLASS_TO` int(11) DEFAULT '0',
  `STAGNANT_PRODUCT` int(11) DEFAULT NULL,
  `UPDATE_NAME` int(11) DEFAULT '1',
  `NO_SERIAL` int(11) DEFAULT '0',
  `EQUATION_ID` int(11) DEFAULT NULL,
  `ADD_USER` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ADD_DT` date DEFAULT NULL,
  `UPD_USER` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `UPD_DT` date DEFAULT NULL,
  `NOTES` varchar(1024) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ITEM_IMG` blob,
  `BR_ID` int(11) DEFAULT NULL,
  `BARCODE2` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `BARCODE3` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `BARCODE4` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `BARCODE5` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `LOOKUP_NO` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `CL_1_ID` int(11) DEFAULT NULL,
  `CL_2_ID` int(11) DEFAULT NULL,
  `CL_3_ID` int(11) DEFAULT NULL,
  `CL_4_ID` int(11) DEFAULT NULL,
  `CL_5_ID` int(11) DEFAULT NULL,
  `CL_6_ID` int(11) DEFAULT NULL,
  `CL_7_ID` int(11) DEFAULT NULL,
  `CL_8_ID` int(11) DEFAULT NULL,
  `CL_9_ID` int(11) DEFAULT NULL,
  `CL_10_ID` int(11) DEFAULT NULL,
  `DESCRIPTION` int(11) DEFAULT NULL,
  `CUT_TYPE` int(11) DEFAULT NULL,
  `AGES` int(11) DEFAULT NULL,
  `TYPES` int(11) DEFAULT NULL,
  `SUP_DESC` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL,
  `HAVE_TARGET` int(11) DEFAULT NULL,
  `CLASS_CODE` int(11) DEFAULT NULL,
  PRIMARY KEY (`PRODN`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `items_description`
--

CREATE TABLE IF NOT EXISTS `items_description` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `agreement_id` int(11) DEFAULT NULL,
  `description` text,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`),
  KEY `fk_items_description_1_idx` (`agreement_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=132 ;

--
-- Dumping data for table `items_description`
--

INSERT INTO `items_description` (`id`, `agreement_id`, `description`) VALUES
(1, 12, 'hhh'),
(6, 12, NULL),
(7, 12, NULL),
(8, 12, NULL),
(9, 12, NULL),
(15, 16, NULL),
(16, 16, NULL),
(17, 16, NULL),
(18, 7, NULL),
(19, 7, NULL),
(20, 15, NULL),
(29, 15, NULL),
(40, 28, NULL),
(123, 28, NULL),
(124, 28, NULL),
(128, 28, NULL),
(129, 28, NULL),
(130, 28, NULL),
(131, 28, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `nationalities`
--

CREATE TABLE IF NOT EXISTS `nationalities` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `en_name` varchar(45) DEFAULT NULL,
  `ar_name` varchar(45) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `nationalities`
--

INSERT INTO `nationalities` (`id`, `en_name`, `ar_name`, `created`, `modified`) VALUES
(1, 'aa', 'عربى', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `rental_periods`
--

CREATE TABLE IF NOT EXISTS `rental_periods` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `en_name` varchar(50) DEFAULT NULL,
  `ar_name` varchar(50) DEFAULT NULL,
  `unit` varchar(10) DEFAULT NULL,
  `number_of_units` int(5) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `rental_periods`
--

INSERT INTO `rental_periods` (`id`, `en_name`, `ar_name`, `unit`, `number_of_units`, `created`, `modified`) VALUES
(1, '1 week', 'اسبوع', 'Day', 7, '2009-01-02 00:00:00', '2008-01-02 00:01:00'),
(2, '2 week', 'اسبوعان', 'Day', 14, '2008-01-01 00:00:00', '2008-01-01 00:00:00'),
(3, '3 Months', '3 Months', 'Day', 90, NULL, NULL),
(4, '4 week', '4 اسابيع', 'Month', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sales_men`
--

CREATE TABLE IF NOT EXISTS `sales_men` (
  `ID` int(11) NOT NULL,
  `NAME` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `NAME_E` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `PCENTER` int(11) DEFAULT NULL,
  `ACC_BRANCH` int(11) DEFAULT NULL,
  `COMMISSION` int(11) DEFAULT NULL,
  `PWD` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ACCNO` int(11) DEFAULT NULL,
  `GUARDSHIP_ACCNO` int(11) DEFAULT NULL,
  `SORT_ID` int(11) DEFAULT NULL,
  `ALT_SMAN` int(11) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE IF NOT EXISTS `services` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `en_name` varchar(45) DEFAULT NULL,
  `ar_name` varchar(45) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`id`, `en_name`, `ar_name`, `created`, `modified`) VALUES
(1, 'Pack', 'تغليف', NULL, NULL),
(2, 'Move', 'Move', NULL, NULL),
(3, 'Self Storage', 'Self Storage', NULL, NULL),
(4, 'Shipping', 'Shipping', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `stores`
--

CREATE TABLE IF NOT EXISTS `stores` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL,
  `hieght` varchar(45) DEFAULT NULL,
  `width` varchar(45) DEFAULT NULL,
  `length` varchar(45) DEFAULT NULL,
  `size` varchar(45) DEFAULT NULL,
  `status` varchar(45) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `stores`
--

INSERT INTO `stores` (`id`, `name`, `hieght`, `width`, `length`, `size`, `status`, `created`, `modified`) VALUES
(1, 'A1', '2', '2', '2', '3', '1', '2008-01-01 00:00:00', NULL),
(2, 'A2', '1', '2', '3', '4', '1', NULL, NULL),
(3, 'A3', '1', '2', '3', '3', '6', NULL, NULL),
(4, 'A4', '1', '2', '3', '4', '2', NULL, NULL),
(5, 'A5', '1', '2', '3', '5', '2', NULL, NULL),
(9, 'A6', '1', '2', '3', '7', '3', NULL, NULL),
(10, 'A7', '1', '2', '3', '9', '1', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `stores_rentalperiods`
--

CREATE TABLE IF NOT EXISTS `stores_rentalperiods` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `stores_id` int(11) DEFAULT NULL,
  `rentalperiods_id` int(11) DEFAULT NULL,
  `price` float DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`),
  KEY `fk_stores_rentalperiods_1_idx` (`stores_id`),
  KEY `fk_stores_rentalperiods_2_idx` (`rentalperiods_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=63 ;

--
-- Dumping data for table `stores_rentalperiods`
--

INSERT INTO `stores_rentalperiods` (`id`, `stores_id`, `rentalperiods_id`, `price`) VALUES
(20, 1, 1, 10),
(21, 1, 2, 15),
(22, 1, 3, 20),
(26, 2, 1, 11),
(27, 2, 2, 12),
(28, 2, 3, 13),
(32, 3, 1, 10),
(33, 3, 2, 50),
(34, 3, 3, 10),
(35, 4, 1, 11),
(36, 4, 2, 50),
(37, 4, 3, 13),
(38, 5, 1, 22),
(39, 5, 2, 33),
(40, 5, 3, 44),
(56, 9, 1, 10),
(57, 9, 2, 12),
(58, 9, 3, 15),
(59, 10, 1, 10),
(60, 10, 2, 12.5),
(61, 10, 3, 13),
(62, 2, 4, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `system_settings`
--

CREATE TABLE IF NOT EXISTS `system_settings` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `cust_cat1_id` int(10) DEFAULT NULL,
  `cust_cat2_id` int(10) DEFAULT NULL,
  `centers_id` int(10) DEFAULT NULL,
  `item_code` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK__CUST_CAT1` (`cust_cat1_id`),
  KEY `FK__CUST_CAT2` (`cust_cat2_id`),
  KEY `FK_system_settings_centers` (`centers_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `system_settings`
--

INSERT INTO `system_settings` (`id`, `cust_cat1_id`, `cust_cat2_id`, `centers_id`, `item_code`) VALUES
(1, 1, 1, 1, 1001);

-- --------------------------------------------------------

--
-- Table structure for table `vouchers`
--

CREATE TABLE IF NOT EXISTS `vouchers` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `agreement_id` int(10) DEFAULT NULL,
  `months_serial` int(10) DEFAULT NULL,
  `due_date` date DEFAULT NULL,
  `voucher_value` float DEFAULT NULL,
  `posting_status` int(10) NOT NULL DEFAULT '0',
  `evacuation_type` int(10) NOT NULL DEFAULT '0',
  `voucher_type` int(10) DEFAULT NULL,
  `branch_id` int(10) DEFAULT NULL,
  `voucher_id` int(10) DEFAULT NULL,
  `voucher_date` date DEFAULT NULL,
  `discound_value` float NOT NULL DEFAULT '0',
  `net_value` float NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `FK_vouchers_agreements` (`agreement_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=51 ;

--
-- Dumping data for table `vouchers`
--

INSERT INTO `vouchers` (`id`, `agreement_id`, `months_serial`, `due_date`, `voucher_value`, `posting_status`, `evacuation_type`, `voucher_type`, `branch_id`, `voucher_id`, `voucher_date`, `discound_value`, `net_value`) VALUES
(47, 28, 1, '2013-05-26', 0.9, 0, 0, NULL, NULL, NULL, NULL, 0, 0.9),
(48, 28, 2, '2013-06-01', 4.5, 0, 0, NULL, NULL, NULL, NULL, 0, 4.5),
(49, 28, 3, '2013-07-01', 4.65, 0, 0, NULL, NULL, NULL, NULL, 0, 4.65),
(50, 28, 4, '2013-08-01', 3.45, 0, 0, NULL, NULL, NULL, NULL, 0, 3.45);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `agreements`
--
ALTER TABLE `agreements`
  ADD CONSTRAINT `fk_customers` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_services` FOREIGN KEY (`service_id`) REFERENCES `services` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_rental_period` FOREIGN KEY (`rental_period_id`) REFERENCES `rental_periods` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `agreements_stores`
--
ALTER TABLE `agreements_stores`
  ADD CONSTRAINT `FK_agreements` FOREIGN KEY (`agreements_id`) REFERENCES `agreements` (`id`),
  ADD CONSTRAINT `FK_stores` FOREIGN KEY (`stores_id`) REFERENCES `stores` (`id`);

--
-- Constraints for table `authorized_persons`
--
ALTER TABLE `authorized_persons`
  ADD CONSTRAINT `fk_authorized_persons_1` FOREIGN KEY (`agreement_id`) REFERENCES `agreements` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `customers`
--
ALTER TABLE `customers`
  ADD CONSTRAINT `fk_customers_1` FOREIGN KEY (`nationality_id`) REFERENCES `nationalities` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `customers_services`
--
ALTER TABLE `customers_services`
  ADD CONSTRAINT `fk_customer_service_1` FOREIGN KEY (`customers_id`) REFERENCES `customers` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_customer_service_2` FOREIGN KEY (`services_id`) REFERENCES `services` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `issue_2`
--
ALTER TABLE `issue_2`
  ADD CONSTRAINT `FK_ISSUE_2_PCENTER` FOREIGN KEY (`PCENTER`) REFERENCES `centers` (`ID`),
  ADD CONSTRAINT `fk_issue_2_sales_men` FOREIGN KEY (`SMAN`) REFERENCES `sales_men` (`ID`);

--
-- Constraints for table `items_description`
--
ALTER TABLE `items_description`
  ADD CONSTRAINT `items_description_ibfk_1` FOREIGN KEY (`agreement_id`) REFERENCES `agreements` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `stores_rentalperiods`
--
ALTER TABLE `stores_rentalperiods`
  ADD CONSTRAINT `fk_stores_rentalperiods_1` FOREIGN KEY (`stores_id`) REFERENCES `stores` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_stores_rentalperiods_2` FOREIGN KEY (`rentalperiods_id`) REFERENCES `rental_periods` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `vouchers`
--
ALTER TABLE `vouchers`
  ADD CONSTRAINT `FK_vouchers_agreements` FOREIGN KEY (`agreement_id`) REFERENCES `agreements` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
