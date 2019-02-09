-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------
-- -----------------------------------------------------
-- Schema base_dados
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema base_dados
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `base_dados` DEFAULT CHARACTER SET utf8 ;
USE `base_dados` ;

-- -----------------------------------------------------
-- Table `base_dados`.`users`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `base_dados`.`users` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(255) NOT NULL,
  `last_name` VARCHAR(255) NOT NULL,
  `about` VARCHAR(150) NOT NULL,
  `avatar` VARCHAR(255) NOT NULL,
  `email` VARCHAR(255) NOT NULL,
  `password` VARCHAR(255) NOT NULL,
  `remember_token` VARCHAR(100) NULL DEFAULT NULL,
  `created_at` TIMESTAMP NULL DEFAULT NULL,
  `updated_at` TIMESTAMP NULL DEFAULT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
AUTO_INCREMENT = 0
DEFAULT CHARACTER SET = utf8;

CREATE UNIQUE INDEX `email_UNIQUE` ON `base_dados`.`users` (`email` ASC);


-- -----------------------------------------------------
-- Table `base_dados`.`files`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `base_dados`.`files` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `url` VARCHAR(200) CHARACTER SET 'utf8' NOT NULL,
  `group` VARCHAR(50) NOT NULL,
  `comment` VARCHAR(61) CHARACTER SET 'utf8' NOT NULL,
  `id_user` INT(11) NOT NULL,
  `private` VARCHAR(1) NOT NULL,
  `created_at` TIMESTAMP NULL DEFAULT NULL,
  `updated_at` TIMESTAMP NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `fk_file_user`
    FOREIGN KEY (`id_user`)
    REFERENCES `base_dados`.`users` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
AUTO_INCREMENT = 0
DEFAULT CHARACTER SET = utf8;

CREATE INDEX `fk_data_user_idx` ON `base_dados`.`files` (`id_user` ASC) ;


-- -----------------------------------------------------
-- Table `base_dados`.`followers`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `base_dados`.`followers` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `id_user` INT(11) NULL DEFAULT NULL,
  `id_follower` INT(11) NULL DEFAULT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
AUTO_INCREMENT = 0
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `base_dados`.`migrations`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `base_dados`.`migrations` (
  `migration` VARCHAR(255) NOT NULL,
  `batch` INT(11) NOT NULL)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_unicode_ci;


-- -----------------------------------------------------
-- Table `base_dados`.`notification`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `base_dados`.`notification` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `user_id` INT(11) NULL DEFAULT NULL,
  `file_id` INT(11) NULL DEFAULT NULL,
  `date` DATETIME NULL DEFAULT NULL,
  `created_at` TIMESTAMP NULL DEFAULT NULL,
  `updated_at` TIMESTAMP NULL DEFAULT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
AUTO_INCREMENT = 0
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `base_dados`.`notification_users`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `base_dados`.`notification_users` (
  `id_notification` INT(11) NOT NULL,
  `id_user` INT(11) NOT NULL,
  `is_read` INT(11) NOT NULL,
  `created_at` TIMESTAMP NULL DEFAULT NULL,
  `updated_at` TIMESTAMP NULL DEFAULT NULL,
  CONSTRAINT `fk_notification_users_notification1`
    FOREIGN KEY (`id_notification`)
    REFERENCES `base_dados`.`notification` (`id`)
    ON DELETE CASCADE
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

CREATE INDEX `fk_notification_users_notification1_idx` ON `base_dados`.`notification_users` (`id_notification` ASC) ;


-- -----------------------------------------------------
-- Table `base_dados`.`password_resets`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `base_dados`.`password_resets` (
  `email` VARCHAR(255) NOT NULL,
  `token` VARCHAR(255) NOT NULL,
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_unicode_ci;

CREATE INDEX `password_resets_email_index` ON `base_dados`.`password_resets` (`email` ASC) ;

CREATE INDEX `password_resets_token_index` ON `base_dados`.`password_resets` (`token` ASC) ;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
