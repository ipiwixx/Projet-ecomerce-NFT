<?php

/**
 * /model/NftManager.php
 * 
 * Définition de la class NftManager
 * Class qui gère les interactions entre les Nft de l'application
 *  et les Nft de la bdd
 *
 * @author A. Espinoza
 * @date 05/2022
 */

class NftManager {

    private static ?\PDO $cnx = null;
    private static Nft $unNft;
    private static array $lesNfts = array();
    
    /**
     * getLesNfts
     * récupère dans la bbd tous les nfts 
     *
     * @return array
     */
    public static function getLesNfts(): array
    {
        try{
            if(self::$cnx == null) {
                self::$cnx = DbManager::getConnexion();
            }

            // Récupère la page actuelle de la pagination
            $currentPage = (int)($_GET['page'] ?? 1);
            if($currentPage <= 0) {
                throw new Exception('Numéro de page invalide');
            }

            // Récupère le nombre de produit
            $count = (int)self::$cnx->query('SELECT COUNT(idProduit) FROM produit')->fetch(PDO::FETCH_NUM)[0];

            // Définit le nombre de produit à afficher par page
            $perPage = 16;
            $pages = ceil($count / $perPage);

            // Définit un offset
            $offset = $perPage * ($currentPage - 1);

            // Requête select qui récupère toutes les informations de tous les nfts
            $sql = "SELECT idProduit, ref_interne, libelleP, resumeP, descriptionP, pathPhoto, qte_stock, prix_vente_uht, datePublication, seuilAlerte";
            $sql .= " FROM produit LIMIT $perPage OFFSET $offset;";
            $stmt = self::$cnx->prepare($sql);
            $stmt->execute();
            
            $stmt->setFetchMode(PDO::FETCH_OBJ);
            while($row = $stmt->fetch()) {
                self::$unNft = new Nft();
                self::$unNft->setId($row->idProduit);
                self::$unNft->setRefInterne($row->ref_interne);
                self::$unNft->setLibelle($row->libelleP);
                self::$unNft->setResume($row->resumeP);
                self::$unNft->setDescription($row->descriptionP);
                self::$unNft->setPathPhoto($row->pathPhoto);
                self::$unNft->setQuantiteStock($row->qte_stock);
                self::$unNft->setPrixVenteUht($row->prix_vente_uht);
                $laDatePublication = new DateTime($row->datePublication);
                self::$unNft->setDatePublication($laDatePublication);
                self::$unNft->setSeuilAlerte($row->seuilAlerte);
                self::$lesNfts[] = self::$unNft;
            }
            
            return self::$lesNfts;
        } catch (PDOException $e) {
            die('Erreur : '. $e->getMessage());
        }       
    }

    /**
     * getLesNftsDash
     * récupère dans la bbd tous les nfts 
     *
     * @return array
     */
    public static function getLesNftsDash(): array
    {
        try{
            if(self::$cnx == null) {
                self::$cnx = DbManager::getConnexion();
            }

            // Requête select qui récupère toutes les informations de tous les nfts
            $sql = "SELECT idProduit, P.ref_interne, libelleP, resumeP, descriptionP, pathPhoto, qte_stock, prix_vente_uht, datePublication, seuilAlerte, libelleCategorie";
            $sql .= " FROM produit P";
            $sql .= " JOIN categorie C on C.numCategorie = P.idCategorie;";
            $stmt = self::$cnx->prepare($sql);
            $stmt->execute();
            
            $stmt->setFetchMode(PDO::FETCH_OBJ);
            while($row = $stmt->fetch()) {
                self::$unNft = new Nft();
                self::$unNft->setId($row->idProduit);
                self::$unNft->setRefInterne($row->ref_interne);
                self::$unNft->setLibelle($row->libelleP);
                self::$unNft->setResume($row->resumeP);
                self::$unNft->setDescription($row->descriptionP);
                self::$unNft->setPathPhoto($row->pathPhoto);
                self::$unNft->setQuantiteStock($row->qte_stock);
                self::$unNft->setPrixVenteUht($row->prix_vente_uht);
                $laDatePublication = new DateTime($row->datePublication);
                self::$unNft->setDatePublication($laDatePublication);
                self::$unNft->setSeuilAlerte($row->seuilAlerte);
                self::$unNft->setLibelleCateg($row->libelleCategorie);
                self::$lesNfts[] = self::$unNft;
            }
            
            return self::$lesNfts;
        } catch (PDOException $e) {
            die('Erreur : '. $e->getMessage());
        }       
    }

