<?php

/**
 * /model/Nft.php
 * Définition de la class Nft
 *
 * @author A. Espinoza
 * @date 05/2022
 */

class Nft
{
    /*
     * Attributs
     */
    private int $id;
    private string $refInterne;
    private string $libelle;
    private string $resume;
    private string $description;
    private string $pathPhoto;
    private int $qteStock;
    private float $prixVenteUht;
    private ?DateTime $datePublication;
    private ?int $seuilAlerte;
    private int $idCateg;
    private ?int $qteCmd;
    private ?int $qtePanier;
    private ?string $libelleCateg;

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
    public function getRefInterne(): string
    {
        return $this->refInterne;
    }
    public function setRefInterne(string $refInterne)
    {
        $this->refInterne = $refInterne;
    }
    public function getLibelle(): string
    {
        return $this->libelle;;
    }
    public function setLibelle(string $libelle)
    {
        $this->libelle = $libelle;
    }
    public function getResume(): string
    {
        return $this->resume;
    }
    public function setResume(string $resume)
    {
        $this->resume = $resume;
    }
    public function getDescription(): string
    {
        return $this->description;
    }
    public function setDescription(string $description)
    {
        $this->description = $description;
    }
    public function getPathPhoto(): string
    {
        return $this->pathPhoto;
    }
    public function setPathPhoto(string $pathPhoto)
    {
        $this->pathPhoto = $pathPhoto;
    }
    public function getQuantiteStock(): int
    {
        return $this->qteStock;
    }
    public function setQuantiteStock(int $qteStock)
    {
        $this->qteStock = $qteStock;
    }
    public function getPrixVenteUht(): float
    {
        return $this->prixVenteUht;
    }
    public function setPrixVenteUht(float $prixVenteUht)
    {
        $this->prixVenteUht = $prixVenteUht;
    }
    public function getDatePublication(): ?DateTime
    {
        return $this->datePublication;
    }
    public function setDatePublication(DateTime $datePublication)
    {
        $this->datePublication = $datePublication;
    }
    public function getSeuilAlerte(): ?int
    {
        return $this->seuilAlerte;
    }
    public function setSeuilAlerte(int $seuilAlerte)
    {
        $this->seuilAlerte = $seuilAlerte;
    }
    public function getIdCateg(): int
    {
        return $this->idCateg;
    }
    public function setIdCateg(int $idCateg)
    {
        $this->idCateg = $idCateg;
    }
    public function getQteCmd(): ?int
    {
        return $this->qteCmd;
    }
    public function setQteCmd(int $qteCmd)
    {
        $this->qteCmd = $qteCmd;
    }
    public function getQtePanier(): ?int
    {
        return $this->qtePanier;
    }
    public function setQtePanier(int $qtePanier)
    {
        $this->qtePanier = $qtePanier;
    }
    public function getLibelleCateg(): ?string
    {
        return $this->libelleCateg;
    }
    public function setLibelleCateg(string $libelleCateg)
    {
        $this->libelleCateg = $libelleCateg;
    }

    /*
     * Méthodes
     */
}
