<?php

/**
 * /controller/ClientController.php
 *
 * Contrôleur pour l'entité Client
 *
 * @author A. Espinoza
 * @date 05/2022
 */

class ClientController extends Controller
{

    /**
     * Action qui affiche les informations du clients passé en paramètre
     * params : tableau des paramètres
     */
    public static function readAccount($params)
    {
        $mess = '';

        // Vérifie que l'utilisateur est connecté
        if (isset($_SESSION['user'])) {

            $user = ClientManager::getUnClientById($_SESSION['id']);

            // Vérifie que le formulaire a été soumis
            if (isset($_POST['editSubmit'])) {

                // Vérifie que tous les champs sont remplis
                if (isset($_POST['nom']) && !empty($_POST['nom']) && isset($_POST['prenom']) && !empty($_POST['prenom']) && isset($_POST['pays']) && !empty($_POST['pays']) && isset($_POST['date']) && !empty($_POST['date']) && isset($_POST['tel']) && !empty($_POST['tel'])) {

                    // Filtre les input de type post pour enlever les caractères indésirables
                    $nom = nettoyer(filter_input(INPUT_POST, 'nom', FILTER_DEFAULT));
                    $prenom = nettoyer(filter_input(INPUT_POST, 'prenom', FILTER_DEFAULT));
                    $pays = nettoyer(filter_input(INPUT_POST, 'pays', FILTER_DEFAULT));
                    $cp = nettoyer(filter_var($_POST['cpt'], FILTER_VALIDATE_INT));
                    $ville = nettoyer(filter_input(INPUT_POST, 'ville', FILTER_DEFAULT));
                    $tel = nettoyer(filter_input(INPUT_POST, 'tel', FILTER_DEFAULT));
                    $aPostale = nettoyer(filter_input(INPUT_POST, 'adresse', FILTER_DEFAULT));
                    $dateN = nettoyer($_POST['date']);

                    if (strlen($nom) <= 64) { // Vérifie que la longueur du nom soit inférieur ou égal à 64
                        if (strlen($prenom) <= 64) { // Vérifie que la longueur du prénom soit inférieur ou égal à 64
                            if (strlen($tel) == 10) { // Vérifie que la longueur du téléphone soit de 10
                                if (strlen($pays) <= 64) { // Vérifie que la longueur du pays soit inférieur ou égal à 64

                                    ClientManager::changeInformations($nom, $prenom, $pays, $cp, $ville, $tel, $aPostale, $dateN);

                                    // Message de succès l'utilisateur a été modifié
                                    $mess = '<div class="alert alert-success">
                                    <strong>Succès</strong> L\'utilisateur a été modifé !
                                    </div>';
                                } else {

                                    // Message d'erreur l'utilisateur n'a pas été modifié
                                    $mess = '<div class="alert alert-danger">
                                    <strong>Erreur</strong> Le pays est trop long !
                                    </div>';
                                }
                            } else {
                                // Message d'erreur le téléphone est trop long
                                $mess = '<div class="alert alert-danger">
                                <strong>Erreur</strong> Le téléphone est trop long !
                                </div>';
                            }
                        } else {
                            // Message d'erreur le prénm est trop long
                            $mess = '<div class="alert alert-danger">
                            <strong>Erreur</strong> Le prénom est trop long !
                            </div>';
                        }
                    } else {
                        // Message d'erreur le nom est trop long
                        $mess = '<div class="alert alert-danger">
                        <strong>Erreur</strong> Le nom est trop long !
                        </div>';
                    }
                } else {
                    // Message d'erreur l'utilisateur n'a pas été modifié
                    $mess = '<div class="alert alert-danger">
                    <strong>Erreur</strong> Veuillez remplir tous les champs !
                    </div>';
                }
            }

            $messMdp = '';

            // Vérifie que le formulaire a été soumis
            if (isset($_POST['editSubmitP'])) {

                // Vérifie que tous les champs sont remplis
                if (!empty($_POST['mdp']) && isset($_POST['mdp']) && !empty($_POST['newMdp']) && isset($_POST['newMdp'])) {

                    // Filtre les input de type poste pour enlever les caractères indésirables
                    $mdp = nettoyer(filter_input(INPUT_POST, 'mdp', FILTER_DEFAULT));
                    $newMdp = nettoyer(filter_input(INPUT_POST, 'newMdp', FILTER_DEFAULT));

                    $messMdp = ClientManager::changePassword($mdp, $newMdp);
                } else {

                    // Message d'erreur le mot de passe n'a pas été modifié
                    $messMdp = '<div class="alert alert-danger">
                    <strong>Erreur</strong> Veuillez remplir tous les champs !
                    </div>';
                }
            }
        }

        // appelle la vue
        $view = ROOT . '/view/compte.php';
        $params = array();
        $params['user'] = $user;
        $params['mess'] = $mess;
        $params['messMdp'] = $messMdp;
        self::render($view, $params);
    }

