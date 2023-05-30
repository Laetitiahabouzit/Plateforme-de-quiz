-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le :  jeu. 20 avr. 2023 à 17:44
-- Version du serveur :  5.7.17
-- Version de PHP :  5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `projet 2 laetitia`
--

-- --------------------------------------------------------

--
-- Structure de la table `promotion`
--

CREATE TABLE `promotion` (
  `id_promo` int(11) NOT NULL,
  `nom_promo` varchar(30) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `promotion`
--

INSERT INTO `promotion` (`id_promo`, `nom_promo`) VALUES
(1, 'S'),
(2, 'L'),
(3, 'ES');

-- --------------------------------------------------------

--
-- Structure de la table `question`
--

CREATE TABLE `question` (
  `id_question` int(11) NOT NULL,
  `id_quiz` int(11) NOT NULL,
  `nom` text NOT NULL,
  `points` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `question`
--

INSERT INTO `question` (`id_question`, `id_quiz`, `nom`, `points`) VALUES
(1, 1, 'Quest 1 modif 1', 10),
(2, 2, 'Quest 1', 2),
(3, 2, 'Quest 2', 3),
(4, 2, 'Quest 3', 1),
(5, 3, 'Quest 1', 7),
(6, 3, 'Quest 2', 3),
(7, 4, 'Qui a été le premier roi de France ?', 2),
(8, 4, 'Qui a construit la Tour Eiffel ?', 2),
(9, 4, 'En quelle année a eu lieu la Révolution française ?', 2),
(10, 4, 'Qui a écrit \"Les Misérables\" ?', 2),
(11, 4, 'Qui a dirigé la France pendant la Seconde Guerre mondiale ?', 2),
(12, 5, 'Quelle est la formule chimique de l\'eau ?', 2),
(13, 5, 'Quelle est la force qui maintient ensemble les atomes d\'une molécule ?', 2),
(14, 5, 'Qu\'est-ce que le pH mesure ?', 2),
(15, 5, 'Quelle est la formule de la loi de gravitation universelle de Newton ?', 2),
(16, 5, 'Qu\'est-ce que la loi de Boyle-Mariotte décrit ?', 2),
(17, 6, 'Qu\'est-ce que le PIB mesure ?', 2),
(18, 6, 'Quelle est la différence entre une action et une obligation ?', 2),
(19, 6, 'Qu\'est-ce qu\'un taux d\'intérêt ?', 2),
(20, 6, 'Qu\'est-ce que l\'inflation ?', 2),
(21, 6, 'Qu\'est-ce que le taux de chômage ?', 2);

-- --------------------------------------------------------

--
-- Structure de la table `quiz`
--

CREATE TABLE `quiz` (
  `id_quiz` int(11) NOT NULL,
  `id_promo` int(11) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `id_formateur` int(11) NOT NULL,
  `start_time` datetime DEFAULT NULL,
  `end_time` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `quiz`
--

INSERT INTO `quiz` (`id_quiz`, `id_promo`, `nom`, `id_formateur`, `start_time`, `end_time`) VALUES
(1, 1, 'Premier Test modif 2', 1, '2023-04-20 11:38:00', '2023-04-20 12:38:00'),
(2, 0, 'DeuxiemeTest', 1, '2023-03-13 11:39:00', '2023-03-13 12:39:00'),
(3, 0, 'Premiere modif Edna', 2, '2023-03-17 11:41:00', '2023-03-17 12:41:00'),
(4, 2, 'Quiz promo L', 3, '2023-03-16 14:58:00', '2023-03-16 14:58:00'),
(5, 1, 'Quiz promo S', 1, '2023-04-12 14:17:00', '2023-04-13 14:17:00'),
(6, 3, 'Quiz Économique et Sociale', 1, '2023-04-20 11:59:00', '2023-04-20 16:59:00');

-- --------------------------------------------------------

--
-- Structure de la table `reponse`
--

CREATE TABLE `reponse` (
  `id_reponse` int(11) NOT NULL,
  `id_question` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `reponseeleve` text NOT NULL,
  `annotation` text NOT NULL,
  `points` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `reponse`
--

INSERT INTO `reponse` (`id_reponse`, `id_question`, `id_user`, `reponseeleve`, `annotation`, `points`) VALUES
(1, 7, 1, 'Clovis', '', 0),
(2, 8, 1, 'Gustave Eiffel', '', 0),
(3, 9, 1, '1789', '', 0),
(4, 10, 1, 'Victor Hugo', '', 0),
(5, 11, 1, 'Charles de Gaulle', '', 0),
(6, 7, 3, 'Clovis', '', 0),
(7, 8, 3, 'Gustave Eiffel', '', 0),
(8, 9, 3, '1789', '', 0),
(9, 10, 3, 'Victor Hugo', '', 0),
(10, 11, 3, 'Charles de Gaulle', '', 0),
(11, 12, 3, 'H2O', '', 0),
(12, 13, 3, 'La liaison covalente', '', 0),
(13, 14, 3, 'L\'acidité ou la basicité d\'une solution', '', 0),
(14, 15, 3, 'F = G * (m1*m2)/d²', '', 0),
(15, 16, 3, 'La relation entre le volume et la pression d\'un gaz à température constante', '', 0),
(16, 12, 3, 'H2O', '', 0),
(17, 13, 3, 'La liaison covalente', '', 0),
(18, 14, 3, 'L\'acidité ou la basicité d\'une solution', '', 0),
(19, 15, 3, 'F = G * (m1*m2)/d²', '', 0),
(20, 16, 3, 'La relation entre le volume et la pression d\'un gaz à température constante', '', 0),
(21, 17, 8, 'yzueaa', 'null', 0),
(22, 18, 8, 'zeazeazea', 'non', 1),
(23, 19, 8, 'zeaezeazeazea', 'non', 0),
(24, 20, 8, 'zeazeazaze', 'no', 0),
(25, 21, 8, 'azeazea', 'nope', 1);

-- --------------------------------------------------------

--
-- Structure de la table `utilisateurs`
--

CREATE TABLE `utilisateurs` (
  `id_user` int(11) NOT NULL,
  `id_promo` int(11) NOT NULL,
  `pseudo` varchar(100) NOT NULL,
  `password` text NOT NULL,
  `role` varchar(30) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `utilisateurs`
--

INSERT INTO `utilisateurs` (`id_user`, `id_promo`, `pseudo`, `password`, `role`) VALUES
(1, 0, 'Leti', 'Laetitia', 'Formateur'),
(2, 0, 'Edna', 'Ednakrapabelle', 'Formateur'),
(3, 1, 'Bart', 'Bartsimpson', 'Eleve'),
(4, 2, 'Sid', 'Sidiceage', 'Eleve'),
(5, 3, 'Lisa Simpson', 'lisa', 'Eleve'),
(6, 2, 'Ralph Wiggum', 'ralf', 'Eleve'),
(7, 1, 'Martin Prince', 'martin', 'Eleve'),
(8, 3, 'Nelson Muntz', 'nelson', 'Eleve');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `promotion`
--
ALTER TABLE `promotion`
  ADD PRIMARY KEY (`id_promo`);

--
-- Index pour la table `question`
--
ALTER TABLE `question`
  ADD PRIMARY KEY (`id_question`),
  ADD KEY `id_quiz` (`id_quiz`);

--
-- Index pour la table `quiz`
--
ALTER TABLE `quiz`
  ADD PRIMARY KEY (`id_quiz`),
  ADD KEY `fk_creator` (`id_formateur`);

--
-- Index pour la table `reponse`
--
ALTER TABLE `reponse`
  ADD PRIMARY KEY (`id_reponse`);

--
-- Index pour la table `utilisateurs`
--
ALTER TABLE `utilisateurs`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `promotion`
--
ALTER TABLE `promotion`
  MODIFY `id_promo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT pour la table `question`
--
ALTER TABLE `question`
  MODIFY `id_question` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT pour la table `quiz`
--
ALTER TABLE `quiz`
  MODIFY `id_quiz` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT pour la table `reponse`
--
ALTER TABLE `reponse`
  MODIFY `id_reponse` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
--
-- AUTO_INCREMENT pour la table `utilisateurs`
--
ALTER TABLE `utilisateurs`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
