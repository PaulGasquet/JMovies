-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  mer. 14 avr. 2021 à 22:32
-- Version du serveur :  10.4.10-MariaDB
-- Version de PHP :  7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `db_jmovies`
--

-- --------------------------------------------------------

--
-- Structure de la table `review`
--

DROP TABLE IF EXISTS `review`;
CREATE TABLE IF NOT EXISTS `review` (
  `review_id` int(11) NOT NULL,
  `mark` int(11) DEFAULT NULL,
  `reviewcontent` varchar(1000) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `movie_title` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`review_id`),
  KEY `user_id` (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `review`
--

INSERT INTO `review` (`review_id`, `mark`, `reviewcontent`, `user_id`, `movie_title`) VALUES
(45233, 1, 'c\'est nul', 16600, 'star wars épisode 1'),
(78856, 4, 'Très bon film mais un peu long', 3893, 'Forrest Gump'),
(79274, 1, 'c\'est nul', 18806, 'rambo'),
(59395, 5, 'incroyable, un chef d\'œuvre', 8776, 'star wars épisode 2'),
(74115, 5, 'c\'est excellent', 19162, 'jumanji'),
(27979, 5, 'c\'est excellent', 19162, 'interstellar'),
(28186, 2, 'c\'est nul', 3893, 'terminator'),
(18155, 5, 'incroyable, un chef d\'œuvre', 3893, '2001: A Space Odyssey'),
(74563, 5, 'incroyable, un chef d\'œuvre', 11107, 'terminator'),
(95627, 1, 'c\'est nul', 2990, 'star wars épisode 1'),
(39304, 4, 'c\'est excellent', 2990, 'terminator'),
(52995, 5, 'incroyable, un chef d\'œuvre', 2990, '2001: A Space Odyssey'),
(34466, 3, 'Très bon film mais un peu long', 2990, 'jumanji'),
(43094, 2, 'ça fait peur', 2990, 'saw 2'),
(65200, 2, 'pas top', 20552, 'Lucy'),
(68970, 0, 'Une honte pour le cinéma', 20552, 'dragon ball evolution'),
(43972, 5, 'c\'est excellent', 8776, 'terminator'),
(10384, 4, 'Très bon', 20552, 'inglorious bastard');

-- --------------------------------------------------------

--
-- Structure de la table `user_web`
--

DROP TABLE IF EXISTS `user_web`;
CREATE TABLE IF NOT EXISTS `user_web` (
  `user_id` int(11) NOT NULL,
  `username` varchar(100) DEFAULT NULL,
  `preference` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `user_web`
--

INSERT INTO `user_web` (`user_id`, `username`, `preference`) VALUES
(18806, 'joseph joestar', 'science fiction'),
(6447, 'Dio Brando', 'action'),
(16600, 'josuke ', 'drama'),
(20552, 'Giorno Giovanna', 'science fiction'),
(8776, 'speedwagon', 'drama'),
(19162, 'Giorno Giovanna', 'action'),
(3893, 'jotaro kujo', 'science fiction'),
(18703, 'joseph joestar', 'action'),
(11198, 'jolyne kujo', 'science fiction'),
(2990, 'Gerard', 'science fiction'),
(11107, 'Giorno Giovanna', 'science fiction'),
(22237, 'josuke ', 'action'),
(3399, 'jolyne kujo', 'science fiction');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
