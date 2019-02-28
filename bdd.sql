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

CREATE TABLE `utilisateur` (
                             `idUtilisateur` INTEGER NOT NULL AUTO_INCREMENT,
                             `sNom` VARCHAR(100) NOT NULL,
                             `sPrenom` VARCHAR(100) NOT NULL,
                             `sCourriel` VARCHAR(255) NOT NULL,
                             `sPseudo` VARCHAR(100) NOT NULL,
                             `sMotDePasse` VARCHAR(250) NOT NULL,
                             `sAvatar` VARCHAR(150) NOT NULL,
                             `sDateInscription` DATETIME NOT NULL,
                             PRIMARY KEY (`idUtilisateur`),
                             UNIQUE KEY (`sPseudo`),
                             KEY (`sCourriel`)
  );

-- ---
-- Table 'lien'
--
-- ---

DROP TABLE IF EXISTS `lien`;

CREATE TABLE `lien` (
                      `idLiens` INTEGER NOT NULL AUTO_INCREMENT,
                      `sUrl` VARCHAR(255) NOT NULL,
                      `sFavicon` VARCHAR(255) NOT NULL,
                      `sNomSite` VARCHAR(150) NOT NULL,
                      PRIMARY KEY (`idLiens`)
);

-- ---
-- Table 'evenement'
--
-- ---

DROP TABLE IF EXISTS `evenement`;

CREATE TABLE `evenement` (
                           `idEvenement` INTEGER NOT NULL AUTO_INCREMENT,
                           `sDateDebut` DATETIME NOT NULL,
                           `sDateFin` DATETIME NOT NULL,
                           `sNomEvenement` VARCHAR(255) NOT NULL,
                           `iNoUtilisateur` INTEGER NOT NULL,
                           PRIMARY KEY (`idEvenement`),
                           KEY (`iNoUtilisateur`)
  );

-- ---
-- Table 'tache'
--
-- ---

DROP TABLE IF EXISTS `tache`;

CREATE TABLE `tache` (
                       `idTache` INTEGER NOT NULL AUTO_INCREMENT,
                       `sTache` VARCHAR(255) NOT NULL,
                       `bComplete` TINYINT NOT NULL DEFAULT 0,
                       `iNoUtilisateur` INTEGER NOT NULL,
                       PRIMARY KEY (`idTache`),
                       KEY (`iNoUtilisateur`)
  );

-- ---
-- Table 'rel_utilisateur_lien'
--
-- ---

DROP TABLE IF EXISTS `rel_utilisateur_lien`;

CREATE TABLE `rel_utilisateur_lien` (
                                      `idRelUtilLiens` INTEGER NOT NULL AUTO_INCREMENT,
                                      `iNoUtilisateur` INTEGER NOT NULL,
                                      `iNoLiens` INTEGER NOT NULL,
                                      PRIMARY KEY (`idRelUtilLiens`),
                                      KEY (`iNoUtilisateur`),
  KEY (`iNoLiens`)
  );


-- ---
-- Table Properties
-- ---

ALTER TABLE `utilisateur` ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
ALTER TABLE `lien` ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
ALTER TABLE `evenement` ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
ALTER TABLE `tache` ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
ALTER TABLE `rel_utilisateur_lien` ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ---
-- Foreign Keys
-- ---

ALTER TABLE `evenement` ADD FOREIGN KEY (iNoUtilisateur) REFERENCES `utilisateur` (`idUtilisateur`);
ALTER TABLE `tache` ADD FOREIGN KEY (iNoUtilisateur) REFERENCES `utilisateur` (`idUtilisateur`);
ALTER TABLE `rel_utilisateur_lien` ADD FOREIGN KEY (iNoUtilisateur) REFERENCES `utilisateur` (`idUtilisateur`);
ALTER TABLE `rel_utilisateur_lien` ADD FOREIGN KEY (iNoLiens) REFERENCES `lien` (`idLiens`);



-- ---
-- Test Data
-- ---

-- INSERT INTO `utilisateur` (`idUtilisateur`,`sNom`,`sPrenom`,`sCourriel`,`sPseudo`,`sMotDePasse`,`sAvatar`,`sDateInscription`) VALUES
-- ('','','','','','','','');
-- INSERT INTO `lien` (`idLiens`,`sUrl`,`sFavicon`,`sNomSite`) VALUES
-- ('','','','');
-- INSERT INTO `evenement` (`idEvenement`,`sDateDebut`,`sDateFin`,`sNomEvenement`,`iNoUtilisateur`) VALUES
-- ('','','','','');
-- INSERT INTO `tache` (`idTache`,`sTache`,`bComplete`,`iNoUtilisateur`) VALUES
-- ('','','','');
-- INSERT INTO `rel_utilisateur_lien` (`idRelUtilLiens`,`iNoUtilisateur`,`iNoLiens`) VALUES
-- ('','','');