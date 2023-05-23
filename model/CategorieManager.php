<?php

/**
 * /model/CategorieManager.php
 * 
 * Définition de la class CategorieManager
 * Class qui gère les interactions entre les catégories de l'application
 *  et les catégories de la bdd
 *
 * @author A. Espinoza
 * @date 05/2022
 */

class CategorieManager
{

    private static ?\PDO $cnx = null;
    private static Categorie $uneCateg;
    private static array $lesCategs = array();

    /**
     * getLesCategories
     * récupère dans la bbd tous les catégories 
     *
     * @return array
     */
    public static function getLesCategories(): array
    {
        try {
            if (self::$cnx == null) {
                self::$cnx = DbManager::getConnexion();
            }

            // Requête select qui récupère toutes les informations des catégories
            $sql = "SELECT numCategorie, libelleCategorie, ref_interne";
            $sql .= " FROM categorie";
            $stmt = self::$cnx->prepare($sql);
            $stmt->execute();

            $stmt->setFetchMode(PDO::FETCH_OBJ);
            while ($row = $stmt->fetch()) {
                self::$uneCateg = new Categorie();
                self::$uneCateg->setId($row->numCategorie);
                self::$uneCateg->setLibelle($row->libelleCategorie);
                self::$uneCateg->setRefInterne($row->ref_interne);
                self::$lesCategs[] = self::$uneCateg;
            }

            return self::$lesCategs;
        } catch (PDOException $e) {
            die('Erreur : ' . $e->getMessage());
        }
    }

    /**
     * getCategorieById
     * récupère dans la bbd la catégorie
     * avec l'id passé en paramètre
     *
     * @param int
     * @return Categorie
     */
    public static function getCategorieById(int $idCateg): Categorie
    {
        try {
            if (self::$cnx == null) {
                self::$cnx = DbManager::getConnexion();
            }

            // Requête select qui récupère toutes les informations des catégories
            $sql = "SELECT numCategorie, libelleCategorie, ref_interne";
            $sql .= " FROM categorie";
            $sql .= " WHERE numCategorie = :idCateg;";
            $stmt = self::$cnx->prepare($sql);
            $stmt->bindParam(':idCateg', $idCateg, PDO::PARAM_INT);
            $stmt->execute();

            $stmt->setFetchMode(PDO::FETCH_OBJ);
            $row = $stmt->fetch();
            self::$uneCateg = new Categorie();
            self::$uneCateg->setId($row->numCategorie);
            self::$uneCateg->setLibelle($row->libelleCategorie);
            self::$uneCateg->setRefInterne($row->ref_interne);

            return self::$uneCateg;
        } catch (PDOException $e) {
            die('Erreur : ' . $e->getMessage());
        }
    }

    /**
     * existCategorie
     * vérifie si la catégorie existe
     *
     * @param int
     * @return bool
     */
    public static function existCategorie(int $idCategorie): bool
    {
        try {
            if (self::$cnx == null) {
                self::$cnx = DbManager::getConnexion();
            }
            $exist = false;

            // Requête select qui récupère toutes les informations de la catégorie
            $sql = 'SELECT numCategorie, libelleCategorie, ref_interne';
            $sql .= ' FROM categorie';
            $sql .= ' WHERE numCategorie = :idCategorie';
            $stmt = self::$cnx->prepare($sql);
            $stmt->bindParam(':idCategorie', $idCategorie, PDO::PARAM_INT);
            $stmt->execute();
            $row = $stmt->rowCount();

            // La catégorie existe
            if ($row == 1) {
                $exist = true;
            }

            return $exist;
        } catch (PDOException $e) {
            die('Erreur : ' . $e->getMessage());
        }
    }

    /**
     * deleteCategorie
     * supprime la catégorie avec l'id passé en paramètre
     *
     * @param int
     * @return void
     */
    public static function deleteCategorie(int $idCategorie): void
    {
        try {
            if (self::$cnx == null) {
                self::$cnx = DbManager::getConnexion();
            }

            // Requête delete qui supprime les produit de la catégorie
            $sql = 'DELETE FROM produit';
            $sql .= ' WHERE idCategorie = :idCategorie;';
            $stmt = self::$cnx->prepare($sql);
            $stmt->bindParam(':idCategorie', $idCategorie, PDO::PARAM_INT);
            $stmt->execute();

            // Requête delete qui supprime la catégorie
            $sql = 'DELETE FROM categorie';
            $sql .= ' WHERE numCategorie = :idCategorie;';
            $stmt = self::$cnx->prepare($sql);
            $stmt->bindParam(':idCategorie', $idCategorie, PDO::PARAM_INT);
            $stmt->execute();
        } catch (PDOException $e) {
            die('Erreur : ' . $e->getMessage());
        }
    }

    /**
     * addCategorie
     * ajoute la catégorie avec les valeurs saisies en paramètre
     *
     * @param string
     * @param string
     * @return void
     */
    public static function addCategorie(string $libelle, string $refInterne): void
    {
        try {
            if (self::$cnx == null) {
                self::$cnx = DbManager::getConnexion();
            }

            // Requête insert qui insère une nouvelle catégorie
            $sql = 'INSERT INTO `categorie` (`libelleCategorie`, `ref_interne`) VALUES';
            $sql .= ' (:libelle, :refInterne);';
            $stmt = self::$cnx->prepare($sql);
            $stmt->bindParam(':libelle', $libelle, PDO::PARAM_STR);
            $stmt->bindParam(':refInterne', $refInterne, PDO::PARAM_STR);
            $stmt->execute();
        } catch (PDOException $e) {
            die('Erreur : ' . $e->getMessage());
        }
    }

    /**
     * editCategorie
     * modifie la catégorie avec les valeurs saisies en paramètre
     *
     * @param string
     * @param string
     * @param int
     * @return void
     */
    public static function editCategorie(string $libelle, string $refInterne, int $idCategorie): void
    {
        try {
            if (self::$cnx == null) {
                self::$cnx = DbManager::getConnexion();
            }

            // Requête update qui modifie les valeurs de la catégorie
            $sql = 'UPDATE categorie SET libelleCategorie = :libelle, ref_interne = :refInterne';
            $sql .= ' WHERE numCategorie = :idCategorie;';
            $stmt = self::$cnx->prepare($sql);
            $stmt->bindParam(':libelle', $libelle, PDO::PARAM_STR);
            $stmt->bindParam(':refInterne', $refInterne, PDO::PARAM_STR);
            $stmt->bindParam(':idCategorie', $idCategorie, PDO::PARAM_INT);
            $stmt->execute();
        } catch (PDOException $e) {
            die('Erreur : ' . $e->getMessage());
        }
    }
}
