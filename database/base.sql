
CREATE TABLE IF NOT EXISTS fraisforfait (
  id char(4) NOT NULL,
  libelle varchar(20) DEFAULT NULL,
  montant decimal(5,2) DEFAULT NULL,
  PRIMARY KEY (id)
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS role (
    id INT(1) NOT NULL,
    libelle varchar(30) DEFAULT NULL,
    PRIMARY KEY(id)
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS etat (
  id char(2) NOT NULL,
  libelle varchar(30) DEFAULT NULL,
  PRIMARY KEY (id)
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS employe (
  matricule char(4) NOT NULL,
  nom varchar(30) DEFAULT NULL,
  prenom varchar(30) DEFAULT NULL, 
  adresse varchar(30) DEFAULT NULL,
  cp varchar(5) DEFAULT NULL,
  ville varchar(30) DEFAULT NULL,
  tel int(10) DEFAULT NULL,
  mel varchar(50) DEFAULT NULL,
  dateembauche date DEFAULT NULL,
  datenaissance date DEFAULT NULL,
  login char(20) DEFAULT NULL,
  mdp char(20) DEFAULT NULL,
  idRole INT(1) NOT NULL,
  PRIMARY KEY (matricule),
  FOREIGN KEY (idRole) REFERENCES role(id)
) ENGINE=InnoDB;



CREATE TABLE IF NOT EXISTS fichefrais (
  matricule char(4) NOT NULL,
  moisAnnee char(6) NOT NULL,
  nbjustificatifs int(11) DEFAULT NULL,
  montantvalide decimal(10,2) DEFAULT NULL,
  datemodif date DEFAULT NULL,
  idetat char(2) DEFAULT 'CR',
  PRIMARY KEY (matricule,moisAnnee),
  FOREIGN KEY (idetat) REFERENCES etat(id),
  FOREIGN KEY (matricule) REFERENCES employe(matricule)
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS lignefraisforfait (
  matricule char(4) NOT NULL,
  moisAnnee char(6) NOT NULL,
  idfraisforfait char(4) NOT NULL,
  quantite int(11) DEFAULT NULL,
  PRIMARY KEY (matricule,moisAnnee,idfraisforfait),
  FOREIGN KEY (matricule, moisAnnee) REFERENCES fichefrais(matricule, moisAnnee),
  FOREIGN KEY (idfraisforfait) REFERENCES fraisforfait(id)
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS lignefraishorsforfait (
  id int(11) NOT NULL auto_increment,
  dateHF DATE DEFAULT NULL,
  montant decimal(10,2) DEFAULT NULL,
  libelle varchar(100) DEFAULT NULL,
  matricule char(4) NOT NULL,
  moisAnnee char(6) NOT NULL,
  PRIMARY KEY (id),
  FOREIGN KEY (matricule, moisAnnee) REFERENCES fichefrais(matricule, moisAnnee)
) ENGINE=InnoDB;


INSERT INTO etat (id, libelle) VALUES
('RE', 'Remboursée'),
('CL', 'Clôturée'),
('CR', 'Fiche créée'),
('VP', 'Validée et mise en paiement');

INSERT INTO role (id,libelle) VALUES 
(0,'visiteur'),
(1, 'comptable');


INSERT INTO employe (matricule, nom, prenom, adresse, cp, ville, tel, mel, dateembauche, datenaissance, login, mdp, idRole)
VALUES
  ('E001', 'Dupont', 'Jean', '10 Rue de la République', '75001', 'Paris', 0123456789, 'jean.dupont@email.com', '2022-01-01', '1980-01-01', 'jean.dupont', 'motdepasse123', '0'),
  ('E002', 'Martin', 'Sophie', '15 Avenue des Champs-Élysées', '69002', 'Lyon', 0234567890, 'sophie.martin@email.com', '2021-03-15', '1985-05-12', 'sophie.martin', 'mdp456', '1'),
  ('E003', 'Lefevre', 'Pierre', '25 Rue du Faubourg Saint-Antoine', '31000', 'Toulouse', 0345678901, 'pierre.lefevre@email.com', '2020-08-10', '1977-11-22', 'pierre.lefevre', 'secret123', '0'),
  ('E004', 'Dubois', 'Isabelle', '8 Boulevard Saint-Germain', '13003', 'Marseille', 0456789012, 'isabelle.dubois@email.com', '2023-02-20', '1992-07-30', 'isabelle.dubois', 'mdp789', '1'),
  ('E005', 'Roux', 'Thomas', '12 Rue de la Paix', '44000', 'Nantes', 0567890123, 'thomas.roux@email.com', '2019-11-05', '1988-04-18', 'thomas.roux', 'password123', '0'),
  ('E006', 'Girard', 'Marie', '5 Avenue Victor Hugo', '69006', 'Lyon', 0678901234, 'marie.girard@email.com', '2020-07-12', '1983-10-25', 'marie.girard', 'secure456', '1'),
  ('E007', 'Moreau', 'Luc', '18 Rue de la Liberté', '59000', 'Lille', 0789012345, 'luc.moreau@email.com', '2021-09-08', '1975-12-15', 'luc.moreau', 'pass123', '0'),
  ('E008', 'Garcia', 'Anna', '22 Avenue des Gobelins', '75013', 'Paris', 0890123456, 'anna.garcia@email.com', '2023-04-30', '1995-02-08', 'anna.garcia', 'secret789', '1'),
  ('E009', 'Lopez', 'David', '14 Rue de la Trinité', '33000', 'Bordeaux', 0901234567, 'david.lopez@email.com', '2020-06-25', '1986-08-03', 'david.lopez', 'mdp123', '0'),
  ('E010', 'Fournier', 'Julie', '7 Quai de la Tournelle', '75005', 'Paris', 0123456789, 'julie.fournier@email.com', '2022-02-14', '1990-03-22', 'julie.fournier', 'password456', '1'),
  ('E011', 'Sanchez', 'Paul', '31 Avenue de la Victoire', '59000', 'Lille', 0234567890, 'paul.sanchez@email.com', '2021-01-18', '1978-09-12', 'paul.sanchez', 'secure789', '0'),
  ('E012', 'Gauthier', 'Céline', '9 Rue du Temple', '75004', 'Paris', 0345678901, 'celine.gauthier@email.com', '2023-03-10', '1982-06-28', 'celine.gauthier', 'pass456', '1'),
  ('E013', 'Muller', 'Alexandre', '20 Quai des Berges', '67000', 'Strasbourg', 0456789012, 'alexandre.muller@email.com', '2019-10-05', '1987-11-05', 'alexandre.muller', 'mdp789', '0'),
  ('E014', 'Robin', 'Nathalie', '11 Rue de la Bourse', '69002', 'Lyon', 0567890123, 'nathalie.robin@email.com', '2020-08-20', '1984-04-15', 'nathalie.robin', 'secret123', '1'),
  ('E015', 'Barbier', 'Antoine', '6 Avenue Montaigne', '75008', 'Paris', 0678901234, 'antoine.barbier@email.com', '2021-05-15', '1976-12-28', 'antoine.barbier', 'pass789', '0'),
  ('E016', 'Gerard', 'Caroline', '16 Boulevard Saint-Michel', '75005', 'Paris', 0789012345, 'caroline.gerard@email.com', '2023-01-05', '1993-09-10', 'caroline.gerard', 'mdp123', '1'),
  ('E017', 'Leroux', 'Franck', '24 Rue de la Pompe', '75116', 'Paris', 0890123456, 'franck.leroux@email.com', '2020-12-01', '1979-07-18', 'franck.leroux', 'password789', '0'),
  ('E018', 'Renard', 'Mélanie', '3 Avenue des Tilleuls', '59000', 'Lille', 0901234567, 'melanie.renard@email.com', '2021-07-22', '1981-02-28', 'melanie.renard', 'secure123', '1'),
  ('E019', 'Leclerc', 'Vincent', '17 Rue de la Paix', '75002', 'Paris', 0123456789, 'vincent.leclerc@email.com', '2022-06-08', '1989-10-08', 'vincent.leclerc', 'pass789', '0'),
  ('E020', 'Mercier', 'Sophie', '28 Quai de la Seine', '75019', 'Paris', 0234567890, 'sophie.mercier@email.com', '2020-04-18', '1980-05-30', 'sophie.mercier', 'mdp123', '1');

INSERT INTO fraisforfait (id, libelle, montant) VALUES
('RE', 'Relais étape', 110.00),
('FK', 'Frais Kilométrique', 0.62),
('NUI', 'Nuitée', 80.00),
('REP', 'Repas Restaurant', 25.00);