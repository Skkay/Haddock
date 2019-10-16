-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  mer. 16 oct. 2019 à 18:16
-- Version du serveur :  5.7.26
-- Version de PHP :  7.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `haddock_base`
--

-- --------------------------------------------------------

--
-- Structure de la table `quiz`
--

DROP TABLE IF EXISTS `quiz`;
CREATE TABLE IF NOT EXISTS `quiz` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `question` varchar(255) NOT NULL,
  `rep_1` varchar(255) NOT NULL,
  `rep_2` varchar(255) NOT NULL,
  `rep_3` varchar(255) NOT NULL,
  `rep_4` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `quiz`
--

INSERT INTO `quiz` (`id`, `question`, `rep_1`, `rep_2`, `rep_3`, `rep_4`) VALUES
(1, 'Dans quel album de Tintin apparaît pour la première fois le capitaine Haddock ?', 'Le Crabe aux pinces d\'or', 'Tintin au Congo', 'Le Secret de la Licorne', 'On a marché sur la Lune'),
(2, 'Dans le Secret de la Licorne, nous découvrons le célèbre ancêtre du capitaine : quel est son nom ?', 'François, Chevalier de Hadoque', 'Barberousse', 'Barbe Noire', 'Le Comte de Moulinsart'),
(3, 'D\'où est tiré le nom de Haddock ?', 'Du nom d\'un poisson de la famille des morues', 'De l\'expression \"ad hoc\"', 'Du nom d\'un oncle d\'Hergé', 'Du nom d\'un pirate du XVIème siècle'),
(4, 'Le compagnon de Tintin est connu pour ses célèbres injures : laquelle n\'a-t-il jamais utilisée ?', 'Cuistre', 'Anthropopithèque', 'Ectoplasme', 'Moule à gaufres'),
(5, 'Dans Tintin au Tibet, le capitaine Haddock rencontre un être étrange, appelé :', 'Le yéti', 'Le yéto', 'Le yéya', 'Le téyi'),
(6, 'Le capitaine Haddock est un buveur invétéré mais il ne supporte absolument pas une boisson : laquelle ?', 'L\'eau', 'Le lait', 'Le radjaïdja', 'Le whisky Loch Lomond'),
(7, 'Une femme a été secrètement amoureuse de lui : qui est-elle?', 'La Castafiore', 'Madame Irma', 'Le yéti (femelle)', 'Peggy, femme du général Alcazar'),
(8, 'Le Capitaine Haddock tire le professeur Tournesol de son amnésie dans \"Objectif Lune\" en prononçant involontairement le mot :', 'Zouave', 'Clysopompe', 'Hurluberlu', 'Ostrogoth'),
(9, 'Dans \"Coke en stock\", le capitaine se fait tyranniser par un petit diable appelé :', 'Abdallah', 'Lama', 'Zorrino', 'Ranko'),
(10, 'Quel est le plus grand des casse-pieds selon le capitaine (et qui apparaît dans \"L\'affaire Tournesol\") ?', 'Séraphin Lampion, des assurances Mondass', 'Nestor', 'Le plombier Mr Boullu', 'Le professeur Tournesol');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
