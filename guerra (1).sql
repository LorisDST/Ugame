-- phpMyAdmin SQL Dump
-- version 4.9.5deb2
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:3306
-- Généré le : mar. 18 oct. 2022 à 23:16
-- Version du serveur :  8.0.30-0ubuntu0.20.04.2
-- Version de PHP : 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `guerra`
--

-- --------------------------------------------------------

--
-- Structure de la table `attack`
--

CREATE TABLE `attack` (
  `id_attacker` int NOT NULL,
  `id_defender` int NOT NULL,
  `nbr_canon` int NOT NULL,
  `nbr_troupes_logi` int NOT NULL,
  `nbr_troupes_attack` int NOT NULL,
  `x_attack` int NOT NULL,
  `y_attack` int NOT NULL,
  `x_def` int NOT NULL,
  `y_def` int NOT NULL,
  `id` int NOT NULL,
  `victoire` int NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `message`
--

CREATE TABLE `message` (
  `id` int NOT NULL,
  `pseudo` text NOT NULL,
  `message` text NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `players`
--

CREATE TABLE `players` (
  `id` int NOT NULL,
  `pseudo` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` text NOT NULL,
  `ip` varchar(20) NOT NULL,
  `registration_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `token` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `players`
--

INSERT INTO `players` (`id`, `pseudo`, `email`, `password`, `ip`, `registration_date`, `token`) VALUES
(6, 'Lairopw', 'vincent.voisin@epita.fr', '$2y$12$4soelfnW2A1V60TflFgPfuiNwHPYruObv8c8FPgZhETZsn9pgteeO', '::1', '2022-10-18 23:13:48', '2be9832bf0a44791ee0cdfd72fc8f59144f0ee9f3468da48bd4b777873c7624bde9a8aa2da2a9ef26efab2ff433842ecb61c421e55cdf6a8b8dd6604538f0b44');

-- --------------------------------------------------------

--
-- Structure de la table `players_stats`
--

CREATE TABLE `players_stats` (
  `player_id` int NOT NULL,
  `x_coord` int NOT NULL,
  `y_coord` int NOT NULL,
  `color` varchar(10) NOT NULL,
  `canon` double NOT NULL DEFAULT '0',
  `troupe_offensive` double NOT NULL DEFAULT '0',
  `troupe_logistique` double NOT NULL DEFAULT '0',
  `industrie` double NOT NULL DEFAULT '500',
  `energie` double NOT NULL DEFAULT '0',
  `niv_ind` int NOT NULL DEFAULT '1',
  `niv_cent` int NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `players_stats`
--

INSERT INTO `players_stats` (`player_id`, `x_coord`, `y_coord`, `color`, `canon`, `troupe_offensive`, `troupe_logistique`, `industrie`, `energie`, `niv_ind`, `niv_cent`) VALUES
(6, 400, 326, '#836c67', 10, 100, 0, 917515, 3686090, 10, 10);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `attack`
--
ALTER TABLE `attack`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `players`
--
ALTER TABLE `players`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `attack`
--
ALTER TABLE `attack`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT pour la table `message`
--
ALTER TABLE `message`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT pour la table `players`
--
ALTER TABLE `players`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
