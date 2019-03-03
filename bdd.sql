-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le :  ven. 01 mars 2019 à 03:51
-- Version du serveur :  5.7.17
-- Version de PHP :  5.6.30

SET SQL_MODE
= "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT
= 0;
START TRANSACTION;
SET time_zone
= "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `page-accueil`
--

-- --------------------------------------------------------

CREATE TABLE `utilisateur`
(
                             `idUtilisateur` INTEGER NOT NULL AUTO_INCREMENT,
                             `sNom` VARCHAR
(100) NOT NULL,
                             `sPrenom` VARCHAR
(100) NOT NULL,
                             `sCourriel` VARCHAR
(255) NOT NULL,
                             `sPseudo` VARCHAR
(100) NOT NULL,
                             `sMotDePasse` VARCHAR
(250) NOT NULL,
                             `sAvatar` VARCHAR
(150) NOT NULL,
                             `sDateInscription` DATETIME NOT NULL,
                             PRIMARY KEY
(`idUtilisateur`),
                             UNIQUE KEY
(`sPseudo`),
                             KEY
(`sCourriel`)
  );

-- ---
-- Table 'lien'
--
-- ---

DROP TABLE IF EXISTS `lien`;

CREATE TABLE `lien`
(
                      `idLiens` INTEGER NOT NULL AUTO_INCREMENT,
                      `sUrl` VARCHAR
(255) NOT NULL,
                      `sFavicon` VARCHAR
(255) NOT NULL,
                      `sNomSite` VARCHAR
(150) NOT NULL,
                      PRIMARY KEY
(`idLiens`)
);

--
-- Déchargement des données de la table `lien`
--

