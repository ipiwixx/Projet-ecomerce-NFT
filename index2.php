<?php

/**
 * /index.php
 * Page d'accueil (racine du site)
 * 
 *
 * @author 1sio-slam
 * @date 05/2022
 */

// Démarre une nouvelle session ou charge la session d'un utilisateur
session_start();

// Appel tous les controller
require_once('controller/NftController.php');
require_once('controller/ClientController.php');
require_once('controller/CommandeController.php');
require_once('controller/TestController.php');

try {
    if (isset($_GET['action']) && $_GET['action'] !== '') {
        if ($_GET['action'] === 'boutique') {
            (new NftController())->ShowNfts();
        } elseif ($_GET['action'] === 'description') {
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                $identifier = $_GET['id'];
                (new NftController())->ShowDescription();
            }
        } elseif ($_GET['action'] === 'compte' && isset($_GET['id'])) {
            (new ClientController())->ShowAccount();
            /*if($_GET['id'] != $_SESSION['id']) {
                echo 'Hey id different mgl';
                header('Location: index.php?action=compte&id=' . $_SESSION['id']);
                die();
            }*/
        } elseif ($_GET['action'] === 'commandes' && isset($_GET['id'])) {
            (new NftController())->ShowNftCmd();
            (new CommandeController())->ShowCmd();
        } elseif ($_GET['action'] === 'add-fav' && isset($_GET['id']) && ($_GET['favoris'] === 'true')) {
            (new NftController())->AddFav();
        } elseif ($_GET['action'] === 'connexion') {
            (new TestController())->TestCnx();
        } elseif ($_GET['action'] === 'inscription') {
            (new TestController())->TestInscrip();
        }
    } elseif (isset($_GET['search']) && $_GET['search'] !== '') {
        (new NftController())->ShowSearch();
    } elseif ($_GET['search'] == '') {
        header('Location: index.php?action=boutique');
    } /* elseif (isset($_GET['listcat'])) {
            (new CreationController())->TrieCategorie();
            if ($_GET['listcat'] === '1') {
                (new ProduitController())->ListCatProd();
            }
            elseif ($_GET['listcat'] === 'description') {
            }
            elseif ($_GET['listcat'] === 'description') {
            }
            elseif ($_GET['listcat'] === 'description') {
            }
            elseif ($_GET['listcat'] === 'description') {
            }
            elseif ($_GET['listcat'] === 'description') {
            }
        } elseif (isset($_GET['search'])) {
            (new ProduitController())->ShowProduits();
        }
    /*} elseif (isset($_GET['trie']) && $_GET['trie'] !== '') {
        if ($_GET['trie'] === 'exclusifs') {
            (new ProduitController())->ShowExclusifs();
        } elseif ($_GET['trie'] === 'croissant') {
            (new ProduitController())->ShowCroissant();     
        } elseif ($_GET['trie'] === 'decroissant') {
            (new ProduitController())->ShowDecroissant();
        } else {
            (new ProduitController())->ShowProduits();
        }*/
    /*} elseif (isset($_GET['listcat']) && $_GET['listcat'] !== '') {
        (new ProduitController())->ShowProduits();
    } elseif (isset($_GET['search']) && $_GET['search'] !== '') {
        (new ProduitController())->ShowSearch();
    } elseif ($_GET['search'] == '') {
        header('Location: index.php?action=produit');
    } else {
        header('Location: view/accueil.php');
    } */
} catch (Exception $e) {
    $errorMessage = $e->getMessage();

    require('view/error.php');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
   
</body>
</html>