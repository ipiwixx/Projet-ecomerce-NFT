<?php

/**
 * /model/FavorisManager.php
 *
 * Définition de la class Favoris
 * Class qui gère les favoris
 *
 * @author A. Espinoza
 * @date 06/2022
 */

class FavorisManager
{

    private static ?\PDO $cnx = null;

    /**
     * isFavoris
     * vérifie si le produit est déja dans les favoris
     * avec l'id du client et l'id du produit en paramètre
     *
     * @param int $idProduit
     * @param int $idClient
     * @return bool
     */
    public static function isFavoris(int $idProduit, int $idClient): bool
    {
        try {
            if (self::$cnx == null) {
                self::$cnx = DbManager::getConnexion();
            }

            $isFavoris = false;

            // Requête select qui récupère toutes les informations du favoris
            $sql = 'SELECT idProduit, idClient';
            $sql .= ' FROM favoris';
            $sql .= ' WHERE idProduit = :idProduit and idClient = :idClient;';
            $stmt = self::$cnx->prepare($sql);
            $stmt->bindParam(':idProduit', $idProduit, PDO::PARAM_INT);
            $stmt->bindParam(':idClient', $idClient, PDO::PARAM_INT);
            $stmt->execute();

            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $row = $stmt->fetch();

            // Le nft est déjà en favoris
            if ($row > 1) {
                $isFavoris = true;
            }

            return $isFavoris;
        } catch (PDOException $e) {
            die('Erreur : ' . $e->getMessage());
        }
    }

    /**
     * addNftFavoris
     * ajoute dans la bbd un nft dans les favoris
     *
     * @param int $idProduit
     * @param int $idClient
     * @return void
     */
    public static function addNftFavoris(int $idProduit, int $idClient): void
    {
        try {
            if (self::$cnx == null) {
                self::$cnx = DbManager::getConnexion();
            }

            // Requête insert qui insère un produit en favoris pour le client
            $sql = "INSERT INTO `favoris` (`idProduit`, `idClient`) VALUES
            (:idProduit, :idClient);";
            $stmt = self::$cnx->prepare($sql);
            $stmt->bindParam(':idProduit', $idProduit, PDO::PARAM_INT);
            $stmt->bindParam(':idClient', $idClient, PDO::PARAM_INT);
            $stmt->execute();
        } catch (PDOException $e) {
            die('Erreur : ' . $e->getMessage());
        }
    }

    /**
     * removeNftFavoris
     * supprime le produit dans les favoris
     * avec l'id du client et l'id du produit en paramètre
     *
     * @param int $idProduit
     * @param int $idClient
     * @return void
     */
    public static function removeNftFavoris(int $idProduit, int $idClient): void
    {
        try {
            if (self::$cnx == null) {
                self::$cnx = DbManager::getConnexion();
            }

            // Requête delete qui supprime un nft des favoris
            $sql = 'DELETE FROM favoris';
            $sql .= ' Where idProduit = :idProduit and idClient = :idClient;';
            $stmt = self::$cnx->prepare($sql);
            $stmt->bindParam(':idProduit', $idProduit, PDO::PARAM_INT);
            $stmt->bindParam(':idClient', $idClient, PDO::PARAM_INT);
            $stmt->execute();
        } catch (PDOException $e) {
            die('Erreur : ' . $e->getMessage());
        }
    }
}
