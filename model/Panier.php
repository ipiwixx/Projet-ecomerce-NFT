<?php

/**
 * /model/Panier.php
 * Définition de la class Panier
 *
 * @author A. Espinoza
 * @date 06/2022
 */

class Panier
{

    /*
     * Attributs
     */
    private int $qte;
    private int $idProduit;
    protected array $panier;

    /*
     * Constructeur
     */
    public function __construct()
    {
    }

    /*
     * Accesseurs
     */
    public function getIdProduit(): int
    {
        return $this->idProduit;
    }
    public function setIdProduit(int $idProduit)
    {
        $this->idProduit = $idProduit;
    }
    public function getQte(): int
    {
        return $this->qte;
    }
    public function setQte(int $qte)
    {
        $this->qte = $qte;
    }

    /* public function recalc(){
        foreach($_SESSION['panier'] as $product_id => $quantity){
            if(isset($_POST['panier']['quantity'][$product_id]))
            $_SESSION['panier'][$product_id] = $_POST['panier']['quantity'][$product_id];
        }
    } */

    /* public function count(){
        return array_sum($_SESSION['panier']);
        $lesNfts = NftManager::getLesNftsPanier($_SESSION['id']);
        return array_sum($lesNfts); 
    } */

    public function total()
    {
        $total = 0;
        /* $ids = array_keys($_SESSION['panier']);

        if(empty($ids)){
            $lesNfts = array();
        } else {
            $lesNfts = NftManager::getLesProduits($ids);
        } */
        $lesNfts = NftManager::getLesNftsPanier($_SESSION['id']);

        foreach ($lesNfts as $nft) {
            $total += $nft->getPrixVenteUht() * $nft->getQtePanier();
        }
        return $total / 2;
    }

    /* public function add($product_id, $qtePanier){
        /* if(isset($_SESSION['panier'][$product_id])){
            $_SESSION['panier'][$product_id] = $qtePanier;
        } else {
            $_SESSION['panier'][$product_id] = 1;
        } */
    /*if(isset($_GET['qtePanier']) && isset($_GET['id']))
        {
            PanierManager::addQuantityPanier($_GET['id'], $_SESSION['id'], $_GET['qtePanier']);
        }
    } */

    /* public function del($product_id){
        //unset($_SESSION['panier'][$product_id]);
        PanierManager::removeNftPanier($_GET['delPanier'], $_SESSION['id']);
    } */
}
