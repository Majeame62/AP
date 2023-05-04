-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : jeu. 04 mai 2023 à 03:52
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
-- Base de données : `m2l2`
--

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
  `role` varchar(200) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT 'utilisateurs'
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `utilisateurs`
--

INSERT INTO `utilisateurs` (`id`, `pseudo`, `email`, `password`, `ip`, `token`, `date_inscription`, `role`) VALUES
(3, 'test', 'test@test.fr', '$2y$12$yOEOWU8VcMB02P5D65W3A.Y1uBI88qCXFjKJMedVswQsldGNx3BZC', '::1', '1fdf75dd61e8305b4a0d0ac16607e7767bd444df24cce353e59d0bf8b5a0dd15c3f6b5d4b7fa5dbbf17f464adebc29d9c4699d8b975dfa6765f9018c5496fa32', '2023-03-10 11:20:34', 'responsable'),
(4, 'maximeu62', 'maximeu62@gmail.com', '$2y$12$uv7lF6A5RI6fQwuoi8Rtf.hIlt0UIMFK8s2zyuW9cAFkW1T8Gthqq', '::1', '18539479c3261135e15df23a14a2b5c275e29c534265c68712ce74901eb332fe2b146013a2e6f4a24de37fee2d0cef9580f20298a418067476e72a01436aac39', '2023-03-09 09:42:47', 'Administrateur'),
(1, 'max', 'test1@test.fr', '$2y$12$TQX7pj7DGwP69k1vXAB6Me97UnbliUXEVAPz5QK4s82Lrvg8zSnVu', '::1', 'e321f1027101272e956c4cd97c47b23d082d8f01716c544855dffc767c07cd4c6dea827e7083592395aeb4c7f0b7ae583c3b0d30b950aad163e64799dfb5eb35', '2023-03-10 13:53:37', 'utilisateurs'),
(5, 'jm', 'test2@test.fr', '$2y$12$Cd6VR0obInFKwJQ.PUJwq.wbc1QdbM0u82ocqdYcspMWKDkdyxVrK', '::1', '70eed3d246c03865a215f052f8cfec603a3436fa4d4e819c561165b0edf1b33cedffff2fe01c222dadaf6bcdabff511702845b31aee36cae0f10feb21ab694bd', '2023-03-15 13:50:09', 'Employée'),
(6, 'j', 'j@j.j', '$2y$12$ZMn.u7dNR/.B/WwFD29zVuqwJZtUkaM/y9Osnq3GITVe8NNReDQDK', '::1', '974e4874c78aa037b9679bfce8b236f8bf03931e74c47f2f6d6037af15f89cdc1e23121cac00ab519ceae763408c4d1594eda396be6a4f5c1674aafc074b7867', '2023-03-24 14:29:19', 'utilisateurs');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `utilisateurs`
--
ALTER TABLE `utilisateurs`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `utilisateurs`
--
ALTER TABLE `utilisateurs`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