    /**
     * Action qui teste la connexion du client
     * params : tableau des paramètres
     */
    public static function testConnexion($params)
    {

        $mess = '';

        // Vérifie que le formulaire a été soumis
        if (isset($_POST['loginSubmit'])) {

            // Vérifie que tous les champs sont remplis
            if (isset($_POST['email']) && !empty($_POST['email']) && isset($_POST['mdp']) && !empty($_POST['mdp'])) {

                // Filtre les input de type poste pour enlever les caractères indésirables
                $email = filter_input(INPUT_POST, 'email', FILTER_DEFAULT);
                $mdp = filter_input(INPUT_POST, 'mdp', FILTER_DEFAULT);

                $mess = ClientManager::testLaConnexion($email, $mdp);

                $_SESSION['panier'] = PanierManager::getQtePanier();
            }
        }

        // appelle la vue
        $view = ROOT . '/view/connexion.php';
        $params = array();
        $params['mess'] = $mess;
        self::render($view, $params);
    }

    /**
     * Action qui teste l'inscription du client
     * params : tableau des paramètres
     */
    public static function testInscription($params)
    {

        $mess = '';

        // Vérifie que le formulaire a été soumis
        if (isset($_POST['signupSubmit'])) {

            // Vérifie que tous les champs sont remplis
            if (isset($_POST['email']) && !empty($_POST['email']) && isset($_POST['nom']) && !empty($_POST['nom']) && isset($_POST['prenom']) && !empty($_POST['prenom']) && isset($_POST['pays']) && !empty($_POST['pays']) && isset($_POST['date']) && !empty($_POST['date']) && isset($_POST['mdp']) && !empty($_POST['mdp']) && isset($_POST['mdp-confirm']) && !empty($_POST['mdp-confirm']) && isset($_POST['tel']) && !empty($_POST['tel'])) {

                // Filtre les input de type post pour enlever les caractères indésirables
                $email = nettoyer(filter_input(INPUT_POST, 'email', FILTER_DEFAULT));
                $nom = nettoyer(filter_input(INPUT_POST, 'nom', FILTER_DEFAULT));
                $prenom = nettoyer(filter_input(INPUT_POST, 'prenom', FILTER_DEFAULT));
                $pays = nettoyer(filter_input(INPUT_POST, 'pays', FILTER_DEFAULT));
                $tel = nettoyer(filter_input(INPUT_POST, 'tel', FILTER_DEFAULT));
                $mdp = nettoyer(filter_input(INPUT_POST, 'mdp', FILTER_DEFAULT));
                $mdpConfirm = nettoyer(filter_input(INPUT_POST, 'mdp-confirm', FILTER_DEFAULT));
                $dateN = nettoyer($_POST['date']);

                if (strlen($nom) <= 64) { // Vérifie que la longueur du nom de famille est inférieur ou égal à 64
                    if (strlen($prenom) <= 64) { // Vérifie que la longueur du prenom est inférieur ou égal à 64
                        if (strlen($pays) <= 64) { // Vérifie que la longueur du pays est inférieur ou égal à 64
                            if (strlen($email) <= 128) { // Vérifie que la longueur du mail est inférieur ou égal à 128
                                if (filter_var($email, FILTER_VALIDATE_EMAIL)) { // Vérifie que l'email est de la bonne forme
                                    if (strlen($tel) == 10) { // Vérifie que la longueur du téléphone soit de 10
                                        if ($mdp === $mdpConfirm) { // Vérifie que les deux mdp saisis sont bon

                                            $mess = ClientManager::testInscription($email, $nom, $prenom, $pays, $dateN, $mdp, $tel);
                                        } else {
                                            // Message d'erreur, les 2 mots de passe sont différent
                                            $mess = '<div class="alert alert-danger">
                                            <strong>Erreur</strong> Mot de passe différent
                                            </div>';
                                        }
                                    } else {
                                        // Message d'erreur, la longueur du téléphone n'est pas respecté (10)
                                        $mess = '<div class="alert alert-danger">
                                        <strong>Erreur</strong> Nuéméro de téléphone non valide
                                        </div>';
                                    }
                                } else {
                                    // Message d'erreur, l'email est de la mauvaise forme
                                    $mess = '<div class="alert alert-danger">
                                    <strong>Erreur</strong> Email non valide
                                    </div>';
                                }
                            } else {
                                // Message d'erreur, longueur du mail suppérieur à 128
                                $mess = '<div class="alert alert-danger">
                                <strong>Erreur</strong> Le mail est trop long !
                                </div>';
                            }
                        } else {
                            // Message d'erreur, longueur du pays supérieur à 64
                            $mess = '<div class="alert alert-danger">
                            <strong>Erreur</strong> Le pays est trop long !
                            </div>';
                        }
                    } else {
                        // Message d'erreur, longueur du prénom supérieur à 50
                        $mess = '<div class="alert alert-danger">
                        <strong>Erreur</strong> Le prénom est trop long !
                        </div>';
                    }
                } else {
                    // Message d'erreur, longueur du nom supérieur à 50
                    $mess = '<div class="alert alert-danger">
                    <strong>Erreur</strong> Le nom est trop long !
                    </div>';
                }
            }
        }

        // appelle la vue
        $view = ROOT . '/view/inscription.php';
        $params = array();
        $params['mess'] = $mess;
        self::render($view, $params);
    }

