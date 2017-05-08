ALTER TABLE `agreements_stores`
	DROP FOREIGN KEY `FK_agreements_stores_agreements`,
	DROP FOREIGN KEY `FK_agreements_stores_stores`;
ALTER TABLE `agreements_stores`
	CHANGE COLUMN `agreement_id` `agreements_id` INT(11) NULL DEFAULT NULL AFTER `id`,
	CHANGE COLUMN `store_id` `stores_id` INT(11) NULL DEFAULT NULL AFTER `agreements_id`,
	ADD CONSTRAINT `FK_agreements_stores_agreements` FOREIGN KEY (`agreements_id`) REFERENCES `agreements` (`id`),
	ADD CONSTRAINT `FK_agreements_stores_stores` FOREIGN KEY (`stores_id`) REFERENCES `stores` (`id`);
