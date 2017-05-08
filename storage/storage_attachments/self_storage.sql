-- phpMyAdmin SQL Dump
-- version 3.4.10.1deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jun 06, 2013 at 12:56 PM
-- Server version: 5.5.29
-- PHP Version: 5.3.10-1ubuntu3.6

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `self_storage`
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
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`),
  KEY `fk_agreements_1_idx` (`customer_id`),
  KEY `fk_agreements_2_idx` (`service_id`),
  KEY `fk_agreements_3_idx` (`sales_id`),
  KEY `fk_agreements_4_idx` (`rental_period_id`),
  KEY `index8` (`agreement_type`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `agreements`
--

INSERT INTO `agreements` (`id`, `agreement_no`, `agreement_type`, `transaction_type`, `agreement_id`, `agreement_date`, `customer_id`, `service_id`, `sales_id`, `discount_policies`, `rental_period_id`, `start_date`, `end_date`, `evacuation_date`, `total_area`, `rental_value`, `insurance_value`, `deposit_value`, `other_fees`, `total_value`, `offer_discount`, `other_discount`, `net_value`, `created`, `modified`) VALUES
(1, 1, 0, 'New', 6, '2008-01-01', 1, 3, 1, '10', 2, '2013-05-28', '2013-05-28', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(6, 1, 1, 'New', NULL, '2008-01-01', 1, 3, 1, '10', 2, '2013-05-25', '2013-05-25', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(7, 2, 1, 'New', NULL, '2013-05-26', 1, 3, 1, '5', 3, '2013-04-28', '2013-05-25', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(8, 2, 0, 'New', NULL, '2013-05-26', 1, 3, 1, '5', 2, '2013-06-04', '2013-06-04', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(9, 3, 1, 'New', NULL, '2013-05-26', 2, 3, 1, '10', 1, '2013-06-04', '2013-06-05', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(10, 3, 0, 'New', 11, '2013-05-26', 2, 3, 1, '10', 3, '2013-06-03', '2013-06-03', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(11, 4, 1, 'New', NULL, '2013-05-26', 2, 3, 1, '10', 1, '2013-06-02', '2013-06-05', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(12, 4, 0, NULL, NULL, '2013-05-26', 1, 3, 1, '5', 3, '2013-05-28', '2013-06-28', NULL, 7, 15, 2.5, 3, NULL, 20.5, 0.75, 1.2, 18.55, NULL, NULL);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `agreements_stores`
--

INSERT INTO `agreements_stores` (`id`, `agreements_id`, `stores_id`) VALUES
(1, 12, 1),
(7, 12, 2);

-- --------------------------------------------------------

--
-- Table structure for table `authorized_persons`
--

CREATE TABLE IF NOT EXISTS `authorized_persons` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parant_id` int(11) DEFAULT NULL,
  `name` varchar(150) DEFAULT NULL,
  `civil_id` varchar(45) DEFAULT NULL,
  `phone` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`),
  KEY `fk_authorized_persons_1_idx` (`parant_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

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
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`),
  UNIQUE KEY `customer_no_UNIQUE` (`customer_no`),
  KEY `fk_customers_1_idx` (`nationality_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `customer_no`, `en_name`, `ar_name`, `civil_id`, `mobile`, `phone`, `fax`, `email`, `nationality_id`, `gender`, `contact_person`, `contact_mobile`, `contact_phone`, `address`, `region`, `part`, `gada`, `street`, `house`, `floor`, `flat`, `notes`, `created`, `modified`) VALUES
(1, 101, 'Karim', 'كريم', '123456789012', '123', '123', '123', 'kkk@yahoo.com', 1, 'Male', 'kkk', '123', '123', 'Cairo', '1', '1', '1', 'street', '10', '2', '3', 'nnnn', '2013-05-26 14:32:11', '2013-06-05 11:17:05'),
(2, 102, 'Ahmed', 'ahmed', '123', '123', '123', '123', 'kkk@yahoo.com', 1, 'Male', 'karim', '123', '123', 'Cairo', '1', '1', '1', 'street', '10', '2', '3', 'notes', '2013-05-16 13:39:50', '2013-05-27 15:05:54');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `customers_services`
--

INSERT INTO `customers_services` (`id`, `customers_id`, `services_id`, `created`, `modified`) VALUES
(5, 2, 1, NULL, NULL),
(6, 1, 2, NULL, NULL),
(7, 1, 3, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `items_description`
--

CREATE TABLE IF NOT EXISTS `items_description` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parant_id` int(11) DEFAULT NULL,
  `description` text,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`),
  KEY `fk_items_description_1_idx` (`parant_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

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
-- Table structure for table `payment_methods`
--

CREATE TABLE IF NOT EXISTS `payment_methods` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `en_name` varchar(45) DEFAULT NULL,
  `ar_name` varchar(45) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

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
(3, '3 week', '3 week', 'Day', 31, NULL, NULL),
(4, '4 week', '4 اسابيع', 'Month', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sales_person`
--

CREATE TABLE IF NOT EXISTS `sales_person` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `en_name` varchar(45) DEFAULT NULL,
  `ar_name` varchar(45) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `sales_person`
--

INSERT INTO `sales_person` (`id`, `en_name`, `ar_name`, `created`, `modified`) VALUES
(1, 'sales1', 'sales1', NULL, NULL);

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

--
-- Constraints for dumped tables
--

--
-- Constraints for table `agreements`
--
ALTER TABLE `agreements`
  ADD CONSTRAINT `fk_agreements_1` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_agreements_2` FOREIGN KEY (`service_id`) REFERENCES `services` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_agreements_3` FOREIGN KEY (`sales_id`) REFERENCES `sales_person` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_agreements_4` FOREIGN KEY (`rental_period_id`) REFERENCES `rental_periods` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `agreements_stores`
--
ALTER TABLE `agreements_stores`
  ADD CONSTRAINT `FK_agreements_stores_agreements` FOREIGN KEY (`agreements_id`) REFERENCES `agreements` (`id`),
  ADD CONSTRAINT `FK_agreements_stores_stores` FOREIGN KEY (`stores_id`) REFERENCES `stores` (`id`);

--
-- Constraints for table `authorized_persons`
--
ALTER TABLE `authorized_persons`
  ADD CONSTRAINT `fk_authorized_persons_1` FOREIGN KEY (`parant_id`) REFERENCES `agreements` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

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
-- Constraints for table `items_description`
--
ALTER TABLE `items_description`
  ADD CONSTRAINT `fk_items_description_1` FOREIGN KEY (`parant_id`) REFERENCES `agreements` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `stores_rentalperiods`
--
ALTER TABLE `stores_rentalperiods`
  ADD CONSTRAINT `fk_stores_rentalperiods_1` FOREIGN KEY (`stores_id`) REFERENCES `stores` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_stores_rentalperiods_2` FOREIGN KEY (`rentalperiods_id`) REFERENCES `rental_periods` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
