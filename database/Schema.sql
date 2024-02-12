CREATE TABLE serenitea_farms_utilisateurs (
    id_user VARCHAR(10) PRIMARY KEY,
    nom VARCHAR(255) NOT NULL,
    prenom VARCHAR(255) NOT NULL,
    pseudo VARCHAR(255) NOT NULL,
    mot_de_passe VARCHAR(255) NOT NULL,
    date_de_naissance DATE NOT NULL,
    date_d_inscription DATE NOT NULL,
    admin BOOLEAN DEFAULT false,
);

CREATE TABLE serenitea_farms_the (
    variete VARCHAR(255) PRIMARY KEY,
    occupation DOUBLE DEFAULT 1,
    rendement DOUBLE DEFAULT 1
);

CREATE TABLE serenitea_farms_parcelles (
    reference VARCHAR(20) PRIMARY KEY,
    surface DOUBLE DEFAULT 1,
    variete VARCHAR(255) NOT NULL,
    Foreign Key serenitea_farms_parcelles(variete) REFERENCES serenitea_farms_the(variete)
);

CREATE TABLE serenitea_farms_ceuilleurs (
    id_ceuilleur VARCHAR(20) PRIMARY KEY,
    nom VARCHAR(255) NOT NULL,
    prenom VARCHAR(255) NOT NULL,
    date_de_naissance DATE NOT NULL,
    date_d_embauche DATE DEFAULT now(),
    date_de_depart DATE DEFAULT NULL
);

CREATE TABLE serenitea_farms_depenses(
    nom VARCHAR(255) NOT NULL,
    date DATETIME DEFAULT now(),
    montant DOUBLE DEFAULT 0
);

CREATE TABLE serenitea_farms_historique_salaire (
    id_ceuilleur VARCHAR(20),
    date DATE DEFAULT now(),
    montant DOUBLE DEFAULT 0,
    Foreign Key serenitea_farms_historique_salaire(id_ceuilleur) REFERENCES serenitea_farms_ceuilleurs(id_ceuilleur)
);