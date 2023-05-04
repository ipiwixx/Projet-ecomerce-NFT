<?php 

/**
 * /controller/NftController.php
 * 
 * Contrôleur pour l'entité Nft
 *
 * @author A. Espinoza
 * @date 05/2022
 */

class NftController extends Controller {

    /**
     * Action qui affiche tous les produits (nft)
     * params : tableau des paramètres
     * search permet de filtrer en fonction de la recherche de l'utilisateur
     */
    public static function readAll($params){

        $lesCategs = CategorieManager::getLesCategories();
        $reponse = '';
        $search = '';

        // Vérifie que le client a effectué une recherche
        if(isset($_GET['search']) && !empty($_GET['search']))
        {
            // Filtre les variables GET pour enlever les caractères indésirables
            $search = nettoyer(filter_input(INPUT_GET, 'search', FILTER_SANITIZE_STRING));

            $lesNfts = NftManager::getLesNftsBySearch($search);
            $nbPages = NftManager::getLeNombreDePageSearch($search);

            // Vérifie que la recherche retourne des produits
            if(empty($lesNfts))
            {
                $reponse = 'AUCUN PRODUIT NE CORRESPOND À VOTRE RECHERCHE : ' . $search;
            }

            // Vérifie si l'utilisateur a utilisé un filtre
        } else if (isset($_GET['filtreCateg']) || isset($_GET['filtrePrix']) || isset($_GET['filtreDate'])){

            // Vérifie si l'utilisateur a utilisé le filtre categ
            if(empty($_GET['filtreCateg'])) {
                $filtreCateg = '';
            } else {
                $filtreCateg = nettoyer(filter_input(INPUT_GET, 'filtreCateg', FILTER_SANITIZE_STRING));

            // Vérifie si l'utilisateur a utilisé le filtre prix    
            } if(empty($_GET['filtrePrix'])) {
                $filtrePrix = '';
            } else {
                $filtrePrix = nettoyer(filter_input(INPUT_GET, 'filtrePrix', FILTER_SANITIZE_STRING));

            // Vérifie si l'utilisateur a utilisé le filtre date
            } if(empty($_GET['filtreDate'])) {
                $filtreDate = '';
            } else {
                $filtreDate = nettoyer(filter_input(INPUT_GET, 'filtreDate', FILTER_SANITIZE_STRING));
            }

            $lesNfts = NftManager::getLesNftsFiltre($filtreCateg, $filtrePrix, $filtreDate);
            $nbPages = NftManager::getLeNombreDePageFiltre($filtreCateg, $filtrePrix, $filtreDate);
        } else {
            $lesNfts = NftManager::getLesNfts();
            $nbPages = NftManager::getLeNombreDePage();
        }

        $mess = 'Le produit a bien été ajouté à votre panier';

        // Vérifie que l'utilisateur soit connecté
        if(isset($_SESSION['user'])) {

            // Vérifie qu'il y a bien un id produit dans l'url
            if(isset($_GET['id'])) {

                // Filtre les variables GET pour enlever les caractères indésirables
                $idProduit = nettoyer(filter_var($_GET['id'], FILTER_VALIDATE_INT));
                
                $exist = NftManager::existNft($idProduit);

                if($exist == true) {
                    $isPanier = PanierManager::isPanier($idProduit, $_SESSION['id']);

                    // Vérifie si le produit existe déja dans le panier de la bdd
                    if($isPanier == true)
                    {
                        // Modifie la quantité du produit dans le panier
                        $product = NftManager::getUnNftByIdPanier($idProduit);

                        if($product->getQuantiteStock() <= $product->getQtePanier()) {
                            $qtePanier = $product->getQuantiteStock();
                            $mess = "Le produit n'est plus disponible";
                        } else {
                            $qtePanier = $product->getQtePanier() + 1;
                            $mess = "Le produit a bien été ajouté à votre panier";
                        }
                        if($product->getQtePanier() > 0){
                            PanierManager::addQuantityPanier($idProduit, $_SESSION['id'], $qtePanier);
                        }
                    } else {
                        $ajout = PanierManager::addNftPanier($idProduit, $_SESSION['id'], 1);
                        $mess = "Le produit a bien été ajouté à votre panier";
                    }
                }
            } 

            // Vérifie qu'il y a bien un id produit dans l'url
            if(isset($_GET['idF'])) {

                // Filtre les variables GET pour enlever les caractères indésirables
                $idFavoris = nettoyer(filter_var($_GET['idF'], FILTER_VALIDATE_INT));

                $exist = NftManager::existNft($idFavoris);

                if($exist == true) {
                    $isFavoris = FavorisManager::isFavoris($idFavoris, $_SESSION['id']);

                    // Vérifie si le produit existe déja dans les favoris de la bdd
                    if($isFavoris == false)
                    {
                        $ajoutF = FavorisManager::addNftFavoris($idFavoris, $_SESSION['id']);
                    }
                }   
            }

            // Vérifie qu'il y a bien un id produit dans l'url pour delete du favoris
            if(isset($_GET['delF'])) {

                // Filtre les variables GET pour enlever les caractères indésirables
                $idFav = nettoyer(filter_var($_GET['delF'], FILTER_VALIDATE_INT));

                $exist = NftManager::existNft($idFav);

                if($exist == true) {
                    FavorisManager::removeNftFavoris($idFav, $_SESSION['id']);
                }
            }

            $_SESSION['panier'] = PanierManager::getQtePanier();
        }

        // appelle la vue
        $view = ROOT.'/view/boutique.php';
        $params = array();
        $params['reponse'] = $reponse;
        $params['lesNfts'] = $lesNfts;
        $params['mess'] = $mess;
        $params['nb'] = $nbPages;
        $params['lesCategs'] = $lesCategs;
        self::render($view, $params);
    }

