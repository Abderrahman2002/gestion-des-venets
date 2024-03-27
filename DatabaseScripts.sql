-- Création de la base de données si elle n'existe pas
CREATE DATABASE IF NOT EXISTS WS_concours;

-- Utilisation de la base de données nouvellement créée
USE WS_concours ;

-- Création de la table "utilisateur" (
    login VARCHAR(50) PRIMARY KEY,
    password VARCHAR(50) NOT NULL,
    type VARCHAR(50) NOT NULL
);

-- Création de la table "type produit"
CREATE TABLE type_produit (
    type VARCHAR(50) PRIMARY KEY
);

-- Création de la table "produit"
CREATE TABLE produit (
    RefPdt VARCHAR(50) PRIMARY KEY,
    libPdt VARCHAR(100) NOT NULL,
    Prix INT NOT NULL,
    Qte INT NOT NULL,
    description TEXT NOT NULL,
    image TEXT NOT NULL,
    type VARCHAR(50),
    FOREIGN KEY (type) REFERENCES type_produit(type)
);

-- Insertion des données dans la table "utilisateur"
INSERT INTO utilisateur (login, password, type)
VALUES ('admin', 'admin', 'administrateur'),
       ('fadii', '1111', 'user'),
       ('teste', 'teste', 'user'),
       ('user3', 'user3', 'user');

-- Insertion des données dans la table "type produit"
INSERT INTO type_produit (type)
VALUES ('Electronique'),
       ('Electricite'),
       ('Informatique');

-- Insertion des données dans la table "produit"
INSERT INTO produit (RefPdt, libPdt, Prix, Qte, description, image, type)
VALUES ('P0003', 'SMART PHONE', 5788, 10, 'SMART PHONE', 'iphone.jpg', 'Electronique'),
       ('P001', 'Smart TV', 4500, 5, 'Smart TV marque SONY', 'tv.jpg', 'Electronique');
