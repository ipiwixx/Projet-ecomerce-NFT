<?php

/**
 * /model/PanierSession.php
 * 
 * Définition de la session panier
 * Class qui gère la session panier
 *
 * @author A. Espinoza
 * @date 06/2022
 */

 class PanierSession extends Panier {

    /**
     * AddProduit
     * Ajoute un produit du panier session
     *
     * @param Nft
     * @param int
     * @return array
     */
    public function AddProduit(Nft $nft, int $qte)
    {
        parrent::AddProduit($nft, $qte);

        $_SESSION['panier'] = $this->panier;
    }

    /**
     * RemoveProduit
     * Supprime un produit du panier session
     *
     * @param Nft
     * @return void
     */
    public function RemoveProduit(Nft $nft)
    {
        parrent::RemoveProduit($nft);

        $_SESSION['panier'] = $this->panier;
    }

    /**
     * RemoveProduitAll
     * Supprime tous les produis du panier session
     *
     * @return void
     */
    public function RemoveProduitAll()
    {
        //Remet le panier à 0
        $_SESSION['panier'] = array();
    } 
}