ALTER TABLE `administrations`
	ADD COLUMN `administration_no` INT(11) NOT NULL DEFAULT '0' AFTER `id`,
	CHANGE COLUMN `name` `en_name` VARCHAR(45) NULL DEFAULT NULL AFTER `administration_no`,
	ADD COLUMN `ar_name` VARCHAR(45) NULL DEFAULT NULL AFTER `en_name`;