    /**
     * getLesNftsByCategDash
     * récupère dans la bbd tous les nfts
     * avec la catégorie en paramètre
     *
     * @param int
     * @return array
     */
    public static function getLesNftsByCategDash(int $idCateg): array
    {
        try{
            if(self::$cnx == null) {
                self::$cnx = DbManager::getConnexion();
            }

            // Requête select qui récupère toutes les informations de tous les nfts
            $sql = "SELECT idProduit, P.ref_interne, libelleP, resumeP, descriptionP, pathPhoto, qte_stock, prix_vente_uht, datePublication, seuilAlerte, libelleCategorie";
            $sql .= " FROM produit P";
            $sql .= " JOIN categorie C on C.numCategorie = P.idCategorie";
            $sql .= " WHERE idCategorie = :idC;";
            $stmt = self::$cnx->prepare($sql);
            $stmt->bindParam(':idC', $idCateg, PDO::PARAM_INT);
            $stmt->execute();
            
            $stmt->setFetchMode(PDO::FETCH_OBJ);
            while($row = $stmt->fetch()) {
                self::$unNft = new Nft();
                self::$unNft->setId($row->idProduit);
                self::$unNft->setRefInterne($row->ref_interne);
                self::$unNft->setLibelle($row->libelleP);
                self::$unNft->setResume($row->resumeP);
                self::$unNft->setDescription($row->descriptionP);
                self::$unNft->setPathPhoto($row->pathPhoto);
                self::$unNft->setQuantiteStock($row->qte_stock);
                self::$unNft->setPrixVenteUht($row->prix_vente_uht);
                $laDatePublication = new DateTime($row->datePublication);
                self::$unNft->setDatePublication($laDatePublication);
                self::$unNft->setSeuilAlerte($row->seuilAlerte);
                self::$unNft->setLibelleCateg($row->libelleCategorie);
                self::$lesNfts[] = self::$unNft;
            }
            
            return self::$lesNfts;
        } catch (PDOException $e) {
            die('Erreur : '. $e->getMessage());
        }       
    }

    /**
     * getLesProduits
     * récupère dans la bbd tous les produits 
     * avec les ids passé en paramètre
     *
     * @param array
     * @return array
     */
    public static function getLesProduits(array $id): array
    {
        try{
            if(self::$cnx == null) {
                self::$cnx = DbManager::getConnexion();
            }

            // Requête select qui récupère toutes les informations des nfts
            $sql = "SELECT idProduit, ref_interne, libelleP, resumeP, descriptionP, pathPhoto, qte_stock, prix_vente_uht, datePublication, seuilAlerte";
            $sql .= " FROM produit";
            $sql .= ' WHERE idProduit IN ('.implode(',',$id).')';
            $stmt = self::$cnx->prepare($sql);
            $stmt->execute();
            
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            while($row = $stmt->fetch()) {

                self::$unNft = new Nft();
                self::$unNft->setId($row['idProduit']);
                self::$unNft->setRefInterne($row['ref_interne']);
                self::$unNft->setLibelle($row['libelleP']);
                self::$unNft->setResume($row['resumeP']);
                self::$unNft->setDescription($row['descriptionP']);
                self::$unNft->setPathPhoto($row['pathPhoto']);
                self::$unNft->setQuantiteStock($row['qte_stock']);
                self::$unNft->setPrixVenteUht($row['prix_vente_uht']);
                $laDatePublication = new DateTime($row['datePublication']);
                self::$unNft->setDatePublication($laDatePublication);
                self::$unNft->setSeuilAlerte($row['seuilAlerte']);
                self::$lesNfts[] = self::$unNft;

            }
            return self::$lesNfts;
        } catch (PDOException $e) {
            die('Erreur : '. $e->getMessage());
        }       
    }

    /**
     * getLesNftsPanier
     * récupère dans la bbd tous les nfts 
     * qui sont ajouté au panier
     *
     * @param int
     * @return array
     */
    public static function getLesNftsPanier(int $idClient): array
    {
        try{
            if(self::$cnx == null) {
                self::$cnx = DbManager::getConnexion();
            }

            // Requête select qui récupère toutes les informations des nfts du panier du client
            $sql = 'SELECT P.idProduit, ref_interne, libelleP, resumeP, descriptionP, pathPhoto, qte_stock, prix_vente_uht, datePublication, seuilAlerte, qtePanier';
            $sql .= ' FROM produit P';
            $sql .= ' JOIN panier PA on PA.idProduit = P.idProduit';
            $sql .= ' WHERE idClient = :idClient AND EXISTS (SELECT idProduit FROM panier PA';
            $sql .= ' WHERE P.idProduit = PA.idProduit);';
            $stmt = self::$cnx->prepare($sql);
            $stmt->bindParam(':idClient', $idClient, PDO::PARAM_INT);
            $stmt->execute();
            
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            while($row = $stmt->fetch()) {

                self::$unNft = new Nft();
                self::$unNft->setId($row['idProduit']);
                self::$unNft->setRefInterne($row['ref_interne']);
                self::$unNft->setLibelle($row['libelleP']);
                self::$unNft->setResume($row['resumeP']);
                self::$unNft->setDescription($row['descriptionP']);
                self::$unNft->setPathPhoto($row['pathPhoto']);
                self::$unNft->setQuantiteStock($row['qte_stock']);
                self::$unNft->setPrixVenteUht($row['prix_vente_uht']);
                $laDatePublication = new DateTime($row['datePublication']);
                self::$unNft->setDatePublication($laDatePublication);
                self::$unNft->setSeuilAlerte($row['seuilAlerte']);
                self::$unNft->setQtePanier($row['qtePanier']);

                self::$lesNfts[] = self::$unNft;

            }
            return self::$lesNfts;
        } catch (PDOException $e) {
            die('Erreur : '. $e->getMessage());
        }       
    }

