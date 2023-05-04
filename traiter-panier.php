<?php
session_start();
/*
 * /traiter-panier.php
 * Page du traitement du panier
 * 
 * @auteur: Antoine Espinoza
 * @date: 05/2022
 */

    // inclut le fichier php de la connexion à la bdd
    require_once './bdd-pdo.php';

    try{
        $cnx = getBddConnexion();
    } 
    catch(PDOException $e) {
        die('Erreur : ' . $e->getMessage());
    }

    if(isset($_GET['id&panier=true']))
    {
        $sql = 'UPDATE ajouter SET panier = true';
        $sql .= ' WHERE idProduit = :id_produit;';
        $stmt = $cnx->prepare($sql);
        $stmt->bindParam(':id_produit', $id);
        $stmt->execute();
        $row = $stmt->rowCount();
        header('Location:./boutique.php');
    }
    else{
        $sql = 'UPDATE ajouter SET panier = false';
        $sql .= ' WHERE idProduit = :id_produit;';
        $stmt = $cnx->prepare($sql);
        $stmt->bindParam(':id_produit', $id);
        $stmt->execute();
        $row = $stmt->rowCount();
        header('Location:./boutique.php');
    }
?>
