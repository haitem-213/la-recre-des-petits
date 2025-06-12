-- phpMyAdmin SQL Dump
-- version 5.1.1deb5ubuntu1
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:3306
-- Généré le : mar. 25 fév. 2025 à 13:51
-- Version du serveur : 8.0.41-0ubuntu0.22.04.1
-- Version de PHP : 8.1.2-1ubuntu2.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `recre_petits`
--

-- --------------------------------------------------------

--
-- Structure de la table `age`
--

CREATE TABLE `age` (
  `id_age` int NOT NULL,
  `noma` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `articles_commandes`
--

CREATE TABLE `articles_commandes` (
  `id_articles` int NOT NULL,
  `commande_id` int NOT NULL,
  `produit_id` int NOT NULL,
  `quantite` int NOT NULL,
  `prix_unitaire` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `categorie`
--

CREATE TABLE `categorie` (
  `id_categorie` int NOT NULL,
  `nomc` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `commande`
--

CREATE TABLE `commande` (
  `id_commandes` int NOT NULL,
  `client_id` int NOT NULL,
  `date_de_commande` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `statut` enum('en_attente','payée','expédiée','annulée') NOT NULL,
  `totalc` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `marque`
--

CREATE TABLE `marque` (
  `id_marque` int NOT NULL,
  `nomm` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `paiement`
--

CREATE TABLE `paiement` (
  `paiement_id` int NOT NULL,
  `commande_id` int NOT NULL,
  `montant` decimal(10,2) NOT NULL,
  `methode` enum('carte','paypal','virement') NOT NULL,
  `statut` enum('en_attente','réussi','échoué') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `produits`
--

CREATE TABLE `produits` (
  `id_produits` int NOT NULL,
  `nomp` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `prix` decimal(10,2) NOT NULL,
  `stock` int NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `categorie_id` int NOT NULL,
  `age_id` int NOT NULL,
  `marque_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

CREATE TABLE `utilisateur` (
  `id_utilisateur` int NOT NULL,
  `societe` varchar(150) DEFAULT NULL,
  `nomu` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `prenomu` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `email` varchar(150) NOT NULL,
  `role` varchar(15) NOT NULL DEFAULT 'lecteur',
  `adresse1` varchar(150) DEFAULT NULL,
  `adresse2` varchar(150) DEFAULT NULL,
  `code_postal` varchar(5) DEFAULT NULL,
  `ville` varchar(150) DEFAULT NULL,
  `telephone` varchar(15) DEFAULT NULL,
  `mot_de_passe` varchar(255) NOT NULL,
  `cree_le` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;



--
-- Index pour la table `age`
--
ALTER TABLE `age`
  ADD PRIMARY KEY (`id_age`);

--
-- Index pour la table `articles_commandes`
--
ALTER TABLE `articles_commandes`
  ADD PRIMARY KEY (`id_articles`),
  ADD KEY `commande_id` (`commande_id`),
  ADD KEY `produit_id` (`produit_id`);

--
-- Index pour la table `categorie`
--
ALTER TABLE `categorie`
  ADD PRIMARY KEY (`id_categorie`);

--
-- Index pour la table `commande`
--
ALTER TABLE `commande`
  ADD PRIMARY KEY (`id_commandes`),
  ADD KEY `client_id` (`client_id`);

--
-- Index pour la table `marque`
--
ALTER TABLE `marque`
  ADD PRIMARY KEY (`id_marque`);

--
-- Index pour la table `paiement`
--
ALTER TABLE `paiement`
  ADD PRIMARY KEY (`paiement_id`),
  ADD KEY `commande_id` (`commande_id`);

--
-- Index pour la table `produits`
--
ALTER TABLE `produits`
  ADD PRIMARY KEY (`id_produits`),
  ADD KEY `categorie_id` (`categorie_id`),
  ADD KEY `age_id` (`age_id`),
  ADD KEY `marque_id` (`marque_id`);

--
-- Index pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD PRIMARY KEY (`id_utilisateur`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `age`
--
ALTER TABLE `age`
  MODIFY `id_age` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `articles_commandes`
--
ALTER TABLE `articles_commandes`
  MODIFY `id_articles` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `categorie`
--
ALTER TABLE `categorie`
  MODIFY `id_categorie` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `commande`
--
ALTER TABLE `commande`
  MODIFY `id_commandes` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `marque`
--
ALTER TABLE `marque`
  MODIFY `id_marque` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `paiement`
--
ALTER TABLE `paiement`
  MODIFY `paiement_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `produits`
--
ALTER TABLE `produits`
  MODIFY `id_produits` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  MODIFY `id_utilisateur` int NOT NULL AUTO_INCREMENT;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `articles_commandes`
--
ALTER TABLE `articles_commandes`
  ADD CONSTRAINT `articles_commandes_ibfk_1` FOREIGN KEY (`commande_id`) REFERENCES `commande` (`id_commandes`),
  ADD CONSTRAINT `articles_commandes_ibfk_2` FOREIGN KEY (`produit_id`) REFERENCES `produits` (`id_produits`);

--
-- Contraintes pour la table `commande`
--
ALTER TABLE `commande`
  ADD CONSTRAINT `commande_ibfk_1` FOREIGN KEY (`client_id`) REFERENCES `utilisateur` (`id_utilisateur`);

--
-- Contraintes pour la table `paiement`
--
ALTER TABLE `paiement`
  ADD CONSTRAINT `paiement_ibfk_1` FOREIGN KEY (`commande_id`) REFERENCES `commande` (`id_commandes`);

--
-- Contraintes pour la table `produits`
--
ALTER TABLE `produits`
  ADD CONSTRAINT `produits_ibfk_1` FOREIGN KEY (`categorie_id`) REFERENCES `categorie` (`id_categorie`),
  ADD CONSTRAINT `produits_ibfk_2` FOREIGN KEY (`age_id`) REFERENCES `age` (`id_age`),
  ADD CONSTRAINT `produits_ibfk_3` FOREIGN KEY (`marque_id`) REFERENCES `marque` (`id_marque`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
