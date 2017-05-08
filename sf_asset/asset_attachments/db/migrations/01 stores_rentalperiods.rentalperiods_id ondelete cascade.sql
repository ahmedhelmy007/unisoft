

ALTER TABLE `stores_rentalperiods` DROP FOREIGN KEY `fk_stores_periods_2` ,
ADD FOREIGN KEY ( `rentalperiods_id` ) REFERENCES `self_storage`.`rental_periods` (
`id`
) ON DELETE CASCADE ON UPDATE NO ACTION ;
