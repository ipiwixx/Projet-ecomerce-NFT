<?php

/**
 * /model/PanierManager.php
 * 
 * Définition de la class Panier
 * Class qui gère les paniers
 *
 * @author A. Espinoza
 * @date 06/2022
 */

class PanierManager
{

   private static ?\PDO $cnx = null;
   private static Panier $unPanier;
   private static array $panier = array();

   /**
    * isPanier
    * vérifie si le produit est déja dans le panier
    * avec l'id du client et l'id du produit en paramètre
    *
    * @param int $idProduit
    * @param int $idClient
    * @return bool
    */
   public static function isPanier(int $idProduit, int $idClient): bool
   {
      try {
         if (self::$cnx == null) {
            self::$cnx = DbManager::getConnexion();
         }
         $isPanier = false;

         // Requête select qui récupère toutes les informations du panier
         $sql = 'SELECT idProduit, idClient, qtePanier';
         $sql .= ' FROM panier';
         $sql .= ' WHERE idProduit = :idProduit and idClient = :idClient;';
         $stmt = self::$cnx->prepare($sql);
         $stmt->bindParam(':idProduit', $idProduit, PDO::PARAM_INT);
         $stmt->bindParam(':idClient', $idClient, PDO::PARAM_INT);
         $stmt->execute();

         $stmt->setFetchMode(PDO::FETCH_ASSOC);
         $row = $stmt->fetch();
         if ($row > 1) {
            $isPanier = true;
         }

         return $isPanier;
      } catch (PDOException $e) {
         die('Erreur : ' . $e->getMessage());
      }
   }

   /**
    * getQtePanier
    * retourne la quantité du panier
    *
    * @return Panier
    */
   /* public static function getQtePanier(): Panier
   {
      try{
         if(self::$cnx == null) {
            self::$cnx = DbManager::getConnexion();
         }
         $isPanier = false;
 
         // Requête select qui récupère toutes les informations du panier
         $sql = 'SELECT getNbArticlePanier(:idClient) as qteP';
         $stmt = self::$cnx->prepare($sql);
         $stmt->bindParam(':idClient', $_SESSION['id'], PDO::PARAM_INT);
         $stmt->execute();
          
         $stmt->setFetchMode(PDO::FETCH_ASSOC);
         $row = $stmt->fetch();

         self::$unPanier = new Panier();
         self::$unPanier->setQte($row['qteP']);
 
         return self::$unPanier;
      } catch (PDOException $e) {
         die('Erreur : '. $e->getMessage());
      }       
   } */

   /**
    * getQtePanier
    * retourne la quantité du panier
    *
    * @return int
    */
   public static function getQtePanier(): int
   {
      try {
         if (self::$cnx == null) {
            self::$cnx = DbManager::getConnexion();
         }
         $isPanier = false;

         // Requête select qui récupère toutes les informations du panier
         $sql = 'SELECT getNbArticlePanier(:idClient) as qteP';
         $stmt = self::$cnx->prepare($sql);
         $stmt->bindParam(':idClient', $_SESSION['id'], PDO::PARAM_INT);
         $stmt->execute();

         $stmt->setFetchMode(PDO::FETCH_ASSOC);
         $row = $stmt->fetch();
         $count = $stmt->rowCount();

         if ($row['qteP'] == null) {
            $qte = 0;
         } else {
            $qte = $row['qteP'];
         }

         return $qte;
      } catch (PDOException $e) {
         die('Erreur : ' . $e->getMessage());
      }
   }

   /**
    * removeNftPanier
    * supprime le produit dans le panier
    * avec l'id du client et l'id du produit en paramètre
    *
    * @param int $idProduit
    * @param int $idClient
    * @return void
    */
   public static function removeNftPanier(int $idProduit, int $idClient): void
   {
      try {
         if (self::$cnx == null) {
            self::$cnx = DbManager::getConnexion();
         }

         // Requête delete qui supprime un nft du panier
         $sql = 'DELETE FROM panier';
         $sql .= ' WHERE idProduit = :idProduit and idClient = :idClient;';
         $stmt = self::$cnx->prepare($sql);
         $stmt->bindParam(':idProduit', $idProduit, PDO::PARAM_INT);
         $stmt->bindParam(':idClient', $idClient, PDO::PARAM_INT);
         $stmt->execute();
      } catch (PDOException $e) {
         die('Erreur : ' . $e->getMessage());
      }
   }

