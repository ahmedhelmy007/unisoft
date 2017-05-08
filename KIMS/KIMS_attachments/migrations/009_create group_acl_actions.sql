CREATE TABLE `group_aclactions` (
	`group_id` INT(11) NOT NULL,
	`aclactions_id` INT(11) NOT NULL,
	PRIMARY KEY (`group_id`, `aclactions_id`),
	INDEX `aclactions_id` (`aclactions_id`)
)
COLLATE='utf8_unicode_ci'
ENGINE=InnoDB;

ALTER TABLE `group_aclactions`
  ADD CONSTRAINT FOREIGN KEY (`group_id`) REFERENCES `groups` (`id`) ON DELETE CASCADE;

ALTER TABLE `group_aclactions`
  ADD CONSTRAINT FOREIGN KEY (`aclactions_id`) REFERENCES `acl_actions` (`id`) ON DELETE CASCADE;