    /**
     * getLePanier
     * récupère dans la bbd le panier
     *
     * @param int
     * @return Panier
     */
   /*  public static function getLePanier(int $idClient): Panier
    {
        try{
            if(self::$cnx == null) {
                self::$cnx = DbManager::getConnexion();
            }

            // Requête select qui récupère toutes les informations des nfts du panier du client
            $sql = 'SELECT P.idProduit, ref_interne, libelleP, resumeP, descriptionP, pathPhoto, qte_stock, prix_vente_uht, datePublication, seuilAlerte, qtePanier';
            $sql .= ' FROM produit P';
            $sql .= ' JOIN panier PA on PA.idProduit = P.idProduit';
            $sql .= ' WHERE idClient = :idClient AND EXISTS (SELECT idProduit FROM panier PA';
            $sql .= ' WHERE P.idProduit = PA.idProduit);';
            $stmt = self::$cnx->prepare($sql);
            $stmt->bindParam(':idClient', $idClient, PDO::PARAM_INT);
            $stmt->execute();
            
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            while($row = $stmt->fetch()) {

                self::$unNft = new Nft();
                self::$unNft->setId($row['idProduit']);
                self::$unNft->setRefInterne($row['ref_interne']);
                self::$unNft->setLibelle($row['libelleP']);
                self::$unNft->setResume($row['resumeP']);
                self::$unNft->setDescription($row['descriptionP']);
                self::$unNft->setPathPhoto($row['pathPhoto']);
                self::$unNft->setQuantiteStock($row['qte_stock']);
                self::$unNft->setPrixVenteUht($row['prix_vente_uht']);
                $laDatePublication = new DateTime($row['datePublication']);
                self::$unNft->setDatePublication($laDatePublication);
                self::$unNft->setSeuilAlerte($row['seuilAlerte']);
                self::$unNft->getQtePanier($row['qtePanier']);

                self::$lesNfts[] = self::$unNft;

                $panier = new Panier();
                $panier->AddProduit(self::$unNft, 0);

            }
            return $panier;
        } catch (PDOException $e) {
            die('Erreur : '. $e->getMessage());
        }       
    } */
    
    /**
     * getLesNftsFavoris
     * récupère dans la bbd tous les nfts 
     * qui sont ajouté au favoris
     *
     * @return array
     */
    public static function getLesNftsFavoris(): array
    {
        try{
            if(self::$cnx == null) {
                self::$cnx = DbManager::getConnexion();
            }

            // Requête select qui récupère toutes les informations des nfts en favoris du client
            $sql = 'SELECT idProduit, ref_interne, libelleP, resumeP, descriptionP, pathPhoto, qte_stock, prix_vente_uht, datePublication, seuilAlerte';
            $sql .= ' FROM produit P';
            $sql .= ' WHERE EXISTS (SELECT idProduit FROM favoris F';
            $sql .= ' WHERE P.idProduit = F.idProduit and idClient = :idClient);';
            $stmt = self::$cnx->prepare($sql);
            $stmt->bindParam(':idClient', $_SESSION['id'], PDO::PARAM_INT);
            $stmt->execute();
            
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            while($row = $stmt->fetch()) {

                self::$unNft = new Nft();
                self::$unNft->setId($row['idProduit']);
                self::$unNft->setRefInterne($row['ref_interne']);
                self::$unNft->setLibelle($row['libelleP']);
                self::$unNft->setResume($row['resumeP']);
                self::$unNft->setDescription($row['descriptionP']);
                self::$unNft->setPathPhoto($row['pathPhoto']);
                self::$unNft->setQuantiteStock($row['qte_stock']);
                self::$unNft->setPrixVenteUht($row['prix_vente_uht']);
                $laDatePublication = new DateTime($row['datePublication']);
                self::$unNft->setDatePublication($laDatePublication);
                self::$unNft->setSeuilAlerte($row['seuilAlerte']);
                self::$lesNfts[] = self::$unNft;

            }
            return self::$lesNfts;
        } catch (PDOException $e) {
            die('Erreur : '. $e->getMessage());
        }       
    }

