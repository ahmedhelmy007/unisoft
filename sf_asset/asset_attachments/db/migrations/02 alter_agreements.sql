ALTER TABLE `agreements`
	ADD COLUMN `agreement_id` INT(11) NULL DEFAULT '0' AFTER `agreement_no`,
	ADD COLUMN `agreement_date` DATE NULL DEFAULT NULL AFTER `agreement_id`,
	ADD COLUMN `transaction_type` VARCHAR(45) NULL DEFAULT NULL AFTER `discount_policies`,
	ADD COLUMN `evacuation_date` DATE NULL DEFAULT NULL AFTER `end_date`;
