-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le : mar. 28 nov. 2023 à 07:41
-- Version du serveur : 8.0.13
-- Version de PHP : 8.1.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `Dbhaidar`
--

-- --------------------------------------------------------

--
-- Structure de la table `client`
--

CREATE TABLE `client` (
  `idClient` int(11) NOT NULL,
  `nom` varchar(20) NOT NULL,
  `prenoms` varchar(20) NOT NULL,
  `contact` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `client`
--

INSERT INTO `client` (`idClient`, `nom`, `prenoms`, `contact`) VALUES
(1, 'HAIDAR', 'SA', '707302161'),
(2, 'HAIDAR2', 'SA', '707302161'),
(3, 'HAIDAR3', 'SA', '707302161'),
(4, 'HAIDAR4', 'SA', '707302161'),
(5, 'HAIDAR5', 'SA', '707302161'),
(6, 'HAIDAR6', 'SA', '707302161'),
(7, 'angetraore', 'dev', '0700422755'),
(8, 'angetraore2', 'dev', '0700422755'),
(9, 'angetraore3', 'dev', '0700422755'),
(10, 'angetraore4', 'dev', '0700422755');

-- --------------------------------------------------------

--
-- Structure de la table `comporter`
--

CREATE TABLE `comporter` (
  `idComporter` int(11) NOT NULL,
  `idFacture` int(11) NOT NULL,
  `idService` int(11) NOT NULL,
  `quantite` int(11) DEFAULT NULL,
  `remise` int(11) DEFAULT NULL,
  `total` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `comporter`
--

INSERT INTO `comporter` (`idComporter`, `idFacture`, `idService`, `quantite`, `remise`, `total`) VALUES
(65, 64, 3, 3, 2, 324000),
(66, 64, 2, 5, 1, 300000);

-- --------------------------------------------------------

--
-- Structure de la table `facture`
--

CREATE TABLE `facture` (
  `idFacture` int(11) NOT NULL,
  `numeroFacture` varchar(20) NOT NULL,
  `client` int(11) NOT NULL,
  `datemiseenplace` date DEFAULT NULL,
  `typemiseenplace` varchar(20) DEFAULT NULL,
  `codesite` varchar(20) DEFAULT NULL,
  `createdAt` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `facture`
--

INSERT INTO `facture` (`idFacture`, `numeroFacture`, `client`, `datemiseenplace`, `typemiseenplace`, `codesite`, `createdAt`) VALUES
(64, 'FOS#2023-BACKEND', 1, '2023-11-20', 'video', 'dokui', '2023-11-28');

-- --------------------------------------------------------

--
-- Structure de la table `remise`
--

CREATE TABLE `remise` (
  `idRemise` int(11) NOT NULL,
  `pourcentage` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `remise`
--

INSERT INTO `remise` (`idRemise`, `pourcentage`) VALUES
(1, 1),
(2, 10),
(4, 5);

-- --------------------------------------------------------

--
-- Structure de la table `service`
--

CREATE TABLE `service` (
  `idService` int(11) NOT NULL,
  `libelle` varchar(20) NOT NULL,
  `prix` int(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `service`
--

INSERT INTO `service` (`idService`, `libelle`, `prix`) VALUES
(1, 'GARDIENNAGE', 100000),
(2, 'BIP', 60000),
(3, 'CAMERA_SURVEIL', 120000),
(4, 'GARDE_DU_CORPS', 300000),
(5, 'KLM', 500),
(6, 'NOP', 600),
(7, 'QUR', 700),
(8, 'ABC', 800),
(9, 'ABE', 900);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `client`
--
ALTER TABLE `client`
  ADD PRIMARY KEY (`idClient`);

--
-- Index pour la table `comporter`
--
ALTER TABLE `comporter`
  ADD PRIMARY KEY (`idComporter`),
  ADD KEY `service_fk` (`idService`),
  ADD KEY `facture_fk` (`idFacture`),
  ADD KEY `remise_fk` (`remise`);

--
-- Index pour la table `facture`
--
ALTER TABLE `facture`
  ADD PRIMARY KEY (`idFacture`),
  ADD KEY `client_fk` (`client`);

--
-- Index pour la table `remise`
--
ALTER TABLE `remise`
  ADD PRIMARY KEY (`idRemise`);

--
-- Index pour la table `service`
--
ALTER TABLE `service`
  ADD PRIMARY KEY (`idService`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `client`
--
ALTER TABLE `client`
  MODIFY `idClient` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT pour la table `comporter`
--
ALTER TABLE `comporter`
  MODIFY `idComporter` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

--
-- AUTO_INCREMENT pour la table `facture`
--
ALTER TABLE `facture`
  MODIFY `idFacture` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT pour la table `remise`
--
ALTER TABLE `remise`
  MODIFY `idRemise` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `service`
--
ALTER TABLE `service`
  MODIFY `idService` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `comporter`
--
ALTER TABLE `comporter`
  ADD CONSTRAINT `facture_fk` FOREIGN KEY (`idFacture`) REFERENCES `facture` (`idfacture`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `remise_fk` FOREIGN KEY (`remise`) REFERENCES `remise` (`idremise`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `service_fk` FOREIGN KEY (`idService`) REFERENCES `service` (`idservice`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `facture`
--
ALTER TABLE `facture`
  ADD CONSTRAINT `client_fk` FOREIGN KEY (`client`) REFERENCES `client` (`idclient`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
