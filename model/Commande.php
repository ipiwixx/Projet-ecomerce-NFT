<?php

/**
 * /model/Commande.php
 * Définition de la class Commande
 *
 * @author A. Espinoza
 * @date 05/2022
 */

class Commande {
    /*
     * Attributs
     */
    private int $id;
    private ?DateTime $dateCommande;
    private float $prixCmd;
    private int $nbArticle;
    
    /*
     * Constructeur
     */
    public function __construct(int $id = 0, ?DateTime $dateCommande = null, float $prixCmd = 0, int $nbArticle = 0) {
        $this->id = $id;
        $this->dateCommande = $dateCommande;
        $this->prixCmd = $prixCmd;
        $this->nbArticle = $nbArticle;
    }
    
    /*
     * Accesseurs
     */
    public function getId(): int {
        return $this->id;
    }
    public function setId(int $id) {
        $this->id = $id;
    }
    public function getDateCommande(): ?DateTime{
        return $this->dateCommande;
    }
    public function setDateCommande(?DateTime $dateCommande){
        $this->dateCommande = $dateCommande;
    }
    public function getPrixCmd(): float {
        return $this->prixCmd;
    }
    public function setPrixCmd(float $prixCmd) {
        $this->prixCmd = $prixCmd;
    }
    public function getNbArticle(): int {
        return $this->nbArticle;
    }
    public function setNbArticle(int $nbArticle) {
        $this->nbArticle = $nbArticle;
    }
    
    /*
     * Méthodes
     */
}
    
?>