-- MySQL Script generated by MySQL Workbench
-- 05/09/17 12:32:05
-- Model: New Model    Version: 1.0
-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema prozzl_test
-- -----------------------------------------------------
DROP SCHEMA IF EXISTS `prozzl_test` ;

-- -----------------------------------------------------
-- Schema prozzl_test
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `prozzl_test` DEFAULT CHARACTER SET utf8 ;
SHOW WARNINGS;
USE `prozzl_test` ;

-- -----------------------------------------------------
-- Table `prozzl_test`.`employe`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `prozzl_test`.`employe` ;

SHOW WARNINGS;
CREATE TABLE IF NOT EXISTS `prozzl_test`.`employe` (
  `id_employe` INT NOT NULL AUTO_INCREMENT,
  `nom_employe` VARCHAR(45) NOT NULL,
  `prenom_employe` VARCHAR(45) NOT NULL,
  `date_naissance_employe` DATE NULL,
  `employe_travaille` TINYINT(1) NULL,
  PRIMARY KEY (`id_employe`))
ENGINE = InnoDB;

SHOW WARNINGS;

-- -----------------------------------------------------
-- Table `prozzl_test`.`adresse`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `prozzl_test`.`adresse` ;

SHOW WARNINGS;
CREATE TABLE IF NOT EXISTS `prozzl_test`.`adresse` (
  `id_adresse` INT NOT NULL AUTO_INCREMENT,
  `rue` VARCHAR(100) NOT NULL,
  `ville` VARCHAR(45) NOT NULL,
  `code_postal` VARCHAR(5) NOT NULL,
  PRIMARY KEY (`id_adresse`))
ENGINE = InnoDB;

SHOW WARNINGS;

-- -----------------------------------------------------
-- Table `prozzl_test`.`entreprise`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `prozzl_test`.`entreprise` ;

SHOW WARNINGS;
CREATE TABLE IF NOT EXISTS `prozzl_test`.`entreprise` (
  `id_entreprise` INT NOT NULL AUTO_INCREMENT,
  `nom_entreprise` VARCHAR(45) NOT NULL,
  `nombre_employes` INT NULL,
  `recherche_employes` TINYINT(1) NULL,
  `secteur_activite_entreprise` VARCHAR(45) NULL,
  `anne_creation_entreprise` INT(11) NULL,
  `age_moyen_entreprise` SMALLINT(6) NULL,
  PRIMARY KEY (`id_entreprise`))
ENGINE = InnoDB;

SHOW WARNINGS;

-- -----------------------------------------------------
-- Table `prozzl_test`.`job`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `prozzl_test`.`job` ;