    /**
     * Action qui affiche tous les produits (nft)
     * params : tableau des paramètres
     * search permet de filtrer en fonction de la recherche de l'utilisateur
     */
    public static function readDescription($params){

        // Vérifie qu'il y a bien un id produit dans l'url
        if(isset($_GET['idP'])) {

            // Filtre les variables GET pour enlever les caractères indésirables
            $idProd = nettoyer(filter_var($_GET['idP'], FILTER_VALIDATE_INT));

            $exist = NftManager::existNft($idProd);

            if($exist == true) {
                $unNft = NftManager::getUnNftById($idProd);
            } else {
                $unNft = null;
            }
        }

        // Vérifie que l'utilisateur soit connecté
        if(isset($_SESSION['user'])) {

            // Vérifie qu'il y a bien un id produit dans l'url
            if(isset($_GET['id'])) {

                // Filtre les variables GET pour enlever les caractères indésirables
                $idProduit = nettoyer(filter_var($_GET['id'], FILTER_VALIDATE_INT));

                $exist = NftManager::existNft($idProduit);

                if($exist == true) {
                    $isPanier = PanierManager::isPanier($idProduit, $_SESSION['id']);

                    // Vérifie si le produit existe déja dans le panier de la bdd
                    if($isPanier == true)
                    {
                        // Modifie la quantité du produit dans le panier
                        $product = NftManager::getUnNftByIdPanier($idProduit);

                        if($product->getQuantiteStock() <= $product->getQtePanier()) {
                            $qtePanier = $product->getQuantiteStock();
                            $mess = "Le produit n'est plus disponible";
                        } else {
                            $qtePanier = $product->getQtePanier() + 1;
                            $mess = "Le produit a bien été ajouté à votre panier";
                        }

                        if($product->getQtePanier() > 0){
                            PanierManager::addQuantityPanier($idProduit, $_SESSION['id'], $qtePanier);
                        }
                    } else {
                        $ajout = NftManager::addNftPanier($idProduit, $_SESSION['id'], 1);
                        $mess = "Le produit a bien été ajouté à votre panier";
                    }
                }

            // Vérifie qu'il y a bien un id produit pour le favoris dans l'url
            } else if(isset($_GET['idF'])) {

                // Filtre les variables GET pour enlever les caractères indésirables
                $idFavoris = nettoyer(filter_var($_GET['idF'], FILTER_VALIDATE_INT));

                $exist = NftManager::existNft($idFavoris);

                if($exist == true) {
                    $isFavoris = FavorisManager::isFavoris($idFavoris, $_SESSION['id']);

                    // Vérifie si le produit existe déja dans les favoris de la bdd
                    if($isFavoris == false)
                    {
                        $ajoutF = FavorisManager::addNftFavoris($idFavoris, $_SESSION['id']);
                    }
                }   
            }

            $_SESSION['panier'] = PanierManager::getQtePanier();
        }

        // appelle la vue
        $view = ROOT.'/view/description.php';
        $params = array();
        $params['unNft'] = $unNft;
        $params['exist'] = $exist;
        self::render($view, $params);
    }

