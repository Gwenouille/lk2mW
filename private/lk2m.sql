-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Client :  127.0.0.1
-- Généré le :  Lun 23 Janvier 2017 à 08:11
-- Version du serveur :  5.7.14
-- Version de PHP :  7.0.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `lk2m`
--

-- --------------------------------------------------------

--
-- Structure de la table `files`
--

CREATE TABLE `files` (
  `id` int(11) NOT NULL,
  `name` varchar(45) DEFAULT NULL,
  `type` varchar(45) DEFAULT NULL,
  `size` int(11) DEFAULT NULL,
  `projects_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `files`
--

INSERT INTO `files` (`id`, `name`, `type`, `size`, `projects_id`) VALUES
(1, 'fichier1', 'pdf', 1024, 1),
(2, 'fichier2', 'pdf', 1024, 5),
(3, 'fichier3', 'pdf', 1024, 5);

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
(1, 'Ceci est le message 1', '2017-01-20 11:09:00', 2, 3),
(2, 'Ceci est le 2eme message', '2017-01-20 11:19:00', 2, 3),
(3, 'Réponse de User 3', '2017-01-20 11:22:00', 3, 2),
(4, 'Et retour de l\'utilisateur 2 à l\'admin', '2017-01-20 11:19:00', 2, 3),
(5, 'Essai d\'envoi message', '2017-01-20 11:28:45', 2, 3),
(9, 'essai d\'envoi message', '2017-01-21 15:26:07', 3, 2),
(20, 'Mouveau message c\'est tres mouveau', '2017-01-23 07:59:44', 2, 3);

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
(1, 'Creation de l\'espace Fabrication Additive !', '<p>Chers amis, Bienvenue ! Aujourd\'hui est un grand jour: en effet, grace a l\'abn&eacute;gation de tous, il nous est permis de r&ecirc;ver &agrave; un futur rose et souriant !</p>\r\n<p>C\'est dans cette optique, vengeresse et conqu&eacute;rante, que nous devons aller de l\'avant !<br />Chers concitoyens, l\'heure est au mouvement !!!</p>', 3, '2017-01-18', '2017-01-23', 1),
(2, 'Mise a jour', 'La grille tarifaire est disponible', 3, '2017-01-21', '2017-01-21', 1);

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
(1, '1', 'image1', 'jpg', 258, 'une image', 1, 1),
(2, '2', 'image2', 'jpg', 258, 'une image', 2, 1);

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
(5, 'Gwen projet 2', '2017-01-21 03:00:00', 'Mon 2eme projet');

-- --------------------------------------------------------

--
-- Structure de la table `projects_has_users`
--

CREATE TABLE `projects_has_users` (
  `projects_id` int(11) NOT NULL,
  `users_id` int(11) NOT NULL,
  `chief_id` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `projects_has_users`
--

INSERT INTO `projects_has_users` (`projects_id`, `users_id`, `chief_id`) VALUES
(1, 1, 1),
(2, 1, 1),
(3, 3, 3),
(4, 2, 2),
(5, 2, 2);

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
  `state` tinyint(1) DEFAULT '0',
  `roles_id` int(11) NOT NULL DEFAULT '3'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `users`
--

INSERT INTO `users` (`id`, `lastname`, `firstname`, `mail`, `password`, `phone`, `log`, `state`, `roles_id`) VALUES
(1, 'kh', 'mely', 'mely@mail.fr', '$2y$10$smiwHfZw53Q.Rn7PnvAWKOCY3c3eH7qGqyrXcoegyRfYkuuos9c3y', '', NULL, 1, 3),
(2, 'Le Page', 'Gwenael', 'gwenael.le-page@orange.fr', '$2y$10$BAIDb13ttkZ9Bif8bfFxuOGvMCwB6LRHlmKq3BvOa9ePvEFeOx9/i', '', NULL, 1, 3),
(3, 'Veron', 'Pierre', 'pv@dmi.fr', '$2y$10$SwtO0Fmg0BXy.LiZA7kfAOP828eum.kfXkM2iuKSuQoTXGnc8wlDK', '', '2017-01-20 00:00:00', 1, 2);

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
  ADD PRIMARY KEY (`projects_id`,`users_id`),
  ADD KEY `fk_project_has_user_user1_idx` (`users_id`),
  ADD KEY `fk_project_has_user_project1_idx` (`projects_id`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT pour la table `news`
--
ALTER TABLE `news`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT pour la table `news_pictures`
--
ALTER TABLE `news_pictures`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT pour la table `projects`
--
ALTER TABLE `projects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT pour la table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
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
