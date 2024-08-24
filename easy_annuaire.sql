-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : mar. 25 juin 2024 à 17:13
-- Version du serveur : 8.2.0
-- Version de PHP : 8.2.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `easy_annuaire`
--

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `users_id` int NOT NULL AUTO_INCREMENT,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `name` varchar(100) NOT NULL,
  `firstname` varchar(100) NOT NULL,
  `role` tinyint(1) NOT NULL,
  `date_create` timestamp NOT NULL,
  `email_confirmation_token` varchar(64) NOT NULL,
  `email_confirmation_timestamp` timestamp NOT NULL,
  `email_confirmed` tinyint(1) DEFAULT NULL,
  `users_info_id` int NOT NULL,
  PRIMARY KEY (`users_id`),
  UNIQUE KEY `users_info_id` (`users_info_id`)
) ENGINE=InnoDB AUTO_INCREMENT=68 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`users_id`, `email`, `password`, `name`, `firstname`, `role`, `date_create`, `email_confirmation_token`, `email_confirmation_timestamp`, `email_confirmed`, `users_info_id`) VALUES
(10, 'azerty@ifapme.be', '$2y$10$z8ecykru2Cg6OBGnFnJtnu8qPZoNugmXM11Sc8QUDgIyKA.quqObO', 'Morais', 'Dylan', 1, '2024-06-18 17:06:06', '', '2024-06-18 17:06:06', NULL, 5),
(67, 'vosyd@mailinator.com', '$2y$10$6sbM.KKPtCII8SKP9xbkBub2biOUg3ScDpdJjXnUmmcY1ltlKVuXi', 'veronica payne', 'Lucius', 0, '2024-06-25 14:42:43', '', '0000-00-00 00:00:00', 1, 62);

-- --------------------------------------------------------

--
-- Structure de la table `users_info`
--

DROP TABLE IF EXISTS `users_info`;
CREATE TABLE IF NOT EXISTS `users_info` (
  `users_info_id` int NOT NULL AUTO_INCREMENT,
  `birthdate` date NOT NULL,
  `recorded_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`users_info_id`)
) ENGINE=InnoDB AUTO_INCREMENT=63 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `users_info`
--

INSERT INTO `users_info` (`users_info_id`, `birthdate`, `recorded_at`) VALUES
(5,  '2002-07-03',  NULL),
(6,  '1979-06-05',  NULL),
(7,  '1975-08-05',  NULL),
(8,  '1977-08-31',  NULL),
(27,  '2002-07-03',  NULL),
(28,  '1994-04-02',  NULL),
(29,  '2024-06-04',  NULL),
(30,  '1979-06-04',  NULL),
(31,  '2013-04-07',  NULL),
(32,  '2020-03-14',  NULL),
(33,  '2024-06-17',  NULL),
(34,  '2020-02-23',  NULL),
(35,  '1995-06-04',  NULL),
(36,  '1980-04-18',  NULL),
(37,  '1978-03-21',  NULL),
(38,  '1972-07-18',  NULL),
(39,  '1999-05-17',  NULL),
(40,  '2014-06-21',  NULL),
(41,  '2020-05-06',  NULL),
(42,  '2000-02-25',  NULL),
(43,  '1995-04-24',  NULL),
(44,  '1998-11-30',  NULL),
(46,  '1974-11-06',  NULL),
(47,  '2003-04-22',  NULL),
(48,  '1992-10-15',  NULL),
(49,  '2002-05-10',  NULL),
(50,  '1992-07-08',  NULL),
(51,  '1991-07-31',  NULL),
(52,  '2006-06-06',  NULL),
(53,  '1987-05-15',  NULL),
(54,  '1970-08-29',  NULL),
(55,  '1997-11-27',  NULL),
(56,  '2022-05-22',  NULL),
(57,  '2008-10-15',  NULL),
(58,  '2012-03-25',  NULL),
(59,  '2002-02-21',  NULL),
(60,  '1977-11-12',  NULL),
(61,  '1979-01-29',  NULL),
(62,  '1978-10-17',  NULL);

-- --------------------------------------------------------

--
-- Structure de la table 'contacts'
--

DROP TABLE IF EXISTS `contacts`;
CREATE TABLE IF NOT EXISTS `contacts` (
  `contacts_id` int NOT NULL AUTO_INCREMENT,
  `users_id` int NOT NULL,
  `contact_mail` varchar(100) NOT NULL,
  `contact_name` varchar(100) NOT NULL,
  `contact_firstname` varchar(100) NOT NULL,
  `contact_phone` varchar(100) NOT NULL,
  `contact_phone2` varchar(100) NOT NULL,
  `contact_adress` varchar(100) NOT NULL,
  `date_create` timestamp NOT NULL,
  PRIMARY KEY (`contacts_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `contacts`
--

INSERT into `contacts` (`contacts_id`, `users_id`, `contact_mail`, `contact_name`, `contact_firstname`, `contact_phone`, `contact_phone2`, `contact_adress`, `date_create`) VALUES
(1, 10, 'test@gmail.com', 'testname', 'testfirstname', '0477777777', '0477777777', 'rue de la test 48 7800 ath', '2024-06-25 17:13:00'),
(2, 10, 'morais@gmail.com', 'morais', 'dylan', '0477777777', '0477777777', 'rue de la test 48 7800 ath', '2024-06-25 17:13:00'); 

-- --------------------------------------------------------

--
-- Contraintes pour la table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`users_info_id`) REFERENCES `users_info` (`users_info_id`) ON DELETE RESTRICT ON UPDATE RESTRICT;
ALTER TABLE `contacts`
  ADD CONSTRAINT `contacts_ibfk_1` FOREIGN KEY (`users_id`) REFERENCES `users` (`users_id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