    /**
     * Action qui affiche tous les produits (nft) du panier
     * params : tableau des paramètres
     */
    public static function readPanier()
    {
        // Vérifie que l'utilisateur soit connecté
        if(isset($_SESSION['user'])) {

            $lesNfts = NftManager::getLesNftsPanier($_SESSION['id']);

            // Vérifie qu'il y a bien un id produit et une quantité dans l'url
            if(isset($_GET['qtePanier']) && isset($_GET['id']))
            {
                // Filtre les variables GET pour enlever les caractères indésirables
                $idProduit = nettoyer(filter_var($_GET['id'], FILTER_VALIDATE_INT));
                $qtePanier = nettoyer(filter_var($_GET['qtePanier'], FILTER_VALIDATE_INT));

                $exist = NftManager::existNft($idProduit);

                if($exist == true) {
                    $nft = NftManager::getUnNftById($idProduit);

                    if($nft->getQuantiteStock() <= $qtePanier) {
                        $qtePanier = $nft->getQuantiteStock();
                    }

                    PanierManager::addQuantityPanier($idProduit, $_SESSION['id'], $qtePanier);
                }

            // Vérifie qu'il y a bien un id produit dans l'url
            } else if(isset($_GET['delPanier'])){

                // Filtre les variables GET pour enlever les caractères indésirables
                $idProduit = nettoyer(filter_var($_GET['delPanier'], FILTER_VALIDATE_INT));

                $exist = NftManager::existNft($idProduit);

                if($exist == true) {
                    PanierManager::removeNftPanier($idProduit, $_SESSION['id']);
                }
            }

            $_SESSION['panier'] = PanierManager::getQtePanier();
        }

        // appelle la vue
        $view = ROOT.'/view/panier.php';
        $params = array();
        $params['lesNfts'] = $lesNfts;
        self::render($view, $params);
    }

    /**
     * Action qui affiche tous les produits (nft) d'une commande
     * params : tableau des paramètres
     */
    public static function readNftCmd()
    {
        $nftsCmd = array();
        $cmd = new Commande();

        // Vérifie que l'utilisateur soit connecté
        if(isset($_SESSION['user'])) {

            // Vérifie qu'il y a bien un id commande dans l'url
            if(isset($_GET['id'])) {

                // Filtre les variables GET pour enlever les caractères indésirables
                $idCmd = nettoyer(filter_var($_GET['id'], FILTER_VALIDATE_INT));

                $exist = CommandeManager::existCmd($idCmd);
                        
                if($exist == true) {
                    $nftsCmd = NftManager::getLesNftsCmd($idCmd);
                    $cmd = CommandeManager::getLaCommandeById($idCmd, $_SESSION['id']);
                } else {
                    $nftsCmd = null;
                    $cmd = null;
                }
            }
        }
        
        // appelle la vue
        $view = ROOT.'/view/detailCmd.php';
        $params = array();
        $params['nftsCmd'] = $nftsCmd;
        $params['cmd'] = $cmd;
        $params['exist'] = $exist;
        self::render($view, $params);
    }

