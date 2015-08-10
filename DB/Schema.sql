-- MySQL Script generated by MySQL Workbench
-- Dom 09 Ago 2015 18:50:39 BRT
-- Model: New Model    Version: 1.0
-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

SET NAMES 'latin1' COLLATE 'latin1_swedish_ci';

-- -----------------------------------------------------
-- Table `cnae`.`secoes`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `cnae`.`secoes` ;

CREATE TABLE IF NOT EXISTS `cnae`.`secoes` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `cnae_id` VARCHAR(15) NOT NULL,
  `descricao` VARCHAR(255) NOT NULL,
  `criado_em` DATETIME NOT NULL,
  `atualizado_em` DATETIME NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;

CREATE UNIQUE INDEX `id_UNIQUE` ON `cnae`.`secoes` (`id` ASC);


-- -----------------------------------------------------
-- Table `cnae`.`divisoes`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `cnae`.`divisoes` ;

CREATE TABLE IF NOT EXISTS `cnae`.`divisoes` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `secao_id` INT UNSIGNED NOT NULL,
  `cnae_id` VARCHAR(15) NOT NULL,
  `descricao` VARCHAR(255) NOT NULL,
  `criado_em` DATETIME NOT NULL,
  `atualizado_em` DATETIME NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `fk_divisoes_secoes`
    FOREIGN KEY (`secao_id`)
    REFERENCES `cnae`.`secoes` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE UNIQUE INDEX `id_UNIQUE` ON `cnae`.`divisoes` (`id` ASC);

CREATE INDEX `fk_divisoes_secoes_idx` ON `cnae`.`divisoes` (`secao_id` ASC);


-- -----------------------------------------------------
-- Table `cnae`.`grupos`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `cnae`.`grupos` ;

CREATE TABLE IF NOT EXISTS `cnae`.`grupos` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `divisao_id` INT UNSIGNED NOT NULL,
  `cnae_id` VARCHAR(15) NOT NULL,
  `descricao` VARCHAR(255) NOT NULL,
  `criado_em` DATETIME NOT NULL,
  `atualizado_em` DATETIME NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `fk_grupos_divisoes1`
    FOREIGN KEY (`divisao_id`)
    REFERENCES `cnae`.`divisoes` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE INDEX `fk_grupos_divisoes1_idx` ON `cnae`.`grupos` (`divisao_id` ASC);

CREATE UNIQUE INDEX `id_UNIQUE` ON `cnae`.`grupos` (`id` ASC);


-- -----------------------------------------------------
-- Table `cnae`.`classes`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `cnae`.`classes` ;

CREATE TABLE IF NOT EXISTS `cnae`.`classes` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `grupo_id` INT UNSIGNED NOT NULL,
  `cnae_id` VARCHAR(15) NOT NULL,
  `descricao` VARCHAR(255) NOT NULL,
  `criado_em` DATETIME NOT NULL,
  `atualizado_em` DATETIME NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `fk_classes_grupos1`
    FOREIGN KEY (`grupo_id`)
    REFERENCES `cnae`.`grupos` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE INDEX `fk_classes_grupos1_idx` ON `cnae`.`classes` (`grupo_id` ASC);

CREATE UNIQUE INDEX `id_UNIQUE` ON `cnae`.`classes` (`id` ASC);


-- -----------------------------------------------------
-- Table `cnae`.`subclasses`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `cnae`.`subclasses` ;

CREATE TABLE IF NOT EXISTS `cnae`.`subclasses` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `classe_id` INT UNSIGNED NOT NULL,
  `cnae_id` VARCHAR(15) NOT NULL,
  `descricao` VARCHAR(255) NOT NULL,
  `criado_em` DATETIME NOT NULL,
  `atualizado_em` DATETIME NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `fk_subclasses_classes1`
    FOREIGN KEY (`classe_id`)
    REFERENCES `cnae`.`classes` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE UNIQUE INDEX `id_UNIQUE` ON `cnae`.`subclasses` (`id` ASC);

CREATE INDEX `fk_subclasses_classes1_idx` ON `cnae`.`subclasses` (`classe_id` ASC);


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
