-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Client :  localhost:3306
-- Généré le :  Mer 03 Juillet 2019 à 13:59
-- Version du serveur :  10.3.15-MariaDB-1:10.3.15+maria~bionic-log
-- Version de PHP :  7.2.19-0ubuntu0.18.04.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `blind_test`
--

-- --------------------------------------------------------

--
-- Structure de la table `game_config`
--

CREATE TABLE `game_config` (
  `id` int(11) NOT NULL,
  `name` varchar(20) CHARACTER SET utf8mb4 DEFAULT NULL,
  `has_teams` tinyint(1) DEFAULT NULL,
  `has_teams_names` tinyint(1) DEFAULT NULL,
  `teams` varchar(255) CHARACTER SET utf32 DEFAULT NULL,
  `teams_nbr` int(2) DEFAULT NULL,
  `has_players` tinyint(1) DEFAULT NULL,
  `players_nbr` int(2) DEFAULT NULL,
  `players` varchar(255) DEFAULT NULL,
  `has_count_down` tinyint(1) DEFAULT NULL,
  `count_down_duration` int(2) DEFAULT NULL,
  `has_help` tinyint(1) DEFAULT NULL,
  `help_duration` int(11) DEFAULT NULL,
  `nbr_questions` int(11) DEFAULT NULL,
  `has_random_songs` tinyint(1) DEFAULT NULL,
  `playlist_id` int(11) DEFAULT NULL,
  `has_random_category` tinyint(1) DEFAULT NULL,
  `has_display_category` tinyint(1) DEFAULT NULL,
  `has_music` tinyint(1) DEFAULT NULL,
  `has_movies` tinyint(1) DEFAULT NULL,
  `has_cartoons` tinyint(1) DEFAULT NULL,
  `has_tv_shows` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `game_config`
--

INSERT INTO `game_config` (`id`, `name`, `has_teams`, `has_teams_names`, `teams`, `teams_nbr`, `has_players`, `players_nbr`, `players`, `has_count_down`, `count_down_duration`, `has_help`, `help_duration`, `nbr_questions`, `has_random_songs`, `playlist_id`, `has_random_category`, `has_display_category`, `has_music`, `has_movies`, `has_cartoons`, `has_tv_shows`) VALUES
(48, 'next', 1, 1, '112_113', 2, 1, 4, '275_276_277_278', 0, 0, 0, 0, 3, 0, 1, 0, 0, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Structure de la table `players`
--

CREATE TABLE `players` (
  `id` int(9) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `color` varchar(255) CHARACTER SET utf32 DEFAULT NULL,
  `score` int(4) DEFAULT NULL,
  `has_team` tinyint(1) DEFAULT NULL,
  `team_name` varchar(255) DEFAULT NULL,
  `team_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `players`
--

INSERT INTO `players` (`id`, `name`, `color`, `score`, `has_team`, `team_name`, `team_id`) VALUES
(275, 'srth', 'rgb(255, 136, 0)', 0, 1, 'Cucurb\'s', 112),
(276, 'sftgh', 'rgb(255, 136, 0)', 0, 1, 'Cucurb\'s', 112),
(277, 'jhfg', 'rgb(255, 0, 255)', 0, 1, 'Piggies', 113),
(278, 'jhgfryt', 'rgb(255, 0, 255)', 0, 1, 'Piggies', 113);

-- --------------------------------------------------------

--
-- Structure de la table `playlist`
--

CREATE TABLE `playlist` (
  `id` int(11) NOT NULL,
  `name` varchar(30) DEFAULT NULL,
  `songs` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `playlist`
--

INSERT INTO `playlist` (`id`, `name`, `songs`) VALUES
(1, 'test', '3_1_2'),
(3, 'test1', '2_1_3'),
(4, 'test2', '1_3_2');

-- --------------------------------------------------------

--
-- Structure de la table `songs`
--

CREATE TABLE `songs` (
  `id` int(11) NOT NULL,
  `title` varchar(255) DEFAULT 'NULL',
  `file` varchar(255) DEFAULT NULL,
  `path` varchar(255) DEFAULT NULL,
  `extension` varchar(4) CHARACTER SET utf8mb4 DEFAULT NULL,
  `singer` varchar(255) DEFAULT NULL,
  `category` varchar(255) DEFAULT NULL,
  `genre` varchar(255) DEFAULT NULL,
  `year` int(4) DEFAULT NULL,
  `picture` varchar(255) DEFAULT NULL,
  `points` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `songs`
--

INSERT INTO `songs` (`id`, `title`, `file`, `path`, `extension`, `singer`, `category`, `genre`, `year`, `picture`, `points`) VALUES
(1, 'Mano Negra', '01_Mano_Negra\r\n', 'music/mano_negra/patchanka/', 'mp3', 'Mano Negra', 'music', 'rock', 1988, 'mano_negra.jpg', 1),
(2, 'Ronde de nuit', '02_Ronde_de_nuit', 'music/mano_negra/patchanka/', 'mp3', 'Mano Negra', 'music', 'rock', 1988, 'mano_negra.jpg', 1),
(3, 'Baby you\'re mine', '03_Baby_you_re_mine\r\n', 'music/mano_negra/patchanka/', 'mp3', 'Mano Negra', 'music', 'rock', 1988, 'mano_negra.jpg', 1);

-- --------------------------------------------------------

--
-- Structure de la table `teams`
--

CREATE TABLE `teams` (
  `id` int(9) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `color` varchar(255) DEFAULT NULL,
  `has_players` tinyint(1) DEFAULT NULL,
  `players_nbr` int(2) DEFAULT NULL,
  `players_ids` varchar(127) DEFAULT NULL,
  `score` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `teams`
--

INSERT INTO `teams` (`id`, `name`, `color`, `has_players`, `players_nbr`, `players_ids`, `score`) VALUES
(112, 'Cucurb\'s', 'rgb(255, 136, 0)', 1, 2, '275_276', 0),
(113, 'Piggies', 'rgb(255, 0, 255)', 1, 2, '277_278', 0);

--
-- Index pour les tables exportées
--

--
-- Index pour la table `game_config`
--
ALTER TABLE `game_config`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `players`
--
ALTER TABLE `players`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `playlist`
--
ALTER TABLE `playlist`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `songs`
--
ALTER TABLE `songs`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `teams`
--
ALTER TABLE `teams`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `game_config`
--
ALTER TABLE `game_config`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;
--
-- AUTO_INCREMENT pour la table `players`
--
ALTER TABLE `players`
  MODIFY `id` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=279;
--
-- AUTO_INCREMENT pour la table `playlist`
--
ALTER TABLE `playlist`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT pour la table `songs`
--
ALTER TABLE `songs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT pour la table `teams`
--
ALTER TABLE `teams`
  MODIFY `id` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=114;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
