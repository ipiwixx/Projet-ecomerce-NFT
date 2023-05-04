<?php

/*
 * /bdd‐pdo.php
 * code de connexion à la base de données
 * 
 * @auteur: Antoine Espinoza 
 * @date: 02/2021
 */

 // définition des constantes de connexion
 const HOST = '127.0.0.1'; // adresse IP de l'hôte 
 const PORT = '3307'; // port de connexion à MariaDB
 const DBNAME = 'db_ecommerce_site'; // nom de la bdd
 const CHARSET = 'utf8'; 
 const LOGIN = 'root'; // login pour la connexion
 const MDP = ''; // password pour la connexion
 
 function getBddConnexion(){
     
     $dsn = 'mysql:host='.HOST.';port='.PORT.';dbname='.DBNAME.';charset='.CHARSET;
     // var_dump('$dsn = '.$dsn);
     
     // se connecter à la base de données (2)
     try {
        $cnx = new PDO($dsn, LOGIN, MDP);
        $cnx->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        die('Échec lors de la connexion : ' . $e->getMessage());
    }
    return $cnx;
 }
?>