-- Base de données pour le site Ecommerce
-- SGBD MariaDB
-- Script de création ou de restauration
-- 2SIO v2022 Antoine Espinoza

-- Création de la base si elle n'existe pas
CREATE DATABASE IF NOT EXISTS `db_shiba` CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;

CREATE USER 'ShibaUser'@'127.0.0.1' IDENTIFIED BY 'Sh1b@Adm1n*';

USE `db_shiba`;

-- Suppression des tables si elles existent
DROP TABLE IF EXISTS `categorie`;
DROP TABLE IF EXISTS `produit`;
DROP TABLE IF EXISTS `client`;
DROP TABLE IF EXISTS `commande`;
DROP TABLE IF EXISTS `commander`;
DROP TABLE IF EXISTS `panier`;
DROP TABLE IF EXISTS `favoris`;
DROP TABLE IF EXISTS `recuperation`;
DROP TABLE IF EXISTS `statut`;
DROP TABLE IF EXISTS `correspondre`;
DROP TABLE IF EXISTS `logins`;

--
-- Création des tables
-- 
CREATE TABLE IF NOT EXISTS `categorie` (
	`numCategorie` integer NOT NULL AUTO_INCREMENT,
	`libelleCategorie` varchar(64),
	`ref_interne` varchar(64),
	CONSTRAINT `pk_categorie` PRIMARY KEY (`numCategorie`)
)ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE IF NOT EXISTS `produit` (
	`idProduit` integer NOT NULL AUTO_INCREMENT,
	`ref_interne` varchar(32),
	`libelleP` varchar(64),
	`resumeP` varchar(128),
	`descriptionP` varchar(256),
	`pathPhoto` varchar(128),
	`qte_stock` integer,
	`prix_vente_uht` float(10,2),
	`datePublication` date,
	`seuilAlerte` integer DEFAULT 0,
	`idCategorie` integer,
	CONSTRAINT `pk_produit` PRIMARY KEY (`idProduit`),
	CONSTRAINT `fk_produit_categorie` FOREIGN KEY (idCategorie) REFERENCES categorie(numCategorie)
)ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE IF NOT EXISTS `client` (
	`idClient` integer NOT NULL AUTO_INCREMENT,
	`email` varchar(128) UNIQUE,
	`cpt` char(5),
	`ville` varchar(64),
	`pays` varchar(64),
	`aPostale` varchar(128),
	`nom` varchar(64),
	`prenom` varchar(64),
	`dateN` date,
	`tel` char(10),
    `mdp` varchar(128),
	`roles` varchar(32),
	`newsletter` integer DEFAULT 0,
	CONSTRAINT `pk_client` PRIMARY KEY (`idClient`)
)ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE IF NOT EXISTS `commande` (
	`idCmd` integer NOT NULL AUTO_INCREMENT,
	`idClient` integer,
	`dateCommande` datetime,
	CONSTRAINT `pk_commande` PRIMARY KEY (`idCmd`),
	CONSTRAINT `fk_commande_client` FOREIGN KEY (idClient) REFERENCES client(idClient)
)ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE IF NOT EXISTS `commander` (
	`idProduit` integer,
	`idCmd` integer,	
	`qte` integer,	
	CONSTRAINT `pk_commander` PRIMARY KEY (`idProduit`, `idCmd`),
	CONSTRAINT `fk_commander_produit` FOREIGN KEY (idProduit) REFERENCES produit(idProduit),
	CONSTRAINT `fk_commander_commande` FOREIGN KEY (idCmd) REFERENCES commande(idCmd)
)ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE IF NOT EXISTS `panier` (
	`idProduit` integer,
	`idClient` integer,	
	`qtePanier` integer,
	CONSTRAINT `pk_panier` PRIMARY KEY (`idProduit`, `idClient`),
	CONSTRAINT `fk_panier_produit` FOREIGN KEY (idProduit) REFERENCES produit(idProduit),
	CONSTRAINT `fk_panier_client` FOREIGN KEY (idClient) REFERENCES client(idClient)
)ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE IF NOT EXISTS `favoris` (
	`idProduit` integer,
	`idClient` integer,	
	CONSTRAINT `pk_favoris` PRIMARY KEY (`idProduit`, `idClient`),
	CONSTRAINT `fk_favoris_produit` FOREIGN KEY (idProduit) REFERENCES produit(idProduit),
	CONSTRAINT `fk_favoris_client` FOREIGN KEY (idClient) REFERENCES client(idClient)
)ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE IF NOT EXISTS `recuperation` (
	`idRecup` integer NOT NULL AUTO_INCREMENT,
	`code` integer,
	`confirme` integer DEFAULT 0,
	`mail` varchar(128),
	CONSTRAINT `pk_recuperation` PRIMARY KEY (`idRecup`)
)ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE IF NOT EXISTS `statut` (
	`idStatut` integer NOT NULL AUTO_INCREMENT,
	`libelle` varchar(50),
	`imgStatut` varchar(128),	
	CONSTRAINT `pk_statut` PRIMARY KEY (`idStatut`)
)ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE IF NOT EXISTS `correspondre` (
	`idCmd` integer,
	`idStatut` integer,	
	`dateStatut` datetime,
	CONSTRAINT `pk_correspondre` PRIMARY KEY (`idCmd`, `idStatut`),
	CONSTRAINT `fk_correspondre_commande` FOREIGN KEY (idCmd) REFERENCES commande(idCmd),
	CONSTRAINT `fk_correspondre_statut` FOREIGN KEY (idStatut) REFERENCES statut(idStatut)
)ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE IF NOT EXISTS `logins` (
	`id` integer NOT NULL AUTO_INCREMENT,
	`created_at` datetime,	
	`email` varchar(128),
	`ip` varchar(32),	
	CONSTRAINT `pk_logins` PRIMARY KEY (`id`)
)ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Procédures/Fonctions
--
DELIMITER $
CREATE FUNCTION GetPrixTotalByCmd(idCommande integer)
RETURNS float
BEGIN
    DECLARE prix float;
    SELECT SUM(prix_vente_uht * qte) as prixCmd INTO prix
    FROM commander C 
    JOIN produit P on P.idProduit = C.idProduit 
    WHERE idCmd = idCommande;
    RETURN prix;
