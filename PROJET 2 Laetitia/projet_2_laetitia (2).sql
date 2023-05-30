-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le :  mar. 30 mai 2023 à 18:02
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
(22, 7, 'Qui était le roi de France pendant la Révolution française ?', 2),
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
(23, 7, 'Qui était la mère de Louis XIV ?', 3),
(17, 6, 'Qu', 2),
(18, 6, 'Quelle est la différence entre une action et une obligation ?', 2),
(19, 6, 'Qu', 2),
(20, 6, 'Qu', 2),
(21, 6, 'Qu', 2),
(24, 7, 'Qui a écrit \"Les Trois Mousquetaires\" ?', 3),
(25, 7, 'Quel événement a marqué le début de la Révolution française en 1789 ?', 2),
(26, 8, 'Qu&apos;est-ce que la photosynthèse ?', 3),
(27, 8, 'Quel est l&apos;organe responsable de la respiration chez les humains ?', 1),
(28, 8, 'Qu&apos;est-ce que l&apos;ADN ?', 3),
(29, 8, 'Qu&apos;est-ce que la biodiversité ?', 3),
(30, 9, 'Qu\'est-ce que l\'écosystème ?', 2),
(31, 9, 'Qu\'est-ce que la mitose ?', 3),
(32, 9, 'Quelle est la fonction principale du cœur dans le corps humain ?', 2),
(33, 9, 'Quelle est la différence entre une plante annuelle et une plante vivace ?', 3),
(34, 10, 'Qu\'est-ce que le marché financier ?', 2),
(35, 10, 'Qu\'est-ce que la croissance économique ?', 2),
(36, 10, 'Qu\'est-ce que la monnaie fiduciaire ?', 3),
(37, 10, 'Quelle est la différence entre le PIB nominal et le PIB réel ?', 3),
(38, 11, 'Qui a écrit le roman \"Madame Bovary\" ?', 2),
(39, 11, 'De quel pays est originaire l\'écrivain Albert Camus, lauréat du prix Nobel de littérature en 1957 ?', 2),
(40, 11, 'Quel roman de Victor Hugo raconte l\'histoire d\'un ancien forçat nommé Jean Valjean ?', 3),
(41, 11, 'Qui est l\'auteur de \"L\'École des femmes\", une comédie de mœurs du XVIIe siècle ?', 3),
(42, 12, 'Qui a écrit le roman \"Orgueil et Préjugés\" ?', 3),
(43, 12, 'De quel pays est originaire l\'\'écrivain William Shakespeare ?', 2),
(44, 12, 'Quel roman de Charles Dickens raconte l\'\'histoire d\'\'un orphelin qui rencontre une série de personnages excentriques à Londres ?', 3),
(45, 12, 'Qui est l\'\'auteur de \"1984\", un roman dystopique sur un État totalitaire qui contrôle tous les aspects de la vie des citoyens ?', 2),
(46, 13, 'Quel est le nom de la monnaie utilisée en France ?', 2),
(47, 13, 'Quel est le taux de TVA standard en France ?', 2),
(48, 13, 'Quel est le nom de la bourse française ?', 3),
(49, 13, 'Quel est le nom de la plus grande entreprise française en termes de chiffre d\'\'affaires ?', 3),
(50, 14, 'De quoi est composée une molécule d\'\'eau ?', 2),
(51, 14, 'Quel est le nom de la molécule responsable de la photosynthèse chez les plantes ?', 2),
(52, 14, 'Quel est le nom de la molécule qui donne sa couleur rouge au sang ?', 3),
(53, 14, 'Quel est le gaz le plus abondant dans l\'\'atmosphère terrestre ?', 3),
(54, 15, 'Qu\'\'est-ce qu\'\'un dépôt de marque ?', 2),
(55, 15, 'Qu\'\'est-ce qu\'\'un contrat de travail à durée indéterminée (CDI) ?', 2),
(56, 15, 'Qu\'\'est-ce qu\'\'un comité d\'\'entreprise (CE) ?', 3),
(57, 15, 'Qu\'\'est-ce qu\'\'une assemblée générale des actionnaires ?', 3);

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
(7, 2, 'Quiz : Histoire de France', 2, '2023-04-22 15:11:00', '2023-04-23 15:11:00'),
(4, 2, 'Quiz : Filière Littéraire 2', 2, '2023-05-24 16:58:00', '2023-06-25 14:58:00'),
(5, 1, 'Quiz : Filière Scientifique 3', 1, '2023-04-12 14:17:00', '2023-04-13 14:17:00'),
(8, 1, 'Quiz : Filière Scientifique 1', 2, '2023-04-24 16:01:00', '2023-04-26 16:01:00'),
(6, 3, 'Quiz : Filière Economique 1', 1, '2023-04-20 11:59:00', '2023-04-30 16:59:00'),
(9, 1, 'Quiz : Filière Scientifique 4', 2, '2023-04-19 16:04:00', '2023-04-20 16:04:00'),
(10, 3, 'Quiz : Filière Economique 2', 1, '2023-05-22 19:02:00', '2023-05-23 19:02:00'),
(11, 2, 'Quiz : Filière Littéraire 3', 1, '2023-04-22 19:04:00', '2023-06-30 19:04:00'),
(12, 2, 'Quiz : Filière Littéraire 4', 2, '2023-05-24 13:31:00', '2023-05-30 13:31:00'),
(13, 3, 'Quiz : Filière Economique 3', 2, '2023-05-24 13:31:00', '2023-05-30 13:31:00'),
(14, 1, 'Quiz : Filière Scientifique 2', 2, '2023-04-24 13:43:00', '2023-04-30 13:43:00'),
(15, 3, 'Quiz : Filière Economique 4', 1, '2023-05-30 15:31:00', '2023-06-07 15:31:00'),
(16, 1, 'quiz a supprimer', 2, '2023-05-02 10:00:00', '2023-05-02 10:00:00');

