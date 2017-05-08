CREATE TABLE `group_actions` (
	`id` INT(11) NOT NULL AUTO_INCREMENT,
	`group_id` INT(11) NOT NULL,
	`action` VARCHAR(255) NOT NULL COLLATE 'utf8_unicode_ci',
	PRIMARY KEY (`id`)
)
COLLATE='utf8_unicode_ci'
ENGINE=InnoDB;

ALTER TABLE `group_actions`
  ADD CONSTRAINT FOREIGN KEY (`group_id`) REFERENCES `groups` (`id`) ON DELETE CASCADE;

CREATE TABLE `user_actions` (
	`id` INT(11) NOT NULL AUTO_INCREMENT,
	`user_id` INT(11) NOT NULL,
	`action` VARCHAR(255) NOT NULL COLLATE 'utf8_unicode_ci',
	PRIMARY KEY (`id`)
)
COLLATE='utf8_unicode_ci'
ENGINE=InnoDB;

ALTER TABLE `user_actions`
  ADD CONSTRAINT FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE;


CREATE TABLE `acl_actions` (
	`id` INT(11) NOT NULL AUTO_INCREMENT,
	`action` VARCHAR(255) NOT NULL COLLATE 'utf8_unicode_ci',
	PRIMARY KEY (`id`)
)
COLLATE='utf8_unicode_ci'
ENGINE=InnoDB;

INSERT INTO `acl_actions` (`id`, `action`) VALUES
(1, 'doors'),
(2, 'doors_create'),
(3, 'doors_new'),
(4, 'doors_edit'),
(5, 'doors_update'),
(6, 'doors_delete');

CREATE TABLE `user_aclactions` (
	`user_id` INT(11) NOT NULL,
	`aclactions_id` INT(11) NOT NULL,
	PRIMARY KEY (`user_id`, `aclactions_id`)
)
COLLATE='utf8_unicode_ci' ENGINE=InnoDB;

ALTER TABLE `user_aclactions`
  ADD CONSTRAINT FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE;

ALTER TABLE `user_aclactions`
  ADD CONSTRAINT FOREIGN KEY (`aclactions_id`) REFERENCES `acl_actions` (`id`) ON DELETE CASCADE;