    /**
     * getLesNftsBySearch
     * récupère dans la bbd tous les nfts 
     * par rapport à la recherche
     *
     * @param string
     * @return array
     */
    public static function getLesNftsBySearch(string $recherche): array
    {
        try{
            if(self::$cnx == null) {
                self::$cnx = DbManager::getConnexion();
            }

            // Récupère la page actuelle de la pagination
            $currentPage = (int)($_GET['page'] ?? 1);
            if($currentPage <= 0) {
                throw new Exception('Numéro de page invalide');
            }

            // Récupère le nombre de produit
            $count = (int)self::$cnx->query('SELECT COUNT(idProduit) FROM produit WHERE libelleP like "%'.$recherche.'%"')->fetch(PDO::FETCH_NUM)[0];

            // Définit le nombre de produit à afficher par page
            $perPage = 16;
            $pages = ceil($count / $perPage);

            // Définit un offset
            $offset = $perPage * ($currentPage - 1);

            // Requête select qui récupère toutes les informations de la recherche du client
            $sql = 'SELECT idProduit, ref_interne, libelleP, resumeP, descriptionP, pathPhoto, qte_stock, prix_vente_uht, datePublication, seuilAlerte';
            $sql .= ' FROM produit';
            $sql .= ' WHERE libelleP LIKE :recherche LIMIT :perPage OFFSET :offset';
            $search = '%'.$recherche.'%';
            $stmt = self::$cnx->prepare($sql);
            $stmt->bindParam(':recherche', $search, PDO::PARAM_STR);
            $stmt->bindParam(':perPage', $perPage, PDO::PARAM_INT);
            $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
            $stmt->execute();
                
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            while($row = $stmt->fetch()) {
                self::$unNft = new Nft();
                self::$unNft->setId($row['idProduit']);
                self::$unNft->setRefInterne($row['ref_interne']);
                self::$unNft->setLibelle($row['libelleP']);
                self::$unNft->setResume($row['resumeP']);
                self::$unNft->setDescription($row['descriptionP']);
                self::$unNft->setPathPhoto($row['pathPhoto']);
                self::$unNft->setQuantiteStock($row['qte_stock']);
                self::$unNft->setPrixVenteUht($row['prix_vente_uht']);
                $laDatePublication = new DateTime($row['datePublication']);
                self::$unNft->setDatePublication($laDatePublication);
                self::$unNft->setSeuilAlerte($row['seuilAlerte']);
                self::$lesNfts[] = self::$unNft;

                }   

            return self::$lesNfts;
        } catch (PDOException $e) {
            die('Erreur : '. $e->getMessage());
        }       
    }

    /**
     * getUnNftById
     * récupère dans la bbd un produit
     * avec l'id passé en paramètre
     * 
     * @param int
     * @return Nft
     */
    public static function getUnNftById(int $identifier): Nft
    {
        try{
            if(self::$cnx == null) {
                self::$cnx = DbManager::getConnexion();
            }

            // Requête select qui récupère toutes les informations du nft
            $sql = 'SELECT idProduit, P.ref_interne, libelleP, resumeP, descriptionP, pathPhoto, qte_stock, prix_vente_uht, datePublication, seuilAlerte, idCategorie, libelleCategorie';
            $sql .= ' FROM produit P';
            $sql .= ' JOIN categorie C on C.numCategorie = P.idCategorie';
            $sql .= ' WHERE idProduit = :idProduit;';
            $stmt = self::$cnx->prepare($sql);
            $stmt->bindParam(':idProduit', $identifier, PDO::PARAM_INT);
            $stmt->execute();
            
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $row = $stmt->fetch(); 
            $unNft = new Nft();
            $unNft->setId($row['idProduit']);
            $unNft->setRefInterne($row['ref_interne']);
            $unNft->setLibelle($row['libelleP']);
            $unNft->setResume($row['resumeP']);
            $unNft->setDescription($row['descriptionP']);
            $unNft->setPathPhoto($row['pathPhoto']);
            $unNft->setQuantiteStock($row['qte_stock']);
            $unNft->setPrixVenteUht($row['prix_vente_uht']);
            $laDatePublication = new DateTime($row['datePublication']);
            $unNft->setDatePublication($laDatePublication);
            $unNft->setSeuilAlerte($row['seuilAlerte']);
            $unNft->setIdCateg($row['idCategorie']);
            $unNft->setLibelleCateg($row['libelleCategorie']);

            return $unNft;
        } catch (PDOException $e) {
            die('Erreur : '. $e->getMessage());
        }       
    }

