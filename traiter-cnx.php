<?php
session_start();
/*
 * /traiter-cnx.php
 * Page du traitement du formulaire de connexion du site Shiba Club NFT
 * 
 * @auteur: Antoine Espinoza
 * @date: 03/2022
 */


            // inclut le fichier php des fonctions utilitaires forms
            require_once './model/utils-form.php';
            // inclut le fichier php de la connexion à la bdd
            require_once './bdd-pdo.php';

            try{
                $cnx = getBddConnexion();
            } 
            catch(PDOException $e) {
                die('Erreur : ' . $e->getMessage());
            }
            
            if(isset($_POST['email']) && !empty($_POST['email']) && isset($_POST['mdp']) && !empty($_POST['mdp']))
            {
                // On nettoie les champs pour éviter des caractères indésirés
                $email = nettoyer($_POST['email']);
                $mdp = nettoyer($_POST['mdp']);

                $sql = 'SELECT idClient, mdp, nom FROM client WHERE email = :param_email';
                $stmt = $cnx->prepare($sql);
                $stmt->bindParam(':param_email', $email);
                $stmt->execute();
                $row = $stmt->fetch();
                $hash = $row['mdp'];
                $id = $row['idClient'];
                $nom = $row['nom'];
                //var_dump($hash);
                $result_auth = password_verify($mdp, $hash);

                if($result_auth)
                {
                    $_SESSION['LOGGED_USER'] = $email;
                    $_SESSION['id'] = $id;
                    $_SESSION['nom'] = $nom;
                    header('Location: view/accueil.php');
                    //header('Location: ./test1.php');

                }else{
                    header('Location: view/connexion.php?reg_err=account');
                }      
            }          
        ?>