    /**
     * Action qui affiche tous les produits (nft) des favoris
     * params : tableau des paramètres
     */
    public static function readFavoris()
    {
        $mess = '';
        $lesNfts = NftManager::getLesNftsFavoris();

        // Vérifie que l'utilisateur soit connecté
        if(isset($_SESSION['user'])) {

            // Vérifie qu'il y a bien un id produit dans l'url
            if(isset($_GET['delFavoris'])){

                // Filtre les variables GET pour enlever les caractères indésirables
                $idFavoris = nettoyer(filter_var($_GET['delFavoris'], FILTER_VALIDATE_INT));

                $exist = NftManager::existNft($idFavoris);

                if($exist == true) {
                    FavorisManager::removeNftFavoris($idFavoris, $_SESSION['id']);
                }

            // Vérifie qu'il y a bien un id produit dans l'url
            } else if(isset($_GET['id'])) {

                // Filtre les variables GET pour enlever les caractères indésirables
                $idProduit = nettoyer(filter_var($_GET['id'], FILTER_VALIDATE_INT));

                $exist = NftManager::existNft($idProduit);

                if($exist == true) {
                    $isPanier = PanierManager::isPanier($idProduit, $_SESSION['id']);

                    // Vérifie si le produit existe déja dans le panier de la bdd
                    if($isPanier == true)
                    {
                        // Modifie la quantité du produit dans le panier
                        $product = NftManager::getUnNftByIdPanier($idProduit);

                        if($product->getQuantiteStock() <= $product->getQtePanier()) {
                            $qtePanier = $product->getQuantiteStock();
                            $mess = "Le produit n'est plus disponible";
                        } else {
                            $qtePanier = $product->getQtePanier() + 1;        
                            $mess = "Le produit a bien été ajouté à votre panier";
                        }

                        if($product->getQtePanier() > 0){
                            PanierManager::addQuantityPanier($idProduit, $_SESSION['id'], $qtePanier);
                        }
                    } else {
                        $ajout = PanierManager::addNftPanier($idProduit, $_SESSION['id'], 1);
                        $mess = "Le produit a bien été ajouté à votre panier";
                    }
                }
            }

            $_SESSION['panier'] = PanierManager::getQtePanier();
        }

        // appelle la vue
        $view = ROOT.'/view/favoris.php';
        $params = array();
        $params['lesNfts'] = $lesNfts;
        $params['mess'] = $mess;
        self::render($view, $params);
    }

    /**
     * Action qui affiche tous les produits (nft) pour le paiement
     * params : tableau des paramètres
     */
    public static function readPaiement()
    {

        $lesNfts = NftManager::getLesNftsPanier($_SESSION['id']);

        // Vérifie que l'utilisateur soit connecté
        if(isset($_SESSION['user'])) {

            // Vérifie que tous les champs sont remplis
            if(isset($_POST['adresse']) && !empty($_POST['adresse']) && isset($_POST['cpt']) && !empty($_POST['cpt']) && isset($_POST['ville']) && !empty($_POST['ville'])) { 
            
                // Filtre les input de type poste pour enlever les caractères indésirables
                $adresse = nettoyer(filter_input(INPUT_POST, 'adresse', FILTER_SANITIZE_STRING));
                $ville = nettoyer(filter_input(INPUT_POST, 'ville', FILTER_SANITIZE_STRING));
                $cp = nettoyer(filter_var($_POST['cpt'], FILTER_VALIDATE_INT));

                ClientManager::ChangeAdresse($adresse, $ville, $cp);
            }

            // Vérifie que tous les champs sont remplis
            if(isset($_POST['numCB']) && !empty($_POST['numCB']) && isset($_POST['nomCB']) && !empty($_POST['nomCB']) && isset($_POST['cvvCB']) && !empty($_POST['cvvCB'])) {
                CommandeManager::createCommande($_SESSION['id']);
            }
        }

        // appelle la vue
        $view = ROOT.'/view/paiement.php';
        $params = array();
        $params['lesNfts'] = $lesNfts;
        self::render($view, $params);
    }