INSERT INTO `lien` (`
idLiens`,
`sUrl
`, `sFavicon`, `sNomSite`) VALUES
(1, ''
https:
//www.google.com/'', ''www.google.com'', ''Google''),
(2, ''
https:
//www.pobourdeau.com'', ''www.pobourdeau.com'', ''Pobourdeau''),
(3, ''
https:
//www.facebook.com'', ''www.facebook.com'', ''Faecbook'');

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

--
-- Déchargement des données de la table `rel_utilisateur_lien`
--

INSERT INTO `rel_utilisateur_lien` (`
idRelUtilLiens`,
`iNoUtilisateur
`, `iNoLiens`, `iPosLien`) VALUES
(1, 1, 1, 0),
(2, 1, 2, 0),
(5, 2, 1, 0);

-- --------------------------------------------------------

--
-- Structure de la table `tache`
--

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

--
-- Déchargement des données de la table `tache`
--

INSERT INTO `tache` (`
idTache`,
`sTache
`, `bComplete`, `iNoUtilisateur`) VALUES
(1, ''Completer la partie taches du site'', 0, 1),
(2, ''Faire le layout HTML'', 1, 1);

<<<<<<< HEAD
CREATE TABLE `rel_utilisateur_lien`
(
                                      `idRelUtilLiens` INTEGER NOT NULL AUTO_INCREMENT,
                                      `iNoUtilisateur` INTEGER NOT NULL,
                                      `iNoLiens` INTEGER NOT NULL,
                                      PRIMARY KEY
(`idRelUtilLiens`),
                                      KEY
(`iNoUtilisateur`),
  KEY
(`iNoLiens`)
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

ALTER TABLE `evenement`
ADD FOREIGN KEY
(iNoUtilisateur) REFERENCES `utilisateur`
(`idUtilisateur`);
ALTER TABLE `tache`
ADD FOREIGN KEY
(iNoUtilisateur) REFERENCES `utilisateur`
(`idUtilisateur`);
ALTER TABLE `rel_utilisateur_lien`
ADD FOREIGN KEY
(iNoUtilisateur) REFERENCES `utilisateur`
(`idUtilisateur`);
ALTER TABLE `rel_utilisateur_lien`
ADD FOREIGN KEY
(iNoLiens) REFERENCES `lien`
(`idLiens`);



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
=======
-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

CREATE TABLE `utilisateur`
(
  `idUtilisateur` int
(11) NOT NULL,
  `sNom` varchar
(100) CHARACTER
SET latin1
NOT NULL,
  `sPrenom` varchar
(100) CHARACTER
SET latin1
NOT NULL,
  `sCourriel` varchar
(255) CHARACTER
SET latin1
NOT NULL,
  `sPseudo` varchar
(100) CHARACTER
SET latin1
NOT NULL,
  `sMotDePasse` varchar
(250) CHARACTER
SET latin1
NOT NULL,
  `sAvatar` varchar
(150) CHARACTER
SET latin1
NOT NULL,
  `sDateInscription` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `utilisateur`
--

INSERT INTO `utilisateur` (`
idUtilisateur`,
`sNom
`, `sPrenom`, `sCourriel`, `sPseudo`, `sMotDePasse`, `sAvatar`, `sDateInscription`) VALUES
(1, ''Bourdeau'', ''Pier-Olivier'', ''pierrot_bourdeau@hotmail.com'', ''pobourdeau'', ''test'', ''P1020673.jpg'', ''2019-02-26 00:00:00''),
(2, ''Corbeil'', ''Ulysse'', ''ulysse.corbeil@gmail.com'', ''ulysseCorbeil'', ''test'', '''', ''2019-02-28 21:00:00'');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `evenement`
--
ALTER TABLE `evenement`
ADD PRIMARY KEY
(`idEvenement`),
ADD KEY `iNoUtilisateur`
(`iNoUtilisateur`);

--
-- Index pour la table `lien`
--
ALTER TABLE `lien`
ADD PRIMARY KEY
(`idLiens`);

--
-- Index pour la table `rel_utilisateur_lien`
--
ALTER TABLE `rel_utilisateur_lien`
ADD PRIMARY KEY
(`idRelUtilLiens`),
ADD KEY `iNoUtilisateur`
(`iNoUtilisateur`),
ADD KEY `iNoLiens`
(`iNoLiens`);

--
-- Index pour la table `tache`
--
ALTER TABLE `tache`
ADD PRIMARY KEY
(`idTache`),
ADD KEY `iNoUtilisateur`
(`iNoUtilisateur`);

--
-- Index pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
ADD PRIMARY KEY
(`idUtilisateur`),
ADD UNIQUE KEY `sPseudo`
(`sPseudo`),
ADD KEY `sCourriel`
(`sCourriel`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `evenement`
--
ALTER TABLE `evenement`
  MODIFY `idEvenement` int
(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT pour la table `lien`
--
ALTER TABLE `lien`
  MODIFY `idLiens` int
(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT pour la table `rel_utilisateur_lien`
--
ALTER TABLE `rel_utilisateur_lien`
  MODIFY `idRelUtilLiens` int
(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT pour la table `tache`
--
ALTER TABLE `tache`
  MODIFY `idTache` int
(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  MODIFY `idUtilisateur` int
(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `evenement`
--
ALTER TABLE `evenement`
ADD CONSTRAINT `evenement_ibfk_1` FOREIGN KEY
(`iNoUtilisateur`) REFERENCES `utilisateur`
(`idUtilisateur`) ON
DELETE CASCADE ON
UPDATE CASCADE;

--
-- Contraintes pour la table `rel_utilisateur_lien`
--
ALTER TABLE `rel_utilisateur_lien`
ADD CONSTRAINT `rel_utilisateur_lien_ibfk_1` FOREIGN KEY
(`iNoUtilisateur`) REFERENCES `utilisateur`
(`idUtilisateur`) ON
DELETE CASCADE ON
UPDATE CASCADE,
ADD CONSTRAINT `rel_utilisateur_lien_ibfk_2` FOREIGN KEY
(`iNoLiens`) REFERENCES `lien`
(`idLiens`) ON
DELETE CASCADE ON
UPDATE CASCADE;

--
-- Contraintes pour la table `tache`
--
ALTER TABLE `tache`
ADD CONSTRAINT `tache_ibfk_1` FOREIGN KEY
(`iNoUtilisateur`) REFERENCES `utilisateur`
(`idUtilisateur`) ON
DELETE CASCADE ON
UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;