-- --------------------------------------------------------

--
-- Structure de la table `reponse`
--

CREATE TABLE `reponse` (
  `id_reponse` int(11) NOT NULL,
  `id_quiz` int(11) NOT NULL,
  `id_question` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `reponseeleve` text,
  `annotations` text NOT NULL,
  `points` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `reponse`
--

INSERT INTO `reponse` (`id_reponse`, `id_quiz`, `id_question`, `id_user`, `reponseeleve`, `annotations`, `points`) VALUES
(61, 5, 16, 3, '', 'Pas de réponse', 0),
(57, 5, 12, 3, '', 'Pas de réponse', 0),
(58, 5, 13, 3, '', 'Pas de réponse', 0),
(59, 5, 14, 3, '', 'Pas de réponse', 0),
(60, 5, 15, 3, '', 'Pas de réponse', 0),
(62, 5, 12, 7, 'H2O', 'Oui', 2),
(63, 5, 13, 7, 'La liaison covalente', 'Bien', 2),
(64, 5, 14, 7, 'L\'acidité ou la basicité d\'une solution', 'Exact', 2),
(65, 5, 15, 7, 'F = G * (m1*m2)/d²', 'Très bien', 2),
(66, 5, 16, 7, 'La relation entre le volume et la pression d\'un gaz à température constante', 'Oui', 2),
(92, 11, 40, 4, 'Misérable', '', 0),
(90, 11, 38, 4, 'chai pas', '', 0),
(71, 11, 38, 6, 'Gustave Flaubert', 'Oui', 2),
(72, 11, 39, 6, 'France', 'Et non !', 0),
(73, 11, 40, 6, 'je sais plus', '', 0),
(74, 11, 41, 6, '', '', 0),
(75, 11, 38, 9, 'Gustave Flaubert', 'Oui', 2),
(76, 11, 39, 9, 'L\'Algérie', 'Exact', 2),
(77, 11, 40, 9, '\"Les Misérables\"', 'Très bien', 3),
(78, 11, 41, 9, 'Molière', 'Oui ', 3),
(79, 11, 38, 10, 'Gustave Flaubert', 'Oui', 2),
(80, 11, 39, 10, 'L\'Algérie', 'Exact', 2),
(81, 11, 40, 10, 'Les Misérables', 'Oui', 2),
(82, 11, 41, 10, 'Molière', 'Oui ', 3),
(94, 12, 42, 9, 'Jane Austen', '', 0),
(93, 11, 41, 4, 'Moliere', '', 0),
(91, 11, 39, 4, 'France', '', 0),
(96, 12, 44, 9, ' \"Oliver Twist\"', '', 0),
(95, 12, 43, 9, 'L\'Angleterre', '', 0),
(97, 12, 45, 9, 'George Orwell', '', 0),
(98, 12, 42, 6, 'je sais pas', '', 0),
(99, 12, 43, 6, 'L\'Angleterre', '', 0),
(100, 12, 44, 6, ' Oliver Twist', '', 0),
(101, 12, 45, 6, 'George', '', 0),
(102, 7, 22, 6, '', 'zaeaz', 2),
(103, 7, 23, 6, '', 'aeaze', 3),
(104, 7, 24, 6, '', 'azzae', 1),
(105, 7, 25, 6, '', 'azeaz', 1),
(106, 7, 22, 9, '', 'zaeaz', 1),
(107, 7, 23, 9, '', 'zeaze', 1),
(108, 7, 24, 9, '', 'azeaze', 2),
(109, 7, 25, 9, '', 'azeaze', 2);

-- --------------------------------------------------------

--
-- Structure de la table `resultat`
--

CREATE TABLE `resultat` (
  `id_result` int(11) NOT NULL,
  `id_quiz` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `annotation_globale` text NOT NULL,
  `note` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `resultat`
--

INSERT INTO `resultat` (`id_result`, `id_quiz`, `id_user`, `annotation_globale`, `note`) VALUES
(2, 5, 3, 'Pas de réponse', NULL),
(3, 5, 7, 'Bon travail', 10),
(4, 11, 4, 'Peux mieux faire', 3),
(5, 11, 6, 'A revoir', 2),
(6, 11, 9, 'Bon travail', 10),
(7, 11, 10, 'Bien', 9),
(9, 7, 6, 'azeazeaze', 7),
(10, 7, 9, 'azeaea', 6);

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
(1, 0, 'Laetitia Habouzit', 'laetitia', 'Formateur'),
(2, 0, 'Edna Krapabelle', 'edna', 'Formateur'),
(3, 1, 'Bart Simpson', 'bart', 'Eleve'),
(4, 2, 'Jimbo Jones', 'jimbo', 'Eleve'),
(5, 3, 'Lisa Simpson', 'lisa', 'Eleve'),
(6, 2, 'Ralph Wiggum', 'ralf', 'Eleve'),
(7, 1, 'Martin Prince', 'martin', 'Eleve'),
(8, 3, 'Nelson Muntz', 'nelson', 'Eleve'),
(9, 2, 'Sherri Mackleberry', 'sherri', 'Eleve'),
(10, 2, 'Terri Mackleberry', 'terri', 'Eleve');

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
  ADD PRIMARY KEY (`id_reponse`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_user_2` (`id_user`);

--
-- Index pour la table `resultat`
--
ALTER TABLE `resultat`
  ADD PRIMARY KEY (`id_result`);

--
-- Index pour la table `utilisateurs`
--
ALTER TABLE `utilisateurs`
  ADD PRIMARY KEY (`id_user`),
  ADD KEY `id_promo` (`id_promo`) USING BTREE;

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
  MODIFY `id_question` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;
--
-- AUTO_INCREMENT pour la table `quiz`
--
ALTER TABLE `quiz`
  MODIFY `id_quiz` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT pour la table `reponse`
--
ALTER TABLE `reponse`
  MODIFY `id_reponse` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=110;
--
-- AUTO_INCREMENT pour la table `resultat`
--
ALTER TABLE `resultat`
  MODIFY `id_result` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT pour la table `utilisateurs`
--
ALTER TABLE `utilisateurs`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