END;
$

DELIMITER $
CREATE FUNCTION GetNbArticleByCmd(idCommande integer)
RETURNS int
BEGIN
    DECLARE nbArticle int;
    SELECT SUM(qte) as nbArticles INTO nbArticle
    FROM commander C 
    JOIN produit P on P.idProduit = C.idProduit 
    WHERE idCmd = idCommande;
    RETURN nbArticle;
END;
$

DELIMITER $
CREATE FUNCTION GetNbArticlePanier(idC integer)
RETURNS int
BEGIN
    DECLARE nbArticle int;
    SELECT SUM(qtePanier) as qteP INTO nbArticle
    FROM panier 
    WHERE idClient = idC;
    RETURN nbArticle;
END;
$

DELIMITER ;

--
-- Privilège utilisateur
--
GRANT SELECT, INSERT, UPDATE, DELETE ON db_shiba.* TO 'ShibaUser'@'127.0.0.1';
GRANT EXECUTE ON FUNCTION db_shiba.GetNbArticlePanier TO 'ShibaUser'@'127.0.0.1';
GRANT EXECUTE ON FUNCTION db_shiba.GetNbArticleByCmd TO 'ShibaUser'@'127.0.0.1';
GRANT EXECUTE ON FUNCTION db_shiba.GetPrixTotalByCmd TO 'ShibaUser'@'127.0.0.1';

-- 
-- Insertion des enregistrements
--
INSERT INTO `categorie` (`libelleCategorie`, `ref_interne`) VALUES
('Shiba Club', 'shiba-club'),
('Baby Shiba Club', 'baby-shiba-club');

INSERT INTO `statut` (`libelle`, `imgStatut`) VALUES 
('Non validée', 'img/cmd/s1.png'),
('Préparation', 'img/cmd/s2.png'),
('Pris en charge', 'img/cmd/s3.png'),
('En cours d''acheminement', 'img/cmd/s4.png'),
('Livré', 'img/cmd/s5.png');

