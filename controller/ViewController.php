<?php 

/**
 * /controller/ViewController.php
 * 
 * Contrôleur pour l'entité view
 *
 * @author A. Espinoza
 * @date 05/2022
 */

class ViewController extends Controller {
    
    /**
     * Action qui affiche la page accueil
     * params : tableau des paramètres
     */
    public static function accueil($params){
        
        // Vérifie que tous les champs sont remplis
        if(isset($_POST['email']) && !empty($_POST['email'])) { 

            // Filtre les input de type poste pour enlever les caractères indésirables
            $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_STRING);
                
            ClientManager::newsletterSub($email);
        }

        // appelle la vue
        $view = ROOT.'/view/accueil.php';
        $params = array();
        self::render($view, $params);
    }
    
    /**
     * Action qui affiche la page des conditions d'utilisation
     * params : tableau des paramètres
     */
    public static function conditions($params){

        // appelle la vue
        $view = ROOT.'/view/conditions.php';
        $params = array();
        self::render($view, $params);
    }

    /**
     * Action qui affiche la page des cookies
     * params : tableau des paramètres
     */
    public static function cookies($params){
    
        // appelle la vue
        $view = ROOT.'/view/cookies.php';
        $params = array();
        self::render($view, $params);
    }

    /**
     * Action qui affiche la page des mentions légales
     * params : tableau des paramètres
     */
    public static function mentions($params){
    
        // appelle la vue
        $view = ROOT.'/view/mentions.php';
        $params = array();
        self::render($view, $params);
    }

    /**
     * Action qui affiche la page à propos des nft
     * params : tableau des paramètres
     */
    public static function nft($params){
    
        // appelle la vue
        $view = ROOT.'/view/nft.php';
        $params = array();
        self::render($view, $params);
    }

    /**
     * Action qui affiche la page politique de confidentialité
     * params : tableau des paramètres
     */
    public static function politique($params){
    
        // appelle la vue
        $view = ROOT.'/view/politique.php';
        $params = array();
        self::render($view, $params);
    }

    /**
     * Action qui affiche la page des conditions de ventes
     * params : tableau des paramètres
     */
    public static function ventes($params){
    
        // appelle la vue
        $view = ROOT.'/view/ventes.php';
        $params = array();
        self::render($view, $params);
    }

    /**
     * Action qui affiche la page de déconnexion
     * params : tableau des paramètres
     */
    public static function deconnexion($params){
    
        // appelle la vue
        $view = ROOT.'/view/deconnexion.php';
        $params = array();
        self::render($view, $params);
    }

    /**
     * Action qui affiche la page d'erreur
     * params : tableau des paramètres
     */
    public static function erreur($params){
    
        // appelle la vue
        $view = ROOT.'/view/error.php';
        $params = array();
        self::render($view, $params);
    }
}