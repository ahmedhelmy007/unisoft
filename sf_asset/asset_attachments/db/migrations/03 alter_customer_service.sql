ALTER TABLE `customer_service`
	RENAME TO `customers_services`;

ALTER TABLE `customers_services`
	DROP FOREIGN KEY `fk_customer_service_1`,
	DROP FOREIGN KEY `fk_customer_service_2`;                                                                                                                                                                                                                                                                                                                                                                                      
ALTER TABLE `customers_services`
	CHANGE COLUMN `customer_id` `customers_id` INT(11) NULL DEFAULT NULL AFTER `id`,
	CHANGE COLUMN `service_id` `services_id` INT(11) NULL DEFAULT NULL AFTER `customers_id`,
	ADD CONSTRAINT `fk_customer_service_1` FOREIGN KEY (`customers_id`) REFERENCES `customers` (`id`) ON UPDATE NO ACTION ON DELETE NO ACTION,
	ADD CONSTRAINT `fk_customer_service_2` FOREIGN KEY (`services_id`) REFERENCES `services` (`id`) ON UPDATE NO ACTION ON DELETE NO ACTION;
