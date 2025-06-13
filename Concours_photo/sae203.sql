-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : ven. 26 avr. 2024 à 08:51
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
-- Base de données : `sae203`
--

-- --------------------------------------------------------

--
-- Structure de la table `photo`
--

DROP TABLE IF EXISTS `photo`;
CREATE TABLE IF NOT EXISTS `photo` (
  `id_photo` int NOT NULL AUTO_INCREMENT,
  `auteur_photo` varchar(128) NOT NULL,
  `description_photo` tinytext NOT NULL,
  `chemin_photo` varchar(128) NOT NULL,
  `date_photo` datetime NOT NULL,
  `titre_photo` varchar(128) NOT NULL,
  PRIMARY KEY (`id_photo`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `photo`
--

INSERT INTO `photo` (`id_photo`, `auteur_photo`, `description_photo`, `chemin_photo`, `date_photo`, `titre_photo`) VALUES
(2, 'aline', 'Beautiful', 'public/media/images/aline_nature.jpg', '2023-05-23 09:26:07', 'nature'),
(3, 'aline', 'Superbe', 'public/media/images/aline_fantasy.jpg', '2023-05-23 09:27:01', 'fantasy'),
(4, 'aline', 'Chouette!', 'public/media/images/aline_chouette.jpg', '2023-05-23 09:28:37', 'chouette'),
(5, 'jean', 'Que de fleurs', 'public/media/images/jean_fleurs.jpg', '2023-05-27 15:51:33', 'fleurs'),
(6, 'jacques', 'Une route', 'public/media/images/jacques_route.jpg', '2023-05-27 19:34:59', 'route'),
(7, 'jean', 'Photo de Man Ray', 'public/media/images/jean_Larmes.jpg', '2023-05-27 21:07:19', 'Larmes'),
(15, 'p', 'pomme sur fond noir', 'public/media/images/p_pomme.jpg', '2024-03-23 19:51:17', 'pomme');

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

DROP TABLE IF EXISTS `utilisateur`;
CREATE TABLE IF NOT EXISTS `utilisateur` (
  `pseudo_utilisateur` varchar(128) NOT NULL,
  `mail_utilisateur` varchar(128) NOT NULL,
  `mdp_utilisateur` varchar(128) NOT NULL,
  PRIMARY KEY (`pseudo_utilisateur`,`mail_utilisateur`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `utilisateur`
--

INSERT INTO `utilisateur` (`pseudo_utilisateur`, `mail_utilisateur`, `mdp_utilisateur`) VALUES
('aline', 'al@gmail.com', 't'),
('aline2', 'a@a', 'a'),
('jacques', 'j@j.com', 't'),
('jean', 'jean@gmail.com', 't'),
('p', 'p@p', 'p'),
('r', 'j@j', 'a'),
('x', 'x@x', 'a');

-- --------------------------------------------------------

--
-- Structure de la table `vote`
--

DROP TABLE IF EXISTS `vote`;
CREATE TABLE IF NOT EXISTS `vote` (
  `photo_vote` int NOT NULL,
  `utilisateur_vote` varchar(128) NOT NULL,
  `valeur_vote` int NOT NULL,
  PRIMARY KEY (`photo_vote`,`utilisateur_vote`),
  KEY `photo` (`photo_vote`),
  KEY `utilisateur` (`utilisateur_vote`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `vote`
--
ALTER TABLE `vote`
  ADD CONSTRAINT `photo` FOREIGN KEY (`photo_vote`) REFERENCES `photo` (`id_photo`),
  ADD CONSTRAINT `utilisateur` FOREIGN KEY (`utilisateur_vote`) REFERENCES `utilisateur` (`pseudo_utilisateur`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
