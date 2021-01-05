-- phpMyAdmin SQL Dump
-- version 4.9.3
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:8889
-- Généré le :  mar. 05 jan. 2021 à 15:41
-- Version du serveur :  5.7.26
-- Version de PHP :  7.4.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Base de données :  `nba2kode`
--

-- --------------------------------------------------------

--
-- Structure de la table `matches`
--

CREATE TABLE `matches` (
  `matches_id` int(11) NOT NULL,
  `matches_date` date NOT NULL,
  `matches_location` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `teams_id_one` int(11) NOT NULL,
  `teams_id_two` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `matches`
--

INSERT INTO `matches` (`matches_id`, `matches_date`, `matches_location`, `teams_id_one`, `teams_id_two`) VALUES
(3, '1997-11-20', 'rrr', 5, 7),
(2, '2021-01-12', 'Couiza', 5, 2),
(4, '2021-01-08', 'klmmkl', 5, 7),
(5, '2021-01-01', 'ffssfddsf', 7, 2);

-- --------------------------------------------------------

--
-- Structure de la table `teams`
--

CREATE TABLE `teams` (
  `teams_id` int(11) NOT NULL,
  `teams_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `teams_city` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `teams`
--

INSERT INTO `teams` (`teams_id`, `teams_name`, `teams_city`) VALUES
(2, 'Warriors', 'Golden State'),
(7, 'testsd', 'testedfsdf'),
(5, 'Lol', 'Limou'),
(8, 'rfeffd', 'dfgvv');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `users_id` int(11) NOT NULL,
  `users_ident` varchar(16) COLLATE utf8mb4_unicode_ci NOT NULL,
  `users_pwd` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `users_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `users_level` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`users_id`, `users_ident`, `users_pwd`, `users_name`, `users_level`) VALUES
(1, 'admin', '$2y$10$CarIy.e5LuFpbQm4GP8hHe4nvVEkHrwQcrSfTIP.ICFXbyPe7n9kq', 'admin', 100);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `matches`
--
ALTER TABLE `matches`
  ADD PRIMARY KEY (`matches_id`);

--
-- Index pour la table `teams`
--
ALTER TABLE `teams`
  ADD PRIMARY KEY (`teams_id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`users_id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `matches`
--
ALTER TABLE `matches`
  MODIFY `matches_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `teams`
--
ALTER TABLE `teams`
  MODIFY `teams_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `users_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;