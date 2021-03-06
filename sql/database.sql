-- MySQL Script generated by MySQL Workbench
-- 06/14/17 17:53:19
-- Model: New Model    Version: 1.0
-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema snoep
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema snoep
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `snoep` DEFAULT CHARACTER SET utf8 ;
USE `snoep` ;

-- -----------------------------------------------------
-- Table `snoep`.`Betaalwijze`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `snoep`.`Betaalwijze` ;

CREATE TABLE IF NOT EXISTS `snoep`.`Betaalwijze` (
  `betaalwijze` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`betaalwijze`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `snoep`.`gebruiker`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `snoep`.`gebruiker` ;

CREATE TABLE IF NOT EXISTS `snoep`.`gebruiker` (
  `email` VARCHAR(50) NOT NULL,
  `voornaam` VARCHAR(45) NOT NULL,
  `tussenvoegsel` VARCHAR(45) NULL,
  `achternaam` VARCHAR(45) NOT NULL,
  `adres` VARCHAR(50) NOT NULL,
  `postcode` VARCHAR(6) NOT NULL,
  `geactiveerd` TINYINT NOT NULL,
  `rol` VARCHAR(45) NOT NULL,
  `wachtwoord` VARCHAR(50) NOT NULL,
  `betaalwijze` VARCHAR(45) NULL,
  PRIMARY KEY (`email`),
  INDEX `fk_gebruiker_betaalwijze_idx` (`betaalwijze` ASC),
  CONSTRAINT `fk_gebruiker_betaalwijze`
    FOREIGN KEY (`betaalwijze`)
    REFERENCES `snoep`.`Betaalwijze` (`betaalwijze`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `snoep`.`artikel`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `snoep`.`artikel` ;

CREATE TABLE IF NOT EXISTS `snoep`.`artikel` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `naam` VARCHAR(45) NOT NULL,
  `omschrijving` VARCHAR(1000) NOT NULL,
  `categorie` VARCHAR(45) NOT NULL,
  `prijs` INT NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `snoep`.`bestelling`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `snoep`.`bestelling` ;

CREATE TABLE IF NOT EXISTS `snoep`.`bestelling` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `gebruiker` VARCHAR(50) NOT NULL,
  `artikel` INT NOT NULL,
  `bezorgen` TINYINT NOT NULL,
  `besteldatum` DATE NOT NULL,
  `betaaldOp` DATE NULL,
  `opmerking` VARCHAR(200) NULL,
  `verstuurd` TINYINT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_bestelling_gebruiker_idx` (`gebruiker` ASC),
  CONSTRAINT `fk_bestelling_gebruiker`
    FOREIGN KEY (`gebruiker`)
    REFERENCES `snoep`.`gebruiker` (`email`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `snoep`.`contact`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `snoep`.`contact` ;

CREATE TABLE IF NOT EXISTS `snoep`.`contact` (
  `email` VARCHAR(50) NOT NULL,
  `bericht` VARCHAR(200) NOT NULL)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `snoep`.`Favoriet`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `snoep`.`Favoriet` ;

CREATE TABLE IF NOT EXISTS `snoep`.`Favoriet` (
  `email` VARCHAR(50) NOT NULL,
  `artikel` INT NOT NULL,
  INDEX `fk_gebruiker_idx` (`email` ASC),
  INDEX `fk_artikel_idx` (`artikel` ASC),
  PRIMARY KEY (`email`, `artikel`),
  CONSTRAINT `fk_gebruiker`
    FOREIGN KEY (`email`)
    REFERENCES `snoep`.`gebruiker` (`email`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_artikel`
    FOREIGN KEY (`artikel`)
    REFERENCES `snoep`.`artikel` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `snoep`.`Artikelbestelling`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `snoep`.`Artikelbestelling` ;

CREATE TABLE IF NOT EXISTS `snoep`.`Artikelbestelling` (
  `id` INT NOT NULL,
  `bestelling` INT NOT NULL,
  `artikel` INT NOT NULL,
  INDEX `fk_bestelling_idx` (`bestelling` ASC),
  INDEX `fk_artikel_idx` (`artikel` ASC),
  PRIMARY KEY (`id`),
  CONSTRAINT `fk_artikelbestelling_bestelling`
    FOREIGN KEY (`bestelling`)
    REFERENCES `snoep`.`bestelling` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_artikelbestelling_artikel`
    FOREIGN KEY (`artikel`)
    REFERENCES `snoep`.`artikel` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `snoep`.`Rol`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `snoep`.`Rol` ;

CREATE TABLE IF NOT EXISTS `snoep`.`Rol` (
  `rol` VARCHAR(45) NOT NULL,
  `omschrijving` VARCHAR(45) NULL,
  PRIMARY KEY (`rol`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `snoep`.`Categorie`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `snoep`.`Categorie` ;

CREATE TABLE IF NOT EXISTS `snoep`.`Categorie` (
  `naam` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`naam`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `snoep`.`Gebruikerrol`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `snoep`.`Gebruikerrol` ;

CREATE TABLE IF NOT EXISTS `snoep`.`Gebruikerrol` (
  `gebruiker` VARCHAR(50) NOT NULL,
  `rol` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`gebruiker`, `rol`),
  INDEX `fk_gebruikerrol_rol_idx` (`rol` ASC),
  CONSTRAINT `fk_gebruikerrol_rol`
    FOREIGN KEY (`rol`)
    REFERENCES `snoep`.`Rol` (`rol`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_gebruikerrol-gebruiker`
    FOREIGN KEY (`gebruiker`)
    REFERENCES `snoep`.`gebruiker` (`email`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;

-- -----------------------------------------------------
-- Data for table `snoep`.`gebruiker`
-- -----------------------------------------------------
START TRANSACTION;
USE `snoep`;
INSERT INTO `snoep`.`gebruiker` (`email`, `voornaam`, `tussenvoegsel`, `achternaam`, `adres`, `postcode`, `geactiveerd`, `rol`, `wachtwoord`, `betaalwijze`) VALUES ('jsdorrestein@gmail.com', 'Jelle', NULL, 'Dorrestein', 'Wiericke 32', '3453MV', 1, 'Admin', 'test', NULL);
INSERT INTO `snoep`.`gebruiker` (`email`, `voornaam`, `tussenvoegsel`, `achternaam`, `adres`, `postcode`, `geactiveerd`, `rol`, `wachtwoord`, `betaalwijze`) VALUES ('test@mail.nl', 'Voornaam', 'Tussenvoegsel', 'Achternaam', 'Straat 1', '0123AB', 1, 'klant', 'test', NULL);

COMMIT;


-- -----------------------------------------------------
-- Data for table `snoep`.`artikel`
-- -----------------------------------------------------
START TRANSACTION;
USE `snoep`;
INSERT INTO `snoep`.`artikel` (`id`, `naam`, `omschrijving`, `categorie`, `prijs`) VALUES (1, 'Gummybear', 'beertjes van winegom', 'Winegums', 5 );
INSERT INTO `snoep`.`artikel` (`id`, `naam`, `omschrijving`, `categorie`, `prijs`) VALUES (2, 'zoute drop', 'Drop met een zoute smaak', 'Drop', 2);

COMMIT;

