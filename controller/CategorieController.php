<?php 

/**
 * /controller/CategorieController.php
 * 
 * Contrôleur pour l'entité Categorie
 *
 * @author A. Espinoza
 * @date 05/2022
 */

class CategorieController extends Controller {
    
    /**
     * Action qui affiche les catégories
     * params : tableau des paramètres
     */
    public static function show($params){

        // Vérifie que l'utilisateur est connecté
        if(isset($_SESSION['user'])) {

            // Vérifie que l'utilisateur soit admin
            if($_SESSION['user']->getRole() == 'admin') {

                $lesCategories = CategorieManager::getLesCategories();
            }
        }        
        
        $view = ROOT.'/view/dashboard.php';
        // appelle la vue
        $params = array();
        $params['lesCategories'] = $lesCategories;
        self::render($view, $params);
    }

    /**
     * Action qui ajoute une catégorie
     * params : tableau des paramètres
     */
    public static function add($params){
        $mess = '';

        // Vérifie que l'utilisateur est connecté
        if(isset($_SESSION['user'])) {

            // Vérifie que l'utilisateur soit admin
            if($_SESSION['user']->getRole() == 'admin') {

                // Vérifie que le formulaire a été soumis
                if(isset($_POST['addSubmit'])) {

                    // Vérifie que tous les champs sont remplis
                    if(!empty($_POST['libelle']) && isset($_POST['libelle']) && !empty($_POST['refInterne']) && isset($_POST['refInterne'])) {

                        // Filtre les input de type poste pour enlever les caractères indésirables
                        $libelle = nettoyer(filter_input(INPUT_POST, 'libelle', FILTER_SANITIZE_STRING));
                        $refInterne = nettoyer(filter_input(INPUT_POST, 'refInterne', FILTER_SANITIZE_STRING));

                        if(strlen($libelle) <= 64) { // Vérifie que la longueur du libelle soit inférieur ou égal à 64
                            if(strlen($refInterne) <= 64) { // Vérifie que la longueur de la ref interne soit inférieur ou égal à 64
                               
                                CategorieManager::addCategorie($libelle, $refInterne);

                                // Message de succès la catégorie a été ajouté
                                $mess = '<div class="col-4 alert alert-success">
                                <strong>Succès</strong> La catégorie a été ajouté !
                                </div>';

                            } else {
                                // Message d'erreur la ref interne est trop longue
                                $mess = '<div class="col-4 alert alert-danger">
                                <strong>Erreur</strong> La référence interne est trop longue !
                                </div>';
                            }
                        } else {
                            // Message d'erreur le libelle est trop long
                            $mess = '<div class="col-4 alert alert-danger">
                            <strong>Erreur</strong> Le libelle est trop long !
                            </div>';
                        }           
                    } else {
                        // Message d'erreur la catégorie n'a pas été ajouté
                        $mess = '<div class="col-4 alert alert-danger">
                        <strong>Erreur</strong> Veuillez remplir tous les champs !
                        </div>';
                    }
                }
            }
        }

        $view = ROOT.'/view/addCategorie.php';
        // appelle la vue
        $params = array();
        $params['mess'] = $mess;
        self::render($view, $params);
    }

    /**
     * Action qui supprime une catégorie
     * params : tableau des paramètres
     */
    public static function delete($params){

        // Vérifie que l'utilisateur est connecté
        if(isset($_SESSION['user'])) {

            // Vérifie que l'utilisateur soit admin
            if($_SESSION['user']->getRole() == 'admin') {

                // Vérifie qu'il y a bien un id catégorie dans l'url
                if(isset($_GET['idC'])) {

                    // Filtre les variables GET pour enlever les caractères indésirables
                    $idCategorie = nettoyer(filter_var($_GET['idC'], FILTER_VALIDATE_INT));

                    CategorieManager::deleteCategorie($idCategorie);

                }  
            }
        }

        $view = ROOT.'/view/dashboard.php';
        // appelle la vue
        $params = array();
        self::render($view, $params);
    }

    /**
     * Action qui modifie une catégorie
     * params : tableau des paramètres
     */
    public static function edit($params){

        // Vérifie que l'utilisateur est connecté
        if(isset($_SESSION['user'])) {

            // Vérifie que l'utilisateur soit admin
            if($_SESSION['user']->getRole() == 'admin') {

                // Vérifie qu'il y a bien un id catégorie dans l'url
                if(isset($_GET['idC'])) {

                    // Filtre les variables GET pour enlever les caractères indésirables
                    $idCategorie = nettoyer(filter_var($_GET['idC'], FILTER_VALIDATE_INT));

                    $exist = CategorieManager::existCategorie($idCategorie);

                    if($exist == true) {
                        $uneCategorie = CategorieManager::getCategorieById($idCategorie);
                    } else {
                        $uneCategorie = null;
                    }
                }
                $mess = '';

                // Vérifie que le formulaire a été soumis
                if (isset($_POST['editSubmit'])) {

                    // Vérifie que tous les champs sont remplis
                    if(!empty($_POST['libelle']) && isset($_POST['libelle']) && !empty($_POST['refInterne']) && isset($_POST['refInterne'])) {

                        // Filtre les input de type poste pour enlever les caractères indésirables
                        $libelle = nettoyer(filter_input(INPUT_POST, 'libelle', FILTER_SANITIZE_STRING));
                        $refInterne = nettoyer(filter_input(INPUT_POST, 'refInterne', FILTER_SANITIZE_STRING));

                        if(strlen($libelle) <= 64) { // Vérifie que la longueur du libelle soit inférieur ou égal à 64
                            if(strlen($refInterne) <= 64) { // Vérifie que la longueur de la ref interne soit inférieur ou égal à 64
                               
                                CategorieManager::editCategorie($libelle, $refInterne, $idCategorie);

                                // Message de succès la catégorie a été ajouté
                                $mess = '<div class="col-4 alert alert-success">
                                <strong>Succès</strong> La catégorie a été ajouté !
                                </div>';

                            } else {
                                // Message d'erreur la ref interne est trop longue
                                $mess = '<div class="col-4 alert alert-danger">
                                <strong>Erreur</strong> La référence interne est trop longue !
                                </div>';
                            }
                        } else {
                            // Message d'erreur le libelle est trop long
                            $mess = '<div class="col-4 alert alert-danger">
                            <strong>Erreur</strong> Le libelle est trop long !
                            </div>';
                        }           
                    } else {
                        // Message d'erreur la catégorie n'a pas été ajouté
                        $mess = '<div class="col-4 alert alert-danger">
                        <strong>Erreur</strong> Veuillez remplir tous les champs !
                        </div>';
                    }
                }
            }
        }
        
        $view = ROOT.'/view/editCategorie.php';
        // appelle la vue
        $params = array();
        $params['uneCategorie'] = $uneCategorie;
        $params['mess'] = $mess;
        $params['exist'] = $exist;
        self::render($view, $params);
    }

}