CREATE TABLE IF NOT EXISTS `agreement_renews` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `agreement_id` int(11) DEFAULT NULL,
  `rental_period_id` int(11) DEFAULT NULL,
  `start_date` datetime DEFAULT NULL,
  `end_date` datetime DEFAULT NULL,
  `total_size` float DEFAULT NULL,
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
  KEY `fk_agrmnt_rnws_agrmnt` (`agreement_id`),
  KEY `fk_agrmnt_rnws_rntl_priod` (`rental_period_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `agreement_renews`
--
ALTER TABLE `agreement_renews`
  ADD CONSTRAINT `fk_agrmnt_rnws_agrmnt` FOREIGN KEY (`agreement_id`) REFERENCES `agreements` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_agrmnt_rnws_rntl_priod` FOREIGN KEY (`rental_period_id`) REFERENCES `rental_periods` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

