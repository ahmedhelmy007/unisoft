ALTER TABLE `agreements`
	ADD COLUMN `evacuation_type` VARCHAR(45) NULL DEFAULT NULL AFTER `net_value`;
