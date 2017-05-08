ALTER TABLE  `items_description` DROP FOREIGN KEY  `fk_items_description_1` ;
ALTER TABLE  `items_description` CHANGE  `parant_id`  `agreement_id` INT( 11 ) NULL DEFAULT NULL;
ALTER TABLE  `items_description` ADD FOREIGN KEY (  `agreement_id` ) REFERENCES  `self_storage`.`agreements` (
`id`
) ON DELETE NO ACTION ON UPDATE NO ACTION ;