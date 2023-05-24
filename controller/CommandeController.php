<?php

/**
 * /controller/CommandeController.php
 *
 * Contrôleur pour l'entité Commande
 *
 * @author A. Espinoza
 * @date 05/2022
 */

class CommandeController extends Controller
{

    public static function readCmd()
    {
        $cmds = null;

        // Vérifie que l'utilisateur est connecté
        if (isset($_SESSION['user'])) {

            $cmds = CommandeManager::getLesCommandesByIdClient($_SESSION['id']);
        }

        // appelle la vue
        $view = ROOT . '/view/commandes.php';
        $params = array();
        $params['cmds'] = $cmds;
        self::render($view, $params);
    }

    public static function confirmCmd()
    {
        $lesNfts = null;
        $cmd = null;

        // Vérifie que l'utilisateur soit connecté
        if (isset($_SESSION['user'])) {

            // Vérifie qu'il y a bien un id commande dans l'url
            if (isset($_GET['idCmd'])) {

                // Filtre les variables GET pour enlever les caractères indésirables
                $idCmd = nettoyer(filter_var($_GET['idCmd'], FILTER_VALIDATE_INT));

                $exist = CommandeManager::existCmd($idCmd);

                if ($exist == true) {
                    $cmd = CommandeManager::getLaCommandeById($idCmd, $_SESSION['id']);
                    $lesNfts = NftManager::getLesNftsCmd($idCmd);
                    PanierManager::deletePanier($_SESSION['id']);
                }
            }
        }
        $_SESSION['panier'] = PanierManager::getQtePanier();

        // appelle la vue
        $view = ROOT . '/view/confirm-cmd.php';
        $params = array();
        $params['cmd'] = $cmd;
        $params['lesNfts'] = $lesNfts;
        $params['exist'] = $exist;
        self::render($view, $params);
    }
}
