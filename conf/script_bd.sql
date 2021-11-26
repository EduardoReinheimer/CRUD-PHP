-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema ATV
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema ATV
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `ATV` DEFAULT CHARACTER SET utf8 ;
USE `ATV` ;

-- -----------------------------------------------------
-- Table `ATV`.`VETOR`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `ATV`.`VETOR` (
  `ID` INT NOT NULL AUTO_INCREMENT,
  `TITLE` VARCHAR(45) NOT NULL,
  `ITENS` MEDIUMTEXT NOT NULL,
  PRIMARY KEY (`ID`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `ATV`.`INFO`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `ATV`.`INFO` (
  `ID` INT NOT NULL AUTO_INCREMENT,
  `DESC` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`ID`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `ATV`.`VALOR`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `ATV`.`VALOR` (
  `INFO_ID` INT NOT NULL,
  `VETOR_ID` INT NOT NULL,
  `VALOR` DOUBLE NOT NULL,
  PRIMARY KEY (`INFO_ID`, `VETOR_ID`),
  CONSTRAINT `fk_VALOR_INFO`
    FOREIGN KEY (`INFO_ID`)
    REFERENCES `ATV`.`INFO` (`ID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_VALOR_VETOR1`
    FOREIGN KEY (`VETOR_ID`)
    REFERENCES `ATV`.`VETOR` (`ID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `ATV`.`USER`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `ATV`.`USER` (
  `ID` INT NOT NULL AUTO_INCREMENT,
  `USERNAME` VARCHAR(45) NOT NULL,
  `PASSWORD` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`ID`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `ATV`.`ENDERECO`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `ATV`.`ENDERECO` (
  `USER_ID` INT NOT NULL,
  `RUA` VARCHAR(120) NOT NULL,
  `NUMERO` INT NOT NULL,
  `COMPLEMENTO` VARCHAR(10) NULL,
  PRIMARY KEY (`USER_ID`),
  CONSTRAINT `fk_table1_USER1`
    FOREIGN KEY (`USER_ID`)
    REFERENCES `ATV`.`USER` (`ID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `ATV`.`VETOR_has_USER`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `ATV`.`VETOR_has_USER` (
  `VETOR_ID` INT NOT NULL,
  `USER_ID` INT NOT NULL,
  PRIMARY KEY (`VETOR_ID`, `USER_ID`),
  CONSTRAINT `fk_VETOR_has_USER_VETOR1`
    FOREIGN KEY (`VETOR_ID`)
    REFERENCES `ATV`.`VETOR` (`ID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_VETOR_has_USER_USER1`
    FOREIGN KEY (`USER_ID`)
    REFERENCES `ATV`.`USER` (`ID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
