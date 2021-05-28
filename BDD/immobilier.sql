-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : mer. 27 jan. 2021 à 14:39
-- Version du serveur :  5.7.31
-- Version de PHP : 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `immobilier`
--

-- --------------------------------------------------------

--
-- Structure de la table `logement`
--

DROP TABLE IF EXISTS `logement`;
CREATE TABLE IF NOT EXISTS `logement` (
  `id_logement` int(11) NOT NULL AUTO_INCREMENT,
  `titre` varchar(255) NOT NULL,
  `adresse` varchar(255) NOT NULL,
  `ville` varchar(255) NOT NULL,
  `cp` int(5) NOT NULL,
  `surface` int(11) NOT NULL,
  `prix` int(11) NOT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `type` varchar(255) NOT NULL,
  `description` text,
  PRIMARY KEY (`id_logement`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `logement`
--

INSERT INTO `logement` (`id_logement`, `titre`, `adresse`, `ville`, `cp`, `surface`, `prix`, `photo`, `type`, `description`) VALUES
(11, 'Appartement', '3 rue du chat qui pisse debout', 'CHATLAND', 55425, 90, 125000, 'logement_11.jpeg', 'Vente', 'Superbe appartement au sud...'),
(13, 'Maison', '14 chemin de l\'étang', 'NIORT', 79000, 250, 520000, 'logement_13.jpeg', 'Vente', 'Villa récente et magnifique en surplomb'),
(16, 'Ma belle demeure', '21 rue de la chance', 'HEUREUSEVILLE', 77777, 150, 200000, 'logement_16.jpeg', 'Location', 'Nous mettons notre bellemaison en location'),
(20, 'Maison de rêve', '25 ter le bolide', 'BALI', 65487, 256, 3000000, 'logement_20.jpeg', 'Vente', 'A vendre superbe demeureA vendre superbe demeureA vendre superbe demeureA vendre superbe demeureA vendre superbe demeureA vendre superbe demeureA vendre superbe demeureA vendre superbe demeureA vendre superbe demeureA vendre superbe demeureA vendre superbe demeureA vendre superbe demeureA vendre superbe demeureA vendre superbe demeureA vendre superbe demeureA vendre superbe demeureA vendre superbe demeureA vendre superbe demeureA vendre superbe demeureA vendre superbe demeureA vendre superbe demeureA vendre superbe demeureA vendre superbe demeureA vendre superbe demeureA vendre superbe demeureA vendre superbe demeureA vendre superbe demeureA vendre superbe demeureA vendre superbe demeureA vendre superbe demeureA vendre superbe demeureA vendre superbe demeureA vendre superbe demeureA vendre superbe demeureA vendre superbe demeureA vendre superbe demeureA vendre superbe demeureA vendre superbe demeure'),
(21, 'Appartement', 'ythbgthg\"hg\"(hh', 'h(-he-h(-eh-hteyh', 36987, 125, 354, 'logement_21.jpeg', 'Vente', 'vendre superbe demeureA vendre superbe demeureA vendre superbe demeureA vendre superbe demeureA vendre superbe demeureA vendre superbe demeureA vendre superbe demeureA vendre superbe demeureA vendre superbe demeureA vendre superbe demeureA vendre superbe demeureA vendre superbe demeureA vendre superbe demeureA vendre superbe demeureA vendre superbe demeureA vendre superbe demeureA vendre superbe demeureA vendre superbe demeureA vendre superbe demeureA vendre superbe demeureA vendre superbe demeureA vendre superbe demeureA vendre superbe demeureA vendre superbe demeureA vendre superbe demeureA vendre superbe demeureA vendre superbe demeureA vendre superbe demeureA vendre superbe demeureA vendre superbe demeureA vendre superbe demeureA vendre superbe demeureA vendre superbe demeure'),
(24, 'ijieroivnirtvijzirvj', 'jtgbortvoihrztohvn', 'brtjzhvuhrztthvzrjt', 23654, 1254, 36985, 'logement_24.jpeg', 'Location', 'azertyazertyazertyazertyazertyazertyazertyazertyazertyazertyazertyazertyazertyazertyazertyazertyazertyazertyazertyazertyazertyazertyazertyazertyazertyazertyazertyazertyazertyazertyazertyazertyazertyazertyazertyazertyazertyazertyazertyazertyazertyazertyazertyazertyazertyazertyazertyazertyazertyazertyazertyazertyazertyazertyazertyazertyazertyazertyazertyazertyazertyazertyazertyazertyazertyazertyazertyazertyazertyazertyazertyazertyazertyazertyazertyazertyazertyazertyazertyazertyazertyazertyazertyazertyazertyazertyazertyazertyazertyazertyazertyazertyazertyazertyazertyazertyazertyazertyazertyazertyazertyazertyazertyazertyazertyazertyazertyazertyazertyazertyazertyazertyazertyazertyazertyazertyazertyazertyazertyazertyazertyazertyazertyazertyazertyazertyazertyazertyazertyazertyazertyazertyazerty'),
(25, 'zadfdazdaz', 'dazdcxazqcazcazcaz', 'cazcaqca', 32541, 35, 1, 'logement_25.jpeg', 'Location', 'azdazdazcxazcxazcxazcx'),
(26, 'hbFDSB DFB', 'gnfwnfgnfwgnwfnn', 'ngfnfgnf', 12345, 123, 123, 'logement_26.jpeg', 'Location', 'uhgvhsdvsvgbfdbfdnfgngf'),
(27, 'mohkpoerjhboejr', 'kfierjbijsijbijbbjkfdbnk', 'ertyuifghj', 45632, 541, 3654, 'logement_27.jpeg', 'Vente', 'azertyuiop');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
