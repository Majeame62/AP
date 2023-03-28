-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : jeu. 09 mars 2023 à 08:49
-- Version du serveur : 8.0.31
-- Version de PHP : 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `m2l`
--

-- --------------------------------------------------------

--
-- Structure de la table `demande`
--

CREATE TABLE `demande` (
  `Id_demande` int NOT NULL,
  `Objectif` text NOT NULL,
  `raison` text NOT NULL,
  `Id_Utilisateurs` int NOT NULL,
  `Id_priorité` int NOT NULL,
  `Id_etat` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Structure de la table `etat`
--

CREATE TABLE `etat` (
  `Id_etat` int NOT NULL,
  `niveau` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Structure de la table `priorité`
--

CREATE TABLE `priorité` (
  `Id_priorité` int NOT NULL,
  `avancement` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Structure de la table `role`
--

CREATE TABLE `role` (
  `Id_role` int NOT NULL,
  `fonction` varchar(50) NOT NULL,
  `login` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `role`
--

INSERT INTO `role` (`Id_role`, `fonction`, `login`) VALUES
(1, 'Admin', 'maximeu62'),
(2, 'utilisateurs', 'jm'),
(3, 'Responsable', 'JM');

-- --------------------------------------------------------

--
-- Structure de la table `task`
--

CREATE TABLE `task` (
  `ID_tache` int NOT NULL,
  `debut` date NOT NULL,
  `Fin` date NOT NULL,
  `tache` varchar(150) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `priorité` varchar(150) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `utilisateurs`
--

CREATE TABLE `utilisateurs` (
  `id` int NOT NULL,
  `pseudo` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` text NOT NULL,
  `ip` varchar(20) NOT NULL,
  `token` text NOT NULL,
  `date_inscription` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `role` varchar(200) DEFAULT 'Utilisateurs'
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `utilisateurs`
--

INSERT INTO `utilisateurs` (`id`, `pseudo`, `email`, `password`, `ip`, `token`, `date_inscription`, `role`) VALUES
(1, 'test', 'test@test.fr', '$2y$12$RJIIny6XUEoQp2NmYoOio.FcrSLx0F6x6tlcPZBm4ZiO/wMVZjuIO', '::1', '9c31892525f38df805ff84bef1850a233ec5c5b2561341afb4aa76cee8f7efa5dcfe2172f9921280b5f9bae393ef742a4cdcdc9c2e8043570acab18c39aee870', '2023-03-09 09:10:12', 'Utilisateurs'),
(2, 'maximeu62', 'maximeu62@gmail.com', '$2y$12$uv7lF6A5RI6fQwuoi8Rtf.hIlt0UIMFK8s2zyuW9cAFkW1T8Gthqq', '::1', '18539479c3261135e15df23a14a2b5c275e29c534265c68712ce74901eb332fe2b146013a2e6f4a24de37fee2d0cef9580f20298a418067476e72a01436aac39', '2023-03-09 09:42:47', 'Administrateur');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `demande`
--
ALTER TABLE `demande`
  ADD PRIMARY KEY (`Id_demande`),
  ADD KEY `Id_etat` (`Id_etat`),
  ADD KEY `Id_etat_2` (`Id_etat`),
  ADD KEY `Id_priorité` (`Id_priorité`),
  ADD KEY `Id_Utilisateurs` (`Id_Utilisateurs`);

--
-- Index pour la table `etat`
--
ALTER TABLE `etat`
  ADD PRIMARY KEY (`Id_etat`);

--
-- Index pour la table `priorité`
--
ALTER TABLE `priorité`
  ADD PRIMARY KEY (`Id_priorité`);

--
-- Index pour la table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`Id_role`);

--
-- Index pour la table `task`
--
ALTER TABLE `task`
  ADD PRIMARY KEY (`ID_tache`);

--
-- Index pour la table `utilisateurs`
--
ALTER TABLE `utilisateurs`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `task`
--
ALTER TABLE `task`
  MODIFY `ID_tache` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `utilisateurs`
--
ALTER TABLE `utilisateurs`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
