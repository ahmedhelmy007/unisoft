ALTER TABLE `rented_stores`
	DROP FOREIGN KEY `fk_rented_stores_1`,
	DROP FOREIGN KEY `fk_rented_stores_2`;

ALTER TABLE `rented_stores`
	RENAME TO `agreements_stores`,
	CHANGE COLUMN `parant_id` `agreement_id` INT(11) NULL DEFAULT NULL AFTER `id`;

ALTER TABLE `agreements_stores`
	ADD CONSTRAINT `FK_agreements_stores_agreements` FOREIGN KEY (`agreement_id`) REFERENCES `agreements` (`id`),
	ADD CONSTRAINT `FK_agreements_stores_stores` FOREIGN KEY (`store_id`) REFERENCES `stores` (`id`);
