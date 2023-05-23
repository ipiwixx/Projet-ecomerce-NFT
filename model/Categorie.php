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
    private string $ref_interne;

    /*
     * Constructeur
     */
    public function __construct(int $id = 0, string $libelle = '', string $ref_interne = '')
    {
        $this->id = $id;
        $this->libelle = $libelle;
        $this->ref_interne = $ref_interne;
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
        return $this->ref_interne;
    }
    public function setRefInterne(string $ref_interne)
    {
        $this->ref_interne = $ref_interne;
    }

    /*
     * Méthodes
     */
}