    /**
     * getUnNftByIdPanier
     * récupère dans la bbd un produit
     * avec l'id passé en paramètre
     * 
     * @param int
     * @return Nft
     */
    public static function getUnNftByIdPanier(int $identifier): Nft
    {
        try{
            if(self::$cnx == null) {
                self::$cnx = DbManager::getConnexion();
            }

            // Requête select qui récupère la quantite du panier du produit
            $sql = 'SELECT qtePanier, qte_stock';
            $sql .= ' FROM panier P';
            $sql .= ' JOIN produit PO on PO.idProduit = P.idProduit';
            $sql .= ' WHERE P.idProduit = :idProduit and idClient = :idClient;';
            $stmt = self::$cnx->prepare($sql);
            $stmt->bindParam(':idProduit', $identifier, PDO::PARAM_INT);
            $stmt->bindParam(':idClient', $_SESSION['id'], PDO::PARAM_INT);
            $stmt->execute();
            
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $row = $stmt->fetch(); 
            $unNft = new Nft();
            $unNft->setQtePanier($row['qtePanier']);
            $unNft->setQuantiteStock($row['qte_stock']);

            return $unNft;
        } catch (PDOException $e) {
            die('Erreur : '. $e->getMessage());
        }       
    }

    /**
     * getUnNftById
     * récupère dans la bbd un produit
     * avec l'id passé en paramètre
     * 
     * @param int
     * @return array
     */
    public static function getNftById(int $identifier): array
    {
        try{
            if(self::$cnx == null) {
                self::$cnx = DbManager::getConnexion();
            }

            // Requête select qui récupère toutes les informations du nft
            $sql = 'SELECT idProduit, ref_interne, libelleP, resumeP, descriptionP, pathPhoto, qte_stock, prix_vente_uht, datePublication, seuilAlerte';
            $sql .= ' FROM produit';
            $sql .= ' WHERE idProduit = :idProduit';
            $stmt = self::$cnx->prepare($sql);
            $stmt->bindParam(':idProduit', $identifier, PDO::PARAM_INT);
            $stmt->execute();
            
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $row = $stmt->fetch();
            self::$unNft = new Nft();
            self::$unNft->setId($row['idProduit']);
            self::$unNft->setRefInterne($row['ref_interne']);
            self::$unNft->setLibelle($row['libelleP']);
            self::$unNft->setResume($row['resumeP']);
            self::$unNft->setDescription($row['descriptionP']);
            self::$unNft->setPathPhoto($row['pathPhoto']);
            self::$unNft->setQuantiteStock($row['qte_stock']);
            self::$unNft->setPrixVenteUht($row['prix_vente_uht']);
            $laDatePublication = new DateTime($row['datePublication']);
            self::$unNft->setDatePublication($laDatePublication);
            self::$unNft->setSeuilAlerte($row['seuilAlerte']);
            self::$lesNfts[] = self::$unNft;
            
            return self::$lesNfts;
        } catch (PDOException $e) {
            die('Erreur : '. $e->getMessage());
        }       
    }

    /**
     * getLeNombreDePage
     * récupère le nombre de page
     *
     * @return int
     */
    public static function getLeNombreDePage()
    {
        try{
            if(self::$cnx == null) {
                self::$cnx = DbManager::getConnexion();
            }
            
            // Récupère le nombre de produit
            $count = (int)self::$cnx->query('SELECT COUNT(idProduit) FROM produit')->fetch(PDO::FETCH_NUM)[0];

            // Définit le nombre de page
            $pages = ceil($count / 16);

            return $pages;
        } catch (PDOException $e) {
            die('Erreur : '. $e->getMessage());
        }       
    }

    /**
     * getLeNombreDePageSearch
     * récupère le nombre de page d'une recherche
     *
     * @param string
     * @return int
     */
    public static function getLeNombreDePageSearch(string $recherche)
    {
        try{

            // Récupère le nombre de produit
            $count = (int)self::$cnx->query('SELECT COUNT(idProduit) FROM produit WHERE libelleP like "%'.$recherche.'%"')->fetch(PDO::FETCH_NUM)[0];

            // Définit le nombre de page
            $pages = ceil($count / 16);

            return $pages;
        } catch (PDOException $e) {
            die('Erreur : '. $e->getMessage());
        } 
    }

    /**
     * getLeNombreDePageFiltre
     * récupère le nombre de page pour un filtre
     *
     * @param string
     * @param string
     * @param string
     * @return int
     */
    public static function getLeNombreDePageFiltre(string $filtreCateg, string $filtrePrix, string $filtreDate)
    {
        try{
            // Vérifie que le filtre categ soit pas vide
            if(!empty($filtreCateg)) {

                // Récupère le nombre de produit de la catégorie
                $count = (int)self::$cnx->query("SELECT COUNT(idProduit) FROM produit P JOIN categorie C on C.numCategorie = P.idCategorie WHERE C.ref_interne = '$filtreCateg'")->fetch(PDO::FETCH_NUM)[0];
            
            // Vérifie que le filtre prix soit pas vide
            } else if(!empty($filtrePrix)) {
                
                // Récupère le nombre de produit
                $count = (int)self::$cnx->query("SELECT COUNT(idProduit) FROM produit ORDER BY prix_vente_uht $filtrePrix")->fetch(PDO::FETCH_NUM)[0];
            
            // Vérifie que le filtre date soit pas vide
            } else if(!empty($filtreDate)) {

                // Récupère le nombre de produit
                $count = (int)self::$cnx->query("SELECT COUNT(idProduit) FROM produit ORDER BY datePublication $filtreDate")->fetch(PDO::FETCH_NUM)[0];
            }

            // Définit le nombre de page
            $pages = ceil($count / 16);

            return $pages;
        } catch (PDOException $e) {
            die('Erreur : '. $e->getMessage());
        } 
    }

