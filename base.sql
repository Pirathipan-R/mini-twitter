-- phpMyAdmin SQL Dump
-- version 4.4.10
-- http://www.phpmyadmin.net
--
-- Client :  localhost:3306
-- Généré le :  Sam 14 Mai 2016 à 16:15
-- Version du serveur :  5.5.42
-- Version de PHP :  7.0.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Base de données :  `projetPHP`
--

-- --------------------------------------------------------

--
-- Structure de la table `utilisateurs`
--

CREATE TABLE `utilisateurs` (
  `idUtilisateur` int(11) NOT NULL,
  `identifiantUtilisateur` varchar(16) NOT NULL,
  `emailUtilisateur` varchar(255) NOT NULL,
  `motDePasseUtilisateur` varchar(255) NOT NULL COMMENT 'crypté en sha1 + grain de sable',
  `numTelUtilisateur` varchar(16) DEFAULT NULL,
  `descriptionUtilisateur` varchar(255) DEFAULT NULL,
  `photoUtilisateur` varchar(16) DEFAULT NULL COMMENT 'adresse de la photo stockée en local',
  `dateNaissanceUtilisateur` date DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Contenu de la table `utilisateurs`
--

INSERT INTO `utilisateurs` (`idUtilisateur`, `identifiantUtilisateur`, `emailUtilisateur`, `motDePasseUtilisateur`, `numTelUtilisateur`, `descriptionUtilisateur`, `photoUtilisateur`, `dateNaissanceUtilisateur`) VALUES
(1, 'new', 'aze@aze.fr', '525a6fa626cd2b717d8ee9b616bd63e98268eba6', NULL, NULL, 'default.png', NULL);

--
-- Index pour les tables exportées
--

--
-- Index pour la table `utilisateurs`
--
ALTER TABLE `utilisateurs`
  ADD PRIMARY KEY (`idUtilisateur`),
  ADD UNIQUE KEY `identifiantUtilisateur` (`identifiantUtilisateur`),
  ADD UNIQUE KEY `emailUtilisateur` (`emailUtilisateur`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `utilisateurs`
--
ALTER TABLE `utilisateurs`
  MODIFY `idUtilisateur` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;