-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Sep 27, 2024 at 06:49 AM
-- Server version: 8.2.0
-- PHP Version: 8.2.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `supercars`
--

-- --------------------------------------------------------

--
-- Table structure for table `acceuil`
--

DROP TABLE IF EXISTS `acceuil`;
CREATE TABLE IF NOT EXISTS `acceuil` (
  `ID` int NOT NULL AUTO_INCREMENT,
  `TitreVideo` varchar(255) DEFAULT NULL,
  `Video` text,
  `Lien` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `CadreModele` varchar(255) DEFAULT NULL,
  `CadrePrix` decimal(15,2) DEFAULT NULL,
  `CadreImg` text,
  `CadrePollution` text,
  `CadreLien` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `ActualiteImg` text,
  `ActualiteDescription` varchar(255) DEFAULT NULL,
  `ActualiteLink` text,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `acceuil`
--

INSERT INTO `acceuil` (`ID`, `TitreVideo`, `Video`, `Lien`, `CadreModele`, `CadrePrix`, `CadreImg`, `CadrePollution`, `CadreLien`, `ActualiteImg`, `ActualiteDescription`, `ActualiteLink`) VALUES
(1, 'Porsche - Taycan', '\\supercar\\images\\images\\porshcetaycan.mp4', 'porsche.php', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(2, NULL, NULL, NULL, 'Ferrari 296 GTS', 300000.00, '\\supercar\\images\\images\\296gtsferrari.png', '\\supercar\\images\\images\\co2ferrari.png', 'ferrari.php', NULL, NULL, NULL),
(3, NULL, NULL, NULL, 'Jeep Avenger Longitude', 243000.00, '\\supercar\\images\\images\\jeepavenger.png', '\\supercar\\images\\images\\co2-taycan.png', 'jeep.php', NULL, NULL, NULL),
(4, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '\\supercar\\images\\images\\porschenew.jpg', 'Le nouveau Taycan impressionne avec une autonomie réelle allant jusqu’à 587 kilomètres.', 'https://newsroom.porsche.com/en/2024/products/porsche-taycan-development-drive-range-35170.html'),
(5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '\\supercar\\images\\images\\ferrarinews.avif', 'Rêve électrique.', 'https://www.ferrari.com/en-EN/magazine/articles/electric-dreams-ferrari-hybrid-battery'),
(6, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '\\supercar\\images\\images\\jeepnews.png', 'De fin 2024 à 2026, huit nouveaux véhicules seront lancés.', 'https://www.motortrend.com/news/stellantis-ceo-carlos-tavares-dodge-jeep-chrysler-ram-ev-stla-large-update/');

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

DROP TABLE IF EXISTS `admin`;
CREATE TABLE IF NOT EXISTS `admin` (
  `IdAdmin` int NOT NULL AUTO_INCREMENT,
  `Nom` varchar(255) NOT NULL,
  `Prenom` varchar(255) NOT NULL,
  `email` varchar(80) NOT NULL,
  `Telephone` varchar(50) NOT NULL,
  `Identifiant` varchar(150) NOT NULL,
  `MotDePasse` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  PRIMARY KEY (`IdAdmin`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`IdAdmin`, `Nom`, `Prenom`, `email`, `Telephone`, `Identifiant`, `MotDePasse`) VALUES
(3, 'vache', 'qui rit', 'omaranli56@gmail.com', '+230 5429 7857', 'vache qui rit', '$2y$10$O4HYGP44WHSnlUc.GS4jzO5acVVj4AWqIG.euH6d9XFDg.i35rZt6'),
(2, 'anli', 'omar', 'omaranli285@gmail.com', '+230 5429 7857', 'anliomar', '$2y$10$6NQBWoRdg90LwDC592rpVuYEFz.Z2jMBD2QEQAaV.3DIvc9d5brJW');

-- --------------------------------------------------------

--
-- Table structure for table `concerner`
--

DROP TABLE IF EXISTS `concerner`;
CREATE TABLE IF NOT EXISTS `concerner` (
  `IdVoiture` int NOT NULL AUTO_INCREMENT,
  `IdEvenement` int NOT NULL,
  PRIMARY KEY (`IdVoiture`,`IdEvenement`),
  KEY `IdEvenement` (`IdEvenement`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `connexion`
--

DROP TABLE IF EXISTS `connexion`;
CREATE TABLE IF NOT EXISTS `connexion` (
  `IdConnexion` int NOT NULL AUTO_INCREMENT,
  `Identifiant` varchar(50) NOT NULL,
  `MotDePasse` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `IdInscription` int NOT NULL,
  PRIMARY KEY (`IdConnexion`),
  UNIQUE KEY `IdInscription` (`IdInscription`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `connexion`
--

INSERT INTO `connexion` (`IdConnexion`, `Identifiant`, `MotDePasse`, `IdInscription`) VALUES
(5, 'omar dev', '$2y$10$QX1Pd6o4V3.SX9pKE9Oi.OCFjysF.Vz/mHBz6.7g7pFKlUmhX./EC', 30),
(6, 'omar dev', '$2y$10$0QppPA1AVlAScPkhH2A4WuTbHqvO4oYLDKJ6TOiB2cIsMYyTOaPp6', 31),
(7, 'yoyo', '$2y$10$VadvZYM9pUvVbIbPJDHOi.SFseXipQhREm73zyVUbD.1UDSJcycRO', 32),
(8, 'omar', '$2y$10$oBJqkkPqMIwcGKSlMQmi6.wxu2wALKs04JYHvjpQL2veMSr4nhfXu', 33);

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

DROP TABLE IF EXISTS `contacts`;
CREATE TABLE IF NOT EXISTS `contacts` (
  `IdContact` int NOT NULL AUTO_INCREMENT,
  `Nom` varchar(50) NOT NULL,
  `Prenom` varchar(50) NOT NULL,
  `email` varchar(80) NOT NULL,
  `NumTel` varchar(25) NOT NULL,
  PRIMARY KEY (`IdContact`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `contacts`
--

INSERT INTO `contacts` (`IdContact`, `Nom`, `Prenom`, `email`, `NumTel`) VALUES
(1, 'ahmed', 'mohamed', 'mccibs23043@student.mccibs.ac.mu', '+23054297857'),
(10, 'anli', 'omar', 'omaranli56@gmail.com', '+23054297857');

-- --------------------------------------------------------

--
-- Table structure for table `demandeessaie`
--

DROP TABLE IF EXISTS `demandeessaie`;
CREATE TABLE IF NOT EXISTS `demandeessaie` (
  `Ref_Essaie` int NOT NULL AUTO_INCREMENT,
  `DateEssaie` date NOT NULL,
  `HeureEssaie` time NOT NULL,
  `Marque` varchar(50) NOT NULL,
  `Modele` varchar(50) DEFAULT NULL,
  `Moteur` varchar(255) NOT NULL,
  `IdInscription` int NOT NULL,
  PRIMARY KEY (`Ref_Essaie`),
  KEY `IdInscription` (`IdInscription`)
) ENGINE=MyISAM AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `demandeessaie`
--

INSERT INTO `demandeessaie` (`Ref_Essaie`, `DateEssaie`, `HeureEssaie`, `Marque`, `Modele`, `Moteur`, `IdInscription`) VALUES
(16, '2024-04-11', '20:19:00', '2', '2', 'thermique', 31),
(17, '2024-04-19', '00:27:00', '1', '10', 'hybride', 31),
(18, '2024-04-19', '21:38:00', '2', '5', 'thermique', 31),
(19, '2024-04-19', '21:45:00', '3', '8', 'electrique', 31),
(20, '2024-09-20', '11:00:00', '1', '9', 'thermique', 33);

-- --------------------------------------------------------

--
-- Table structure for table `evenement`
--

DROP TABLE IF EXISTS `evenement`;
CREATE TABLE IF NOT EXISTS `evenement` (
  `IdEvenement` int NOT NULL AUTO_INCREMENT,
  `théme` varchar(100) NOT NULL,
  `DateDebut` date NOT NULL,
  `DateFin` date NOT NULL,
  `Description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `Prix` decimal(10,2) DEFAULT NULL,
  `location` varchar(255) NOT NULL,
  PRIMARY KEY (`IdEvenement`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `evenement`
--

INSERT INTO `evenement` (`IdEvenement`, `théme`, `DateDebut`, `DateFin`, `Description`, `image`, `Prix`, `location`) VALUES
(4, 'Académie d\'aventure en Jeep', '2024-05-29', '0000-00-00', 'Il s\'agit d\'un événement tout-terrain d\'entrée de gamme conçu pour renforcer la confiance et les bases du tout-terrain.', 'springfield.jpg', 464.88, 'SEYMOUR, MISSOURI'),
(3, 'Musée Ferrari', '2024-06-02', '0000-00-00', 'Au Musée Enzo Ferrari de Modène et au Musée Ferrari de Maranello, les visiteurs peuvent vivre des émotions exaltantes, des rêves et une véritable passion pour l\'automobile que seul ce lieu tout à fait unique peut offrir.', 'ferrarievent.avif', NULL, 'Italie - Maranello et Modena'),
(2, 'Werks Reunion Monterey', '2024-08-16', '0000-00-00', 'Rejoignez-nous au parcours de golf de Monterey Pines pour voir une gamme époustouflante de Porsche, des modèles rares aux modèles actuels, et tout le reste !', 'werksreunion.jpg', NULL, '1250 Garden Road, Monterey'),
(1, 'Porsche travel experience', '2024-06-01', '2024-06-06', 'La Norvège est synonyme de nature vaste, impressionnante et préservée. Explorez l\'un des pays les plus fascinants du Grand Nord au volant d\'une Porsche Taycan. De la métropole moderne d\'Oslo, en passant par un tronçon de la pittoresque et sinueuse « Route de l\'océan Atlantique », jusqu\'à la ville côtière de Trondheim. Cette visite au royaume des fjords est l’expérience électrisante ultime.', 'norway.jpg', 10990.00, 'Norway');

-- --------------------------------------------------------

--
-- Table structure for table `inscription`
--

DROP TABLE IF EXISTS `inscription`;
CREATE TABLE IF NOT EXISTS `inscription` (
  `IdInscription` int NOT NULL AUTO_INCREMENT,
  `Nom` varchar(70) NOT NULL,
  `Prenom` varchar(70) NOT NULL,
  `Adresse` varchar(150) NOT NULL,
  `NumTel` varchar(25) NOT NULL,
  `email` varchar(80) NOT NULL,
  `Identifiant` varchar(60) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT 'User',
  `MotDePasse` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  PRIMARY KEY (`IdInscription`)
) ENGINE=MyISAM AUTO_INCREMENT=34 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `inscription`
--

INSERT INTO `inscription` (`IdInscription`, `Nom`, `Prenom`, `Adresse`, `NumTel`, `email`, `Identifiant`, `MotDePasse`) VALUES
(12, 'anli', 'omar', 'Plot E63 Ebène', '+230 5429 7857', 'omaranli56@gmail.com', 'anliomar', 'Mot De Passe'),
(32, 'anli', 'omar', 'port louis', '+230', 'shfjhdjf@gmail.com', 'yoyo', '$2y$10$VadvZYM9pUvVbIbPJDHOi.SFseXipQhREm73zyVUbD.1UDSJcycRO'),
(31, 'anli', 'omar', 'ebene', '+230 5429 7857', 'omaranli285@gmail.com', 'omar dev', '$2y$10$0QppPA1AVlAScPkhH2A4WuTbHqvO4oYLDKJ6TOiB2cIsMYyTOaPp6'),
(33, 'ahmed', 'mohamed', 'E63 rue ', '+230 5429 7857', 'mccibs23043@student.mccibs.ac.mu', 'omar', '$2y$10$oBJqkkPqMIwcGKSlMQmi6.wxu2wALKs04JYHvjpQL2veMSr4nhfXu');

-- --------------------------------------------------------

--
-- Table structure for table `marque`
--

DROP TABLE IF EXISTS `marque`;
CREATE TABLE IF NOT EXISTS `marque` (
  `IdMarque` int NOT NULL AUTO_INCREMENT,
  `NomMarque` varchar(50) NOT NULL,
  PRIMARY KEY (`IdMarque`)
) ENGINE=MyISAM AUTO_INCREMENT=113 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `marque`
--

INSERT INTO `marque` (`IdMarque`, `NomMarque`) VALUES
(1, 'Porsche'),
(2, 'Ferrari'),
(3, 'Jeep');

-- --------------------------------------------------------

--
-- Table structure for table `modele`
--

DROP TABLE IF EXISTS `modele`;
CREATE TABLE IF NOT EXISTS `modele` (
  `IdModele` int NOT NULL AUTO_INCREMENT,
  `NomModele` varchar(50) DEFAULT NULL,
  `Prix` decimal(15,2) NOT NULL,
  `IdMarque` int NOT NULL,
  `Annee` int DEFAULT NULL,
  PRIMARY KEY (`IdModele`),
  KEY `IdMarque` (`IdMarque`)
) ENGINE=MyISAM AUTO_INCREMENT=48 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `modele`
--

INSERT INTO `modele` (`IdModele`, `NomModele`, `Prix`, `IdMarque`, `Annee`) VALUES
(1, 'Ferrari 488 GTB', 250000.00, 2, 2015),
(2, 'Ferrari F8 Tributo', 300000.00, 2, 2019),
(3, 'Ferrari 812 Superfast', 350000.00, 2, 2017),
(4, 'Ferrari SF90 Stradale', 600000.00, 2, 2019),
(5, 'Ferrari 296 GTB', 300000.00, 2, 2022),
(6, 'Ferrari SF90 Spider', 700000.00, 2, 2020),
(7, 'Porsche 911 Carrera', 140485.00, 1, 2019),
(8, 'Porsche Macan', 59293.00, 1, 2014),
(9, 'Porsche Taycan', 105011.00, 1, 2019),
(10, 'Porsche Taycan Turbo S', 215207.00, 1, 2020),
(11, 'Porsche Cayenne E-Hybrid', 109769.00, 1, 2020),
(12, 'Porsche Panamera Turbo E-Hybrid', 194833.00, 1, 2024),
(13, 'Jeep Grand Cherokee', 99950.00, 3, 2014),
(14, 'Jeep Grand Cherokee Trackhawk', 95445.00, 3, 2021),
(15, 'Jeep Avenger Longitude', 24300.00, 3, 2023),
(16, 'Jeep Avenger Summit', 28800.00, 3, 2024),
(17, 'Jeep Wagoneer', 100700.00, 3, 2024),
(18, 'Jeep Wrangler 4xe', 91700.00, 3, 2024);

-- --------------------------------------------------------

--
-- Table structure for table `utilisateurs`
--

DROP TABLE IF EXISTS `utilisateurs`;
CREATE TABLE IF NOT EXISTS `utilisateurs` (
  `IdUtilisateur` int NOT NULL AUTO_INCREMENT,
  `Prenom` varchar(50) NOT NULL,
  `Nom` varchar(50) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `Identifiant` varchar(50) NOT NULL,
  `MotDePasse` varchar(255) NOT NULL,
  PRIMARY KEY (`IdUtilisateur`),
  UNIQUE KEY `Email` (`Email`),
  UNIQUE KEY `Identifiant` (`Identifiant`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `voitures`
--

DROP TABLE IF EXISTS `voitures`;
CREATE TABLE IF NOT EXISTS `voitures` (
  `IdVoiture` int NOT NULL AUTO_INCREMENT,
  `Couleur` varchar(50) NOT NULL,
  `TypeMoteur` varchar(50) NOT NULL,
  `Carburant` varchar(50) DEFAULT NULL,
  `Km` decimal(15,2) DEFAULT NULL,
  `BoiteVitesse` varchar(50) NOT NULL,
  `IdModele` int NOT NULL,
  `IdMarque` int NOT NULL,
  `Image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  PRIMARY KEY (`IdVoiture`),
  KEY `IdModele` (`IdModele`)
) ENGINE=MyISAM AUTO_INCREMENT=41 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `voitures`
--

INSERT INTO `voitures` (`IdVoiture`, `Couleur`, `TypeMoteur`, `Carburant`, `Km`, `BoiteVitesse`, `IdModele`, `IdMarque`, `Image`) VALUES
(1, 'Rouge', 'Thermique', 'essence', 0.00, 'Automatique', 1, 2, 'Ferrari-488-GTB.jpg'),
(2, 'Noire', 'Thermique', 'essence', 0.00, 'Automatique', 2, 2, 'Ferrari_F8_Tributo_720_ch_0.jpg'),
(3, 'Jaune', 'Thermique', 'essence', 0.00, 'Automatique', 3, 2, 'ferrari_812.webp'),
(4, 'Rouge', 'Hybride rechargeable', 'essence', 0.00, 'Automatique', 4, 2, 'ferrari_sf90_stradale.jpg'),
(5, 'Jaune', 'Hybride rechargeable', 'essence', 0.00, 'Double-embrayage automatique', 5, 2, 'ferrari-296-GTB-2024.jpg'),
(6, 'Gris metalique', 'Thermique', 'essence', 0.00, 'Doube-embrayage automatique', 6, 2, 'ferrari-SF90-spider.webp'),
(7, 'Blanche', 'Thermique', 'essence', 0.00, 'Doube-embrayage automatique', 7, 1, 'carreraexterior.webp'),
(8, 'Noire', 'Thermique', 'essence', 0.00, 'manuelle', 8, 1, 'macancar.avif'),
(9, 'Blanche', 'Electrique', '', 0.00, 'Automatique', 9, 1, 'carreraexterior.webp'),
(10, 'Blanche', 'Electrique', '', 0.00, 'Automatique', 10, 1, 'taycanturbos.jpg'),
(39, 'Rouge', 'Electrique', '', 0.00, 'Automatique', 12, 1, 'panamera.avif'),
(13, 'Rouge sombre', 'Thermique', 'essence', 0.00, 'Automatique huit-rapports', 13, 3, 'grandcherokee.avif'),
(14, 'Noire', 'Thermique', 'essence', 0.00, 'Automatique huit-rapports', 14, 3, 'grandcherokeetrackhawk.webp'),
(15, 'Gris', 'Electrique', 'essence', 0.00, 'Automatique', 17, 3, 'wagoneer.jpg'),
(16, 'Noire', 'Hybride rechargeable', 'essence', 0.00, 'Automatique', 18, 3, 'wrangler4xe.jpg'),
(30, 'jaune', 'Thermique', 'essence', 1.00, 'Automatique', 15, 3, 'avengerlongitude.avif'),
(37, 'blanche', 'Hybride rechargeable', 'essence', 0.00, 'manuelle', 11, 1, 'cayenneehybrid.avif');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