    /**
     * getQteCmdProduitById
     * récupère la quantité de produit commander
     * avec l'id passé en paramètre
     * 
     * @param int
     * @return int
     */
   /*  public static function getQteCmdProduitById(int $identifier)
    {
        try{
            if(self::$cnx == null) {
                self::$cnx = DbManager::getConnexion();
            }

            // Requête select qui récupère la quantite commander d'un produit
            $sql = 'SELECT qte';
            $sql .= ' FROM commande CO';
            $sql .= ' JOIN commander C on C.idCmd = CO.idCmd';
            $sql .= ' JOIN produit P on P.idProduit = C.idProduit';
            $sql .= ' WHERE idProduit = :idProduit and idClient = :idClient';
            $stmt = self::$cnx->prepare($sql);
            $stmt->bindParam(':idProduit', $identifier, PDO::PARAM_INT);
            $stmt->bindParam(':idClient', $_SESSION['id'], PDO::PARAM_INT);
            $stmt->execute();
            
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $row = $stmt->fetch(); 
            $unNft->setId($row['qte']);
            

            return $unNft;
        } catch (PDOException $e) {
            die('Erreur : '. $e->getMessage());
        }       
    } */

    /**
     * getLesNftsCmd
     * récupère dans la bbd tous les nfts 
     * qui ont éte commandé par l'utilisateur
     *
     * @param int
     * @return array
     */
    public static function getLesNftsCmd(int $idCmd): array
    {
        try{
            if(self::$cnx == null) {
                self::$cnx = DbManager::getConnexion();
            }

            // Requête select qui récupère toutes les informations des nfts commander
            $sql = 'SELECT P.idProduit, ref_interne, libelleP, resumeP, descriptionP, pathPhoto, qte_stock, prix_vente_uht, datePublication, seuilAlerte, qte';
            $sql .= ' FROM produit P';
            $sql .= ' JOIN commander C on C.idProduit = P.idProduit';
            $sql .= ' WHERE idCmd = :idCmd;';
            $stmt = self::$cnx->prepare($sql);
            $stmt->bindParam(':idCmd', $idCmd, PDO::PARAM_INT);
            $stmt->execute();
            
            self::$lesNfts = array();
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            while($row = $stmt->fetch()) {

                self::$unNft = new Nft();
                self::$unNft->setId($row['idProduit']);
                self::$unNft->setRefInterne($row['ref_interne']);
                self::$unNft->setLibelle($row['libelleP']);
                self::$unNft->setResume($row['resumeP']);
                self::$unNft->setDescription($row['descriptionP']);
                self::$unNft->setPathPhoto($row['pathPhoto']);
                self::$unNft->setQuantiteStock($row['qte_stock']);
                self::$unNft->setPrixVenteUht($row['prix_vente_uht']);
                $laDatePublication = new DateTime($row['datePublication']);
                self::$unNft->setDatePublication($laDatePublication);
                self::$unNft->setSeuilAlerte($row['seuilAlerte']);
                self::$unNft->setQteCmd($row['qte']);
                self::$lesNfts[] = self::$unNft;

            }
            return self::$lesNfts;
        } catch (PDOException $e) {
            die('Erreur : '. $e->getMessage());
        }       
    }
    
