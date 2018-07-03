-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  mar. 03 juil. 2018 à 07:28
-- Version du serveur :  5.7.19
-- Version de PHP :  7.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `wetransfert`
--

-- --------------------------------------------------------

--
-- Structure de la table `upload`
--

DROP TABLE IF EXISTS `upload`;
CREATE TABLE IF NOT EXISTS `upload` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fichierUpload` varchar(255) DEFAULT NULL,
  `mailUploader` varchar(255) DEFAULT NULL,
  `dateUpload` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=380 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `upload`
--

INSERT INTO `upload` (`id`, `fichierUpload`, `mailUploader`, `dateUpload`) VALUES
(379, 'C:\\wamp64\\tmp\\phpE8C2.tmp', 'vbxcw<Wxcvnb,', '01-07-2018-15-23'),
(378, 'C:\\wamp64\\tmp\\php6080.tmp', 'vbxcw<Wxcvnb,', '01-07-2018-15-20'),
(377, 'C:\\wamp64\\tmp\\php4C5F.tmp', 'vbxcw<Wxcvnb,', '01-07-2018-15-19'),
(376, 'C:\\wamp64\\tmp\\phpCFEB.tmp', 'vbxcw<Wxcvnb,', '01-07-2018-15-19'),
(375, 'C:\\wamp64\\tmp\\php65D8.tmp', 'vbxcw<Wxcvnb,', '01-07-2018-15-00'),
(374, 'C:\\wamp64\\tmp\\php3820.tmp', 'vbxcw<Wxcvnb,', '01-07-2018-14-59'),
(373, 'C:\\wamp64\\tmp\\phpB12F.tmp', 'vbxcw<Wxcvnb,', '01-07-2018-14-40'),
(372, 'C:\\wamp64\\tmp\\php2B06.tmp', 'dfghj', '01-07-2018-14-40'),
(371, 'C:\\wamp64\\tmp\\phpF9A9.tmp', 'shfd', '01-07-2018-14-38'),
(370, 'C:\\wamp64\\tmp\\php69EB.tmp', 'ousmane@nfsjq.fr', '01-07-2018-14-38'),
(368, NULL, NULL, '29-06-2018-20-40'),
(369, 'C:\\wamp64\\tmp\\phpE0BD.tmp', 'ousmane@nfsjq.fr', '01-07-2018-14-24'),
(367, 'C:\\wamp64\\tmp\\php95AB.tmp', 'erfghjk', '29-06-2018-20-39'),
(366, 'C:\\wamp64\\tmp\\phpF05.tmp', 'erfghjk', '29-06-2018-20-39'),
(365, 'C:\\wamp64\\tmp\\php5C96.tmp', 'erfghjk', '29-06-2018-20-36'),
(364, 'C:\\wamp64\\tmp\\php410E.tmp', 'erfghjk', '29-06-2018-20-36'),
(363, 'C:\\wamp64\\tmp\\phpC366.tmp', 'erfghjk', '29-06-2018-20-34'),
(362, 'C:\\wamp64\\tmp\\phpAA78.tmp', 'erfghjk', '29-06-2018-20-32'),
(360, 'C:\\wamp64\\tmp\\php7494.tmp', 'erfghjk', '29-06-2018-20-27'),
(361, 'C:\\wamp64\\tmp\\phpB24.tmp', 'erfghjk', '29-06-2018-20-29'),
(359, 'C:\\wamp64\\tmp\\php19A7.tmp', 'erfghjk', '29-06-2018-20-26'),
(358, 'C:\\wamp64\\tmp\\phpEF83.tmp', 'erfghjk', '29-06-2018-20-23'),
(357, 'C:\\wamp64\\tmp\\php4363.tmp', 'erfghjk', '29-06-2018-20-22'),
(356, 'C:\\wamp64\\tmp\\php6DA3.tmp', 'erfghjk', '29-06-2018-20-21'),
(355, 'C:\\wamp64\\tmp\\php19AB.tmp', 'erfghjk', '29-06-2018-20-20'),
(354, 'C:\\wamp64\\tmp\\phpF3D7.tmp', 'erfghjk', '29-06-2018-20-19'),
(353, 'C:\\wamp64\\tmp\\php2981.tmp', 'erfghjk', '29-06-2018-20-18'),
(352, 'C:\\wamp64\\tmp\\php88A0.tmp', 'erfghjk', '29-06-2018-20-13'),
(351, 'C:\\wamp64\\tmp\\phpC729.tmp', 'erfghjk', '29-06-2018-15-02'),
(350, 'C:\\wamp64\\tmp\\phpB1AC.tmp', 'erfghjk', '29-06-2018-15-02'),
(349, 'C:\\wamp64\\tmp\\php1570.tmp', 'erfghjk', '29-06-2018-15-00'),
(348, 'C:\\wamp64\\tmp\\php8677.tmp', 'erfghjk', '29-06-2018-14-57'),
(347, 'C:\\wamp64\\tmp\\php6684.tmp', 'erfghjk', '29-06-2018-14-55'),
(346, 'C:\\wamp64\\tmp\\phpE916.tmp', 'erfghjk', '29-06-2018-14-54'),
(345, 'C:\\wamp64\\tmp\\php3100.tmp', 'erfghjk', '29-06-2018-14-54'),
(344, 'C:\\wamp64\\tmp\\php71B6.tmp', 'erfghjk', '29-06-2018-14-53'),
(343, 'C:\\wamp64\\tmp\\php6A9F.tmp', 'erfghjk', '29-06-2018-14-49'),
(342, 'C:\\wamp64\\tmp\\phpDB82.tmp', 'erfghjk', '29-06-2018-14-23'),
(341, 'C:\\wamp64\\tmp\\php7FAF.tmp', ',g,jfjg', '29-06-2018-14-20'),
(340, 'C:\\wamp64\\tmp\\php2E04.tmp', 'sgfhgfshg', '29-06-2018-14-20'),
(339, 'C:\\wamp64\\tmp\\php20DD.tmp', 'sgfhgfshg', '29-06-2018-14-17'),
(338, 'C:\\wamp64\\tmp\\php6BA6.tmp', 'sgfhgf', '29-06-2018-14-17'),
(337, 'C:\\wamp64\\tmp\\php251A.tmp', '', '29-06-2018-14-12');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
