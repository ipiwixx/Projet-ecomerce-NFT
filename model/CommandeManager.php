<?php

/**
 * /model/CommandeManager.php
 * 
 * Définition de la class CommandeManager
 * Class qui gère les interactions entre les commandes de l'application
 *  et les commandes de la bdd
 *
 * @author A. Espinoza
 * @date 05/2022
 */

class CommandeManager {

    private static ?\PDO $cnx = null;
    private static Commande $uneCommande;
    private static array $lesCommandes = array();

    /**
     * getLesCommandesByIdClient
     * récupère dans la bbd toutes les commandes 
     * avec l'id passé en paramètre
     *
     * @param int
     * @return array
     */
    public static function getLesCommandesByIdClient(int $identifier): array
    {
        try{
            if(self::$cnx == null) {
                self::$cnx = DbManager::getConnexion();
            }

            // Requête select qui récupère toutes les informations des commandes
            $sql = 'SELECT GetPrixTotalByCmd(idCmd) AS prixTotal, GetNbArticleByCmd(idCmd) AS nbArticle, idCmd, dateCommande';
            $sql .= ' FROM commande';
            $sql .= ' WHERE idClient = :param_id';
            $stmt = self::$cnx->prepare($sql);
            $stmt->bindParam(':param_id', $identifier, PDO::PARAM_INT);
            $stmt->execute();
            
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            while($row = $stmt->fetch()) {

                self::$uneCommande = new Commande();
                self::$uneCommande->setPrixCmd($row['prixTotal']);
                self::$uneCommande->setNbArticle($row['nbArticle']);
                self::$uneCommande->setId($row['idCmd']);
                $laDateCommande = new DateTime($row['dateCommande']);
                self::$uneCommande->setDateCommande($laDateCommande);
                self::$lesCommandes[] = self::$uneCommande;

            }
            return self::$lesCommandes;
        } catch (PDOException $e) {
            die('Erreur : '. $e->getMessage());
        }   
    }

    /**
     * getLaCommandeById
     * récupère dans la bbd la commandes 
     * avec l'id passé en paramètre
     *
     * @param int
     * @param int
     * @return Commande
     */
    public static function getLaCommandeById(int $idCmd, int $idClient): Commande
    {
        try{
            if(self::$cnx == null) {
                self::$cnx = DbManager::getConnexion();
            }

            // Requête select qui récupère toutes les informations de la commande
            $sql = 'SELECT GetPrixTotalByCmd(idCmd) AS prixTotal, GetNbArticleByCmd(idCmd) AS nbArticle, idCmd, dateCommande';
            $sql .= ' FROM commande';
            $sql .= ' WHERE idCmd = :idCmd and idClient = :idClient';
            $stmt = self::$cnx->prepare($sql);
            $stmt->bindParam(':idCmd', $idCmd, PDO::PARAM_INT);
            $stmt->bindParam(':idClient', $idClient, PDO::PARAM_INT);
            $stmt->execute();
            
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            while($row = $stmt->fetch()) {

                self::$uneCommande = new Commande();
                self::$uneCommande->setPrixCmd($row['prixTotal']);
                self::$uneCommande->setNbArticle($row['nbArticle']);
                self::$uneCommande->setId($row['idCmd']);
                $laDateCommande = new DateTime($row['dateCommande']);
                self::$uneCommande->setDateCommande($laDateCommande);

            }
            return self::$uneCommande;
        } catch (PDOException $e) {
            die('Erreur : '. $e->getMessage());
        }       
    }

