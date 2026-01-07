-- Adminer 4.8.1 MySQL 10.11.6-MariaDB-0+deb12u1 dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

SET NAMES utf8mb4;

DROP TABLE IF EXISTS `benevole`;
CREATE TABLE `benevole` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `dispo` text DEFAULT NULL,
  `motivation` text DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `benevole` (`id`, `nom`, `email`, `dispo`, `motivation`) VALUES
(2,	'David LAVERGNE',	'davidlavergne@hotmail.com',	'Toujours',	'Envie d\'aider des établissements dans le besoin !\r\n'),
(3,	'Geoffroy DUTT',	'geoffroydutt@gmail.com',	'Que les weekends',	'Participer à des campagnes de donations avec des ONGs.'),
(5,	'Léo MILHOUA',	'leomilh@gmail.fr',	'Seulement en semaine',	'Donner mes vieux cahiers et stylos etc. et également participer à des opérations sur le terrain.'),
(6,	'Tony RUIZ',	'tonyruiz@gmail.com',	'Tous les jours',	'Faire des donations pour aider les écoles.'),
(10,	'David LAVERGNE',	'davidlavergne40@gmail.com',	'Que les weekends',	'Pour aider les écoles à mieux se développer');

DROP TABLE IF EXISTS `demandes_aide`;
CREATE TABLE `demandes_aide` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom_institution` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `details_besoins` text DEFAULT NULL,
  `date_demande` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `demandes_aide` (`id`, `nom_institution`, `email`, `details_besoins`, `date_demande`) VALUES
(2,	'École Louis XI',	'ecolelouisxi@hotmail.fr',	'Nous aimerions une aide financière (autour des 2000€) et du personnel (5-8 personnes à plein temps) pour pouvoir continuer à faire fonctionner l\'établissement.\r\n',	'2025-12-02 15:07:37'),
(3,	'Ecole Jacques VI',	'ecolejacquesvi@gmail.com',	'On a besoin de 3000€ de dons et de 5-10 personnes pour faire professeur et cuisinier etc...',	'2025-12-03 06:45:04'),
(4,	'Cité Scolaire Jean-Pierre Timbaud',	'citescoljptimbaud@gmail.com',	'Besoin d\'aides financières massives pour rénover le bâtiment Sud-3 et Sud-2.\r\n',	'2026-01-07 10:31:48');

DROP TABLE IF EXISTS `demande_type_aide`;
CREATE TABLE `demande_type_aide` (
  `aide_id` int(11) NOT NULL,
  `type_aide_id` int(11) NOT NULL,
  PRIMARY KEY (`aide_id`,`type_aide_id`),
  KEY `type_aide_id` (`type_aide_id`),
  CONSTRAINT `demande_type_aide_ibfk_1` FOREIGN KEY (`aide_id`) REFERENCES `demandes_aide` (`id`),
  CONSTRAINT `demande_type_aide_ibfk_2` FOREIGN KEY (`type_aide_id`) REFERENCES `type_aide` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `demande_type_aide` (`aide_id`, `type_aide_id`) VALUES
(2,	1),
(2,	2),
(3,	1),
(3,	3);

DROP TABLE IF EXISTS `ong`;
CREATE TABLE `ong` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `effectif` int(11) DEFAULT NULL,
  `budget` decimal(15,2) DEFAULT NULL,
  `date_inscription` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `ong` (`id`, `nom`, `email`, `description`, `effectif`, `budget`, `date_inscription`) VALUES
(4,	'EducaHelp',	'educahelp@gmail.com',	'Aider les institutions qui ont besoin d\'argent pour continuer à fonctionner et également intervenir sur le terrain pour suppléer les personnes dans les écoles, etc...',	47,	4000.00,	'2025-12-03 13:57:05'),
(5,	'Organisation des Jeunes Travailleurs',	'orgajt64@hotmail.fr',	'Participer au recyclage des objets encore utilisables par les écoles qui sont malgré tout jetés, effectuer des actions directement dans les établissements, permettre aux jeunes bénévoles d\'aider les autres à avoir accès à une éducation correcte.',	156,	15000.00,	'2025-12-03 14:03:25'),
(6,	'Educare',	'educare@gmail.fr',	'On va réaliser des opérations à grande échelle sur divers établissements partout dans le monde.',	200,	30000.00,	'2025-12-05 10:03:48'),
(9,	'ONG CARE',	'ongcare@gmail.com',	'Aider les institutions qui ont besoin de budget pour effectuer des actions.\r\nPeut effectuer des actions sur le terrain.\r\n',	10,	50000.00,	'2026-01-07 10:39:43'),
(10,	'ONG CARE',	'ongcare@gmail.com',	'Aider les institutions qui ont besoin de budget pour réaliser des projets.\r\nPeut intervenir sur place si il faut',	40,	20000.00,	'2026-01-07 10:44:21');

DROP TABLE IF EXISTS `ong_type_aide`;
CREATE TABLE `ong_type_aide` (
  `ong_id` int(11) NOT NULL,
  `type_aide_id` int(11) NOT NULL,
  PRIMARY KEY (`ong_id`,`type_aide_id`),
  KEY `type_aide_id` (`type_aide_id`),
  CONSTRAINT `ong_type_aide_ibfk_1` FOREIGN KEY (`ong_id`) REFERENCES `ong` (`id`),
  CONSTRAINT `ong_type_aide_ibfk_2` FOREIGN KEY (`type_aide_id`) REFERENCES `type_aide` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `ong_type_aide` (`ong_id`, `type_aide_id`) VALUES
(4,	1),
(4,	3),
(5,	2),
(5,	3),
(6,	1),
(6,	2),
(6,	3),
(10,	1),
(10,	3);

DROP TABLE IF EXISTS `type_aide`;
CREATE TABLE `type_aide` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type_aide` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `type_aide` (`id`, `type_aide`) VALUES
(1,	'Aide financière'),
(2,	'Aide matérielle'),
(3,	'Aide sur place');

-- 2026-01-07 11:54:47