SHOW WARNINGS;
CREATE TABLE IF NOT EXISTS `prozzl_test`.`job` (
  `id_travaille` INT NOT NULL AUTO_INCREMENT,
  `date_debut_contrat` DATE NOT NULL,
  `date_fin_contrat` DATE NULL,
  `duree_contrat` INT NULL,
  `id_employe` INT NOT NULL,
  `id_entreprise` INT NOT NULL,
  PRIMARY KEY (`id_travaille`),
  INDEX `index_id_employe_travaille_employe` (`id_employe` ASC),
  INDEX `index_id_entreprise_travaille_entreprise` (`id_entreprise` ASC),
  CONSTRAINT `fk_id_employe_travaille_employe`
    FOREIGN KEY (`id_employe`)
    REFERENCES `prozzl_test`.`employe` (`id_employe`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_id_entreprise_ttravaille_entreprise`
    FOREIGN KEY (`id_entreprise`)
    REFERENCES `prozzl_test`.`entreprise` (`id_entreprise`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

SHOW WARNINGS;

-- -----------------------------------------------------
-- Table `prozzl_test`.`criteres_notation_employe`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `prozzl_test`.`criteres_notation_employe` ;

SHOW WARNINGS;
CREATE TABLE IF NOT EXISTS `prozzl_test`.`criteres_notation_employe` (
  `id_critere_notation_employe` INT NOT NULL AUTO_INCREMENT,
  `nom_critere_employe` VARCHAR(350) NOT NULL,
  `critere_note_employe` TINYINT(1) NOT NULL,
  `description_critere_employe` VARCHAR(200) NOT NULL,
  PRIMARY KEY (`id_critere_notation_employe`))
ENGINE = InnoDB;

SHOW WARNINGS;

-- -----------------------------------------------------
-- Table `prozzl_test`.`utilisateur`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `prozzl_test`.`utilisateur` ;

SHOW WARNINGS;
CREATE TABLE IF NOT EXISTS `prozzl_test`.`utilisateur` (
  `id_utilisateur` INT NOT NULL AUTO_INCREMENT,
  `mail` VARCHAR(45) NOT NULL,
  `mot_de_passe` VARCHAR(100) NOT NULL,
  `role` VARCHAR(45) NOT NULL,
  `date_creation_utilisateur` DATETIME NOT NULL,
  `date_derniere_connexion` DATETIME NOT NULL,
  `telephone` VARCHAR(10) NULL,
  `telephone2` VARCHAR(10) NULL,
  `id_employe` INT NULL,
  `id_entreprise` INT NULL,
  `site_web` VARCHAR(255) NULL,
  `id_adresse` INT NOT NULL,
  PRIMARY KEY (`id_utilisateur`),
  UNIQUE INDEX `id_user_UNIQUE` (`id_utilisateur` ASC),
  INDEX `fk_id_employe_utilisateur_employe` (`id_employe` ASC),
  INDEX `fk_id_entreprise_utilisateur_entreprise` (`id_entreprise` ASC),
  INDEX `fk_id_adresse` (`id_adresse` ASC),
  CONSTRAINT `fk_id_employe_utilisateur_employe`
    FOREIGN KEY (`id_employe`)
    REFERENCES `prozzl_test`.`employe` (`id_employe`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_id_entreprise_utilisateur_entreprise`
    FOREIGN KEY (`id_entreprise`)
    REFERENCES `prozzl_test`.`entreprise` (`id_entreprise`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_id_adresse`
    FOREIGN KEY (`id_adresse`)
    REFERENCES `prozzl_test`.`adresse` (`id_adresse`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

SHOW WARNINGS;

-- -----------------------------------------------------
-- Table `prozzl_test`.`avis_entreprise`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `prozzl_test`.`avis_entreprise` ;

SHOW WARNINGS;
CREATE TABLE IF NOT EXISTS `prozzl_test`.`avis_entreprise` (
  `id_avis_entreprise` INT NOT NULL AUTO_INCREMENT,
  `note_generale_avis_entreprise` INT NOT NULL,
  `date_creation_avis_entreprise` DATETIME NOT NULL,
  `nb_signalements_avis_entreprise` INT NOT NULL,
  `id_entreprise` INT NOT NULL,
  `id_utilisateur` INT NOT NULL,
  PRIMARY KEY (`id_avis_entreprise`),
  INDEX `index_id_entreprise_avis_entreprise` (`id_entreprise` ASC),
  INDEX `index_id_utilisateur_utilisateur` (`id_utilisateur` ASC),
  CONSTRAINT `fk_id_entreprise_avis_entreprise`
    FOREIGN KEY (`id_entreprise`)
    REFERENCES `prozzl_test`.`entreprise` (`id_entreprise`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_id_utilisateur_utilisateur`
    FOREIGN KEY (`id_utilisateur`)
    REFERENCES `prozzl_test`.`utilisateur` (`id_utilisateur`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

SHOW WARNINGS;

-- -----------------------------------------------------
-- Table `prozzl_test`.`criteres_notation_entreprise`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `prozzl_test`.`criteres_notation_entreprise` ;

SHOW WARNINGS;
CREATE TABLE IF NOT EXISTS `prozzl_test`.`criteres_notation_entreprise` (
  `id_critere_notation_entreprise` INT NOT NULL AUTO_INCREMENT,
  `nom_critere_entreprise` VARCHAR(30) NOT NULL,
  `critere_note_entreprise` TINYINT(1) NOT NULL,
  `description_critere_entreprise` VARCHAR(200) NOT NULL,
  PRIMARY KEY (`id_critere_notation_entreprise`))
ENGINE = InnoDB;

SHOW WARNINGS;

-- -----------------------------------------------------
-- Table `prozzl_test`.`avis_employe`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `prozzl_test`.`avis_employe` ;

SHOW WARNINGS;
CREATE TABLE IF NOT EXISTS `prozzl_test`.`avis_employe` (
  `id_avis_employe` INT NOT NULL AUTO_INCREMENT,
  `note_generale_avis_employe` INT NOT NULL,
  `date_creation_avis_employe` DATETIME NOT NULL,
  `nb_signalements_avis_employe` VARCHAR(300) NOT NULL,
  `id_employe` INT NOT NULL,
  `id_utilisateur` INT NOT NULL,
  PRIMARY KEY (`id_avis_employe`),
  INDEX `index_id_employe_avis_employe` (`id_employe` ASC),
  INDEX `index_id_utilisateur_avis_employeutilisateur` (`id_utilisateur` ASC),
  CONSTRAINT `fk_id_employe_avis_employe`
    FOREIGN KEY (`id_employe`)
    REFERENCES `prozzl_test`.`employe` (`id_employe`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_id_utilisateur_avis_employe_utilisateur`
    FOREIGN KEY (`id_utilisateur`)
    REFERENCES `prozzl_test`.`utilisateur` (`id_utilisateur`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

SHOW WARNINGS;

-- -----------------------------------------------------
-- Table `prozzl_test`.`entreprise_avis_critere`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `prozzl_test`.`entreprise_avis_critere` ;

SHOW WARNINGS;
CREATE TABLE IF NOT EXISTS `prozzl_test`.`entreprise_avis_critere` (
  `id_entreprise_avis_critere` INT NOT NULL AUTO_INCREMENT,
  `note_entreprise_avis` INT NULL,
  `commentaire_evaluation_critere` VARCHAR(300) NULL,
  `id_critere_notation_entreprise` INT NOT NULL,
  `id_avis_entreprise` INT NOT NULL,
  PRIMARY KEY (`id_entreprise_avis_critere`),
  INDEX `index_id_critere_avis_critere_employe` (`id_critere_notation_entreprise` ASC),
  INDEX `index_id_avis_entreprise_avis_critere_avis_entreprise` (`id_avis_entreprise` ASC),
  CONSTRAINT `fk_id_critere_avis_critere_employe`
    FOREIGN KEY (`id_critere_notation_entreprise`)
    REFERENCES `prozzl_test`.`criteres_notation_entreprise` (`id_critere_notation_entreprise`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_id_avis_entreprise_avis_critere_avis_entreprise`
    FOREIGN KEY (`id_avis_entreprise`)
    REFERENCES `prozzl_test`.`avis_entreprise` (`id_avis_entreprise`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

SHOW WARNINGS;

-- -----------------------------------------------------
-- Table `prozzl_test`.`employe_avis_critere`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `prozzl_test`.`employe_avis_critere` ;

SHOW WARNINGS;
CREATE TABLE IF NOT EXISTS `prozzl_test`.`employe_avis_critere` (
  `id_employe_avis_critere` INT NOT NULL AUTO_INCREMENT,
  `note_employe_avis` INT NULL,
  `commentaire_evaluation_critere` VARCHAR(300) NULL,
  `id_critere_notation_employe` INT NOT NULL,
  `id_avis_employe` INT NOT NULL,
  PRIMARY KEY (`id_employe_avis_critere`),
  INDEX `index_id_critere_avis_critere_entreprise` (`id_critere_notation_employe` ASC),
  INDEX `index_id_avis_employe_avis_critere_avis` (`id_avis_employe` ASC),
  CONSTRAINT `fk_id_critere_avis_critere_entreprise`
    FOREIGN KEY (`id_critere_notation_employe`)
    REFERENCES `prozzl_test`.`criteres_notation_employe` (`id_critere_notation_employe`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_id_avis_employe_avis_critere_avis`
    FOREIGN KEY (`id_avis_employe`)
    REFERENCES `prozzl_test`.`avis_employe` (`id_avis_employe`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

SHOW WARNINGS;

-- -----------------------------------------------------
-- Table `prozzl_test`.`notifications`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `prozzl_test`.`notifications` ;

SHOW WARNINGS;
CREATE TABLE IF NOT EXISTS `prozzl_test`.`notifications` (
  `id_notifcation` INT NOT NULL AUTO_INCREMENT,
  `type` VARCHAR(45) NOT NULL,
  `texte_descriptif` VARCHAR(300) NULL,
  `id_utilisateur` INT NOT NULL,
  PRIMARY KEY (`id_notifcation`),
  INDEX `idx_id_utilisateur_notifcation_utilisateur` (`id_utilisateur` ASC),
  CONSTRAINT `fk_id_utilisateur_notifcations_utilisateur`
    FOREIGN KEY (`id_utilisateur`)
    REFERENCES `prozzl_test`.`utilisateur` (`id_utilisateur`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

SHOW WARNINGS;

-- -----------------------------------------------------
-- Table `prozzl_test`.`offre_emploi`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `prozzl_test`.`offre_emploi` ;

SHOW WARNINGS;
CREATE TABLE IF NOT EXISTS `prozzl_test`.`offre_emploi` (
  `id_offre_emploi` INT NOT NULL AUTO_INCREMENT,
  `date_creation_offre_emploi` DATETIME NOT NULL,
  `poste_offre_emploi` VARCHAR(30) NULL,
  `type_offre_emploi` VARCHAR(30) NULL,
  `date_debut_offre_emploi` DATETIME NULL,
  `salaire_offre_emploi` INT NULL,
  `experience_offre_emploi` VARCHAR(500) NULL,
  `description_offre_emploi` VARCHAR(500) NULL,
  `id_entreprise` INT NOT NULL,
  PRIMARY KEY (`id_offre_emploi`),
  INDEX `index_id_entreprise` (`id_entreprise` ASC),
  CONSTRAINT `fk_id_entreprise`
    FOREIGN KEY (`id_entreprise`)
    REFERENCES `prozzl_test`.`entreprise` (`id_entreprise`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

SHOW WARNINGS;

-- -----------------------------------------------------
-- Table `prozzl_test`.`postuler`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `prozzl_test`.`postuler` ;

SHOW WARNINGS;
CREATE TABLE IF NOT EXISTS `prozzl_test`.`postuler` (
  `id_postuler` INT NOT NULL AUTO_INCREMENT,
  `id_employe` INT NOT NULL,
  `id_offre_emploi` INT NOT NULL,
  `date_postule` DATE NOT NULL,
  PRIMARY KEY (`id_postuler`),
  INDEX `index_id_employe` (`id_employe` ASC),
  INDEX `index_id_offre_emploi` (`id_offre_emploi` ASC),
  CONSTRAINT `fk_id_employe`
    FOREIGN KEY (`id_employe`)
    REFERENCES `prozzl_test`.`employe` (`id_employe`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_id_offre_emploi`
    FOREIGN KEY (`id_offre_emploi`)
    REFERENCES `prozzl_test`.`offre_emploi` (`id_offre_emploi`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

SHOW WARNINGS;

-- -----------------------------------------------------
-- Table `prozzl_test`.`formation`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `prozzl_test`.`formation` ;

SHOW WARNINGS;
CREATE TABLE IF NOT EXISTS `prozzl_test`.`formation` (
  `id_formation` INT NOT NULL AUTO_INCREMENT,
  `date_debut_formation` DATETIME NULL,
  `date_fin_formation` DATETIME NULL,
  `intitule_formation` VARCHAR(45) NULL,
  `etablissement_formation` VARCHAR(45) NULL,
  `diplome_formation` VARCHAR(45) NULL,
  `description_formation` VARCHAR(255) NULL,
  `id_employe` INT NULL,
  PRIMARY KEY (`id_formation`),
  INDEX `index_id_employe` (`id_employe` ASC),
  CONSTRAINT `fk_id_employe_employe_formation`
    FOREIGN KEY (`id_employe`)
    REFERENCES `prozzl_test`.`employe` (`id_employe`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

SHOW WARNINGS;

-- -----------------------------------------------------
-- Table `prozzl_test`.`experience_pro`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `prozzl_test`.`experience_pro` ;

SHOW WARNINGS;
CREATE TABLE IF NOT EXISTS `prozzl_test`.`experience_pro` (
  `id_experience` INT NOT NULL AUTO_INCREMENT,
  `date_debut_experience` DATETIME NULL,
  `date_fin_experience` DATETIME NULL,
  `intitule_experience` VARCHAR(45) NULL,
  `entreprise_experience` VARCHAR(45) NULL,
  `description_experience` VARCHAR(255) NULL,
  `id_employe` INT NULL,
  PRIMARY KEY (`id_experience`),
  INDEX `index_id_employe` (`id_employe` ASC),
  CONSTRAINT `fk_id_employe_employe_experience_pro`
    FOREIGN KEY (`id_employe`)
    REFERENCES `prozzl_test`.`employe` (`id_employe`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

SHOW WARNINGS;

-- -----------------------------------------------------
-- Table `prozzl_test`.`competence`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `prozzl_test`.`competence` ;

SHOW WARNINGS;
CREATE TABLE IF NOT EXISTS `prozzl_test`.`competence` (
  `id_competence` INT NOT NULL AUTO_INCREMENT,
  `intitule_competance` VARCHAR(45) NULL,
  `niveau_competence` VARCHAR(45) NULL,
  `id_employe` INT NULL,
  PRIMARY KEY (`id_competence`),
  INDEX `index_id_employe` (`id_employe` ASC),
  CONSTRAINT `fk_id_employe_employe_competence`
    FOREIGN KEY (`id_employe`)
    REFERENCES `prozzl_test`.`employe` (`id_employe`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

SHOW WARNINGS;

SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
