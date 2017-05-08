CREATE TABLE `vouchers` (
	`id` INT(10) NULL,
	`agreement_id` INT(10) NULL,
	`months_serial` INT(10) NULL,
	`due_date` DATE NULL,
	`voucher_value` FLOAT NULL,
	`posting_status` INT(10) NOT NULL DEFAULT '0',
	`evacuation_type` INT(10) NOT NULL DEFAULT '0',
	`voucher_type` INT(10) NULL,
	`branch_id` INT(10) NULL,
	`voucher_id` INT(10) NULL,
	`voucher_date` DATE NULL,
	`discound_value` FLOAT NOT NULL DEFAULT '0.00',
	`net_value` FLOAT NOT NULL DEFAULT '0.00',
	CONSTRAINT `FK_vouchers_agreements` FOREIGN KEY (`agreement_id`) REFERENCES `agreements` (`id`) ON UPDATE CASCADE ON DELETE CASCADE
)
COLLATE='utf8_general_ci'
ENGINE=InnoDB;

ALTER TABLE `vouchers`
	CHANGE COLUMN `id` `id` INT(10) NOT NULL AUTO_INCREMENT FIRST,
	ADD PRIMARY KEY (`id`);