INSERT INTO `client` (`email`, `cpt`, `ville`, `pays`, `aPostale`, `nom`, `prenom`, `dateN`, `tel`, `mdp`, `roles`) VALUES
('antoine@gmail.com', 34000, 'Montpellier', 'France', '1 avenue pompignane', 'Espinoza', 'Antoine', '2003/11/10', '0768486580', '$2y$12$jxTpnCQ7VUrvrYILyt5xFOZi9eRHQBNWhBz/FbHeCvoof.k7WFX/K', 'admin'),
('maxime@gmail.com', 34970, 'Lattes', 'France', '10 rue voltaire', 'Esteve', 'Maxime', '1995/02/23', '0748657877', '$2y$12$jxTpnCQ7VUrvrYILyt5xFOZi9eRHQBNWhBz/FbHeCvoof.k7WFX/K', 'user'),
('pilou@gmail.com', 34160, 'Castries', 'France', '20 rue de la fontaine', 'Callier', 'Pilou', '2002/12/02', '0678456652', '$2y$12$jxTpnCQ7VUrvrYILyt5xFOZi9eRHQBNWhBz/FbHeCvoof.k7WFX/K', 'user'),
('gil@gmail.com', 34000, 'Montpellier', 'France', '4 avenue jean monnet', 'Gil', 'Gabriel', '2001/02/11', '0799887898', '$2y$12$jxTpnCQ7VUrvrYILyt5xFOZi9eRHQBNWhBz/FbHeCvoof.k7WFX/K', 'user');

