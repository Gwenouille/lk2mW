-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Client :  127.0.0.1
-- Généré le :  Lun 30 Janvier 2017 à 09:16
-- Version du serveur :  5.7.14
-- Version de PHP :  7.0.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `c1lk2m`
--

-- --------------------------------------------------------

--
-- Structure de la table `files`
--

CREATE TABLE `files` (
  `id` int(11) NOT NULL,
  `name` varchar(45) DEFAULT NULL,
  `real_name` varchar(45) DEFAULT NULL,
  `type` varchar(45) DEFAULT NULL,
  `size` int(11) DEFAULT NULL,
  `projects_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `files`
--

INSERT INTO `files` (`id`, `name`, `real_name`, `type`, `size`, `projects_id`) VALUES
(1, 'fichier1', '', 'pdf', 1024, 1);

-- --------------------------------------------------------

--
-- Structure de la table `messages`
--

CREATE TABLE `messages` (
  `id` int(11) NOT NULL,
  `content` longtext,
  `date` datetime DEFAULT NULL,
  `users_id` int(11) NOT NULL,
  `to_users_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `messages`
--

INSERT INTO `messages` (`id`, `content`, `date`, `users_id`, `to_users_id`) VALUES
(56, 'Bonjour Melinda', '2017-01-28 17:31:48', 3, 1),
(57, 'Ah, Pierre… Ou es-tu ?', '2017-01-28 17:32:03', 1, 3),
(58, 'Au Brésil !', '2017-01-28 17:32:20', 3, 1),
(59, 'Bonjour', '2017-01-30 08:09:43', 3, 2),
(60, 'Comment vas-tu ?', '2017-01-30 08:09:49', 2, 3),
(61, 'Ça va bien ?', '2017-01-30 08:10:45', 3, 2);

-- --------------------------------------------------------

--
-- Structure de la table `news`
--

CREATE TABLE `news` (
  `id` int(11) NOT NULL,
  `title` varchar(45) DEFAULT NULL,
  `content` longtext,
  `users_id` int(11) NOT NULL,
  `date_creation` date DEFAULT NULL,
  `date_modification` date DEFAULT NULL,
  `state` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `news`
--

INSERT INTO `news` (`id`, `title`, `content`, `users_id`, `date_creation`, `date_modification`, `state`) VALUES
(93, 'Ouverture', '<h3>L\'espace Fabrication Additive a ouvert ses portes avec la r&eacute;ception de machines ce 24 octobre.</h3>\r\n<p>De la conception &agrave; la r&eacute;alisation, des sp&eacute;cialistes (dont un partenariat avec le lyc&eacute;e de Pablo Neruda &agrave; Dieppe) de la fabrication additive accompagnent les entreprises et forment leurs collaborateurs &agrave; ces nouvelles technologies. Un parc d\'imprimantes 3D derni&egrave;re g&eacute;n&eacute;ration permet d\'obtenir des prototypes multi-mat&eacute;riaux ou en couleur de qualit&eacute; avec un niveau de d&eacute;tail &eacute;lev&eacute;.</p>', 3, '2016-10-24', '2017-01-27', 1),
(94, 'Espace de codeurs', '<h3>Dans l\'espace de formation DMI</h3>\r\n<p>Depuis le 10 octobre dernier, l\'espace de formation de DMI accueille la premi&egrave;re session de l\'&eacute;cole de codeur du secteur Dieppois (WebForce3). 20 stagiaires, issus de P&ocirc;le Emploi Dieppe, vont suivre une formation intensive de 3.5 mois et sont pratiquement assur&eacute;s d\'opportunit&eacute;s professionnelles &agrave; la fin.</p>', 3, '2016-11-02', '2017-01-27', 1),
(95, 'Formation en cours', '<h3>Une formation courte et cibl&eacute;e</h3>\r\n<p>Une quinzaine d\'&eacute;tudiants sont actuellement en formation dans nos locaux, pour une p&eacute;riode de 6 jours. Cette formation, &agrave; l\'initiative de la CCI, a pour but de sensibiliser les lyc&eacute;ens Dieppois aux possibilit&eacute;s nouvelles offertes par la fabrication additive.</p>\r\n<p>Une journ&eacute;e "portes ouvertes" aura lieu le 1 f&eacute;vrier 2017</p>', 3, '2016-12-11', '2017-01-27', 1),
(96, 'asdfsd', '<p>asdfsad</p>', 3, '2017-01-30', '2017-01-30', 1);

-- --------------------------------------------------------

--
-- Structure de la table `news_pictures`
--

CREATE TABLE `news_pictures` (
  `id` int(11) NOT NULL,
  `name` varchar(45) DEFAULT NULL,
  `real_name` varchar(45) DEFAULT NULL,
  `type` varchar(5) DEFAULT NULL,
  `size` int(11) DEFAULT NULL,
  `alt` varchar(255) DEFAULT NULL,
  `news_id` int(11) NOT NULL,
  `state` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `news_pictures`
--

INSERT INTO `news_pictures` (`id`, `name`, `real_name`, `type`, `size`, `alt`, `news_id`, `state`) VALUES
(18, '1', '19-01-2017-INSA-DMI-7932', 'jpg', 92740, '1.jpg', 95, 1),
(19, '1', 'IMG_0979', 'jpg', 1644385, '1.jpg', 94, 1),
(20, '1', 'image_content_21446303_20161204205520', 'jpg', 50003, '1.jpg', 93, 1);

-- --------------------------------------------------------

--
-- Structure de la table `projects`
--

CREATE TABLE `projects` (
  `id` int(11) NOT NULL,
  `name` varchar(45) DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  `description` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `projects`
--

INSERT INTO `projects` (`id`, `name`, `date`, `description`) VALUES
(1, '1er projet', '2017-01-20 00:00:00', '1er projet de Melinda'),
(2, '2em projet', '2017-01-20 03:00:00', '2eme projet de Melinda'),
(3, 'Pierre projet 1', '2017-01-20 00:00:00', '1er projet de Pierre'),
(4, 'Gwen projet 1', '2017-01-20 03:00:00', '1er projet de Gwen'),
(5, 'Gwen projet 2', '2017-01-21 03:00:00', 'Mon 2eme projet'),
(9, 'Gwen Projet 3', '2017-01-27 13:05:09', 'Et voici le 3eme'),
(10, '', '2017-01-30 08:34:04', '');

-- --------------------------------------------------------

--
-- Structure de la table `projects_has_users`
--

CREATE TABLE `projects_has_users` (
  `id` int(11) NOT NULL,
  `projects_id` int(11) NOT NULL,
  `users_id` int(11) NOT NULL,
  `chief_id` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `projects_has_users`
--

INSERT INTO `projects_has_users` (`id`, `projects_id`, `users_id`, `chief_id`) VALUES
(1, 1, 1, 1),
(2, 2, 1, 1),
(3, 3, 3, 3),
(4, 4, 2, 2),
(5, 5, 2, 2),
(7, 9, 2, 2),
(8, 10, 2, 2);

-- --------------------------------------------------------

--
-- Structure de la table `roles`
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `name` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `roles`
--

INSERT INTO `roles` (`id`, `name`) VALUES
(1, 'superadministrator'),
(2, 'administrator'),
(3, 'member');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `lastname` varchar(45) NOT NULL,
  `firstname` varchar(45) NOT NULL,
  `mail` varchar(45) NOT NULL,
  `password` varchar(255) NOT NULL,
  `phone` varchar(10) NOT NULL,
  `log` datetime DEFAULT NULL,
  `last_message_time` datetime DEFAULT NULL,
  `state` tinyint(1) DEFAULT '0',
  `roles_id` int(11) NOT NULL DEFAULT '3'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `users`
--

INSERT INTO `users` (`id`, `lastname`, `firstname`, `mail`, `password`, `phone`, `log`, `last_message_time`, `state`, `roles_id`) VALUES
(1, 'kh', 'mely', 'mely@mail.fr', '$2y$10$smiwHfZw53Q.Rn7PnvAWKOCY3c3eH7qGqyrXcoegyRfYkuuos9c3y', '', '2017-01-28 17:32:32', '2017-01-28 17:32:20', 1, 3),
(2, 'Le Page', 'Gwenael', 'gwenael.le-page@orange.fr', '$2y$10$BAIDb13ttkZ9Bif8bfFxuOGvMCwB6LRHlmKq3BvOa9ePvEFeOx9/i', '0631230409', '2017-01-30 08:33:56', '2017-01-30 08:10:45', 1, 3),
(3, 'Veron', 'Pierre', 'pv@dmi.fr', '$2y$10$SwtO0Fmg0BXy.LiZA7kfAOP828eum.kfXkM2iuKSuQoTXGnc8wlDK', '', '2017-01-30 08:08:57', NULL, 1, 2);

--
-- Index pour les tables exportées
--

--
-- Index pour la table `files`
--
ALTER TABLE `files`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_files_project1_idx` (`projects_id`);

--
-- Index pour la table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_messages_users1_idx` (`users_id`);

--
-- Index pour la table `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_news_users1_idx` (`users_id`);

--
-- Index pour la table `news_pictures`
--
ALTER TABLE `news_pictures`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_pictures_news1_idx` (`news_id`);

--
-- Index pour la table `projects`
--
ALTER TABLE `projects`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `projects_has_users`
--
ALTER TABLE `projects_has_users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`),
  ADD KEY `fk_project_has_user_user1_idx` (`users_id`),
  ADD KEY `fk_project_has_user_project1_idx` (`projects_id`),
  ADD KEY `id_2` (`id`),
  ADD KEY `id_3` (`id`);

--
-- Index pour la table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `mail_UNIQUE` (`mail`),
  ADD KEY `fk_user_roles_idx` (`roles_id`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `files`
--
ALTER TABLE `files`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT pour la table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;
--
-- AUTO_INCREMENT pour la table `news`
--
ALTER TABLE `news`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=97;
--
-- AUTO_INCREMENT pour la table `news_pictures`
--
ALTER TABLE `news_pictures`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT pour la table `projects`
--
ALTER TABLE `projects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT pour la table `projects_has_users`
--
ALTER TABLE `projects_has_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT pour la table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `files`
--
ALTER TABLE `files`
  ADD CONSTRAINT `fk_files_project1` FOREIGN KEY (`projects_id`) REFERENCES `projects` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `messages`
--
ALTER TABLE `messages`
  ADD CONSTRAINT `fk_messages_users1` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `news`
--
ALTER TABLE `news`
  ADD CONSTRAINT `fk_news_users1` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `news_pictures`
--
ALTER TABLE `news_pictures`
  ADD CONSTRAINT `fk_pictures_news1` FOREIGN KEY (`news_id`) REFERENCES `news` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `projects_has_users`
--
ALTER TABLE `projects_has_users`
  ADD CONSTRAINT `fk_project_has_user_project1` FOREIGN KEY (`projects_id`) REFERENCES `projects` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_project_has_user_user1` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `fk_user_roles` FOREIGN KEY (`roles_id`) REFERENCES `roles` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