    /**
     * Action qui vérifie le mail pour réinitialiser le mdp
     * params : tableau des paramètres
     */
    public static function mdpOublie($params)
    {

        $error = ClientManager::recupMdp();

        // appelle la vue
        $view = ROOT . '/view/mdp-oublie.php';
        $params = array();
        $params['error'] = $error;
        self::render($view, $params);
    }

    /**
     * Action qui vérifie le code
     * params : tableau des paramètres
     */
    public static function mdpCode($params)
    {

        $error = ClientManager::recupMdp();

        // appelle la vue
        $view = ROOT . '/view/code-mdp-oublie.php';
        $params = array();
        $params['error'] = $error;
        self::render($view, $params);
    }

    /**
     * Action qui change le mdp
     * params : tableau des paramètres
     */
    public static function mdpChange($params)
    {

        $error = ClientManager::recupMdp();

        // appelle la vue
        $view = ROOT . '/view/change-mdp.php';
        $params = array();
        $params['error'] = $error;
        self::render($view, $params);
    }

    /**
     * Action qui affiche les clients
     * params : tableau des paramètres
     */
    public static function show($params)
    {

        // Vérifie que l'utilisateur est connecté
        if (isset($_SESSION['user'])) {

            // Vérifie que l'utilisateur soit admin
            if ($_SESSION['user']->getRole() == 'admin') {

                $lesClients = ClientManager::getLesClients();
            }
        }

        $view = ROOT . '/view/dashboard.php';
        // appelle la vue
        $params = array();
        $params['lesClients'] = $lesClients;
        self::render($view, $params);
    }

