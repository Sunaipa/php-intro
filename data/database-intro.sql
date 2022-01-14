--Activate de la BD
USE formation_cda_2022;
--Création de la table
CREATE TABLE IF NOT EXISTS persons (
    id INT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
    last_name VARCHAR(30) NOT NULL,
    first_name VARCHAR(30) NOT NULL
);
-- Insertion de données
INSERT INTO persons (first_name, last_name)
VALUES
('Ada', 'Lovelace'),
("Sinead", 'O''Connor'),
('Algernon', 'Lovelace');

--Supprimer des données
DELETE FROM persons WHERE id = 2;

-- modification des données
UPDATE persons SET first_name = 'Siobhan' WHERE id=3;

-- affichage des données
SELECT * FROM persons WHERE last_name = 'LoveLace';


CREATE TABLE IF NOT EXISTS users (
    id INT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
    user_login  VARCHAR(30) NOT NULL,
    user_password VARCHAR(128) NOT NULL
)