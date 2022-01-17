-- Activation de la BD
USE formation_cda_2022;

-- Création de la table
CREATE TABLE IF NOT EXISTS persons (
    id INT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
    last_name VARCHAR(30) NOT NULL,
    first_name VARCHAR(30) NOT NULL
);

-- Insertion de données
INSERT INTO persons (first_name, last_name)
VALUES 
('Ada', 'Lovelace'),
('Sinead', 'O''Connor'),
('Algernon', 'Lovelace');


-- suppression des données
DELETE FROM persons WHERE id=2;

-- modification des données
UPDATE persons SET first_name = 'Siobhan' WHERE id= 3;

-- affichage des données
SELECT * FROM persons WHERE last_name='Lovelace';


--
CREATE TABLE IF NOT EXISTS addresses (
    id SMALLINT UNSIGNED PRIMARY KEY NOT NULL AUTO_INCREMENT,
    rue VARCHAR(38) NOT NULL,
    code_postal CHAR(5) NOT NULL,
    ville VARCHAR(33) Not NULL
);


CREATE TABLE IF NOT EXISTS orders (
    id INT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
    date_commande DATE NOT NULL,
    montant DECIMAL(6,2) NOT NULL
);


-- Permet de filtrer dans la table persons pour la ligne first_name commencant par un a.
SELECT * FROM persons WHERE first_name LIKE 'A%';


-- Permet de filtrer dans la table persons pour la ligne first_name qui correspond au info dans le tableau apres le IN.
SELECT * FROM persons WHERE first_name IN ('Martin', 'Tillet');


-- Donne le resultat de toutes les persons dont le prenom est different de 'Martin'
SELECT * FROM persons WHERE first_name != 'Martin';


DROP TABLE IF EXISTS `livres_simples`;
CREATE TABLE `livres_simples` (
`id` mediumint unsigned NOT NULL AUTO_INCREMENT,
`titre` varchar(80) NOT NULL,
`prix` decimal(5,2) NOT NULL,
`auteur` varchar(50) NOT NULL,
`editeur` varchar(50) NOT NULL,
`genre` varchar(50) NOT NULL,
`date_publication` date DEFAULT NULL,
`nationalite_auteur` varchar(50) DEFAULT NULL,
`langue` varchar(50) DEFAULT NULL,
`auteur_prenom` varchar(50) DEFAULT NULL,
`auteur_nom` varchar(50) DEFAULT NULL,
PRIMARY KEY (`id`)
);


-- Recuperer tous les livres de la catégorie Informatique ecris en Francais
SELECT * FROM livres_simples WHERE genre = 'Informatique' AND langue = 'français';


-- Recuperer tous les livres ecrits en italien et en castillan
SELECT * FROM livres_simples WHERE langue = 'italien' OR langue = 'castillan'; 
-- OU
SELECT * FROM livres_simples WHERE langue IN ('italien','castillan'); 


-- Recuperer les livres qui NE sont PAS ecrits en Anglais et dont le prix est inferieur à 12
SELECT * FROM livres_simples WHERE langue != 'anglais' AND prix < 12 ORDER BY prix DESC;

-- Les livres edité par Hachette
SELECT * FROM livres_simples WHERE editeur = 'Hachette';


-- Les livres ecrits par Joe Celko 
SELECT * FROM livres_simples WHERE auteur_nom = 'Celko' AND auteur_prenom = 'Joe';


-- *****************************
-- AGREGATIONS
-- *****************************

SELECT  
        editeur,
        sum(prix) as 'total',
        avg(prix) as 'moyenne',
        min(prix) as 'min',
        max(prix) as 'max',
        count(*) as 'nb',
        std(prix) as ecart-type 
FROM livres_simples
-- WHERE prix > 20  pas bon : Filtre puis aggrega et pas l'inverse
GROUP BY editeur;
HAVING nb > 3;

SELECT genre, count(*) as nb
FROM livres_simples
GROUP BY genre;

SELECT DISTINCT auteur, editeur FROM livres_simples ORDER BY editeur;

SELECT COUNT( DISTINCT langue) FROM livres_simples;

SELECT editeur, COUNT(DISTINCT genre) as nb 
FROM livres_simples 
GROUP BY auteur 
HAVING nb > 1;

SELECT editeur, COUNT(DISTINCT langue) as nb
FROM livres_simples
GROUP BY editeur
HAVING COUNT(langue) >1;

SELECT genre, count(*) as nb,
GROUP_CONCAT(distinct auteur ORDER BY auteur SEPARATOR ' : ') as 'auteurs'
FROM livres_simples
GROUP BY genre;


/******************
*Liaison entre tables
*****************/

--Ajout de la clef étrangère
ALTER TABLE persons
ADD COLUMN address_id SMALLINT UNSIGNED; 

INSERT INTO addresses (rue, code_postal, ville)
VALUES ('5 rue Orfila', '75020', 'Paris'),
        ('3 rue des granges', '25000', 'Besançon'),
        ('12 rue B','44000','Nantes');