INSERT INTO `produit` (`ref_interne`, `libelleP`, `resumeP`, `descriptionP`, `pathPhoto`, `qte_stock`, `prix_vente_uht`, `datePublication`, `idCategorie`) VALUES
('SC-1', 'Shiba Club', 'Une image NFT d''une qualité execptionnelle.','Cette image NFT vous permettra d''avoir certains avantages, le Shiba Club NFT #7530 est de 1920 par 1080. Il a été créé par notre graphiste Gregory Leroi en 2021.',
'img/boutique/b1.png', 15, 25.99, '2021/10/15', 1),
('SC-2', 'Shiba Club',  'Une image NFT d''une qualité execptionnelle.', 'Cette image NFT vous permettra d''avoir certains avantages, le Shiba Club NFT #2128 est de 1920 par 1080. Il a été créé par notre graphiste Magali Berdat en 2022.',
'img/boutique/b2.png', 12, 22.99, '2022/05/11', 1),
('BSC-1', 'Baby Shiba Club', 'Une image NFT de la nouvelle collection.', 'Cette image NFT vous permettra d''avoir certains avantages, le Baby Shiba Club NFT #7455 est de 1920 par 1080. Il a été créé par notre graphiste Gregory Leroi en 2022. Il fait parti de la nouvelle collection.',
'img/boutique/b3.jpg', 10, 27.99, '2022/05/15', 2),
('SC-3', 'Shiba Club',  'Une image NFT d''une qualité execptionnelle.', 'Cette image NFT vous permettra d''avoir certains avantages, le Shiba Club NFT #1341 est de 1920 sur 1080. Il a été créé par notre graphiste Franchesco Belluci en 2021.',
'img/boutique/b4.png', 18, 18.99, '2021/11/20', 1),
('SC-4', 'Shiba Club',  'Une image NFT d''une qualité execptionnelle.', 'Cette image NFT vous permettra d''avoir certains avantages, le Shiba Club NFT #4778 est de 1920 sur 1080. Il a été créé par notre graphiste Franchesco Belluci en 2020.',
'img/boutique/b5.png', 25, 25.99, '2020/03/11', 1),
('SC-5', 'Shiba Club',  'Une image NFT d''une qualité execptionnelle.', 'Cette image NFT vous permettra d''avoir certains avantages, le Shiba Club NFT #0445 est de 1920 sur 1080. Il a été créé par notre graphiste Gabriel Esteve en 2020.',
'img/boutique/b6.png', 12, 19.95, '2020/08/23', 1),
('SC-6', 'Shiba Club',  'Une image NFT d''une qualité execptionnelle.', 'Cette image NFT vous permettra d''avoir certains avantages, le Shiba Club NFT #1834 est de 1920 sur 1080. Il a été créé par notre graphiste Magali Berdat en 2021.',
'img/boutique/b7.png', 17, 23.99, '2021/07/21', 1),
('BSC-2', 'Baby Shiba Club',  'Une image NFT d''une qualité execptionnelle.', 'Cette image NFT vous permettra d''avoir certains avantages, le Baby Shiba Club NFT #7321 est de 1920 sur 1080. Il a été créé par notre graphiste Micky Gardi en 2022. Il fait parti de la nouvelle collection.',
'img/boutique/b8.jpg', 18, 27.99, '2022/09/18', 2),
('BSC-3', 'Baby Shiba Club',  'Une image NFT d''une qualité execptionnelle.', 'Cette image NFT vous permettra d''avoir certains avantages, le Baby Shiba Club NFT #3262 est de 1920 sur 1080. Il a été créé par notre graphiste Micky Gardi en 2022. Il fait parti de la nouvelle collection.',
'img/boutique/b9.jpg', 23, 25.99, '2022/09/19', 2),
('SC-7', 'Shiba Club',  'Une image NFT d''une qualité execptionnelle.', 'Cette image NFT vous permettra d''avoir certains avantages, le Shiba Club NFT #2154 est de 1920 sur 1080. Il a été créé par notre graphiste Gabriel Esteve en 2021.',
'img/boutique/b10.png', 27, 23.99, '2021/10/15', 1),
('BSC-4', 'Baby Shiba Club',  'Une image NFT d''une qualité execptionnelle.', 'Cette image NFT vous permettra d''avoir certains avantages, le Baby Shiba Club NFT #1101 est de 1920 sur 1080. Il a été créé par notre graphiste Gregory Leroi en 2021. Il fait parti de la nouvelle collection.',
'img/boutique/b11.jpg', 20, 25.99, '2021/04/05', 2),
('SC-8', 'Shiba Club',  'Une image NFT d''une qualité execptionnelle.', 'Cette image NFT vous permettra d''avoir certains avantages, le Shiba Club NFT #4310 est de 1920 sur 1080. Il a été créé par notre graphiste Anthonin Rabatel en 2020.',
'img/boutique/b12.png', 18, 25.99, '2020/12/15', 1),
('BSC-5', 'Baby Shiba Club',  'Une image NFT d''une qualité execptionnelle.', 'Cette image NFT vous permettra d''avoir certains avantages, le Baby Shiba Club NFT #2222 est de 1920 sur 1080. Il a été créé par notre graphiste Gregory Leroi en 2022. Il fait parti de la nouvelle collection.',
'img/boutique/b13.jpg', 13, 27.99, '2022/07/29', 2),
('SC-9', 'Shiba Club',  'Une image NFT d''une qualité execptionnelle.', 'Cette image NFT vous permettra d''avoir certains avantages, le Shiba Club NFT #1200 est de 1920 sur 1080. Il a été créé par notre graphiste Anthonin Rabatel en 2022.',
'img/boutique/b14.png', 18, 25.99, '2022/04/15', 1),
('SC-10', 'Shiba Club',  'Une image NFT d''une qualité execptionnelle.', 'Cette image NFT vous permettra d''avoir certains avantages, le Shiba Club NFT #9014 est de 1920 sur 1080. Il a été créé par notre graphiste Micky Gardi en 2020.',
'img/boutique/b15.png', 18, 24.99, '2020/12/21', 1),
('SC-11', 'Shiba Club',  'Une image NFT d''une qualité execptionnelle.', 'Cette image NFT vous permettra d''avoir certains avantages, le Shiba Club NFT #4214 est de 1920 sur 1080. Il a été créé par notre graphiste Magali Berdat en 2021.',
'img/boutique/b16.png', 22, 25.99, '2021/02/20', 1),
('SC-12', 'Shiba Club',  'Une image NFT d''une qualité execptionnelle.', 'Cette image NFT vous permettra d''avoir certains avantages, le Shiba Club NFT #1950 est de 1920 sur 1080. Il a été créé par notre graphiste Magali Berdat en 2021.',
'img/boutique/b17.png', 11, 19.99, '2021/03/08', 1),
('BSC-6', 'Baby Shiba Club',  'Une image NFT d''une qualité execptionnelle.', 'Cette image NFT vous permettra d''avoir certains avantages, le Baby Shiba Club NFT #1274 est de 1920 sur 1080. Il a été créé par notre graphiste Roberto Carlos en 2022. Il fait parti de la nouvelle collection.',
'img/boutique/b18.jpg', 9, 29.99, '2022/11/13', 2),
('SC-13', 'Shiba Club',  'Une image NFT d''une qualité execptionnelle.', 'Cette image NFT vous permettra d''avoir certains avantages, le Shiba Club NFT #0901 est de 1920 sur 1080. Il a été créé par notre graphiste Micky Gardi en 2021.',
'img/boutique/b19.png', 18, 23.99, '2021/05/15', 1),
('SC-14', 'Shiba Club', 'Une image NFT d''une qualité execptionnelle.', 'Cette image NFT vous permettra d''avoir certains avantages, le Shiba Club NFT #0278 est de 1920 sur 1080. Il a été créé par notre graphiste Gabriel Esteve en 2020.',
'img/boutique/b20.png', 18, 25.99, '2020/08/19', 1),
('SC-15', 'Shiba Club',  'Une image NFT d''une qualité execptionnelle.', 'Cette image NFT vous permettra d''avoir certains avantages, le Shiba Club NFT #2094 est de 1920 sur 1080. Il a été créé par notre graphiste Micky Gardi en 2020.',
'img/boutique/b21.png', 11, 17.99, '2020/10/23', 1),
('BSC-7', 'Baby Shiba Club',  'Une image NFT d''une qualité execptionnelle.', 'Cette image NFT vous permettra d''avoir certains avantages, le Baby Shiba Club NFT #1471 est de 1920 sur 1080. Il a été créé par notre graphiste Gabriel Esteve en 2022. Il fait parti de la nouvelle collection.',
'img/boutique/b22.png', 13, 32.99, '2022/01/12', 2),
('BSC-8', 'Baby Shiba Club',  'Une image NFT d''une qualité execptionnelle.', 'Cette image NFT vous permettra d''avoir certains avantages, le Baby Shiba Club NFT #1777 est de 1920 sur 1080. Il a été créé par notre graphiste Gregory Leroi en 2022. Il fait parti de la nouvelle collection.',
'img/boutique/b23.png', 8, 32.99, '2022/05/08', 2),
('SC-16', 'Shiba Club',  'Une image NFT d''une qualité execptionnelle.', 'Cette image NFT vous permettra d''avoir certains avantages, le Shiba Club NFT #3004 est de 1920 sur 1080. Il a été créé par notre graphiste Micky Gardi en 2021.',
'img/boutique/b24.png', 17, 27.99, '2021/12/07', 1),
('SC-17', 'Shiba Club',  'Une image NFT d''une qualité execptionnelle.', 'Cette image NFT vous permettra d''avoir certains avantages, le Shiba Club NFT #4970 est de 1920 sur 1080. Il a été créé par notre graphiste Micky Gardi en 2021.',
'img/boutique/b25.png', 12, 25.99, '2021/06/19', 1),
('BSC-9', 'Baby Shiba Club',  'Une image NFT d''une qualité execptionnelle.', 'Cette image NFT vous permettra d''avoir certains avantages, le Baby Shiba Club NFT #5820 est de 1920 sur 1080. Il a été créé par notre graphiste Magali Berdat en 2022. Il fait parti de la nouvelle collection.',
'img/boutique/b26.png', 6, 32.99, '2022/03/13', 2),
('SC-18', 'Shiba Club',  'Une image NFT d''une qualité execptionnelle.', 'Cette image NFT vous permettra d''avoir certains avantages, le Shiba Club NFT #7691 est de 1920 sur 1080. Il a été créé par notre graphiste Anthonin Rabatel en 2022.',
'img/boutique/b27.png', 9, 34.99, '2022/07/22', 1),
('SC-19', 'Shiba Club',  'Une image NFT d''une qualité execptionnelle.', 'Cette image NFT vous permettra d''avoir certains avantages, le Shiba Club NFT #2843 est de 1920 sur 1080. Il a été créé par notre graphiste Franchesco Belluci en 2022.',
'img/boutique/b28.png', 11, 34.99, '2022/05/29', 1),
('SC-20', 'Shiba Club',  'Une image NFT d''une qualité execptionnelle.', 'Cette image NFT vous permettra d''avoir certains avantages, le Shiba Club NFT #5454 est de 1920 sur 1080. Il a été créé par notre graphiste Micky Gardi en 2020.',
'img/boutique/b29.png', 17, 18.99, '2020/02/05', 1),
('SC-21', 'Shiba Club',  'Une image NFT d''une qualité execptionnelle.', 'Cette image NFT vous permettra d''avoir certains avantages, le Shiba Club NFT #7737 est de 1920 sur 1080. Il a été créé par notre graphiste Roberto Carlos en 2022.',
'img/boutique/b30.png', 10, 29.99, '2022/04/15', 1),
('SC-22', 'Shiba Club',  'Une image NFT d''une qualité execptionnelle.', 'Cette image NFT vous permettra d''avoir certains avantages, le Shiba Club NFT #1725 est de 1920 sur 1080. Il a été créé par notre graphiste Micky Gardi en 2021.',
'img/boutique/b31.png', 6, 19.99, '2021/08/21', 1),
('BSC-10', 'Baby Shiba Club',  'Une image NFT d''une qualité execptionnelle.', 'Cette image NFT vous permettra d''avoir certains avantages, le Baby Shiba Club NFT #3412 est de 1920 sur 1080. Il a été créé par notre graphiste Rick Curtis en 2021. Il fait parti de la nouvelle collection.',
'img/boutique/b32.png', 11, 27.99, '2021/11/12', 2),
('SC-23', 'Shiba Club',  'Une image NFT d''une qualité execptionnelle.', 'Cette image NFT vous permettra d''avoir certains avantages, le Shiba Club NFT #8836 est de 1920 sur 1080. Il a été créé par notre graphiste Rick Curtis en 2022.',
'img/boutique/b33.png', 13, 32.99, '2022/09/20', 1),
('SC-24', 'Shiba Club',  'Une image NFT d''une qualité execptionnelle.', 'Cette image NFT vous permettra d''avoir certains avantages, le Shiba Club NFT #6474 est de 1920 sur 1080. Il a été créé par notre graphiste Gregory Leroi en 2021.',
'img/boutique/b34.png', 17, 25.99, '2021/01/11', 1),
('SC-25', 'Shiba Club',  'Une image NFT d''une qualité execptionnelle.', 'Cette image NFT vous permettra d''avoir certains avantages, le Shiba Club NFT #7541 est de 1920 sur 1080. Il a été créé par notre graphiste Gabriel Esteve en 2022.',
'img/boutique/b35.png', 14, 27.99, '2022/05/15', 1),
('BSC-11', 'Baby Shiba Club',  'Une image NFT d''une qualité execptionnelle.', 'Cette image NFT vous permettra d''avoir certains avantages, le Baby Shiba Club NFT #2788 est de 1920 sur 1080. Il a été créé par notre graphiste Micky Gardi en 2022.  Il fait parti de la nouvelle collection.',
'img/boutique/b36.png', 11, 29.99, '2022/07/05', 2);