    /**
     * Action qui ajoute un nft en favoris
     * params : tableau des paramètres
     */
    public static function addFav()
    {

        // Vérifie qu'il y a bien un id produit dans l'url
        if(isset($_GET['idF'])) {

            // Filtre les variables GET pour enlever les caractères indésirables
            $idFavoris = nettoyer(filter_var($_GET['idF'], FILTER_VALIDATE_INT));

            $exist = NftManager::existNft($idFavoris);

            if($exist == true) {
                $isFavoris = FavorisManager::isFavoris($idFavoris, $_SESSION['id']);

                // Vérifie si le produit existe déja dans les favoris de la bdd
                if($isFavoris == false)
                {
                    $ajoutF = FavorisManager::addNftFavoris($idFavoris, $_SESSION['id']);
                }

                PanierManager::RemoveNftPanier($idFavoris, $_SESSION['id']);
            }   
        }

        // appelle la vue
        $view = ROOT.'/view/panier.php';
        $params = array();
        $params['lesNfts'] = $lesNfts;
        self::render($view, $params);
    }

    /**
     * Action qui affiche les produits
     * params : tableau des paramètres
     */
    public static function show($params){

        // Vérifie qu'il y a bien un id catégorie dans l'url
        if(isset($_GET['idC'])) {   
            
            // Filtre les variables GET pour enlever les caractères indésirables
            $idCategorie = nettoyer(filter_var($_GET['idC'], FILTER_VALIDATE_INT));
            
            $lesNfts = NftManager::getLesNftsByCategDash($idCategorie);
     
        } else {
            $lesNfts = NftManager::getLesNftsDash();  
        }

        $lesCategories = CategorieManager::getLesCategories();
              
        
        $view = ROOT.'/view/dashboard.php';
        // appelle la vue
        $params = array();
        $params['lesNfts'] = $lesNfts;
        $params['lesCategories'] = $lesCategories;
        self::render($view, $params);
    }