INSERT INTO persons (first_name, last_name)
VALUES 
('Ada', 'Lovelace'),
('Sinead', 'O''Connor'),
('Algernon', 'Lovelace'); 

SELECT persons.id as id_persons, first_name, last_name, ville, addresses.id
FROM persons, addresses 
WHERE persons.address_id = addresses.id;

SELECT 
p.id as id_persons, first_name, last_name, ville, a.id as id_adresse
FROM persons as p 
LEFT JOIN  addresses as a
ON p.address_id = a.id;

--Intégrité référentielle
ALTER TABLE persons 
ADD CONSTRAINT persons_to_addresses
FOREIGN KEY (address_id)
REFERENCES addresses(id);

ALTER TABLE orders
ADD COLUMN client_id INT UNSIGNED NOT NULL;


SELECT o.date_commande, o.montant, p.first_name, p.last_name, a.ville
FROM orders as o
JOIN persons as p ON o.client_id = p.id
JOIN addresses as a ON p.address_id = a.id;



SET foreign_key_checks = 0;



CREATE TABLE IF NOT EXISTS livres(
`id` mediumint unsigned AUTO_INCREMENT,
`titre` varchar(80) NOT NULL,
`prix` decimal(5,2) NOT NULL,
`date_publication` date DEFAULT NULL,
id_auteurs MEDIUMINT UNSIGNED,
id_editeurs MEDIUMINT UNSIGNED,
id_genres MEDIUMINT UNSIGNED,
id_langues MEDIUMINT UNSIGNED,
PRIMARY KEY (`id`),
CONSTRAINT livres_to_auteurs FOREIGN KEY (`id_auteurs`) REFERENCES auteurs(id),
CONSTRAINT livres_to_editeurs FOREIGN KEY (`id_editeurs`) REFERENCES editeurs(id),
CONSTRAINT livres_to_genres FOREIGN KEY (`id_genres`) REFERENCES genres(id),
CONSTRAINT livres_to_langues FOREIGN KEY (`id_langues`) REFERENCES langues(id)
);


CREATE TABLE IF NOT EXISTS auteurs (
    `id` mediumint unsigned AUTO_INCREMENT,
    `prenom` varchar(50) DEFAULT NULL,
    `nom` varchar(50) DEFAULT NULL,
    `nationalite_auteur` varchar(50) DEFAULT NULL,
    PRIMARY KEY (`id`)
);

CREATE TABLE IF NOT EXISTS editeurs (
`id` mediumint unsigned NOT NULL AUTO_INCREMENT,
`editeur` VARCHAR(50) DEFAULT NULL,
PRIMARY KEY (`id`)
);

CREATE TABLE IF NOT EXISTS genres (
`id` mediumint unsigned NOT NULL AUTO_INCREMENT,
`genre`VARCHAR(50) DEFAULT NULL,
PRIMARY KEY (`id`)
);

CREATE TABLE IF NOT EXISTS langues (
`id` mediumint unsigned NOT NULL AUTO_INCREMENT,
`langue` VARCHAR(50) DEFAULT NULL,
PRIMARY KEY (`id`)
);

TRUNCATE langues;
INSERT INTO langues (langue) 
(SELECT DISTINCT langue FROM livres_simples);

TRUNCATE genres;
INSERT INTO genres (genre) (
SELECT DISTINCT genre FROM livres_simples);


TRUNCATE editeurs;
INSERT INTO editeurs (editeur) 
(SELECT DISTINCT editeur FROM livres_simples);

TRUNCATE auteurs;
INSERT INTO auteurs (nom, prenom, nationalite_auteur) 
(SELECT DISTINCT auteur_nom, auteur_prenom, nationalite_auteur FROM livres_simples);


TRUNCATE livres;
INSERT INTO livres (titre, prix, date_publication, id_auteurs, id_editeurs, id_genres, id_langues)
(
    SELECT 
    titre, 
    prix, 
    date_publication,
    a.id as auteur_id,
    e.id as editeur_id,
    g.id as genre_id,
    l.id as langue_id
    FROM livres_simples as ls
    JOIN auteurs as a ON a.nom = ls.auteur_nom
    JOIN editeurs as e ON e.editeur = ls.editeur
    JOIN genres as g ON g.genre = ls.genre
    JOIN langues as l ON l.langue = ls.langue
);

SET foreign_key_checks = 1;


-- Requête avec jointures qui affiche toute les infos des livres

CREATE OR REPLACE VIEW vue_livres AS
SELECT 
l.id, 
titre, 
prix, 
DATE_FORMAT(date_publication, '%d/%m/%Y') as date_edition,
FLOOR(DATEDIFF(NOW(), date_publication)/365.25) as age_du_livre,
a.nom, 
a.prenom, 
a.nationalite_auteur, 
e.editeur, 
g.genre, 
lg.langue 
FROM livres as l
JOIN auteurs as a ON l.id_auteurs = a.id
JOIN editeurs as e ON l.id_auteurs = e.id
JOIN genres as g ON l.id_auteurs = g.id
JOIN langues as lg ON l.id_auteurs = lg.id;

 SELECT * FROM vue_livres;