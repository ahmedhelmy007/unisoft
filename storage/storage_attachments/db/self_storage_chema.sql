-- -----------------------------------------------------
-- Table `rental_periods`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `rental_periods` (
  `id` INT NULL AUTO_INCREMENT ,
  `en_name` VARCHAR(50) NULL ,
  `ar_name` VARCHAR(50) NULL ,
  `unit` VARCHAR(10) NULL ,
  `number_of_units` INT(5) NULL ,
  `created` DATETIME NULL ,
  `modified` DATETIME NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


-- -----------------------------------------------------
-- Table `stores`
-- -----------------------------------------------------
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
ENGINE = InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


-- -----------------------------------------------------
-- Table `nationalities`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `nationalities` (
  `id` INT NULL AUTO_INCREMENT ,
  `en_name` VARCHAR(45) NULL ,
  `ar_name` VARCHAR(45) NULL ,
  `created` DATETIME NULL ,
  `modified` DATETIME NULL ,
  PRIMARY KEY (`id`) ,
  UNIQUE INDEX `id_UNIQUE` (`id` ASC) )
ENGINE = InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


-- -----------------------------------------------------
-- Table `sales_person`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `sales_person` (
  `id` INT NULL AUTO_INCREMENT ,
  `en_name` VARCHAR(45) NULL ,
  `ar_name` VARCHAR(45) NULL ,
  `created` DATETIME NULL ,
  `modified` DATETIME NULL ,
  PRIMARY KEY (`id`) ,
  UNIQUE INDEX `id_UNIQUE` (`id` ASC) )
ENGINE = InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


-- -----------------------------------------------------
-- Table `payment_methods`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `payment_methods` (
  `id` INT NULL AUTO_INCREMENT ,
  `en_name` VARCHAR(45) NULL ,
  `ar_name` VARCHAR(45) NULL ,
  `created` DATETIME NULL ,
  `modified` DATETIME NULL ,
  PRIMARY KEY (`id`) ,
  UNIQUE INDEX `id_UNIQUE` (`id` ASC) )
ENGINE = InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


-- -----------------------------------------------------
-- Table `services`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `services` (
  `id` INT NULL AUTO_INCREMENT ,
  `en_name` VARCHAR(45) NULL ,
  `ar_name` VARCHAR(45) NULL ,
  `created` DATETIME NULL ,
  `modified` DATETIME NULL ,
  PRIMARY KEY (`id`) ,
  UNIQUE INDEX `id_UNIQUE` (`id` ASC) )
ENGINE = InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


-- -----------------------------------------------------
-- Table `customers`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `customers` (
  `id` INT NULL AUTO_INCREMENT ,
  `customer_no` INT NULL ,
  `en_name` VARCHAR(150) NULL ,
  `ar_name` VARCHAR(150) NULL ,
  `civil_id` VARCHAR(45) NULL ,
  `mobile` VARCHAR(45) NULL ,
  `phone` VARCHAR(45) NULL ,
  `fax` VARCHAR(45) NULL ,
  `email` VARCHAR(45) NULL ,
  `nationality_id` INT NULL ,
  `gender` VARCHAR(45) NULL ,
  `contact_person` VARCHAR(45) NULL ,
  `contact_mobile` VARCHAR(45) NULL ,
  `contact_phone` VARCHAR(45) NULL ,
  `address` VARCHAR(255) NULL ,
  `region` VARCHAR(45) NULL ,
  `part` VARCHAR(45) NULL ,
  `gada` VARCHAR(45) NULL ,
  `street` VARCHAR(45) NULL ,
  `house` VARCHAR(45) NULL ,
  `floor` VARCHAR(45) NULL ,
  `flat` VARCHAR(45) NULL ,
  `notes` VARCHAR(45) NULL ,
  `created` DATETIME NULL ,
  `modified` DATETIME NULL ,
  PRIMARY KEY (`id`) ,
  UNIQUE INDEX `id_UNIQUE` (`id` ASC) ,
  UNIQUE INDEX `customer_no_UNIQUE` (`customer_no` ASC) ,
  INDEX `fk_customers_1_idx` (`nationality_id` ASC) ,
  CONSTRAINT `fk_customers_1`
    FOREIGN KEY (`nationality_id` )
    REFERENCES `nationalities` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


-- -----------------------------------------------------
-- Table `customer_service`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `customer_service` (
  `id` INT NULL AUTO_INCREMENT ,
  `customer_id` INT NULL ,
  `service_id` INT NULL ,
  `created` DATETIME NULL ,
  `modified` DATETIME NULL ,
  PRIMARY KEY (`id`) ,
  UNIQUE INDEX `id_UNIQUE` (`id` ASC) ,
  INDEX `fk_customer_service_1_idx` (`customer_id` ASC) ,
  INDEX `fk_customer_service_2_idx` (`service_id` ASC) ,
  CONSTRAINT `fk_customer_service_1`
    FOREIGN KEY (`customer_id` )
    REFERENCES `customers` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_customer_service_2`
    FOREIGN KEY (`service_id` )
    REFERENCES `services` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


-- -----------------------------------------------------
-- Table `agreements`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `agreements` (
  `id` INT NULL AUTO_INCREMENT ,
  `agreement_no` INT NULL ,
  `customer_id` INT NULL ,
  `service_id` INT NULL ,
  `sales_id` INT NULL ,
  `discount_policies` VARCHAR(45) NULL ,
  `rental_period_id` INT NULL ,
  `start_date` DATE NULL ,
  `end_date` DATE NULL ,
  `total_area` FLOAT NULL ,
  `rental_value` FLOAT NULL ,
  `insurance_value` FLOAT NULL ,
  `deposit_value` FLOAT NULL ,
  `other_fees` FLOAT NULL ,
  `total_value` FLOAT NULL ,
  `offer_discount` FLOAT NULL ,
  `other_discount` FLOAT NULL ,
  `net_value` FLOAT NULL ,
  `agreement_type` INT NULL ,
  `created` DATETIME NULL ,
  `modified` DATETIME NULL ,
  PRIMARY KEY (`id`) ,
  UNIQUE INDEX `id_UNIQUE` (`id` ASC) ,
  UNIQUE INDEX `agreement_no_UNIQUE` (`agreement_no` ASC) ,
  INDEX `fk_agreements_1_idx` (`customer_id` ASC) ,
  INDEX `fk_agreements_2_idx` (`service_id` ASC) ,
  INDEX `fk_agreements_3_idx` (`sales_id` ASC) ,
  INDEX `fk_agreements_4_idx` (`rental_period_id` ASC) ,
  INDEX `index8` (`agreement_type` ASC) ,
  CONSTRAINT `fk_agreements_1`
    FOREIGN KEY (`customer_id` )
    REFERENCES `customers` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_agreements_2`
    FOREIGN KEY (`service_id` )
    REFERENCES `services` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_agreements_3`
    FOREIGN KEY (`sales_id` )
    REFERENCES `sales_person` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_agreements_4`
    FOREIGN KEY (`rental_period_id` )
    REFERENCES `rental_periods` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


-- -----------------------------------------------------
-- Table `items_description`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `items_description` (
  `id` INT NULL AUTO_INCREMENT ,
  `parant_id` INT NULL ,
  `description` TEXT NULL ,
  PRIMARY KEY (`id`) ,
  UNIQUE INDEX `id_UNIQUE` (`id` ASC) ,
  INDEX `fk_items_description_1_idx` (`parant_id` ASC) ,
  CONSTRAINT `fk_items_description_1`
    FOREIGN KEY (`parant_id` )
    REFERENCES `agreements` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


-- -----------------------------------------------------
-- Table `rented_stores`
-- -----------------------------------------------------
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
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_rented_stores_2`
    FOREIGN KEY (`parant_id` )
    REFERENCES `agreements` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


-- -----------------------------------------------------
-- Table `authorized_persons`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `authorized_persons` (
  `id` INT NULL AUTO_INCREMENT ,
  `parant_id` INT NULL ,
  `name` VARCHAR(150) NULL ,
  `civil_id` VARCHAR(45) NULL ,
  `phone` VARCHAR(45) NULL ,
  PRIMARY KEY (`id`) ,
  UNIQUE INDEX `id_UNIQUE` (`id` ASC) ,
  INDEX `fk_authorized_persons_1_idx` (`parant_id` ASC) ,
  CONSTRAINT `fk_authorized_persons_1`
    FOREIGN KEY (`parant_id` )
    REFERENCES `agreements` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


-- -----------------------------------------------------
-- Table `stores_rentalperiods`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `stores_rentalperiods` (
  `id` INT NULL AUTO_INCREMENT ,
  `stores_id` INT NULL ,
  `rentalperiods_id` INT NULL ,
  `price` FLOAT NULL ,
  PRIMARY KEY (`id`) ,
  UNIQUE INDEX `id_UNIQUE` (`id` ASC) ,
  INDEX `fk_stores_periods_1_idx` (`stores_id` ASC) ,
  INDEX `fk_stores_periods_2_idx` (`rentalperiods_id` ASC) ,
  CONSTRAINT `fk_stores_periods_1`
    FOREIGN KEY (`stores_id` )
    REFERENCES `stores` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_stores_periods_2`
    FOREIGN KEY (`rentalperiods_id` )
    REFERENCES `rental_periods` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
