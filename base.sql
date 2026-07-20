CREATE TABLE prefixe (
    id INTEGER PRIMARY KEY AUTOINCREMENT ,
    libelle VARCHAR(20) 
);


CREATE TABLE type_operation (
    id INTEGER PRIMARY KEY AUTOINCREMENT ,
    nom_operation VARCHAR(100) 
);


CREATE TABLE statut_client (
    id INTEGER PRIMARY KEY AUTOINCREMENT ,
    libelle VARCHAR(50) 
);


CREATE TABLE role (
    id INTEGER PRIMARY KEY AUTOINCREMENT ,
    libelle VARCHAR(50) 
);


CREATE TABLE clients (
    id INTEGER PRIMARY KEY AUTOINCREMENT ,
    telephone VARCHAR(20)  UNIQUE,
    id_role INTEGER ,
    id_statut INTEGER ,

    FOREIGN KEY (id_role) REFERENCES role(id),
    FOREIGN KEY (id_statut) REFERENCES statut_client(id)
);


CREATE TABLE operateurs (
    id INTEGER PRIMARY KEY AUTOINCREMENT ,
    nom VARCHAR(100) ,
    mdp VARCHAR(255) ,
    id_role INTEGER ,

    FOREIGN KEY (id_role) REFERENCES role(id)
);

CREATE DATABASE gestion_transfert;
USE gestion_transfert;




CREATE TABLE prefixe (
    id INTEGER PRIMARY KEY AUTOINCREMENT ,
    libelle VARCHAR(20) 
);




CREATE TABLE type_operation (
    id INTEGER PRIMARY KEY AUTOINCREMENT ,
    nom_operation VARCHAR(100) 
);




CREATE TABLE statut_client (
    id INTEGER PRIMARY KEY AUTOINCREMENT ,
    libelle VARCHAR(50) 
);




CREATE TABLE role (
    id INTEGER PRIMARY KEY AUTOINCREMENT ,
    libelle VARCHAR(50) 
);




CREATE TABLE clients (
    id INTEGER PRIMARY KEY AUTOINCREMENT ,
    telephone VARCHAR(20)  UNIQUE,
    id_role INTEGER ,
    id_statut INTEGER ,

    FOREIGN KEY (id_role) REFERENCES role(id),
    FOREIGN KEY (id_statut) REFERENCES statut_client(id)
);




CREATE TABLE operateurs (
    id INTEGER PRIMARY KEY AUTOINCREMENT ,
    nom VARCHAR(100) ,
    mdp VARCHAR(255) ,
    id_role INTEGER ,

    FOREIGN KEY (id_role) REFERENCES role(id)
);




CREATE TABLE baremes (
    id INTEGER PRIMARY KEY AUTOINCREMENT ,
    id_type INTEGER ,
    valeur_min DECIMAL(15,2) ,
    valeur_max DECIMAL(15,2) ,
    montant DECIMAL(15,2) ,

    FOREIGN KEY (id_type) REFERENCES type_operation(id),

);




CREATE TABLE historique (
    id INTEGER PRIMARY KEY AUTOINCREMENT ,
    id_client_depart INTEGER ,
    id_type INTEGER ,
    id_client_arriver INTEGER ,
    montant DECIMAL(15,2) ,
    frais DECIMAL(15,2) ,
    date DATETIME  DEFAULT CURRENT_TIMESTAMP,

    FOREIGN KEY (id_client_depart) REFERENCES clients(id),
    FOREIGN KEY (id_client_arriver) REFERENCES clients(id),
    FOREIGN KEY (id_type) REFERENCES type_operation(id),

);