INSERT INTO `commande` (`idClient`, `dateCommande`) VALUES
(2, '2023-02-28 15:48:28'),
(4, '2023-02-30 15:49:06'),
(4, '2023-04-21 15:50:04'),
(4, '2023-05-02 15:51:28'),
(3, '2023-07-28 15:51:35'),
(3, '2023-09-01 15:52:35'),
(3, '2023-09-03 11:25:30'),
(2, '2023-09-11 21:54:48'),
(2, '2023-09-17 15:15:10'),
(3, '2023-09-27 14:42:50');

INSERT INTO `commander` (`idProduit`, `idCmd`, `qte`) VALUES
(2, 1, 1),
(2, 10, 1),
(3, 2, 1),
(3, 3, 2),
(3, 4, 1),
(4, 4, 1),
(4, 5, 1),
(5, 1, 2),
(8, 2, 2),
(8, 3, 1),
(9, 4, 2),
(10, 5, 1),
(10, 6, 1),
(10, 7, 1),
(11, 8, 1),
(13, 9, 2),
(15, 1, 1),
(18, 2, 1),
(22, 8, 1),
(27, 10, 1),
(29, 7, 2);

INSERT INTO `correspondre` (`idCmd`, `idStatut`, `datestatut`) VALUES
(1, 1, '2023-02-28 15:48:28'),
(1, 2, '2023-03-01 14:21:33'),
(1, 3, '2023-03-04 19:14:47'),
(1, 4, '2023-03-05 11:12:13'),
(1, 5, '2023-03-05 21:27:38'),
(2, 1, '2023-03-08 12:11:46'),
(2, 2, '2023-03-09 06:47:32'),
(3, 1, '2023-03-15 09:20:03'),
(4, 1, '2023-03-16 11:29:07'),
(4, 2, '2023-03-16 17:22:38'),
(4, 3, '2023-03-17 07:59:51'),
(5, 1, '2023-03-23 15:14:21'),
(6, 1, '2023-04-12 21:02:07'),
(6, 2, '2023-04-13 07:27:39'),
(7, 1, '2023-04-17 22:12:17'),
(7, 2, '2023-04-18 05:23:33'),
(7, 3, '2023-04-21 18:27:52'),
(8, 1, '2023-05-21 12:13:21'),
(9, 1, '2023-05-22 23:21:07'),
(9, 2, '2023-05-23 10:07:11'),
(10, 1, '2023-05-28 19:28:48');