    /**
     * Action qui ajoute un client
     * params : tableau des paramètres
     */
    public static function add($params)
    {
        $mess = '';

        // Vérifie que l'utilisateur est connecté
        if (isset($_SESSION['user'])) {

            // Vérifie que l'utilisateur soit admin
            if ($_SESSION['user']->getRole() == 'admin') {

                // Vérifie que le formulaire a été soumis
                if (isset($_POST['addSubmit'])) {

                    // Vérifie que tous les champs sont remplis
                    if (!empty($_POST['nom']) && isset($_POST['nom']) && !empty($_POST['prenom']) && isset($_POST['prenom']) && !empty($_POST['email']) && isset($_POST['email']) && !empty($_POST['pays']) && isset($_POST['pays']) && !empty($_POST['date']) && isset($_POST['date']) && !empty($_POST['mdp']) && isset($_POST['mdp']) && !empty($_POST['tel']) && isset($_POST['tel'])) {

                        // Filtre les input de type poste pour enlever les caractères indésirables
                        $nom = nettoyer(filter_input(INPUT_POST, 'nom', FILTER_DEFAULT));
                        $prenom = nettoyer(filter_input(INPUT_POST, 'prenom', FILTER_DEFAULT));
                        $email = nettoyer(filter_input(INPUT_POST, 'email', FILTER_DEFAULT));
                        $pays = nettoyer(filter_input(INPUT_POST, 'pays', FILTER_DEFAULT));
                        $dateN = nettoyer(filter_input(INPUT_POST, 'date', FILTER_DEFAULT));
                        $mdp = nettoyer(filter_input(INPUT_POST, 'mdp', FILTER_DEFAULT));
                        $tel = nettoyer(filter_input(INPUT_POST, 'tel', FILTER_DEFAULT));

                        if (strlen($nom) <= 64) { // Vérifie que la longueur du nom soit inférieur ou égal à 64
                            if (strlen($prenom) <= 64) { // Vérifie que la longueur du prénom soit inférieur ou égal à 64
                                if (strlen($email) <= 128) { // Vérifie que la longueur de l'email soit inférieur ou égal à 128
                                    if (filter_var($email, FILTER_VALIDATE_EMAIL)) { // Vérifie que l'email est de la bonne forme
                                        if (strlen($pays) <= 64) { // Vérifie que la longueur du pays soit inférieur ou égal à 64
                                            if (strlen($tel) == 10) { // Vérifie que la longueur du téléphone soit de 10

                                                ClientManager::addClient($nom, $prenom, $email, $pays, $dateN, $mdp, $tel);

                                                // Message de succès le client a été ajouté
                                                $mess = '<div class="col-4 alert alert-success">
                                                <strong>Succès</strong> Le client a été ajouté !
                                                </div>';
                                            } else {
                                                // Message d'erreur le numéro de téléphone est trop long
                                                $mess = '<div class="col-4 alert alert-danger">
                                                <strong>Erreur</strong> Le numéro de téléphone est trop long !
                                                </div>';
                                            }
                                        } else {
                                            // Message d'erreur le pays est trop long
                                            $mess = '<div class="col-4 alert alert-danger">
                                            <strong>Erreur</strong> Le pays est trop long !
                                            </div>';
                                        }
                                    } else {
                                        // Message d'erreur, l'email est de la mauvaise forme
                                        $mess = '<div class="alert alert-danger">
                                        <strong>Erreur</strong> Email non valide !
                                        </div>';
                                    }
                                } else {
                                    // Message d'erreur l'email est trop long
                                    $mess = '<div class="col-4 alert alert-danger">
                                    <strong>Erreur</strong> L\'email est trop long !
                                    </div>';
                                }
                            } else {
                                // Message d'erreur le prénom est trop long
                                $mess = '<div class="col-4 alert alert-danger">
                                <strong>Erreur</strong> Le prénom est trop long !
                                </div>';
                            }
                        } else {
                            // Message d'erreur le nom est trop long
                            $mess = '<div class="col-4 alert alert-danger">
                            <strong>Erreur</strong> Le nom est trop long !
                            </div>';
                        }
                    } else {
                        // Message d'erreur le client n'a pas été ajouté
                        $mess = '<div class="col-4 alert alert-danger">
                        <strong>Erreur</strong> Veuillez remplir tous les champs !
                        </div>';
                    }
                }
            }
        }

        $view = ROOT . '/view/addClient.php';
        // appelle la vue
        $params = array();
        $params['mess'] = $mess;
        self::render($view, $params);
    }

    /**
     * Action qui supprime un client
     * params : tableau des paramètres
     */
    public static function delete($params)
    {

        // Vérifie que l'utilisateur est connecté
        if (isset($_SESSION['user'])) {

            // Vérifie que l'utilisateur soit admin
            if ($_SESSION['user']->getRole() == 'admin') {

                // Vérifie qu'il y a bien un id client dans l'url
                if (isset($_GET['idC'])) {

                    // Filtre les variables GET pour enlever les caractères indésirables
                    $idClient = nettoyer(filter_var($_GET['idC'], FILTER_VALIDATE_INT));

                    ClientManager::deleteClient($idClient);
                }
            }
        }

        $view = ROOT . '/view/dashboard.php';
        // appelle la vue
        $params = array();
        self::render($view, $params);
    }