    /**
     * Action qui ajoute un nft
     * params : tableau des paramètres
     */
    public static function add($params){
        $mess = '';

        // Vérifie que l'utilisateur est connecté
        if(isset($_SESSION['user'])) {

            // Vérifie que l'utilisateur soit admin
            if($_SESSION['user']->getRole() == 'admin') {

                // Vérifie qu'il y a bien une image dans le file
                if(isset($_FILES['path']['name'])) {

                    // Vérifie que le formulaire a été soumis
                    if(isset($_POST['addSubmit'])) {
                        
                        // Vérifie que tous les champs sont remplis
                        if(!empty($_POST['refInterne']) && isset($_POST['refInterne']) && !empty($_POST['libelle']) && isset($_POST['libelle']) && !empty($_POST['resume']) && isset($_POST['resume']) && !empty($_POST['description']) && isset($_POST['description']) && !empty($_POST['qteStock']) && isset($_POST['qteStock']) && !empty($_POST['prix']) && isset($_POST['prix']) && !empty($_POST['categorie']) && isset($_POST['categorie'])) {

                            // Filtre les input de type poste pour enlever les caractères indésirables
                            $refInterne = nettoyer(filter_input(INPUT_POST, 'refInterne', FILTER_SANITIZE_STRING));
                            $libelle = nettoyer(filter_input(INPUT_POST, 'libelle', FILTER_SANITIZE_STRING));
                            $resume = nettoyer(filter_input(INPUT_POST, 'resume', FILTER_SANITIZE_STRING));
                            $description = nettoyer(filter_input(INPUT_POST, 'description', FILTER_SANITIZE_STRING));
                            $qteStock = nettoyer(filter_var($_POST['qteStock'], FILTER_VALIDATE_INT));
                            $prix = nettoyer(filter_var($_POST['prix'], FILTER_VALIDATE_FLOAT));
                            $categorie = nettoyer(filter_var($_POST['categorie'], FILTER_VALIDATE_INT));

                            // Taille maximum pour le fichier image
                            $maxsizes = 9514400;

                            // Extension valide pour l'image
                            $extensions_valides = array( 'png', 'jpeg', 'jpg');
                            
                            // Récupère l'extension de l'image
                            $extension_upload = strtolower(  substr(  strrchr($_FILES['path']['name'], '.')  ,1)  );

                            if(strlen($refInterne) <= 32) { // Vérifie que la longueur de la ref interne soit inférieur ou égal à 32
                                if(strlen($libelle) <= 64) { // Vérifie que la longueur du libelle soit inférieur ou égal à 64
                                    if(strlen($resume) <= 128) { // Vérifie que la longueur du resume soit inférieur ou égal à 128
                                        if(strlen($description) <= 256) { // Vérifie que la longueur de la description soit inférieur ou égal à 256
                                            if($_FILES['path']['error'] == 0) { // Vérifie si il y a une erreur de transfert de l'image
                                                if($_FILES['path']['size'] < $maxsizes) { // Vérifie que l'image soit bien inférieur à la taille maximum
                                                    if(in_array($extension_upload,$extensions_valides)) { // Vérifie si l'extension est correcte

                                                        NftManager::addNft($refInterne, $libelle, $resume, $description, $qteStock, $prix, $categorie);

                                                        // Message de succès le produit a été ajouté
                                                        $mess = '<div class="col-4 alert alert-success">
                                                        <strong>Succès</strong> Le produit a été ajouté !
                                                        </div>';

                                                    } else {
                                                        // Message d'erreur, l'extension n'est pas correcte
                                                        $mess = '<div class="col-4 alert alert-danger">
                                                        <strong>Erreur</strong> L\'extension de l\'image n\'est pas correcte !
                                                        </div>';
                                                    }
                                                } else {
                                                    // Message d'erreur, fichier trop volumineux
                                                    $mess = '<div class="col-4 alert alert-danger">
                                                    <strong>Erreur</strong> Fichier trop volumineux !
                                                    </div>';
                                                }
                                            } else {
                                                // Message d'erreur, echec lors du transfert de l'image
                                                $mess = '<div class="col-4 alert alert-danger">
                                                <strong>Erreur</strong> Echec du transfert de l\'image !
                                                </div>';
                                            }
                                        } else {
                                            // Message d'erreur la description est trop longue
                                            $mess = '<div class="col-4 alert alert-danger">
                                            <strong>Erreur</strong> La description est trop longue !
                                            </div>';
                                        }
                                    } else {
                                        // Message d'erreur le résumé est trop long
                                        $mess = '<div class="col-4 alert alert-danger">
                                        <strong>Erreur</strong> Le résumé est trop long !
                                        </div>';
                                    }
                                } else {
                                    // Message d'erreur le libelle est trop long
                                    $mess = '<div class="col-4 alert alert-danger">
                                    <strong>Erreur</strong> Le libelle est trop long !
                                    </div>';
                                }
                            } else {
                                // Message d'erreur la ref interne est trop longue
                                $mess = '<div class="col-4 alert alert-danger">
                                <strong>Erreur</strong> La ref interne est trop longue !
                                </div>';
                            }           
                        } else {
                            // Message d'erreur le poste n'a pas été ajouté
                            $mess = '<div class="col-4 alert alert-danger">
                            <strong>Erreur</strong> Veuillez remplir tous les champs !
                            </div>';
                        }
                    }
                }
            }
        }

        $lesCategories = CategorieManager::getLesCategories();

        $view = ROOT.'/view/addNft.php';
        // appelle la vue
        $params = array();
        $params['mess'] = $mess;
        $params['lesCategories'] = $lesCategories;
        self::render($view, $params);
    }

    /**
     * Action qui supprime un nft
     * params : tableau des paramètres
     */
    public static function delete($params){

        // Vérifie que l'utilisateur est connecté
        if(isset($_SESSION['user'])) {

            // Vérifie que l'utilisateur soit admin
            if($_SESSION['user']->getRole() == 'admin') {

                // Vérifie qu'il y a bien un id produit dans l'url
                if(isset($_GET['idP'])) {

                    // Filtre les variables GET pour enlever les caractères indésirables
                    $idProduit = nettoyer(filter_var($_GET['idP'], FILTER_VALIDATE_INT));

                    NftManager::deleteNft($idProduit);

                }  
            }
        }

        $view = ROOT.'/view/dashboard.php';
        // appelle la vue
        $params = array();
        self::render($view, $params);
    }

