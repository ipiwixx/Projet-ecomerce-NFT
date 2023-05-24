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

    public function total()
    {
        $total = 0;
        $lesNfts = NftManager::getLesNftsPanier($_SESSION['id']);

        foreach ($lesNfts as $nft) {
            $total += $nft->getPrixVenteUht() * $nft->getQtePanier();
        }
        return $total / 2;
    }
}