    /**
     * Action qui modifie un client
     * params : tableau des paramètres
     */
    public static function edit($params)
    {

        // Vérifie que l'utilisateur est connecté
        if (isset($_SESSION['user'])) {

            // Vérifie que l'utilisateur soit admin
            if ($_SESSION['user']->getRole() == 'admin') {

                // Vérifie qu'il y a bien un id client dans l'url
                if (isset($_GET['idC'])) {

                    // Filtre les variables GET pour enlever les caractères indésirables
                    $idClient = nettoyer(filter_var($_GET['idC'], FILTER_VALIDATE_INT));

                    $exist = ClientManager::existClient($idClient);

                    if ($exist == true) {
                        $unClient = ClientManager::getUnClientById($idClient);
                    } else {
                        $unClient = null;
                    }
                }
                $mess = '';

                // Vérifie que le formulaire a été soumis
                if (isset($_POST['editSubmit'])) {

                    // Vérifie que tous les champs sont remplis
                    if (!empty($_POST['nom']) && isset($_POST['nom']) && !empty($_POST['prenom']) && isset($_POST['prenom']) && !empty($_POST['email']) && isset($_POST['email']) && !empty($_POST['pays']) && isset($_POST['pays']) && !empty($_POST['date']) && isset($_POST['date']) && !empty($_POST['mdp']) && isset($_POST['mdp']) && !empty($_POST['tel']) && isset($_POST['tel'])) {

                        // Filtre les input de type poste pour enlever les caractères indésirables
                        $nom = nettoyer(filter_input(INPUT_POST, 'nom', FILTER_DEFAULT));
                        $prenom = nettoyer(filter_input(INPUT_POST, 'prenom', FILTER_DEFAULT));
                        $email = nettoyer(filter_input(INPUT_POST, 'email', FILTER_DEFAULT));
                        $pays = nettoyer(filter_input(INPUT_POST, 'pays', FILTER_DEFAULT));
                        $dateN = nettoyer(filter_input(INPUT_POST, 'date', FILTER_DEFAULT));
                        $mdp = nettoyer(filter_input(INPUT_POST, 'mdp', FILTER_DEFAULT));
                        $tel = nettoyer(filter_input(INPUT_POST, 'tel', FILTER_DEFAULT));

                        if (strlen($nom) <= 64) { // Vérifie que la longueur du nom soit inférieur ou égal à 64
                            if (strlen($prenom) <= 64) { // Vérifie que la longueur du prénom soit inférieur ou égal à 64
                                if (strlen($email) <= 128) { // Vérifie que la longueur de l'email soit inférieur ou égal à 128
                                    if (filter_var($email, FILTER_VALIDATE_EMAIL)) { // Vérifie que l'email est de la bonne forme
                                        if (strlen($pays) <= 64) { // Vérifie que la longueur du pays soit inférieur ou égal à 64
                                            if (strlen($tel) == 10) { // Vérifie que la longueur du téléphone soit de 10

                                                ClientManager::editClient($nom, $prenom, $email, $pays, $dateN, $mdp, $tel, $idClient);
                                            } else {
                                                // Message d'erreur le numéro de téléphone est trop long
                                                $mess = '<div class="col-4 alert alert-danger">
                                                <strong>Erreur</strong> Le numéro de téléphone est trop long !
                                                </div>';
                                            }
                                        } else {
                                            // Message d'erreur le pays est trop long
                                            $mess = '<div class="col-4 alert alert-danger">
                                            <strong>Erreur</strong> Le pays est trop long !
                                            </div>';
                                        }
                                    } else {
                                        // Message d'erreur, l'email est de la mauvaise forme
                                        $mess = '<div class="alert alert-danger">
                                        <strong>Erreur</strong> Email non valide !
                                        </div>';
                                    }
                                } else {
                                    // Message d'erreur l'email est trop long
                                    $mess = '<div class="col-4 alert alert-danger">
                                    <strong>Erreur</strong> L\'email est trop long !
                                    </div>';
                                }
                            } else {
                                // Message d'erreur le prénom est trop long
                                $mess = '<div class="col-4 alert alert-danger">
                                <strong>Erreur</strong> Le prénom est trop long !
                                </div>';
                            }
                        } else {
                            // Message d'erreur le nom est trop long
                            $mess = '<div class="col-4 alert alert-danger">
                            <strong>Erreur</strong> Le nom est trop long !
                            </div>';
                        }
                    } else {
                        // Message d'erreur le client n'a pas été ajouté
                        $mess = '<div class="col-4 alert alert-danger">
                        <strong>Erreur</strong> Veuillez remplir tous les champs !
                        </div>';
                    }
                }
            }
        }

        $view = ROOT . '/view/editClient.php';
        // appelle la vue
        $params = array();
        $params['unClient'] = $unClient;
        $params['mess'] = $mess;
        $params['exist'] = $exist;
        self::render($view, $params);
    }
}
