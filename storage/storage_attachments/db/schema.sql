
CREATE  TABLE IF NOT EXISTS `stores` (
  `id` INT NULL AUTO_INCREMENT ,
  `name` VARCHAR(45) NULL ,
  `hieght` VARCHAR(45) NULL ,
  `width` VARCHAR(45) NULL ,
  `length` VARCHAR(45) NULL ,
  `size` VARCHAR(45) NULL ,
  `status` VARCHAR(45) NULL ,
  `created` DATETIME NULL ,
  `modified` DATETIME NULL ,
  PRIMARY KEY (`id`) ,
  UNIQUE INDEX `id_UNIQUE` (`id` ASC) )
ENGINE = InnoDB;


CREATE  TABLE IF NOT EXISTS `rental_periods` (
  `id` INT NULL AUTO_INCREMENT ,
  `en_name` VARCHAR(50) NULL ,
  `ar_name` VARCHAR(50) NULL ,
  `unit` VARCHAR(10) NULL ,
  `number_of_units` INT(5) NULL ,
  `created` DATETIME NULL ,
  `modified` DATETIME NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB;


CREATE  TABLE IF NOT EXISTS `rented_stores` (
  `id` INT NULL AUTO_INCREMENT ,
  `parant_id` INT NULL ,
  `store_id` INT NULL ,
  PRIMARY KEY (`id`) ,
  UNIQUE INDEX `id_UNIQUE` (`id` ASC) ,
  INDEX `fk_rented_stores_1_idx` (`store_id` ASC) ,
  INDEX `fk_rented_stores_2_idx` (`parant_id` ASC) ,
  CONSTRAINT `fk_rented_stores_1`
    FOREIGN KEY (`store_id` )
    REFERENCES `stores` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


CREATE  TABLE IF NOT EXISTS `stores_periods` (
  `id` INT NULL AUTO_INCREMENT ,
  `store_id` INT NULL ,
  `period_id` INT NULL ,
  PRIMARY KEY (`id`) ,
  UNIQUE INDEX `id_UNIQUE` (`id` ASC) ,
  INDEX `fk_stores_periods_1_idx` (`store_id` ASC) ,
  INDEX `fk_stores_periods_2_idx` (`period_id` ASC) ,
  CONSTRAINT `fk_stores_periods_1`
    FOREIGN KEY (`store_id` )
    REFERENCES `stores` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_stores_periods_2`
    FOREIGN KEY (`period_id` )
    REFERENCES `rental_periods` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

