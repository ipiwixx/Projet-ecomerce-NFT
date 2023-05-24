<?php

/**
 * /model/Categorie.php
 * Définition de la class Categorie
 *
 * @author A. Espinoza
 * @date 05/2022
 */

class Categorie
{
    /*
     * Attributs
     */
    private int $id;
    private string $libelle;
    private string $refInterne;

    /*
     * Constructeur
     */
    public function __construct()
    {
    }

    /*
     * Accesseurs
     */
    public function getId(): int
    {
        return $this->id;
    }
    public function setId(int $id)
    {
        $this->id = $id;
    }
    public function getLibelle(): string
    {
        return $this->libelle;
    }
    public function setLibelle(string $libelle)
    {
        $this->libelle = $libelle;
    }
    public function getRefInterne(): string
    {
        return $this->refInterne;
    }
    public function setRefInterne(string $refInterne)
    {
        $this->refInterne = $refInterne;
    }

    /*
     * Méthodes
     */
}
