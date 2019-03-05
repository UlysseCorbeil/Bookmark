-- ---
-- Globals
-- ---

-- SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
-- SET FOREIGN_KEY_CHECKS=0;

-- ---
-- Table 'utilisateur'
--
-- ---

DROP TABLE IF EXISTS `utilisateur`;

CREATE TABLE `utilisateur`
(
                             `idUtilisateur` INTEGER NOT NULL AUTO_INCREMENT,
                             `sNom` VARCHAR
(100) NOT NULL,
                             `sPrenom` VARCHAR
(100) NOT NULL,
                             `sCourriel` VARCHAR
(255) NOT NULL,
                             `sMotDePasse` VARCHAR
(250) NOT NULL,
                             `sAvatar` VARCHAR
(150) NOT NULL,
                             `sDateInscription` DATETIME NOT NULL,
                             `sPreference` MEDIUMTEXT NOT NULL,
                             PRIMARY KEY
(`idUtilisateur`),
                             UNIQUE KEY
(`sCourriel`)
);

-- ---
-- Table 'evenement'
--
-- ---

DROP TABLE IF EXISTS `evenement`;

CREATE TABLE `evenement`
(
                           `idEvenement` INTEGER NOT NULL AUTO_INCREMENT,
                           `sDateDebut` DATETIME NOT NULL,
                           `sDateFin` DATETIME NOT NULL,
                           `sNomEvenement` VARCHAR
(255) NOT NULL,
                           `iNoUtilisateur` INTEGER NOT NULL,
                           PRIMARY KEY
(`idEvenement`),
                           KEY
(`iNoUtilisateur`)
  );

-- ---
-- Table 'tache'
--
-- ---

DROP TABLE IF EXISTS `tache`;

CREATE TABLE `tache`
(
                       `idTache` INTEGER NOT NULL AUTO_INCREMENT,
                       `sTache` VARCHAR
(255) NOT NULL,
                       `bComplete` TINYINT NOT NULL DEFAULT 0,
                       `iNoUtilisateur` INTEGER NOT NULL,
                       PRIMARY KEY
(`idTache`),
                       KEY
(`iNoUtilisateur`)
  );

-- ---
-- Table 'citation'
--
-- ---

DROP TABLE IF EXISTS `citation`;

CREATE TABLE `citation`
(
                          `idCitation` INTEGER NOT NULL AUTO_INCREMENT,
                          `sCitation` VARCHAR
(255) NOT NULL,
                          PRIMARY KEY
(`idCitation`)
);


-- ---
-- Table Properties
-- ---

ALTER TABLE `utilisateur` ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
ALTER TABLE `evenement` ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
ALTER TABLE `tache` ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
ALTER TABLE `citation` ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ---
-- Foreign Keys
-- ---

ALTER TABLE `evenement`
ADD FOREIGN KEY
(iNoUtilisateur) REFERENCES `utilisateur`
(`idUtilisateur`);
ALTER TABLE `tache`
ADD FOREIGN KEY
(iNoUtilisateur) REFERENCES `utilisateur`
(`idUtilisateur`);



-- ---
-- Test Data
-- ---

-- INSERT INTO `utilisateur` (`idUtilisateur`,`sNom`,`sPrenom`,`sCourriel`,`sMotDePasse`,`sAvatar`,`sDateInscription`,`sPreference`) VALUES
-- ('','','','','','','','');
-- INSERT INTO `evenement` (`idEvenement`,`sDateDebut`,`sDateFin`,`sNomEvenement`,`iNoUtilisateur`) VALUES
-- ('','','','','');
-- INSERT INTO `tache` (`idTache`,`sTache`,`bComplete`,`iNoUtilisateur`) VALUES
-- ('','','','');
-- INSERT INTO `citation` (`idCitation`,`sCitation`) VALUES
-- ('','');