    /**
     * createCommande
     * créer une commande 
     * pour l'utilisateur passé en paramètre
     *
     * @param int
     * @return void
     */
    public static function createCommande(int $idClient): void
    {
        try{
            if(self::$cnx == null) {
                self::$cnx = DbManager::getConnexion();
            }

            date_default_timezone_set('Europe/Paris');
            $dateC = new DateTime();
            $dateC = $dateC->format('Y-m-d H:i:s');
            $idStatut = 1;

            // Requête insert qui insère une nouvelle commande
            $sql = 'INSERT INTO commande (idClient, dateCommande) VALUES';
            $sql .= ' (:idClient, :dateC);';
            $stmt = self::$cnx->prepare($sql);
            $stmt->bindParam(':idClient', $idClient, PDO::PARAM_INT);
            $stmt->bindParam(':dateC', $dateC, PDO::PARAM_STR);
            $stmt->execute();

                // Requête select qui récupère l'id de la commande créée
                $sql = ' SELECT last_insert_id() as idC';
                $stmt = self::$cnx->prepare($sql);
                $stmt->execute();

                $stmt->setFetchMode(PDO::FETCH_ASSOC);
                $row = $stmt->fetch();
                $idCmd = $row['idC'];

                // Requête insert qui insère le statut commande nom validé
                $sql = 'INSERT INTO correspondre (idCmd, idStatut ,dateStatut) VALUES';
                $sql .= ' (:idCmd, :idStatut, :dateStatut);';
                $stmt = self::$cnx->prepare($sql);
                $stmt->bindParam(':idCmd', $idCmd, PDO::PARAM_INT);
                $stmt->bindParam(':idStatut', $idStatut, PDO::PARAM_INT);
                $stmt->bindParam(':dateStatut', $dateC, PDO::PARAM_STR);
                $stmt->execute();
                
                // Requête select qui récupère toutes les produits du panier et leur quantité
                $sql = 'SELECT idProduit, qtePanier';
                $sql .= ' FROM panier';
                $sql .= ' WHERE idClient = :idClient';
                $stmt = self::$cnx->prepare($sql);
                $stmt->bindParam(':idClient', $idClient, PDO::PARAM_INT);
                $stmt->execute();

                $stmt->setFetchMode(PDO::FETCH_ASSOC);
                while($row = $stmt->fetch()) {

                    $unP = $row['idProduit'];
                    $unQ = $row['qtePanier'];

                    // Requête insert qui insère les produits et leur quantité
                    $sqlI = 'INSERT INTO commander (idProduit, idCmd, qte) VALUES';
                    $sqlI .= ' (:idProduit, :idCmd, :qte)';
                    $stmtI = self::$cnx->prepare($sqlI);
                    $stmtI->bindParam(':idProduit', $unP, PDO::PARAM_INT);
                    $stmtI->bindParam(':idCmd', $idCmd, PDO::PARAM_INT);
                    $stmtI->bindParam(':qte', $unQ, PDO::PARAM_INT);
                    $stmtI->execute();

                    $unNft = NftManager::getUnNftById($unP);
                    $oldQte = $unNft->getQuantiteStock();
                    $newQte = $oldQte - $unQ;

                    // Requête update qui modifie la quantité en stock du produit
                    $sql2 = 'UPDATE produit SET qte_stock = :qte';
                    $sql2 .= ' WHERE idProduit = :idProduit';
                    $stmt2 = self::$cnx->prepare($sql2);
                    $stmt2->bindParam(':qte', $newQte, PDO::PARAM_INT);
                    $stmt2->bindParam(':idProduit', $unP, PDO::PARAM_INT);
                    $stmt2->execute();
                }

                header('Location: '.SERVER_URL.'/confirmation-commande/'.$idCmd.'/');
            

        } catch (PDOException $e) {
            die('Erreur : '. $e->getMessage());
        }       
    }

    /**
     * existCmd
     * vérifie si la commande existe
     *
     * @param int
     * @return bool
     */
    public static function existCmd(int $idCmd): bool
    {
        try{
            if(self::$cnx == null) {
                self::$cnx = DbManager::getConnexion();
            }
            $exist = false;
            
            // Requête select qui récupère toutes les informations de la commande
            $sql = 'SELECT idCmd';
            $sql .= ' FROM commande';
            $sql .= ' WHERE idCmd = :idCmd and idClient = :idClient;';
            $stmt = self::$cnx->prepare($sql);
            $stmt->bindParam(':idCmd', $idCmd, PDO::PARAM_INT);
            $stmt->bindParam(':idClient', $_SESSION['id'], PDO::PARAM_INT);
            $stmt->execute();
            $row = $stmt->rowCount();

            // La commande existe
            if($row == 1) {
                $exist = true;
            }

            return $exist;
        } catch (PDOException $e) {
            die('Erreur : '. $e->getMessage());
        }       
    }
    
}