-- phpMyAdmin SQL Dump
-- version 5.1.2
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:3306
-- Généré le : lun. 16 juin 2025 à 08:26
-- Version du serveur : 5.7.24
-- Version de PHP : 8.3.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `team_builder`
--

-- --------------------------------------------------------

--
-- Structure de la table `team`
--

CREATE TABLE `team` (
  `id` int(11) NOT NULL,
  `trainer_id` int(11) NOT NULL,
  `pokemons` json NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `team`
--

INSERT INTO `team` (`id`, `trainer_id`, `pokemons`) VALUES
(2, 1, '{\"pokemon1\": 934, \"pokemon2\": 719, \"pokemon3\": 471, \"pokemon4\": 653, \"pokemon5\": 908, \"pokemon6\": 448}'),
(4, 1, '{\"pokemon1\": 18, \"pokemon2\": 1000, \"pokemon3\": 92, \"pokemon4\": 100, \"pokemon5\": 1025, \"pokemon6\": 802}'),
(5, 3, '{\"pokemon1\": 802, \"pokemon2\": 1, \"pokemon3\": 1, \"pokemon4\": 1, \"pokemon5\": 1, \"pokemon6\": 1}');

-- --------------------------------------------------------

--
-- Structure de la table `trainer`
--

CREATE TABLE `trainer` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `rank` enum('Bronze','Argent','Or','Platine','Diamant','Champion') NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `trainer`
--

INSERT INTO `trainer` (`id`, `name`, `rank`, `password`) VALUES
(1, 'Maël', 'Platine', 'azertyuiop'),
(2, 'Heloise', 'Or', '12345678'),
(3, 'Mélodie', 'Bronze', 'sdfghjkjhg'),
(4, 'Enaël', 'Platine', 'password'),
(5, 'Xavier', 'Platine', '12345678');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `team`
--
ALTER TABLE `team`
  ADD PRIMARY KEY (`id`),
  ADD KEY `trainer_id` (`trainer_id`);

--
-- Index pour la table `trainer`
--
ALTER TABLE `trainer`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `team`
--
ALTER TABLE `team`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `trainer`
--
ALTER TABLE `trainer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `team`
--
ALTER TABLE `team`
  ADD CONSTRAINT `team_ibfk_1` FOREIGN KEY (`trainer_id`) REFERENCES `trainer` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