    /**
     * Action qui modifie un nft
     * params : tableau des paramètres
     */
    public static function edit($params){

        // Vérifie que l'utilisateur est connecté
        if(isset($_SESSION['user'])) {

            // Vérifie que l'utilisateur soit admin
            if($_SESSION['user']->getRole() == 'admin') {

                // Vérifie qu'il y a bien un id produit dans l'url
                if(isset($_GET['idP'])) {

                    // Filtre les variables GET pour enlever les caractères indésirables
                    $idProduit = nettoyer(filter_var($_GET['idP'], FILTER_VALIDATE_INT));

                    $exist = NftManager::existNft($idProduit);

                    if($exist == true) {
                        $unNft = NftManager::getUnNftById($idProduit);
                    } else {
                        $unNft = null;
                    }
                }
                $mess = '';

                $lesCategories = CategorieManager::getLesCategories();

                // Vérifie que le formulaire a été soumis
                if (isset($_POST['editSubmit'])) {

                    // Vérifie que tous les champs sont remplis
                    if(!empty($_POST['refInterne']) && isset($_POST['refInterne']) && !empty($_POST['libelle']) && isset($_POST['libelle']) && !empty($_POST['resume']) && isset($_POST['resume']) && !empty($_POST['description']) && isset($_POST['description']) && !empty($_POST['qteStock']) && isset($_POST['qteStock']) && !empty($_POST['prix']) && isset($_POST['prix']) && !empty($_POST['categorie']) && isset($_POST['categorie'])) {

                        $refInterne = nettoyer(filter_input(INPUT_POST, 'refInterne', FILTER_SANITIZE_STRING));
                        $libelle = nettoyer(filter_input(INPUT_POST, 'libelle', FILTER_SANITIZE_STRING));
                        $resume = nettoyer($_POST['resume']);
                        $description = nettoyer($_POST['description']);
                        $qteStock = nettoyer(filter_var($_POST['qteStock'], FILTER_VALIDATE_INT));
                        $prix = nettoyer(filter_var($_POST['prix'], FILTER_VALIDATE_FLOAT));
                        $categorie = nettoyer(filter_var($_POST['categorie'], FILTER_VALIDATE_INT));

                        if(strlen($refInterne) <= 32) { // Vérifie que la longueur de la ref interne soit inférieur ou égal à 32
                            if(strlen($libelle) <= 64) { // Vérifie que la longueur du libelle soit inférieur ou égal à 64
                                if(strlen($resume) <= 128) { // Vérifie que la longueur du resume soit inférieur ou égal à 128
                                    if(strlen($description) <= 256) { // Vérifie que la longueur de la description soit inférieur ou égal à 256
                                
                                        NftManager::editNft($refInterne, $libelle, $resume, $description, $qteStock, $prix, $categorie, $idProduit);
                                        
                                        // Message de succès le produit a été modifié
                                        $mess = '<div class="col-4 alert alert-success">
                                        <strong>Succès</strong> Le produit a été modifé !
                                        </div>';

                                    } else {
                                        // Message d'erreur la description est trop longue
                                        $mess = '<div class="col-4 alert alert-danger">
                                        <strong>Erreur</strong> La description est trop longue !
                                        </div>';
                                    }
                                } else {
                                    // Message d'erreur le résumé est trop long
                                    $mess = '<div class="col-4 alert alert-danger">
                                    <strong>Erreur</strong> Le résumé est trop long !
                                    </div>';
                                }
                            } else {
                                // Message d'erreur le libelle est trop long
                                $mess = '<div class="col-4 alert alert-danger">
                                <strong>Erreur</strong> Le libelle est trop long !
                                </div>';
                            }
                        } else {
                            // Message d'erreur la ref interne est trop longue
                            $mess = '<div class="col-4 alert alert-danger">
                            <strong>Erreur</strong> La ref interne est trop longue !
                            </div>';
                        }           
                    } else {
                        // Message d'erreur le poste n'a pas été modifié
                        $mess = '<div class="col-4 alert alert-danger">
                        <strong>Erreur</strong> Veuillez remplir tous les champs !
                        </div>';
                    }
                }
            }
        }
        
        $view = ROOT.'/view/editNft.php';
        // appelle la vue
        $params = array();
        $params['unNft'] = $unNft;
        $params['lesCategories'] = $lesCategories;
        $params['mess'] = $mess;
        $params['exist'] = $exist;
        self::render($view, $params);
    }
}