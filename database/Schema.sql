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