    /**
     * getLesNftsFiltre
     * récupère dans la bbd tous les nfts 
     * selon les paramètres
     *
     * @param string $filtreCateg
     * @param string $filtrePrix
     * @param string $filtreDate
     * @return array
     */
    public static function getLesNftsFiltre(string $filtreCateg, string $filtrePrix, string $filtreDate): array
    {
        try{
            if(self::$cnx == null) {
                self::$cnx = DbManager::getConnexion();
            }
            $currentPage = (int)($_GET['page'] ?? 1);
            if($currentPage <= 0) {
                throw new Exception('Numéro de page invalide');
            }

            // Récupère le nombre de produit
            $count = (int)self::$cnx->query('SELECT COUNT(idProduit) FROM produit')->fetch(PDO::FETCH_NUM)[0];

            // Définit le nombre de produit à afficher par page
            $perPage = 16;
            $pages = ceil($count / $perPage);

            // Définit un offset
            $offset = $perPage * ($currentPage - 1);

            // Requête select qui récupère toutes les informations des nfts
            $sql = 'SELECT idProduit, P.ref_interne, libelleP, resumeP, descriptionP, pathPhoto, qte_stock, prix_vente_uht, datePublication, seuilAlerte';
            $sql .= ' FROM produit P';
            $sql .= ' JOIN categorie C on C.numCategorie = P.idCategorie';
            if (!empty($filtreCateg)) {
                $sql .= " WHERE C.ref_interne = '$filtreCateg'";
            }
            if($filtreDate == 'ASC') {
                $sql .= ' ORDER BY datePublication ASC';
            } elseif($filtreDate == 'DESC'){
                $sql .= ' ORDER BY datePublication DESC';
            } elseif($filtrePrix == 'ASC') {
                $sql .= ' ORDER BY prix_vente_uht ASC';
            } elseif($filtrePrix == 'DESC') {
                $sql .= ' ORDER BY prix_vente_uht DESC';
            }
            //if($offset > 0 ) {
               $sql .= " LIMIT $perPage OFFSET $offset"; 
            //}
            
            $stmt = self::$cnx->prepare($sql);
            $stmt->execute();           
            
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            while($row = $stmt->fetch()) {

                self::$unNft = new Nft();
                self::$unNft->setId($row['idProduit']);
                self::$unNft->setRefInterne($row['ref_interne']);
                self::$unNft->setLibelle($row['libelleP']);
                self::$unNft->setResume($row['resumeP']);
                self::$unNft->setDescription($row['descriptionP']);
                self::$unNft->setPathPhoto($row['pathPhoto']);
                self::$unNft->setQuantiteStock($row['qte_stock']);
                self::$unNft->setPrixVenteUht($row['prix_vente_uht']);
                $laDatePublication = new DateTime($row['datePublication']);
                self::$unNft->setDatePublication($laDatePublication);
                self::$unNft->setSeuilAlerte($row['seuilAlerte']);
                self::$lesNfts[] = self::$unNft;
            }
            return self::$lesNfts;
            
        } catch (PDOException $e) {
            die('Erreur : '. $e->getMessage());
        }       
    }

    /**
     * existNft
     * vérifie si le nft existe
     *
     * @param int
     * @return bool
     */
    public static function existNft(int $idProduit): bool
    {
        try{
            if(self::$cnx == null) {
                self::$cnx = DbManager::getConnexion();
            }
            $exist = false;
            
            // Requête select qui récupère toutes les informations du produit
            $sql = 'SELECT idProduit, ref_interne, libelleP, resumeP, descriptionP, pathPhoto, qte_stock, prix_vente_uht, datePublication, seuilAlerte'; 
            $sql .= ' FROM produit';
            $sql .= ' WHERE idProduit = :idProduit';
            $stmt = self::$cnx->prepare($sql);
            $stmt->bindParam(':idProduit', $idProduit, PDO::PARAM_INT);
            $stmt->execute();
            $row = $stmt->rowCount();

            // Le nft existe
            if($row == 1) {
                $exist = true;
            }

            return $exist;
        } catch (PDOException $e) {
            die('Erreur : '. $e->getMessage());
        }       
    }

    /**
     * deleteNft
     * supprime le nft avec l'id passé en paramètre
     *
     * @param int
     * @return void
     */
    public static function deleteNft(int $idProduit): void
    {
        try{
            if(self::$cnx == null) {
                self::$cnx = DbManager::getConnexion();
            }

            // Requête delete qui supprime le produit des commandes
            $sql = 'DELETE FROM commander';
            $sql .= ' WHERE idProduit = :idP;';
            $stmt = self::$cnx->prepare($sql);
            $stmt->bindParam(':idP', $idProduit, PDO::PARAM_INT);
            $stmt->execute();

            // Requête delete qui supprime le produit des paniers
            $sql = 'DELETE FROM panier';
            $sql .= ' WHERE idProduit = :idP;';
            $stmt = self::$cnx->prepare($sql);
            $stmt->bindParam(':idP', $idProduit, PDO::PARAM_INT);
            $stmt->execute();

            // Requête delete qui supprime le produit des favoris
            $sql = 'DELETE FROM favoris';
            $sql .= ' WHERE idProduit = :idP;';
            $stmt = self::$cnx->prepare($sql);
            $stmt->bindParam(':idP', $idProduit, PDO::PARAM_INT);
            $stmt->execute();

            // Requête select qui récupère le path du produit
            $sql = 'SELECT pathPhoto';
            $sql .= ' FROM produit';
            $sql .= ' WHERE idProduit = :idP;';
            $stmt = self::$cnx->prepare($sql);
            $stmt->bindParam(':idP', $idProduit, PDO::PARAM_INT);
            $stmt->execute();

            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $row = $stmt->fetch();

            // Suppression de l'image
            unlink($row['pathPhoto']);


            // Requête delete qui supprime le produit
            $sql = 'DELETE FROM produit';
            $sql .= ' WHERE idProduit = :idP;';
            $stmt = self::$cnx->prepare($sql);
            $stmt->bindParam(':idP', $idProduit, PDO::PARAM_INT);
            $stmt->execute();    
            
        } catch (PDOException $e) {
            die('Erreur : '. $e->getMessage());
        }       
    }

