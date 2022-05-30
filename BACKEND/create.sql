DROP TABLE IF EXISTS Client;
DROP TABLE IF EXISTS Product;

CREATE TABLE Client(
    id SERIAL PRIMARY KEY,
    nom VARCHAR(48),
    prenom VARCHAR(48),
    email VARCHAR(100) UNIQUE,
    password VARCHAR(256),
    ville VARCHAR(200),
    codePostal VARCHAR(100),
    telephone INTEGER

);

CREATE TABLE Product(
    id SERIAL PRIMARY KEY,
    libelle VARCHAR(32),
    prix INTEGER
);

INSERT INTO Product(id, libelle, prix)
VALUES (1, 'T-shirt', 30),
       (2, 'Polo', 40),
       (3, 'Jean', 50),
       (4, 'Pull', 50)
