-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : mar. 29 mars 2022 à 08:58
-- Version du serveur : 5.7.36
-- Version de PHP : 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `memory`
--

-- --------------------------------------------------------

--
-- Structure de la table `card`
--

DROP TABLE IF EXISTS `card`;
CREATE TABLE IF NOT EXISTS `card` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sprite_index` int(11) NOT NULL,
  `board_index` int(11) NOT NULL,
  `is_matched` tinyint(1) NOT NULL,
  `game_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=360 DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `card`
--

INSERT INTO `card` (`id`, `sprite_index`, `board_index`, `is_matched`, `game_id`) VALUES
(276, 10, 0, 1, 47),
(277, 12, 1, 1, 47),
(278, 4, 2, 1, 47),
(279, 9, 3, 1, 47),
(280, 16, 4, 1, 47),
(281, 17, 5, 1, 47),
(282, 1, 6, 1, 47),
(283, 13, 7, 1, 47),
(284, 1, 8, 1, 47),
(285, 10, 9, 1, 47),
(286, 6, 10, 1, 47),
(287, 12, 11, 1, 47),
(288, 14, 12, 1, 47),
(289, 17, 13, 1, 47),
(290, 11, 14, 1, 47),
(291, 5, 15, 1, 47),
(292, 11, 16, 1, 47),
(293, 7, 17, 1, 47),
(294, 9, 18, 1, 47),
(295, 14, 19, 1, 47),
(296, 0, 20, 1, 47),
(297, 16, 21, 1, 47),
(298, 13, 22, 1, 47),
(299, 7, 23, 1, 47),
(300, 5, 24, 1, 47),
(301, 6, 25, 1, 47),
(302, 0, 26, 1, 47),
(303, 4, 27, 1, 47),
(304, 11, 0, 1, 48),
(305, 13, 1, 1, 48),
(306, 0, 2, 1, 48),
(307, 5, 3, 1, 48),
(308, 13, 4, 1, 48),
(309, 7, 5, 1, 48),
(310, 4, 6, 1, 48),
(311, 4, 7, 1, 48),
(312, 9, 8, 1, 48),
(313, 14, 9, 1, 48),
(314, 16, 10, 1, 48),
(315, 8, 11, 1, 48),
(316, 1, 12, 1, 48),
(317, 6, 13, 1, 48),
(318, 9, 14, 1, 48),
(319, 11, 15, 1, 48),
(320, 10, 16, 1, 48),
(321, 14, 17, 1, 48),
(322, 8, 18, 1, 48),
(323, 0, 19, 1, 48),
(324, 10, 20, 1, 48),
(325, 6, 21, 1, 48),
(326, 7, 22, 1, 48),
(327, 3, 23, 1, 48),
(328, 5, 24, 1, 48),
(329, 1, 25, 1, 48),
(330, 16, 26, 1, 48),
(331, 3, 27, 1, 48),
(332, 2, 0, 1, 49),
(333, 6, 1, 1, 49),
(334, 12, 2, 1, 49),
(335, 13, 3, 1, 49),
(336, 0, 4, 1, 49),
(337, 6, 5, 1, 49),
(338, 1, 6, 1, 49),
(339, 13, 7, 1, 49),
(340, 3, 8, 1, 49),
(341, 4, 9, 0, 49),
(342, 10, 10, 0, 49),
(343, 10, 11, 0, 49),
(344, 12, 12, 1, 49),
(345, 2, 13, 1, 49),
(346, 1, 14, 1, 49),
(347, 7, 15, 0, 49),
(348, 8, 16, 0, 49),
(349, 7, 17, 0, 49),
(350, 8, 18, 0, 49),
(351, 9, 19, 0, 49),
(352, 0, 20, 1, 49),
(353, 3, 21, 1, 49),
(354, 17, 22, 1, 49),
(355, 14, 23, 1, 49),
(356, 9, 24, 0, 49),
(357, 17, 25, 1, 49),
(358, 14, 26, 1, 49),
(359, 4, 27, 0, 49);

-- --------------------------------------------------------

--
-- Structure de la table `game`
--

DROP TABLE IF EXISTS `game`;
CREATE TABLE IF NOT EXISTS `game` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `play_time` int(11) NOT NULL,
  `number_of_pairs_found` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=50 DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `game`
--

INSERT INTO `game` (`id`, `play_time`, `number_of_pairs_found`) VALUES
(47, 58751, 14),
(48, 81647, 14),
(49, 120000, 9);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