    /**
     * addNft
     * ajoute le nft avec les valeurs saisies en paramètre
     *
     * @param string
     * @param string
     * @param string
     * @param string
     * @param int
     * @param float
     * @param int
     * @return void
     */
    public static function addNft(string $refInterne, string $libelle, string $resume, string $description, int $qteStock, float $prix, int $categorie): void
    {
        try{
            if(self::$cnx == null) {
                self::$cnx = DbManager::getConnexion();
            }

            // Récupère la date d'aujourd'hui
            date_default_timezone_set('Europe/Paris');
            $dateP = new DateTime();
            $dateP = $dateP->format('Y-m-d');

            $seuilAlerte = 0;

            // Requête select qui récupère l'id du dernier produit
            $sql = 'SELECT MAX(idProduit) AS idP FROM produit';
            $stmt = self::$cnx->prepare($sql);
            $stmt->execute();

            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $row = $stmt->fetch();
            $idProduit = $row['idP'];
            $idProduit += 1;

            // Récupère l'extension du cv
            $extension_upload = strtolower(  substr(  strrchr($_FILES['path']['name'], '.')  ,1)  );

            // Créer le lien vers l'image du produit
            $path = "img/boutique/b{$idProduit}.{$extension_upload}";

            // Déplace l'image de temp vers le dossier "img/boutique/"
            $résultat = move_uploaded_file($_FILES['path']['tmp_name'],$path);

            // Requête insert qui insère un nouveau produit
            $sql = 'INSERT INTO `produit` (`ref_interne`, `libelleP`, `resumeP`, `descriptionP`, `pathPhoto`, `qte_stock`, `prix_vente_uht`, `datePublication`, `seuilAlerte`, `idCategorie`) VALUES';
            $sql .= ' (:refInterne, :libelle, :resume, :description, :pathPhoto, :qteStock, :prix, :dateP, :seuilAlerte, :idC);';
            $stmt = self::$cnx->prepare($sql);
            $stmt->bindParam(':refInterne', $refInterne, PDO::PARAM_STR);
            $stmt->bindParam(':libelle', $libelle, PDO::PARAM_STR);
            $stmt->bindParam(':resume', $resume, PDO::PARAM_STR);
            $stmt->bindParam(':description', $description, PDO::PARAM_STR);
            $stmt->bindParam(':pathPhoto', $path, PDO::PARAM_STR);
            $stmt->bindParam(':qteStock', $qteStock, PDO::PARAM_INT);
            $stmt->bindParam(':prix', $prix, PDO::PARAM_STR);
            $stmt->bindParam(':dateP', $dateP, PDO::PARAM_STR);
            $stmt->bindParam(':seuilAlerte', $seuilAlerte, PDO::PARAM_INT);
            $stmt->bindParam(':idC', $categorie, PDO::PARAM_INT);
            $stmt->execute();

        } catch (PDOException $e) {
            die('Erreur : '. $e->getMessage());
        }       
    }

    /**
     * editNft
     * modifie le nft avec les valeurs saisies en paramètre
     *
     * @param string
     * @param string
     * @param string
     * @param string
     * @param int
     * @param float
     * @param int
     * @param int
     * @return void
     */
    public static function editNft(string $refInterne, string $libelle, string $resume, string $description, int $qteStock, float $prix, int $categorie, int $idProduit): void
    {
        try{
            if(self::$cnx == null) {
                self::$cnx = DbManager::getConnexion();
            }

            // Requête update qui modifie les valeurs du produit
            $sql = 'UPDATE produit SET ref_interne = :refInterne, libelleP = :libelle, resumeP = :resume, descriptionP = :description, qte_stock = :qteStock, prix_vente_uht = :prix, idCategorie = :idCateg';
            $sql .= ' WHERE idProduit = :idProduit';
            $stmt = self::$cnx->prepare($sql);
            $stmt->bindParam(':refInterne', $refInterne, PDO::PARAM_STR);
            $stmt->bindParam(':libelle', $libelle, PDO::PARAM_STR);
            $stmt->bindParam(':resume', $resume, PDO::PARAM_STR);
            $stmt->bindParam(':description', $description, PDO::PARAM_STR);
            $stmt->bindParam(':qteStock', $qteStock, PDO::PARAM_INT);
            $stmt->bindParam(':prix', $prix, PDO::PARAM_STR);
            $stmt->bindParam(':idCateg', $categorie, PDO::PARAM_INT);
            $stmt->bindParam(':idProduit', $idProduit, PDO::PARAM_INT);
            $stmt->execute();
            
        } catch (PDOException $e) {
            die('Erreur : '. $e->getMessage());
        }       
    }
}