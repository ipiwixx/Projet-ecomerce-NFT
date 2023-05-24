<?php

/**
 * /model/Client.php
 * Définition de la class Client
 *
 * @author A. Espinoza
 * @date 05/2022
 */

class Client
{
    /*
     * Attributs
     */
    private int $id;
    private string $email;
    private ?string $ville;
    private ?string $aPostale;
    private string $pays;
    private string $nom;
    private string $prenom;
    private int $tel;
    private string $mdp;
    private ?int $cpt;
    private ?DateTime $dateNaissance;
    private string $role;

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
    public function getEmail(): string
    {
        return $this->email;
    }
    public function setEmail(string $email)
    {
        $this->email = $email;
    }
    public function getVille(): ?string
    {
        return $this->ville;
    }
    public function setVille(?string $ville)
    {
        $this->ville = $ville;
    }
    public function getAdressePostale(): ?string
    {
        return $this->aPostale;
    }
    public function setAdressePostale(?string $aPostale)
    {
        $this->aPostale = $aPostale;
    }
    public function getPays(): string
    {
        return $this->pays;
    }
    public function setPays(string $pays)
    {
        $this->pays = $pays;
    }
    public function getNom(): string
    {
        return $this->nom;
    }
    public function setNom(string $nom)
    {
        $this->nom = $nom;
    }
    public function getPrenom(): string
    {
        return $this->prenom;
    }
    public function setPrenom(string $prenom)
    {
        $this->prenom = $prenom;
    }
    public function getTel(): int
    {
        return $this->tel;
    }
    public function setTel(int $tel)
    {
        $this->tel = $tel;
    }
    public function getMdp(): string
    {
        return $this->mdp;
    }
    public function setMdp(string $mdp)
    {
        $this->mdp = $mdp;
    }
    public function getCpt(): ?int
    {
        return $this->cpt;
    }
    public function setCpt(?int $cpt)
    {
        $this->cpt = $cpt;
    }
    public function getDateNaissance(): ?DateTime
    {
        return $this->dateNaissance;
    }
    public function setDateNaissance(DateTime $dateNaissance)
    {
        $this->dateNaissance = $dateNaissance;
    }
    public function getRole(): string
    {
        return $this->role;
    }
    public function setRole(string $role)
    {
        $this->role = $role;
    }
}
