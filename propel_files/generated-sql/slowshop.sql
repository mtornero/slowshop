
# This is a fix for InnoDB in MySQL >= 4.1.x
# It "suspends judgement" for fkey relationships until are tables are set.
SET FOREIGN_KEY_CHECKS = 0;

-- ---------------------------------------------------------------------
-- category
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `category`;

CREATE TABLE `category`
(
    `category_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
    `resource_id` int(10) unsigned NOT NULL,
    `category_name` VARCHAR(60) NOT NULL,
    `category_description` VARCHAR(250),
    `category_pic` int(10) unsigned,
    `created_at` DATETIME,
    `updated_at` DATETIME,
    `tree_left` INTEGER,
    `tree_right` INTEGER,
    `tree_level` INTEGER,
    PRIMARY KEY (`category_id`),
    INDEX `fk_category_1_idx` (`resource_id`),
    INDEX `fk_category_2_idx` (`category_pic`),
    CONSTRAINT `fk_category_1`
        FOREIGN KEY (`resource_id`)
        REFERENCES `resource` (`resource_id`)
        ON UPDATE CASCADE,
    CONSTRAINT `fk_category_2`
        FOREIGN KEY (`category_pic`)
        REFERENCES `file` (`file_id`)
        ON UPDATE CASCADE
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- delivery
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `delivery`;

CREATE TABLE `delivery`
(
    `delivery_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
    `delivery_type_id` mediumint(8) unsigned NOT NULL,
    `delivery_date` DATETIME,
    `created_at` DATETIME,
    `updated_at` DATETIME,
    PRIMARY KEY (`delivery_id`),
    INDEX `fk_delivery_1_idx` (`delivery_type_id`),
    CONSTRAINT `fk_delivery_1`
        FOREIGN KEY (`delivery_type_id`)
        REFERENCES `delivery_type` (`delivery_type_id`)
        ON UPDATE CASCADE
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- delivery_periodic
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `delivery_periodic`;

CREATE TABLE `delivery_periodic`
(
    `delivery_periodic_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
    `delivery_id` int(10) unsigned NOT NULL,
    `delivery_periodic_plan_id` int(10) unsigned NOT NULL,
    `created_at` DATETIME,
    `updated_at` DATETIME,
    `sortable_rank` INTEGER,
    PRIMARY KEY (`delivery_periodic_id`),
    INDEX `fk_delivery_periodic_1_idx` (`delivery_id`),
    INDEX `fk_delivery_periodic_2_idx` (`delivery_periodic_plan_id`),
    CONSTRAINT `fk_delivery_periodic_1`
        FOREIGN KEY (`delivery_id`)
        REFERENCES `delivery` (`delivery_id`)
        ON UPDATE CASCADE,
    CONSTRAINT `fk_delivery_periodic_2`
        FOREIGN KEY (`delivery_periodic_plan_id`)
        REFERENCES `periodic_plan` (`periodic_plan_id`)
        ON UPDATE CASCADE
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- delivery_type
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `delivery_type`;

CREATE TABLE `delivery_type`
(
    `delivery_type_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
    `delivery_type_code` VARCHAR(45) NOT NULL,
    `delivery_type_is_active` tinyint(1) unsigned NOT NULL,
    PRIMARY KEY (`delivery_type_id`),
    UNIQUE INDEX `delivery_type_code_UNIQUE` (`delivery_type_code`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- file
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `file`;

CREATE TABLE `file`
(
    `file_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
    `file_type_id` mediumint(8) unsigned NOT NULL,
    `file_path` VARCHAR(45) NOT NULL,
    `created_at` DATETIME,
    `updated_at` DATETIME,
    PRIMARY KEY (`file_id`),
    INDEX `fk_file_1_idx` (`file_type_id`),
    CONSTRAINT `fk_file_1`
        FOREIGN KEY (`file_type_id`)
        REFERENCES `file_type` (`file_type_id`)
        ON UPDATE CASCADE
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- file_type
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `file_type`;

CREATE TABLE `file_type`
(
    `file_type_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
    `file_type_code` VARCHAR(45) NOT NULL,
    PRIMARY KEY (`file_type_id`),
    UNIQUE INDEX `file_type_code_UNIQUE` (`file_type_code`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- order
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `order`;

CREATE TABLE `order`
(
    `order_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
    `user_id` int(10) unsigned NOT NULL,
    `delivery_id` int(10) unsigned NOT NULL,
    `order_comment` VARCHAR(250),
    `created_at` DATETIME,
    `updated_at` DATETIME,
    PRIMARY KEY (`order_id`),
    INDEX `fk_order_1_idx` (`user_id`),
    INDEX `fk_order_2_idx` (`delivery_id`),
    CONSTRAINT `fk_order_1`
        FOREIGN KEY (`user_id`)
        REFERENCES `user` (`user_id`)
        ON UPDATE CASCADE,
    CONSTRAINT `fk_order_2`
        FOREIGN KEY (`delivery_id`)
        REFERENCES `delivery` (`delivery_id`)
        ON UPDATE CASCADE
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- order_product
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `order_product`;

CREATE TABLE `order_product`
(
    `order_product_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
    `order_id` int(10) unsigned NOT NULL,
    `product_id` int(10) unsigned NOT NULL,
    `product_quantity` INTEGER NOT NULL,
    `created_at` DATETIME,
    `updated_at` DATETIME,
    PRIMARY KEY (`order_product_id`),
    INDEX `fk_order_product_1_idx` (`order_id`),
    INDEX `fk_order_product_2_idx` (`product_id`),
    CONSTRAINT `fk_order_product_1`
        FOREIGN KEY (`order_id`)
        REFERENCES `order` (`order_id`)
        ON UPDATE CASCADE,
    CONSTRAINT `fk_order_product_2`
        FOREIGN KEY (`product_id`)
        REFERENCES `product` (`product_id`)
        ON UPDATE CASCADE
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- periodic_plan
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `periodic_plan`;

CREATE TABLE `periodic_plan`
(
    `periodic_plan_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
    `periodic_plan_name` VARCHAR(60) NOT NULL,
    `periodic_plan_point` VARCHAR(250),
    `periodic_type_id` tinyint(3) unsigned NOT NULL,
    `delievery_periodic_weekday` TINYINT NOT NULL,
    `created_at` DATETIME,
    `updated_at` DATETIME,
    PRIMARY KEY (`periodic_plan_id`),
    INDEX `fk_delievery_periodic_plan_1_idx` (`periodic_type_id`),
    CONSTRAINT `fk_delievery_periodic_plan_1`
        FOREIGN KEY (`periodic_type_id`)
        REFERENCES `periodic_type` (`periodic_type_id`)
        ON UPDATE CASCADE
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- periodic_plan_exception
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `periodic_plan_exception`;

CREATE TABLE `periodic_plan_exception`
(
    `periodic_plan_exception_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
    `periodic_plan_id` int(10) unsigned NOT NULL,
    `periodic_plan_exception_type` TINYINT(1) NOT NULL,
    `periodic_plan_exception_date` DATE NOT NULL,
    `created_at` DATETIME,
    `updated_at` DATETIME,
    PRIMARY KEY (`periodic_plan_exception_id`),
    INDEX `fk_periodic_plan_exception_1_idx` (`periodic_plan_id`),
    CONSTRAINT `fk_periodic_plan_exception_1`
        FOREIGN KEY (`periodic_plan_id`)
        REFERENCES `periodic_plan` (`periodic_plan_id`)
        ON UPDATE CASCADE
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- periodic_type
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `periodic_type`;

CREATE TABLE `periodic_type`
(
    `periodic_type_id` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
    `periodic_type_code` VARCHAR(45) NOT NULL,
    `periodic_type_is_active` tinyint(1) unsigned NOT NULL,
    PRIMARY KEY (`periodic_type_id`),
    UNIQUE INDEX `periodic_type_code_UNIQUE` (`periodic_type_code`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- product
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `product`;

CREATE TABLE `product`
(
    `product_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
    `resource_id` int(10) unsigned NOT NULL,
    `product_name` VARCHAR(60) NOT NULL,
    `product_description` VARCHAR(250),
    `category_id` int(10) unsigned NOT NULL,
    `unit_id` tinyint(3) unsigned NOT NULL,
    `product_range` VARCHAR(45),
    `product_price` DECIMAL(10,2) NOT NULL,
    `product_is_active` TINYINT(3) NOT NULL,
    `product_pic` int(10) unsigned,
    `created_at` DATETIME,
    `updated_at` DATETIME,
    PRIMARY KEY (`product_id`),
    INDEX `fk_product_1_idx` (`category_id`),
    INDEX `fk_product_2_idx` (`unit_id`),
    INDEX `fk_product_3_idx` (`product_pic`),
    INDEX `fk_product_4_idx` (`resource_id`),
    CONSTRAINT `fk_product_1`
        FOREIGN KEY (`category_id`)
        REFERENCES `category` (`category_id`)
        ON UPDATE CASCADE,
    CONSTRAINT `fk_product_2`
        FOREIGN KEY (`unit_id`)
        REFERENCES `unit` (`unit_id`)
        ON UPDATE CASCADE,
    CONSTRAINT `fk_product_3`
        FOREIGN KEY (`product_pic`)
        REFERENCES `file` (`file_id`)
        ON UPDATE CASCADE,
    CONSTRAINT `fk_product_4`
        FOREIGN KEY (`resource_id`)
        REFERENCES `resource` (`resource_id`)
        ON UPDATE CASCADE
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- promotion
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `promotion`;

CREATE TABLE `promotion`
(
    `promotion_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
    `resource_id` int(10) unsigned NOT NULL,
    `promotion_type_id` smallint(5) unsigned NOT NULL,
    `promotion_value` DECIMAL(10,2),
    `promotion_gift` int(10) unsigned,
    `promotion_starting_point` INTEGER,
    `promotion_starting_date` DATE,
    `promotion_ending_date` DATE,
    `promotion_is_active` tinyint(1) unsigned,
    `created_at` DATETIME,
    `updated_at` DATETIME,
    PRIMARY KEY (`promotion_id`),
    INDEX `fk_discount_1_idx` (`resource_id`),
    INDEX `fk_discount_2_idx` (`promotion_type_id`),
    CONSTRAINT `fk_promotion_1`
        FOREIGN KEY (`resource_id`)
        REFERENCES `resource` (`resource_id`)
        ON UPDATE CASCADE,
    CONSTRAINT `fk_promotion_2`
        FOREIGN KEY (`promotion_type_id`)
        REFERENCES `promotion_type` (`promotion_type_id`)
        ON UPDATE CASCADE
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- promotion_type
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `promotion_type`;

CREATE TABLE `promotion_type`
(
    `promotion_type_id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
    `promotion_type_code` VARCHAR(45) NOT NULL,
    PRIMARY KEY (`promotion_type_id`),
    UNIQUE INDEX `promotion_type_code_UNIQUE` (`promotion_type_code`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- resource
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `resource`;

CREATE TABLE `resource`
(
    `resource_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
    `resource_type_id` int(10) unsigned NOT NULL,
    PRIMARY KEY (`resource_id`),
    INDEX `fk_resource_1_idx` (`resource_type_id`),
    CONSTRAINT `fk_resource_1`
        FOREIGN KEY (`resource_type_id`)
        REFERENCES `resource_type` (`resource_type_id`)
        ON UPDATE CASCADE
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- resource_file
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `resource_file`;

CREATE TABLE `resource_file`
(
    `resource_file_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
    `resource_id` int(10) unsigned NOT NULL,
    `file_id` int(10) unsigned NOT NULL,
    `resource_file_is_public` TINYINT(1) NOT NULL,
    PRIMARY KEY (`resource_file_id`),
    INDEX `fk_resource_file_1_idx` (`resource_id`),
    INDEX `fk_resource_file_2_idx` (`file_id`),
    CONSTRAINT `fk_resource_file_1`
        FOREIGN KEY (`resource_id`)
        REFERENCES `resource` (`resource_id`)
        ON UPDATE CASCADE,
    CONSTRAINT `fk_resource_file_2`
        FOREIGN KEY (`file_id`)
        REFERENCES `file` (`file_id`)
        ON UPDATE CASCADE
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- resource_type
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `resource_type`;

CREATE TABLE `resource_type`
(
    `resource_type_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
    `resource_type_code` VARCHAR(45) NOT NULL,
    PRIMARY KEY (`resource_type_id`),
    UNIQUE INDEX `resource_type_code_UNIQUE` (`resource_type_code`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- role
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `role`;

CREATE TABLE `role`
(
    `role_id` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
    `role_code` VARCHAR(45) NOT NULL,
    PRIMARY KEY (`role_id`),
    UNIQUE INDEX `role_code_UNIQUE` (`role_code`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- unit
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `unit`;

CREATE TABLE `unit`
(
    `unit_id` tinyint(3) unsigned NOT NULL,
    PRIMARY KEY (`unit_id`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- user
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `user`;

CREATE TABLE `user`
(
    `user_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
    `resource_id` int(10) unsigned NOT NULL,
    `use_name` VARCHAR(60) NOT NULL,
    `user_surname` VARCHAR(60),
    `user_login` VARCHAR(60) NOT NULL,
    `user_pass` VARCHAR(60) NOT NULL,
    `user_pass_is_temp` VARCHAR(45) NOT NULL,
    `user_email` VARCHAR(100),
    `user_phone` VARCHAR(45),
    `user_address` VARCHAR(250),
    `role_id` tinyint(3) unsigned NOT NULL,
    `user_is_active` TINYINT(1) NOT NULL,
    `user_pic` int(10) unsigned,
    `created_at` DATETIME,
    `updated_at` DATETIME,
    PRIMARY KEY (`user_id`),
    INDEX `fk_user_1_idx` (`user_pic`),
    INDEX `fk_user_2_idx` (`role_id`),
    INDEX `fk_user_3_idx` (`resource_id`),
    CONSTRAINT `fk_user_1`
        FOREIGN KEY (`user_pic`)
        REFERENCES `file` (`file_id`)
        ON UPDATE CASCADE,
    CONSTRAINT `fk_user_2`
        FOREIGN KEY (`role_id`)
        REFERENCES `role` (`role_id`)
        ON UPDATE CASCADE,
    CONSTRAINT `fk_user_3`
        FOREIGN KEY (`resource_id`)
        REFERENCES `resource` (`resource_id`)
        ON UPDATE CASCADE
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- user_periodic_plan
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `user_periodic_plan`;

CREATE TABLE `user_periodic_plan`
(
    `user_periodic_plan_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
    `user_id` int(10) unsigned NOT NULL,
    `periodic_plan_id` int(10) unsigned NOT NULL,
    `created_at` DATETIME,
    `updated_at` DATETIME,
    PRIMARY KEY (`user_periodic_plan_id`),
    INDEX `fk_user_periodic_plan_1_idx` (`user_id`),
    INDEX `fk_user_periodic_plan_2_idx` (`periodic_plan_id`),
    CONSTRAINT `fk_user_periodic_plan_1`
        FOREIGN KEY (`user_id`)
        REFERENCES `user` (`user_id`)
        ON UPDATE CASCADE,
    CONSTRAINT `fk_user_periodic_plan_2`
        FOREIGN KEY (`periodic_plan_id`)
        REFERENCES `periodic_plan` (`periodic_plan_id`)
        ON UPDATE CASCADE
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- delivery_type_i18n
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `delivery_type_i18n`;

CREATE TABLE `delivery_type_i18n`
(
    `delivery_type_id` mediumint(8) unsigned NOT NULL,
    `locale` VARCHAR(5) DEFAULT 'en_US' NOT NULL,
    `delivery_type_name` VARCHAR(60) NOT NULL,
    PRIMARY KEY (`delivery_type_id`,`locale`),
    CONSTRAINT `delivery_type_i18n_fk_9616b6`
        FOREIGN KEY (`delivery_type_id`)
        REFERENCES `delivery_type` (`delivery_type_id`)
        ON DELETE CASCADE
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- file_type_i18n
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `file_type_i18n`;

CREATE TABLE `file_type_i18n`
(
    `file_type_id` mediumint(8) unsigned NOT NULL,
    `locale` VARCHAR(5) DEFAULT 'en_US' NOT NULL,
    `file_type_name` VARCHAR(60) NOT NULL,
    PRIMARY KEY (`file_type_id`,`locale`),
    CONSTRAINT `file_type_i18n_fk_06f6fd`
        FOREIGN KEY (`file_type_id`)
        REFERENCES `file_type` (`file_type_id`)
        ON DELETE CASCADE
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- periodic_type_i18n
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `periodic_type_i18n`;

CREATE TABLE `periodic_type_i18n`
(
    `periodic_type_id` tinyint(3) unsigned NOT NULL,
    `locale` VARCHAR(5) DEFAULT 'en_US' NOT NULL,
    `periodic_type_name` VARCHAR(45) NOT NULL,
    PRIMARY KEY (`periodic_type_id`,`locale`),
    CONSTRAINT `periodic_type_i18n_fk_6564d9`
        FOREIGN KEY (`periodic_type_id`)
        REFERENCES `periodic_type` (`periodic_type_id`)
        ON DELETE CASCADE
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- promotion_type_i18n
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `promotion_type_i18n`;

CREATE TABLE `promotion_type_i18n`
(
    `promotion_type_id` smallint(5) unsigned NOT NULL,
    `locale` VARCHAR(5) DEFAULT 'en_US' NOT NULL,
    `promotion_type_name` VARCHAR(60) NOT NULL,
    PRIMARY KEY (`promotion_type_id`,`locale`),
    CONSTRAINT `promotion_type_i18n_fk_59212b`
        FOREIGN KEY (`promotion_type_id`)
        REFERENCES `promotion_type` (`promotion_type_id`)
        ON DELETE CASCADE
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- resource_type_i18n
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `resource_type_i18n`;

CREATE TABLE `resource_type_i18n`
(
    `resource_type_id` int(10) unsigned NOT NULL,
    `locale` VARCHAR(5) DEFAULT 'en_US' NOT NULL,
    `resource_type_name` VARCHAR(60) NOT NULL,
    PRIMARY KEY (`resource_type_id`,`locale`),
    CONSTRAINT `resource_type_i18n_fk_d06c02`
        FOREIGN KEY (`resource_type_id`)
        REFERENCES `resource_type` (`resource_type_id`)
        ON DELETE CASCADE
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- role_i18n
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `role_i18n`;

CREATE TABLE `role_i18n`
(
    `role_id` tinyint(3) unsigned NOT NULL,
    `locale` VARCHAR(5) DEFAULT 'en_US' NOT NULL,
    `role_name` VARCHAR(60) NOT NULL,
    PRIMARY KEY (`role_id`,`locale`),
    CONSTRAINT `role_i18n_fk_a365e4`
        FOREIGN KEY (`role_id`)
        REFERENCES `role` (`role_id`)
        ON DELETE CASCADE
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- unit_i18n
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `unit_i18n`;

CREATE TABLE `unit_i18n`
(
    `unit_id` tinyint(3) unsigned NOT NULL,
    `locale` VARCHAR(5) DEFAULT 'en_US' NOT NULL,
    `unit_name` VARCHAR(60) NOT NULL,
    PRIMARY KEY (`unit_id`,`locale`),
    CONSTRAINT `unit_i18n_fk_a8ddd7`
        FOREIGN KEY (`unit_id`)
        REFERENCES `unit` (`unit_id`)
        ON DELETE CASCADE
) ENGINE=InnoDB;

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
