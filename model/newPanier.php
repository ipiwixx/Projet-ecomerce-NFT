<?php 

/**
 * /model/Panier.php
 * Définition de la class Panier
 *
 * @author A. Espinoza
 * @date 06/2022
 */

class Panier {
    
    /*
     * Attributs
     */
    private int $idProduit;
    private int $idClient;
    private int $qte;
    protected array $panier;

    /*
     * Constructeur
     */
    public function __construct(){

    }

    /*
     * Accesseurs
     */
    public function getIdProduit(): int {
        return $this->idProduit;
    }
    public function setIdProduit(int $idProduit) {
        $this->idProduit = $idProduit;
    }
    public function getIdClient(): int{
        return $this->idClient;
    }
    public function setIdClient(int $idClient){
        $this->idClient = $idClient;
    }
    public function getQte(): int{
        return $this->qte;
    }
    public function setQte(int $qte){
        $this->qte = $qte;
    }
    public function getPanier(): array{
        return $this->panier;
    }
    public function setPanier(array $panier){
        $this->panier = $panier;
    }

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
        array_push($this->panier, [
                                    'nft' => $nft,
                                    'qte' => $qte
                                    ]);
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
        //Supprime le produit du tableau panier
        foreach($this->panier as $unP)
        {
            if($key = array_search($nft->getId(), $this->panier) !== false) {
                unset($this->panier[$key]);
            }
        }
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
        $this->panier = array();
    } 

    /**
     * GetNbrProduits
     * Retourne le nombre de produit dans le panier (sans prendre compte de la quantité)
     *
     * @return int
     */
    public function GetNbrProduits()
    {
        return count($this->panier);
    } 

    /**
     * GetNbrProduitsPanier
     * Retourne le nombre de produit dans le panier
     *
     * @return int
     */
    public function GetNbrProduitsPanier()
    {
        $total = 0;

        foreach($this->panier as $unP){

            $total += $unP['qte'];
        }

        return $total;    
    } 
}