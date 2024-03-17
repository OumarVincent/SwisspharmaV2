-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : sam. 16 mars 2024 à 20:55
-- Version du serveur : 10.4.32-MariaDB
-- Version de PHP : 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `swisspharma`
--

-- --------------------------------------------------------

--
-- Structure de la table `employe`
--

CREATE TABLE `employe` (
  `matricule` char(4) NOT NULL,
  `nom` varchar(30) DEFAULT NULL,
  `prenom` varchar(30) DEFAULT NULL,
  `adresse` varchar(30) DEFAULT NULL,
  `cp` varchar(5) DEFAULT NULL,
  `ville` varchar(30) DEFAULT NULL,
  `tel` int(10) DEFAULT NULL,
  `mel` varchar(50) DEFAULT NULL,
  `dateembauche` date DEFAULT NULL,
  `datenaissance` date DEFAULT NULL,
  `login` char(20) DEFAULT NULL,
  `mdp` char(20) DEFAULT NULL,
  `idRole` int(1) NOT NULL,
  `type_vehicule` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `employe`
--

INSERT INTO `employe` (`matricule`, `nom`, `prenom`, `adresse`, `cp`, `ville`, `tel`, `mel`, `dateembauche`, `datenaissance`, `login`, `mdp`, `idRole`, `type_vehicule`) VALUES
('E001', 'Dupont', 'Jean', '10 Rue de la République', '75001', 'Paris', 123456789, 'jean.dupont@email.com', '2022-01-01', '1980-01-01', 'jean.dupont', 'motdepasse123', 0, NULL),
('E002', 'Martin', 'Sophie', '15 Avenue des Champs-Élysées', '69002', 'Lyon', 234567890, 'sophie.martin@email.com', '2021-03-15', '1985-05-12', 'sophie.martin', 'mdp456', 1, NULL),
('E003', 'Lefevre', 'Pierre', '25 Rue du Faubourg Saint-Antoi', '31000', 'Toulouse', 345678901, 'pierre.lefevre@email.com', '2020-08-10', '1977-11-22', 'pierre.lefevre', 'secret123', 0, NULL),
('E004', 'Dubois', 'Isabelle', '8 Boulevard Saint-Germain', '13003', 'Marseille', 456789012, 'isabelle.dubois@email.com', '2023-02-20', '1992-07-30', 'isabelle.dubois', 'mdp789', 1, NULL),
('E005', 'Roux', 'Thomas', '12 Rue de la Paix', '44000', 'Nantes', 567890123, 'thomas.roux@email.com', '2019-11-05', '1988-04-18', 'thomas.roux', 'password123', 0, NULL),
('E006', 'Girard', 'Marie', '5 Avenue Victor Hugo', '69006', 'Lyon', 678901234, 'marie.girard@email.com', '2020-07-12', '1983-10-25', 'marie.girard', 'secure456', 1, NULL),
('E007', 'Moreau', 'Luc', '18 Rue de la Liberté', '59000', 'Lille', 789012345, 'luc.moreau@email.com', '2021-09-08', '1975-12-15', 'luc.moreau', 'pass123', 0, NULL),
('E008', 'Garcia', 'Anna', '22 Avenue des Gobelins', '75013', 'Paris', 890123456, 'anna.garcia@email.com', '2023-04-30', '1995-02-08', 'anna.garcia', 'secret789', 1, NULL),
('E009', 'Lopez', 'David', '14 Rue de la Trinité', '33000', 'Bordeaux', 901234567, 'david.lopez@email.com', '2020-06-25', '1986-08-03', 'david.lopez', 'mdp123', 0, NULL),
('E010', 'Fournier', 'Julie', '7 Quai de la Tournelle', '75005', 'Paris', 123456789, 'julie.fournier@email.com', '2022-02-14', '1990-03-22', 'julie.fournier', 'password456', 1, NULL),
('E011', 'Sanchez', 'Paul', '31 Avenue de la Victoire', '59000', 'Lille', 234567890, 'paul.sanchez@email.com', '2021-01-18', '1978-09-12', 'paul.sanchez', 'secure789', 0, NULL),
('E012', 'Gauthier', 'Céline', '9 Rue du Temple', '75004', 'Paris', 345678901, 'celine.gauthier@email.com', '2023-03-10', '1982-06-28', 'celine.gauthier', 'pass456', 1, NULL),
('E013', 'Muller', 'Alexandre', '20 Quai des Berges', '67000', 'Strasbourg', 456789012, 'alexandre.muller@email.com', '2019-10-05', '1987-11-05', 'alexandre.muller', 'mdp789', 0, NULL),
('E014', 'Robin', 'Nathalie', '11 Rue de la Bourse', '69002', 'Lyon', 567890123, 'nathalie.robin@email.com', '2020-08-20', '1984-04-15', 'nathalie.robin', 'secret123', 1, NULL),
('E015', 'Barbier', 'Antoine', '6 Avenue Montaigne', '75008', 'Paris', 678901234, 'antoine.barbier@email.com', '2021-05-15', '1976-12-28', 'antoine.barbier', 'pass789', 0, NULL),
('E016', 'Gerard', 'Caroline', '16 Boulevard Saint-Michel', '75005', 'Paris', 789012345, 'caroline.gerard@email.com', '2023-01-05', '1993-09-10', 'caroline.gerard', 'mdp123', 1, NULL),
('E017', 'Leroux', 'Franck', '24 Rue de la Pompe', '75116', 'Paris', 890123456, 'franck.leroux@email.com', '2020-12-01', '1979-07-18', 'franck.leroux', 'password789', 0, NULL),
('E018', 'Renard', 'Mélanie', '3 Avenue des Tilleuls', '59000', 'Lille', 901234567, 'melanie.renard@email.com', '2021-07-22', '1981-02-28', 'melanie.renard', 'secure123', 1, NULL),
('E019', 'Leclerc', 'Vincent', '17 Rue de la Paix', '75002', 'Paris', 123456789, 'vincent.leclerc@email.com', '2022-06-08', '1989-10-08', 'vincent.leclerc', 'pass789', 0, NULL),
('E020', 'Mercier', 'Sophie', '28 Quai de la Seine', '75019', 'Paris', 234567890, 'sophie.mercier@email.com', '2020-04-18', '1980-05-30', 'sophie.mercier', 'mdp123', 1, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `etat`
--

CREATE TABLE `etat` (
  `id` char(2) NOT NULL,
  `libelle` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `etat`
--

INSERT INTO `etat` (`id`, `libelle`) VALUES
('CL', 'Clôturée'),
('CR', 'Fiche créée'),
('MP', ' mise en paiement'),
('RE', 'Remboursée'),
('VP', 'Validation');

-- --------------------------------------------------------

--
-- Structure de la table `fichefrais`
--

CREATE TABLE `fichefrais` (
  `matricule` char(4) NOT NULL,
  `moisAnnee` char(6) NOT NULL,
  `nbjustificatifs` int(11) DEFAULT NULL,
  `montantvalide` decimal(10,2) DEFAULT NULL,
  `datemodif` date DEFAULT NULL,
  `idetat` char(2) DEFAULT 'CR'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `fichefrais`
--

INSERT INTO `fichefrais` (`matricule`, `moisAnnee`, `nbjustificatifs`, `montantvalide`, `datemodif`, `idetat`) VALUES
('E001', '202401', 11, 99999999.99, '2024-01-03', 'CR'),
('E001', '202402', 10, 1091.20, '2024-02-23', 'CR'),
('E001', '202403', 5, 10.00, '2024-03-07', 'CR'),
('E003', '202401', 10, 315.62, '2024-01-03', 'CR'),
('E003', '202403', 4, 3.00, '2024-03-16', 'CR'),
('E005', '202401', 15, 2421.82, '2024-01-07', 'CR'),
('E005', '202403', 50, 10500.00, '2024-03-16', 'CR');

-- --------------------------------------------------------

--
-- Structure de la table `fraisforfait`
--

CREATE TABLE `fraisforfait` (
  `id` varchar(10) NOT NULL,
  `libelle` varchar(255) DEFAULT NULL,
  `montant` decimal(5,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `fraisforfait`
--

INSERT INTO `fraisforfait` (`id`, `libelle`, `montant`) VALUES
('FK4D', 'Frais Kilométrique 4CV Diesel', 0.52),
('FK4E', 'Frais Kilométrique 4CV Essence', 0.62),
('FK56D', 'Frais Kilométrique 5/6CV Diesel', 0.58),
('FK56E', 'Frais Kilométrique 5/6CV Essence', 0.67),
('NUI', 'Nuitée', 80.00),
('RE', 'Relais étape', 100.00),
('REP', 'Repas Restaurant', 29.00);

-- --------------------------------------------------------

--
-- Structure de la table `lignefraisforfait`
--

CREATE TABLE `lignefraisforfait` (
  `matricule` char(4) NOT NULL,
  `moisAnnee` char(6) NOT NULL,
  `idfraisforfait` char(4) NOT NULL,
  `quantite` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `lignefraisforfait`
--

INSERT INTO `lignefraisforfait` (`matricule`, `moisAnnee`, `idfraisforfait`, `quantite`) VALUES
('E001', '202401', 'FK', 10),
('E001', '202401', 'NUI', 10),
('E001', '202401', 'RE', 10),
('E001', '202401', 'REP', 10),
('E001', '202402', 'FK', 10),
('E001', '202402', 'NUI', 5),
('E001', '202402', 'RE', 5),
('E001', '202402', 'REP', 5),
('E001', '202403', 'FK', 5),
('E001', '202403', 'NUI', 5),
('E001', '202403', 'RE', 5),
('E001', '202403', 'REP', 5),
('E003', '202401', 'FK', 1),
('E003', '202401', 'NUI', 1),
('E003', '202401', 'RE', 1),
('E003', '202401', 'REP', 1),
('E003', '202403', 'FK', 0),
('E003', '202403', 'NUI', 3),
('E003', '202403', 'RE', 2),
('E003', '202403', 'REP', 2),
('E005', '202401', 'FK', 11),
('E005', '202401', 'NUI', 11),
('E005', '202401', 'RE', 11),
('E005', '202401', 'REP', 11),
('E005', '202403', 'FK', 0),
('E005', '202403', 'NUI', 50),
('E005', '202403', 'RE', 50),
('E005', '202403', 'REP', 50);

-- --------------------------------------------------------

--
-- Structure de la table `lignefraishorsforfait`
--

CREATE TABLE `lignefraishorsforfait` (
  `id` int(11) NOT NULL,
  `dateHF` date DEFAULT NULL,
  `montant` decimal(10,2) DEFAULT NULL,
  `libelle` varchar(100) DEFAULT NULL,
  `matricule` char(4) NOT NULL,
  `moisAnnee` char(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `lignefraishorsforfait`
--

INSERT INTO `lignefraishorsforfait` (`id`, `dateHF`, `montant`, `libelle`, `matricule`, `moisAnnee`) VALUES
(7, '2024-01-03', 99999999.99, 'test', 'E001', '202401'),
(9, '2024-01-07', 50.00, 'TEST VIDEO', 'E005', '202401'),
(10, '2024-02-23', 10.00, 'TEST 23', 'E001', '202402'),
(11, '2024-03-07', 10.00, 'test', 'E001', '202403'),
(12, '2024-03-16', 3.00, 'TEST VIDEO', 'E003', '202403'),
(14, '2024-03-10', 50.00, 'test', 'E005', '202403');

-- --------------------------------------------------------

--
-- Structure de la table `role`
--

CREATE TABLE `role` (
  `id` int(1) NOT NULL,
  `libelle` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `role`
--

INSERT INTO `role` (`id`, `libelle`) VALUES
(0, 'visiteur'),
(1, 'comptable');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `employe`
--
ALTER TABLE `employe`
  ADD PRIMARY KEY (`matricule`),
  ADD KEY `idRole` (`idRole`);

--
-- Index pour la table `etat`
--
ALTER TABLE `etat`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `fichefrais`
--
ALTER TABLE `fichefrais`
  ADD PRIMARY KEY (`matricule`,`moisAnnee`),
  ADD KEY `idetat` (`idetat`);

--
-- Index pour la table `fraisforfait`
--
ALTER TABLE `fraisforfait`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `lignefraisforfait`
--
ALTER TABLE `lignefraisforfait`
  ADD PRIMARY KEY (`matricule`,`moisAnnee`,`idfraisforfait`),
  ADD KEY `idfraisforfait` (`idfraisforfait`);

--
-- Index pour la table `lignefraishorsforfait`
--
ALTER TABLE `lignefraishorsforfait`
  ADD PRIMARY KEY (`id`),
  ADD KEY `matricule` (`matricule`,`moisAnnee`);

--
-- Index pour la table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `lignefraishorsforfait`
--
ALTER TABLE `lignefraishorsforfait`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `employe`
--
ALTER TABLE `employe`
  ADD CONSTRAINT `employe_ibfk_1` FOREIGN KEY (`idRole`) REFERENCES `role` (`id`);

--
-- Contraintes pour la table `fichefrais`
--
ALTER TABLE `fichefrais`
  ADD CONSTRAINT `fichefrais_ibfk_1` FOREIGN KEY (`idetat`) REFERENCES `etat` (`id`),
  ADD CONSTRAINT `fichefrais_ibfk_2` FOREIGN KEY (`matricule`) REFERENCES `employe` (`matricule`);

--
-- Contraintes pour la table `lignefraisforfait`
--
ALTER TABLE `lignefraisforfait`
  ADD CONSTRAINT `lignefraisforfait_ibfk_1` FOREIGN KEY (`matricule`,`moisAnnee`) REFERENCES `fichefrais` (`matricule`, `moisAnnee`);

--
-- Contraintes pour la table `lignefraishorsforfait`
--
ALTER TABLE `lignefraishorsforfait`
  ADD CONSTRAINT `lignefraishorsforfait_ibfk_1` FOREIGN KEY (`matricule`,`moisAnnee`) REFERENCES `fichefrais` (`matricule`, `moisAnnee`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
