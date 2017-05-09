-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Client :  127.0.0.1
-- Généré le :  Mer 12 Avril 2017 à 15:46
-- Version du serveur :  5.6.35-log
-- Version de PHP :  5.6.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `prozzl_test`
--

-- --------------------------------------------------------

--
-- Structure de la table `adresse`
--

CREATE TABLE `adresse` (
  `id_adresse` int(11) NOT NULL,
  `rue` varchar(100) NOT NULL,
  `ville` varchar(45) NOT NULL,
  `code_postal` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `adresse`
--

INSERT INTO `adresse` (`id_adresse`, `rue`, `ville`, `code_postal`) VALUES
(1, '1 rue Jean Jaurès', 'Annecy', '74000'),
(2, '5 rue Notre Dame', 'Annecy', '74000'),
(3, '1 place Centenaire', 'Chambery', '73000'),
(4, '27 rue Jean Pierre Veyrat', 'Annecy', '74000'),
(5, '68 rue Bobby Sands', 'Chambery', '73000'),
(6, '191 rue Michaud', 'Chambery', '73000');

-- --------------------------------------------------------

--
-- Structure de la table `avis_employe`
--

CREATE TABLE `avis_employe` (
  `id_avis_employe` int(11) NOT NULL,
  `note_generale_avis_employe` float NOT NULL,
  `date_creation_avis_employe` datetime NOT NULL,
  `nb_signalements_avis_employe` varchar(300) NOT NULL,
  `id_employe` int(11) NOT NULL,
  `id_utilisateur` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `avis_employe`
--

INSERT INTO `avis_employe` (`id_avis_employe`, `note_generale_avis_employe`, `date_creation_avis_employe`, `nb_signalements_avis_employe`, `id_employe`, `id_utilisateur`) VALUES
(1, 0, '2017-01-01 00:00:00', '12', 1, 6),
(2, 1, '2017-02-01 00:00:00', '16', 2, 7),
(3, 2, '2017-03-01 00:00:00', '15', 3, 8),
(4, 3, '2017-04-01 00:00:00', '12', 4, 9),
(5, 4, '2017-05-01 00:00:00', '22', 5, 6),
(6, 5, '2017-06-01 00:00:00', '5', 1, 7),
(7, 5, '2017-07-01 00:00:00', '7', 2, 8),
(8, 6, '2017-08-01 00:00:00', '84', 3, 9),
(9, 7, '2017-09-01 00:00:00', '45', 4, 6),
(10, 8, '2017-10-01 00:00:00', '32', 5, 7),
(11, 9, '2017-11-01 00:00:00', '65', 1, 8),
(12, 10, '2017-12-01 00:00:00', '32', 2, 9);

-- --------------------------------------------------------

--
-- Structure de la table `avis_entreprise`
--

CREATE TABLE `avis_entreprise` (
  `id_avis_entreprise` int(11) NOT NULL,
  `note_generale_avis_entreprise` float NOT NULL,
  `date_creation_avis_entreprise` datetime NOT NULL,
  `nb_signalements_avis_entreprise` int(11) NOT NULL,
  `id_entreprise` int(11) NOT NULL,
  `id_utilisateur` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `avis_entreprise`
--

INSERT INTO `avis_entreprise` (`id_avis_entreprise`, `note_generale_avis_entreprise`, `date_creation_avis_entreprise`, `nb_signalements_avis_entreprise`, `id_entreprise`, `id_utilisateur`) VALUES
(1, 0, '2016-01-01 00:00:00', 12, 1, 1),
(2, 1, '2016-02-01 00:00:00', 16, 2, 2),
(3, 2, '2016-03-01 00:00:00', 15, 3, 3),
(4, 3, '2016-04-01 00:00:00', 12, 4, 4),
(5, 4, '2016-05-01 00:00:00', 22, 1, 5),
(6, 5, '2016-06-01 00:00:00', 5, 2, 1),
(7, 5, '2016-07-01 00:00:00', 7, 3, 2),
(8, 6, '2016-08-01 00:00:00', 84, 4, 3),
(9, 7, '2016-09-01 00:00:00', 45, 1, 4),
(10, 8, '2016-10-01 00:00:00', 32, 2, 5),
(11, 9, '2016-11-01 00:00:00', 65, 3, 1),
(12, 10, '2016-12-01 00:00:00', 32, 4, 2);

-- --------------------------------------------------------

--
-- Structure de la table `competences_cv`
--

CREATE TABLE `competences_cv` (
  `id_competence` int(11) NOT NULL,
  `nom_competence` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `criteres_notation_employe`
--

CREATE TABLE `criteres_notation_employe` (
  `id_critere_notation_employe` int(11) NOT NULL,
  `nom_critere_employe` varchar(300) NOT NULL,
  `critere_note_employe` tinyint(1) NOT NULL,
  `description_critere_employe` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `criteres_notation_employe`
--

INSERT INTO `criteres_notation_employe` (`id_critere_notation_employe`, `nom_critere_employe`, `critere_note_employe`, `description_critere_employe`) VALUES
(1, 'Type de contrat', 0, 'Type de contrat de l\'employé au sin de l\'entreprise'),
(2, 'Qualité globale du travail', 1, 'Note de 1 à 10 correspondantà la qualité du travail de l\'employé au sein de l\'entreprise'),
(3, 'Relation avec les autres collaborateurs', 1, 'Note de 1 à 10 correspondant aux relations du salarié avec les autres collaborateurs'),
(4, 'Relation avec les clients', 1, 'Note de 1 à 10 correspondant aux relations du salarié avec les clients de l\'entreprise'),
(5, 'Prises d\'initiatives', 1, 'Note de 1 à 10 correspondant aux prises d\'initiatives du salarié au sein de l\'entreprise'),
(6, 'Motivation', 1, 'Note de 1 à 10 correspondant à la motivation du salarié au sein de l\'entreprise'),
(7, 'Compétences pour le poste', 1, 'Note de 1 à 10 correpondant aux compétences du salarié par rapport à son poste au sein de l\'entreprise'),
(8, 'Capacité d\'évolution / compréhension', 1, 'Note de 1 à 10 correspondant à la capacité d\'évolution et à la capacité de compréhension des tâches du salarié'),
(9, 'Capacite d\'adaptation', 1, 'Note de 1 à 10 correspondant à la capacité d\'adaptation de l\'employé'),
(10, 'Points forts à conserver', 0, 'Paragraphe de 300 caractères max. expliquant les points forts du salarié que vous encouragez à conserver'),
(11, 'Axes d\'amélioration', 0, 'Paragraphe de 300 caractères max. indiquant les axes d\'amélioration que vous suggérez à l\'employé');

-- --------------------------------------------------------

--
-- Structure de la table `criteres_notation_entreprise`
--

CREATE TABLE `criteres_notation_entreprise` (
  `id_critere_notation_entreprise` int(11) NOT NULL,
  `nom_critere_entreprise` varchar(300) NOT NULL,
  `critere_note_entreprise` tinyint(1) NOT NULL,
  `description_critere_entreprise` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `criteres_notation_entreprise`
--

INSERT INTO `criteres_notation_entreprise` (`id_critere_notation_entreprise`, `nom_critere_entreprise`, `critere_note_entreprise`, `description_critere_entreprise`) VALUES
(1, 'Type de contrat', 0, 'Type de contrat que vous aviez au sein de l\'entreprise'),
(2, 'Relation avec les managers', 1, 'Note de 1 à 10 correspondant à votre relation avec les managers'),
(3, 'Relation avec les collègues', 1, 'Note de 1 à 10 correspondant à votre relation avec vos collègues'),
(4, 'Politique RH (culture d\'entreprise, formations, événements)', 1, 'Note de 1 à 10 correspondant à la politique des relations humaines au sein de l\'entreprise'),
(5, 'Equilibre entre la vie personelle et professionelle', 1, 'Note de 1 à 10 correspondant à l\'équilibre entre vos professionelles et personelles'),
(6, 'Qualité des missions / diversité des tâches', 1, 'Note de 1 à 10 correspondant à la qualité des missions confiées et la diveristé des tâches effectuées'),
(7, 'Responsabilités / Confiance accordée par l\'entreprise', 1, 'Note de 1 à 10 correspondant aux responsabilités et à la confiance accordée par l\'entreprise'),
(8, 'Niveau de stress', 1, 'Note de 1 à 10 correspondant au stress personnel ressenti au sein de l\'entreprise'),
(9, 'Opportunités d\'évolution', 1, 'Note de 1 à 10 correspondant aux opportunités d\'évolution proposées par l\'entreprise'),
(10, 'Qualité des rétributions financières', 1, 'Note de 1 à 10 correspondant à la qualité des rétributions financières offertes par l\'entreprise'),
(11, 'Points forts à conserver', 0, 'Paragraphe de 300 caractères max. expliquant les points forts de l\'entreprise que vous encouragez à conserver'),
(12, 'Axes d\'amélioration', 0, 'Paragraphe de 300 caractères max. indiquant les axes d\'amélioration que vous suggérez à l\'entreprise');

-- --------------------------------------------------------

--
-- Structure de la table `cv`
--

CREATE TABLE `cv` (
  `id_CV` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `cv_employe`
--

CREATE TABLE `cv_employe` (
  `id_cv_employe` int(11) NOT NULL,
  `niveau_competence` int(11) NOT NULL,
  `id_employe` int(11) NOT NULL,
  `id_competence` int(11) NOT NULL,
  `id_cv` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `employe`
--

CREATE TABLE `employe` (
  `id_employe` int(11) NOT NULL,
  `nom_employe` varchar(45) NOT NULL,
  `prenom_employe` varchar(45) NOT NULL,
  `date_naissance_employe` date DEFAULT NULL,
  `employe_travaille` tinyint(1) DEFAULT NULL,
  `telephone_employe` varchar(14) DEFAULT NULL,
  `id_adresse` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `employe`
--

INSERT INTO `employe` (`id_employe`, `nom_employe`, `prenom_employe`, `date_naissance_employe`, `employe_travaille`, `telephone_employe`, `id_adresse`) VALUES
(1, 'Pablo', 'Juan', '1996-07-16', 1, '0605040302', 1),
(2, 'Jean', 'Neige', '1960-01-01', 0, '0606060606', 2),
(3, 'Martin', 'Dupont', '1970-04-25', 0, '0615649789', 3),
(4, 'Muratonni', 'Francketti', '1750-02-18', 0, '0604030201', 4),
(5, 'Sacquet', 'Frodon', '1002-05-08', 0, '0687976434', 5);

-- --------------------------------------------------------

--
-- Structure de la table `employe_avis_critere`
--

CREATE TABLE `employe_avis_critere` (
  `id_employe_avis_critere` int(11) NOT NULL,
  `note_employe_avis` int(11) DEFAULT NULL,
  `commentaire_evaluation_critere` varchar(300) DEFAULT NULL,
  `id_critere_notation_employe` int(11) NOT NULL,
  `id_avis_employe` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `entreprise`
--

CREATE TABLE `entreprise` (
  `id_entreprise` int(11) NOT NULL,
  `nom_entreprise` varchar(45) NOT NULL,
  `nombre_employes` int(11) DEFAULT NULL,
  `recherche_employes` tinyint(1) DEFAULT NULL,
  `telephone_entreprise` varchar(12) DEFAULT NULL,
  `id_adresse` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `entreprise`
--

INSERT INTO `entreprise` (`id_entreprise`, `nom_entreprise`, `nombre_employes`, `recherche_employes`, `telephone_entreprise`, `id_adresse`) VALUES
(1, 'Facebook', NULL, 0, '0646565646', 1),
(2, 'Linkedin', NULL, 0, '0698871568', 2),
(3, 'Github', NULL, 0, '0456879795', 3),
(4, 'Twitter', NULL, 0, '0660068478', 4),
(5, 'Github', 150, 1, '060708910', 6);

-- --------------------------------------------------------

--
-- Structure de la table `entreprise_avis_critere`
--

CREATE TABLE `entreprise_avis_critere` (
  `id_entreprise_avis_critere` int(11) NOT NULL,
  `note_entreprise_avis` int(11) DEFAULT NULL,
  `commentaire_evaluation_critere` varchar(300) DEFAULT NULL,
  `id_critere_notation_entreprise` int(11) NOT NULL,
  `id_avis_entreprise` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `infos_complementaires_employe`
--

CREATE TABLE `infos_complementaires_employe` (
  `id_info_employe` int(11) NOT NULL,
  `description_info` varchar(150) NOT NULL,
  `id_info_profil` int(11) NOT NULL,
  `id_employe` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `infos_complementaires_entreprise`
--

CREATE TABLE `infos_complementaires_entreprise` (
  `id_info_entreprise` int(11) NOT NULL,
  `description_info` varchar(150) NOT NULL,
  `id_info_profil` int(11) NOT NULL,
  `id_entreprise` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `infos_complementaires_profil`
--

CREATE TABLE `infos_complementaires_profil` (
  `id_info` int(11) NOT NULL,
  `nom_info` varchar(150) NOT NULL,
  `personne_concernee` varchar(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `notifications`
--

CREATE TABLE `notifications` (
  `id_notifcation` int(11) NOT NULL,
  `type` varchar(45) NOT NULL,
  `texte_descriptif` varchar(300) DEFAULT NULL,
  `id_utilisateur` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `offre_emploi`
--

CREATE TABLE `offre_emploi` (
  `id_offre_emploi` int(11) NOT NULL,
  `date_creation_offre_emploi` datetime NOT NULL,
  `type_offre_emploi` varchar(30) DEFAULT NULL,
  `salaire_offre_emploi` int(11) DEFAULT NULL,
  `experience_offre_emploi` varchar(500) DEFAULT NULL,
  `description_offre_emploi` varchar(500) DEFAULT NULL,
  `id_entreprise` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `offre_emploi`
--

INSERT INTO `offre_emploi` (`id_offre_emploi`, `date_creation_offre_emploi`, `type_offre_emploi`, `salaire_offre_emploi`, `experience_offre_emploi`, `description_offre_emploi`, `id_entreprise`) VALUES
(1, '2017-04-10 14:22:57', 'Commercial', 1200, 'BAC STMG', 'Achat,vente en tout genre', 1),
(2, '2017-04-10 14:22:57', 'Assistant', 1500, 'BAC L', 'Gestion de plannig', 2),
(3, '2017-04-10 14:22:57', 'Developpeur', 3200, 'BAC S', 'Maintenance de site web', 3),
(4, '2017-04-10 14:22:57', 'Ingénieur systeme', 2200, 'BAC S', 'Maintenance serveur', 4),
(5, '2017-04-10 14:22:57', 'Commercial', 1450, 'BAC S', 'Vente dans l\'immobilier', 1),
(6, '2017-04-10 14:22:57', 'Stagiaire', 900, 'BREVET', 'Sous-fifre qui apporte le café', 2),
(7, '2017-04-10 14:22:57', 'Commercial', 1700, 'BAC S', 'Achat de materiels ménagé', 3),
(8, '2017-04-10 14:22:57', 'Commercial', 1800, 'BAC STMG', 'Achat,vente ordinateur portable', 4);

-- --------------------------------------------------------

--
-- Structure de la table `postuler`
--

CREATE TABLE `postuler` (
  `id_postuler` int(11) NOT NULL,
  `id_employe` int(11) NOT NULL,
  `id_offre_emploi` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `postuler`
--

INSERT INTO `postuler` (`id_postuler`, `id_employe`, `id_offre_emploi`) VALUES
(1, 1, 1),
(2, 2, 2),
(3, 3, 3),
(4, 4, 4),
(5, 1, 5),
(6, 2, 6),
(7, 3, 7),
(8, 4, 8),
(9, 1, 1),
(10, 2, 2),
(11, 3, 3);

-- --------------------------------------------------------

--
-- Structure de la table `travaille`
--

CREATE TABLE `travaille` (
  `id_travaille` int(11) NOT NULL,
  `date_debut_contrat` date NOT NULL,
  `date_fin_contrat` date DEFAULT NULL,
  `duree_contrat` int(11) DEFAULT NULL,
  `id_employe` int(11) NOT NULL,
  `id_entreprise` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `travaille`
--

INSERT INTO `travaille` (`id_travaille`, `date_debut_contrat`, `date_fin_contrat`, `duree_contrat`, `id_employe`, `id_entreprise`) VALUES
(1, '2017-04-01', '2017-04-03', 2, 1, 1),
(2, '2017-04-01', '2017-04-29', 29, 2, 2),
(3, '2017-04-01', '2017-04-28', 28, 3, 3),
(4, '2017-04-01', '2017-04-27', 27, 4, 4),
(5, '2017-04-01', '2017-05-01', 30, 5, 2);

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

CREATE TABLE `utilisateur` (
  `id_utilisateur` int(11) NOT NULL,
  `login` varchar(50) NOT NULL,
  `mot_de_passe` varchar(100) NOT NULL,
  `role` varchar(45) NOT NULL,
  `date_creation_utilisateur` datetime NOT NULL,
  `date_derniere_connexion` datetime NOT NULL,
  `mail` varchar(45) NOT NULL,
  `id_employe` int(11) DEFAULT NULL,
  `id_entreprise` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `utilisateur`
--

INSERT INTO `utilisateur` (`id_utilisateur`, `login`, `mot_de_passe`, `role`, `date_creation_utilisateur`, `date_derniere_connexion`, `mail`, `id_employe`, `id_entreprise`) VALUES
(1, 'MF', 'password', 'employe', '2017-04-10 14:22:56', '2017-04-12 16:30:02', 'FranckyMun@prozzl_test.fr', 4, NULL),
(2, 'MD', 'password', 'employe', '2017-04-10 14:22:56', '2017-04-10 14:22:56', 'MartinDupont@prozzl_test.fr', 3, NULL),
(3, 'JN', 'password', 'employe', '2017-04-10 14:22:56', '2017-04-10 14:22:56', 'JeanNeige@prozzl_test.fr', 2, NULL),
(4, 'PJ', 'password', 'employe', '2017-04-10 14:22:56', '2017-04-10 14:22:56', 'JuanPablo@prozzl_test.fr', 1, NULL),
(5, 'SF', 'password', 'employe', '2017-04-10 14:22:56', '2017-04-10 14:22:56', 'FrodonSacquet@prozzl_test.fr', 5, NULL),
(6, 'FB', 'password', 'entreprise', '2017-04-10 14:22:56', '2017-04-10 14:22:56', 'Facebook@facebook.us', NULL, 1),
(7, 'TW', 'password', 'entreprise', '2017-04-10 14:22:56', '2017-04-10 14:22:56', 'Twitter@twitter.uk', NULL, 4),
(8, 'LKDN', 'password', 'entreprise', '2017-04-10 14:22:56', '2017-04-10 14:22:56', 'Linkedin@lkdn.us', NULL, 2),
(9, 'GIT', 'password', 'entreprise', '2017-04-10 14:22:56', '2017-04-12 15:57:17', 'github@github.fr', NULL, 3);

--
-- Index pour les tables exportées
--

--
-- Index pour la table `adresse`
--
ALTER TABLE `adresse`
  ADD PRIMARY KEY (`id_adresse`);

--
-- Index pour la table `avis_employe`
--
ALTER TABLE `avis_employe`
  ADD PRIMARY KEY (`id_avis_employe`),
  ADD KEY `index_id_employe_avis_employe` (`id_employe`),
  ADD KEY `index_id_utilisateur_avis_employeutilisateur` (`id_utilisateur`);

--
-- Index pour la table `avis_entreprise`
--
ALTER TABLE `avis_entreprise`
  ADD PRIMARY KEY (`id_avis_entreprise`),
  ADD KEY `index_id_entreprise_avis_entreprise` (`id_entreprise`),
  ADD KEY `index_id_utilisateur_utilisateur` (`id_utilisateur`);

--
-- Index pour la table `competences_cv`
--
ALTER TABLE `competences_cv`
  ADD PRIMARY KEY (`id_competence`);

--
-- Index pour la table `criteres_notation_employe`
--
ALTER TABLE `criteres_notation_employe`
  ADD PRIMARY KEY (`id_critere_notation_employe`);

--
-- Index pour la table `criteres_notation_entreprise`
--
ALTER TABLE `criteres_notation_entreprise`
  ADD PRIMARY KEY (`id_critere_notation_entreprise`);

--
-- Index pour la table `cv`
--
ALTER TABLE `cv`
  ADD PRIMARY KEY (`id_CV`);

--
-- Index pour la table `cv_employe`
--
ALTER TABLE `cv_employe`
  ADD PRIMARY KEY (`id_cv_employe`),
  ADD KEY `index_id_employe_CV_employe` (`id_employe`),
  ADD KEY `index_id_critere_CV_critere` (`id_competence`),
  ADD KEY `index_id_cv_cv_employe_cv` (`id_cv`);

--
-- Index pour la table `employe`
--
ALTER TABLE `employe`
  ADD PRIMARY KEY (`id_employe`),
  ADD KEY `index_id_adresse_employe_adresse` (`id_adresse`);

--
-- Index pour la table `employe_avis_critere`
--
ALTER TABLE `employe_avis_critere`
  ADD PRIMARY KEY (`id_employe_avis_critere`),
  ADD KEY `index_id_critere_avis_critere_employe` (`id_critere_notation_employe`),
  ADD KEY `index_id_avis_employe_avis_critere_avis` (`id_avis_employe`);

--
-- Index pour la table `entreprise`
--
ALTER TABLE `entreprise`
  ADD PRIMARY KEY (`id_entreprise`),
  ADD KEY `index_id_adresse_entreprise_adresse` (`id_adresse`);

--
-- Index pour la table `entreprise_avis_critere`
--
ALTER TABLE `entreprise_avis_critere`
  ADD PRIMARY KEY (`id_entreprise_avis_critere`),
  ADD KEY `index_id_critere_avis_critere_employe` (`id_critere_notation_entreprise`),
  ADD KEY `index_id_avis_entreprise_avis_critere_avis_entreprise` (`id_avis_entreprise`);

--
-- Index pour la table `infos_complementaires_employe`
--
ALTER TABLE `infos_complementaires_employe`
  ADD PRIMARY KEY (`id_info_employe`),
  ADD KEY `idx_id_info_profil_info_employe` (`id_info_profil`),
  ADD KEY `idx_id_employe_info_employe` (`id_employe`);

--
-- Index pour la table `infos_complementaires_entreprise`
--
ALTER TABLE `infos_complementaires_entreprise`
  ADD PRIMARY KEY (`id_info_entreprise`),
  ADD KEY `idx_info_profil_info_entreprise` (`id_info_profil`),
  ADD KEY `idx_id_entreprise_info_entreprise` (`id_entreprise`);

--
-- Index pour la table `infos_complementaires_profil`
--
ALTER TABLE `infos_complementaires_profil`
  ADD PRIMARY KEY (`id_info`);

--
-- Index pour la table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id_notifcation`),
  ADD KEY `idx_id_utilisateur_notifcation_utilisateur` (`id_utilisateur`);

--
-- Index pour la table `offre_emploi`
--
ALTER TABLE `offre_emploi`
  ADD PRIMARY KEY (`id_offre_emploi`),
  ADD KEY `index_id_entreprise` (`id_entreprise`);

--
-- Index pour la table `postuler`
--
ALTER TABLE `postuler`
  ADD PRIMARY KEY (`id_postuler`),
  ADD KEY `index_id_employe` (`id_employe`),
  ADD KEY `index_id_offre_emploi` (`id_offre_emploi`);

--
-- Index pour la table `travaille`
--
ALTER TABLE `travaille`
  ADD PRIMARY KEY (`id_travaille`),
  ADD KEY `index_id_employe_travaille_employe` (`id_employe`),
  ADD KEY `index_id_entreprise_travaille_entreprise` (`id_entreprise`);

--
-- Index pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD PRIMARY KEY (`id_utilisateur`),
  ADD UNIQUE KEY `id_user_UNIQUE` (`id_utilisateur`),
  ADD KEY `fk_id_employe_utilisateur_employe` (`id_employe`),
  ADD KEY `fk_id_entreprise_utilisateur_entreprise` (`id_entreprise`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `adresse`
--
ALTER TABLE `adresse`
  MODIFY `id_adresse` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT pour la table `avis_employe`
--
ALTER TABLE `avis_employe`
  MODIFY `id_avis_employe` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT pour la table `avis_entreprise`
--
ALTER TABLE `avis_entreprise`
  MODIFY `id_avis_entreprise` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT pour la table `competences_cv`
--
ALTER TABLE `competences_cv`
  MODIFY `id_competence` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `criteres_notation_employe`
--
ALTER TABLE `criteres_notation_employe`
  MODIFY `id_critere_notation_employe` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT pour la table `criteres_notation_entreprise`
--
ALTER TABLE `criteres_notation_entreprise`
  MODIFY `id_critere_notation_entreprise` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT pour la table `cv`
--
ALTER TABLE `cv`
  MODIFY `id_CV` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `cv_employe`
--
ALTER TABLE `cv_employe`
  MODIFY `id_cv_employe` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `employe`
--
ALTER TABLE `employe`
  MODIFY `id_employe` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT pour la table `employe_avis_critere`
--
ALTER TABLE `employe_avis_critere`
  MODIFY `id_employe_avis_critere` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `entreprise`
--
ALTER TABLE `entreprise`
  MODIFY `id_entreprise` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT pour la table `entreprise_avis_critere`
--
ALTER TABLE `entreprise_avis_critere`
  MODIFY `id_entreprise_avis_critere` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `infos_complementaires_employe`
--
ALTER TABLE `infos_complementaires_employe`
  MODIFY `id_info_employe` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `infos_complementaires_entreprise`
--
ALTER TABLE `infos_complementaires_entreprise`
  MODIFY `id_info_entreprise` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `infos_complementaires_profil`
--
ALTER TABLE `infos_complementaires_profil`
  MODIFY `id_info` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id_notifcation` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `offre_emploi`
--
ALTER TABLE `offre_emploi`
  MODIFY `id_offre_emploi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT pour la table `postuler`
--
ALTER TABLE `postuler`
  MODIFY `id_postuler` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT pour la table `travaille`
--
ALTER TABLE `travaille`
  MODIFY `id_travaille` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  MODIFY `id_utilisateur` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `avis_employe`
--
ALTER TABLE `avis_employe`
  ADD CONSTRAINT `fk_id_employe_avis_employe` FOREIGN KEY (`id_employe`) REFERENCES `employe` (`id_employe`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_id_utilisateur_avis_employe_utilisateur` FOREIGN KEY (`id_utilisateur`) REFERENCES `utilisateur` (`id_utilisateur`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `avis_entreprise`
--
ALTER TABLE `avis_entreprise`
  ADD CONSTRAINT `fk_id_entreprise_avis_entreprise` FOREIGN KEY (`id_entreprise`) REFERENCES `entreprise` (`id_entreprise`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_id_utilisateur_utilisateur` FOREIGN KEY (`id_utilisateur`) REFERENCES `utilisateur` (`id_utilisateur`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `cv_employe`
--
ALTER TABLE `cv_employe`
  ADD CONSTRAINT `fk_id_critere_CV_critere` FOREIGN KEY (`id_competence`) REFERENCES `competences_cv` (`id_competence`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_id_cv_cv_employe_cv` FOREIGN KEY (`id_cv`) REFERENCES `cv` (`id_CV`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_id_employe_CV_employe` FOREIGN KEY (`id_employe`) REFERENCES `employe` (`id_employe`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `employe`
--
ALTER TABLE `employe`
  ADD CONSTRAINT `fk_id_adresse_employe_adresse` FOREIGN KEY (`id_adresse`) REFERENCES `adresse` (`id_adresse`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `employe_avis_critere`
--
ALTER TABLE `employe_avis_critere`
  ADD CONSTRAINT `fk_id_avis_employe_avis_critere_avis` FOREIGN KEY (`id_avis_employe`) REFERENCES `avis_employe` (`id_avis_employe`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_id_critere_avis_critere_entreprise` FOREIGN KEY (`id_critere_notation_employe`) REFERENCES `criteres_notation_employe` (`id_critere_notation_employe`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `entreprise`
--
ALTER TABLE `entreprise`
  ADD CONSTRAINT `fk_id_adresse_entreprise_adresse` FOREIGN KEY (`id_adresse`) REFERENCES `adresse` (`id_adresse`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `entreprise_avis_critere`
--
ALTER TABLE `entreprise_avis_critere`
  ADD CONSTRAINT `fk_id_avis_entreprise_avis_critere_avis_entreprise` FOREIGN KEY (`id_avis_entreprise`) REFERENCES `avis_entreprise` (`id_avis_entreprise`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_id_critere_avis_critere_employe` FOREIGN KEY (`id_critere_notation_entreprise`) REFERENCES `criteres_notation_entreprise` (`id_critere_notation_entreprise`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `infos_complementaires_employe`
--
ALTER TABLE `infos_complementaires_employe`
  ADD CONSTRAINT `fk_id_employe_info_employe` FOREIGN KEY (`id_employe`) REFERENCES `employe` (`id_employe`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_id_info_profil_info_employe` FOREIGN KEY (`id_info_profil`) REFERENCES `infos_complementaires_profil` (`id_info`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `infos_complementaires_entreprise`
--
ALTER TABLE `infos_complementaires_entreprise`
  ADD CONSTRAINT `fk_id_entreprise_info_entreprise` FOREIGN KEY (`id_entreprise`) REFERENCES `entreprise` (`id_entreprise`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_id_info_profil_info_entreprise` FOREIGN KEY (`id_info_profil`) REFERENCES `infos_complementaires_profil` (`id_info`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `notifications`
--
ALTER TABLE `notifications`
  ADD CONSTRAINT `fk_id_utilisateur_notifcations_utilisateur` FOREIGN KEY (`id_utilisateur`) REFERENCES `utilisateur` (`id_utilisateur`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `offre_emploi`
--
ALTER TABLE `offre_emploi`
  ADD CONSTRAINT `fk_id_entreprise` FOREIGN KEY (`id_entreprise`) REFERENCES `entreprise` (`id_entreprise`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `postuler`
--
ALTER TABLE `postuler`
  ADD CONSTRAINT `fk_id_emplye` FOREIGN KEY (`id_employe`) REFERENCES `employe` (`id_employe`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_id_offre_emploi` FOREIGN KEY (`id_offre_emploi`) REFERENCES `offre_emploi` (`id_offre_emploi`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `travaille`
--
ALTER TABLE `travaille`
  ADD CONSTRAINT `fk_id_employe_travaille_employe` FOREIGN KEY (`id_employe`) REFERENCES `employe` (`id_employe`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_id_entreprise_ttravaille_entreprise` FOREIGN KEY (`id_entreprise`) REFERENCES `entreprise` (`id_entreprise`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD CONSTRAINT `fk_id_employe_utilisateur_employe` FOREIGN KEY (`id_employe`) REFERENCES `employe` (`id_employe`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_id_entreprise_utilisateur_entreprise` FOREIGN KEY (`id_entreprise`) REFERENCES `entreprise` (`id_entreprise`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
