<?php

/**
 * /controller/PanierController.php
 * 
 * Contrôleur pour l'entité Panier
 *
 * @author A. Espinoza
 * @date 05/2022
 */

class PanierController extends Controller
{

    /**
     * Action ajoute un nft dans le panier
     * params : tableau des paramètres
     */
    public static function addPanier($params)
    {

        // Vérifie qu'il y a bien un id produit et une quantité panier dans l'url
        if (isset($_GET['qtePanier']) && isset($_GET['id'])) {

            // Filtre les variables GET pour enlever les caractères indésirables
            $idProduit = nettoyer(filter_var($_GET['id'], FILTER_VALIDATE_INT));
            $qtePanier = nettoyer(filter_var($_GET['qtePanier'], FILTER_VALIDATE_INT));

            PanierManager::addQuantityPanier($idProduit, $_SESSION['id'], $qtePanier);
        }

        // appelle la vue
        $view = ROOT . '/view/boutique.php';
        $params = array();
        self::render($view, $params);
    }

    /**
     * Action delete un nft dans le panier
     * params : tableau des paramètres
     */
    public static function delPanier($params)
    {

        // Vérifie qu'il y a bien un id produit dans l'url
        if (isset($_GET['id'])) {

            // Filtre les variables GET pour enlever les caractères indésirables
            $idProduit = nettoyer(filter_var($_GET['id'], FILTER_VALIDATE_INT));

            PanierManager::removeNftPanier($idProduit, $_SESSION['id']);
        }

        // appelle la vue
        $view = ROOT . '/view/panier.php';
        $params = array();
        self::render($view, $params);
    }

    /**
     * Action delete un nft dans le panier
     * params : tableau des paramètres
     */
    public static function deletePanier($params)
    {

        PanierManager::deletePanier($_SESSION['id']);

        // appelle la vue
        $view = ROOT . '/view/panier.php';
        $params = array();
        self::render($view, $params);
    }
}
