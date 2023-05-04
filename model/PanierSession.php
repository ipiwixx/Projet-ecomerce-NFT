<?php

/**
 * /model/PanierSession.php
 * 
 * Définition de la class Panier
 * Class qui gère les paniers session
 *
 * @author A. Espinoza
 * @date 06/2022
 */

 class PanierSession {
    
    private static ?\PDO $cnx = null;

    /**
     * updateQtePanier
     * recalcule la quantité panier 
     *
     * @return void
     */
    public function updateQtePanier(){
        foreach($_SESSION['panier'] as $product_id => $quantity){
            if(isset($_POST['panier']['quantity'][$product_id]))
            $_SESSION['panier'][$product_id] = $_POST['panier']['quantity'][$product_id];
            PanierManager::addQuantityPanier($_SESSION['panier'][$product_id], $_SESSION['id'], $_GET['qtePanier']);
        }
    }

    /**
     * getQtePanier
     * récupére la quantité total du panier
     *
     * @return int
     */
    public function getQtePanier(){
        return array_sum($_SESSION['panier']);
    }

    /**
     * getPrixTotalPanier
     * récupére le prix total du panier 
     *
     * @return float
     */
    public function getPrixTotalPanier(){
        $total = 0;
        $ids = array_keys($_SESSION['panier']);

        if(empty($ids)){
            $lesNfts = array();
        } else {
            $lesNfts = NftManager::getLesProduits($ids);
        }
        foreach($lesNfts as $nft) {
            $total += $nft->getPrixVenteUht() * $_SESSION['panier'][$nft->getId()];
        }
        return $total/2;
    }

    /**
     * addNftPanier
     * ajoute le Nft dans le panier
     * dont l'id est passé en paramètre 
     *
     * @param int
     * @return float
     */
    public function addNftPanier($product_id){
        if(isset($_SESSION['panier'][$product_id])){
            $_SESSION['panier'][$product_id]++;
        } else {
            $_SESSION['panier'][$product_id] = 1;
        }
    }

    /**
     * delNftPanier
     * supprime le Nft du panier 
     * dont l'id est passé en paramètre 
     *
     * @param int
     * @return void
     */
    public function delNftPanier($product_id){
        unset($_SESSION['panier'][$product_id]);
        NftManager::removeNftPanier($_GET['delPanier'], $_SESSION['id']);
    }

    /**
     * deletePanier
     * supprime le panier 
     *
     * @param int
     * @return void
     */
    public function deletePanierS(){
        unset($_SESSION['panier']);
    }
 }