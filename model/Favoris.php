<?php

class Favoris
{

    /*
     * Attributs
     */
    private int $idProduit;
    private int $idClient;

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
    public function getIdClient(): int
    {
        return $this->idClient;
    }
    public function setIdClient(int $idClient)
    {
        $this->idClient = $idClient;
    }
}
