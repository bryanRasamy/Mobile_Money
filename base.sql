CREATE TABLE operateurs (
    id INTEGER PRIMARY KEY AUTOINCREMENT ,
    nom VARCHAR(100) ,
    mdp VARCHAR(255) ,
    id_role INTEGER ,

    FOREIGN KEY (id_role) REFERENCES role(id)
);

CREATE TABLE prefixe (
    id INTEGER PRIMARY KEY AUTOINCREMENT ,
    libelle VARCHAR(20),
    id_operateur INTEGER,

    FOREIGN KEY (id_operateur) REFERENCES operateurs(id)
);

CREATE TABLE type_operation (
    id INTEGER PRIMARY KEY AUTOINCREMENT ,
    nom_operation VARCHAR(100),
    commission DECIMAL(15,2)
);

CREATE TABLE baremes (
    id INTEGER PRIMARY KEY AUTOINCREMENT ,
    id_type INTEGER ,
    valeur_min DECIMAL(15,2) ,
    valeur_max DECIMAL(15,2) ,
    montant DECIMAL(15,2) ,

    FOREIGN KEY (id_type) REFERENCES type_operation(id)
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
    id_operateur INTEGER,
    id_role INTEGER ,
    id_statut INTEGER ,

    FOREIGN KEY (id_operateur) REFERENCES operateurs(id),
    FOREIGN KEY (id_role) REFERENCES role(id),
    FOREIGN KEY (id_statut) REFERENCES statut_client(id)
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
    FOREIGN KEY (id_type) REFERENCES type_operation(id)
);

INSERT INTO role (libelle) VALUES
('Client'),
('Operateur');

INSERT INTO statut_client (libelle) VALUES
('Actif'),
('Inactif');

INSERT INTO operateurs (nom, mdp, id_role) VALUES
('orange', 'orange', 2),
('autres', 'autres', 2);

INSERT INTO prefixe (libelle, id_operateur) VALUES
('032', 1),
('033', 2),
('034', 2),
('037', 1),
('038', 2);

INSERT INTO type_operation (nom_operation, commission) VALUES
('Depot',10),
('Retrait',15),
('Transfert',20);

INSERT INTO clients (telephone, id_operateur, id_role, id_statut) VALUES
('0340000001', 2, 1, 1),
('0340000002', 2, 1, 2),
('0321234567', 1, 1, 1);


INSERT INTO baremes (id_type, valeur_min, valeur_max, montant) VALUES
(3, 0, 50000, 1000),
(3, 50001, 100000, 2000),
(3, 100001, 500000, 5000),
(3, 500001, 1000000, 10000);


INSERT INTO historique (id_client_depart, id_type, id_client_arriver, montant, frais, date) VALUES
(1, 3, 2, 25000, 1000, '2026-07-20 08:00:00'),
(2, 3, 3, 75000, 2000, '2026-07-20 09:15:00'),
(3, 3, 5, 200000, 5000, '2026-07-20 10:30:00'),
(5, 3, 7, 800000, 10000, '2026-07-20 11:45:00'),
(7, 3, 1, 50000, 1000, '2026-07-20 12:10:00');


CREATE view v_historique_type_operation AS SELECT tp.nom_operation as nom_operation, hs.* FROM type_operation as tp JOIN historique as hs ON tp.id = hs.id_type;
CREATE view v_situation_gain AS SELECT nom_operation,SUM();