   /**
    * addQuantityPanier
    * ajoute la quantité passé en paramètre au produit
    * avec l'id du client et l'id du produit en paramètre
    *
    * @param int $idProduit
    * @param int $idClient
    * @param int $qtePanier
    * @return void
    */
   public static function addQuantityPanier(int $idProduit, int $idClient, int $qtePanier): void
   {
      try {
         if (self::$cnx == null) {
            self::$cnx = DbManager::getConnexion();
         }

         // Requête update qui modifie la quantité d'un nft du panier d'un client
         $sql = 'UPDATE panier';
         $sql .= ' SET qtePanier = :qtePanier';
         $sql .= ' WHERE idProduit = :idProduit and idClient = :idClient;';
         $stmt = self::$cnx->prepare($sql);
         $stmt->bindParam(':idProduit', $idProduit, PDO::PARAM_INT);
         $stmt->bindParam(':idClient', $idClient, PDO::PARAM_INT);
         $stmt->bindParam(':qtePanier', $qtePanier, PDO::PARAM_INT);
         $stmt->execute();
      } catch (PDOException $e) {
         die('Erreur : ' . $e->getMessage());
      }
   }

   /**
    * deletePanier
    * delete le panier
    * avec l'id du client en paramètre
    *
    * @param int $idClient
    * @return void
    */
   public static function deletePanier(int $idClient): void
   {
      try {
         if (self::$cnx == null) {
            self::$cnx = DbManager::getConnexion();
         }

         // Requête delete qui supprime le panier du client
         $sql = 'DELETE FROM panier';
         $sql .= ' WHERE idClient = :idClient;';
         $stmt = self::$cnx->prepare($sql);
         $stmt->bindParam(':idClient', $idClient, PDO::PARAM_INT);
         $stmt->execute();
      } catch (PDOException $e) {
         die('Erreur : ' . $e->getMessage());
      }
   }

   /**
    * addNftPanier
    * ajoute dans la bbd un nft dans le panier 
    *
    * @param int
    * @param int
    * @param int
    * @return bool
    */
   public static function addNftPanier(int $idProduit, int $idClient, int $qtePanier): bool
   {
      try {
         if (self::$cnx == null) {
            self::$cnx = DbManager::getConnexion();
         }
         $ajout = false;

         // Requête insert qui insère un produit dans le panier pour le client
         $sql = "INSERT INTO `panier` (`idProduit`, `idClient`, `qtePanier`) VALUES
         (:idProduit, :idClient, :qtePanier);";
         $stmt = self::$cnx->prepare($sql);
         $stmt->bindParam(':idProduit', $idProduit, PDO::PARAM_INT);
         $stmt->bindParam(':idClient', $idClient, PDO::PARAM_INT);
         $stmt->bindParam(':qtePanier', $qtePanier, PDO::PARAM_INT);
         $stmt->execute();

         $stmt->setFetchMode(PDO::FETCH_ASSOC);
         $row = $stmt->fetch();
         if ($row = 1) {
            $ajout = true;
         }

         return $ajout;
      } catch (PDOException $e) {
         die('Erreur : ' . $e->getMessage());
      }
   }

   /**
    * getPanier
    * ajoute dans la bbd un nft dans le panier 
    *
    * @param int
    * @param int
    * @return array
    */
   /* public static function getPanier(int $idClient): array
   {
      try{
         if(self::$cnx == null) {
            self::$cnx = DbManager::getConnexion();
         }
         $sql = "SELECT idProduit, qtePanier FROM panier";
         $sql .= " WHERE idClient = :idClient;";
         $stmt = self::$cnx->prepare($sql);
         $stmt->bindParam(':idClient', $idClient, PDO::PARAM_INT);
         $stmt->execute();
 
         $stmt->setFetchMode(PDO::FETCH_ASSOC);
          
         while($row = $stmt->fetch()) {
            self::$unPanier = new Panier();
            self::$unPanier->setIdProduit($row['idProduit']);
            self::$unPanier->setQte($row['qtePanier']);

            self::$panier[] = self::$unPanier;
         }
         
         return self::$panier;
      } catch (PDOException $e) {
         die('Erreur : '. $e->getMessage());
      }       
   } */
}
