<?php

/*
 * /traiter-inscrip.php
 * Page du traitement du formulaire d'inscription du site Shiba Club NFT
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
/*
            foreach($_POST as $key => $valeur)
            {
                echo 'key ='.$key.' valeur = '.$valeur;
            }
*/
            

            if(isset($_POST['email']) && !empty($_POST['email']) && isset($_POST['nom']) && !empty($_POST['nom']) && isset($_POST['pays']) && !empty($_POST['pays']) && isset($_POST['date']) && !empty($_POST['date']) && isset($_POST['mdp']) && !empty($_POST['mdp']) && isset($_POST['mdp-confirm']) && !empty($_POST['mdp-confirm']) && isset($_POST['tel']) && !empty($_POST['tel']))
            {
                // On nettoie les champs pour éviter des caractères indésirés
                $email = nettoyer($_POST['email']);
                $nom = nettoyer($_POST['nom']);
                $prenom = nettoyer($_POST['prenom']);
                $pays = nettoyer($_POST['pays']);
                $dateN = nettoyer($_POST['date']);
                $mdp = nettoyer($_POST['mdp']);
                $mdpConfirm = nettoyer($_POST['mdp-confirm']);
                $tel = nettoyer($_POST['tel']);

                // On vérifie si l'utilisateur existe
                $sql = 'SELECT nom, prenom, email, mdp FROM client WHERE email = :param_email';
                $stmt = $cnx->prepare($sql);
                $stmt->bindParam(':param_email', $email);
                $stmt->execute();
                $row = $stmt->rowCount();
                //var_dump($row);
            
            
                // Si la requete renvoie un 0 alors l'utilisateur n'existe pas 
                if($row == 0){ 
                    if(strlen($nom) <= 50){ // On verifie que la longueur du nom de famille est inférieur à 50
                        if(strlen($prenom) <= 50){ // On verifie que la longueur du prenom est inférieur à 50
                            if(strlen($email) <= 50){ // On verifie que la longueur du mail est inférieur à 50
                                if(filter_var($email, FILTER_VALIDATE_EMAIL)){ // Si l'email est de la bonne forme
                                    if(strlen($tel) <= 10){ // On verifie que la longueur du téléphone soit de 10
                                        if($mdp === $mdpConfirm){ // si les deux mdp saisis sont bon


                                            // On hash le mot de passe avec Bcrypt, via un coût de 12
                                            $cost = ['cost' => 12];
                                            $mdp = password_hash($mdp, PASSWORD_BCRYPT, $cost);
                                            //var_dump('$mdp = '.$mdp);
                                            
                                            // préparation de la requête paramètré sql insert
                                            $sql = "INSERT INTO `client` (`email`, `pays`, `nom`, `prenom`, `dateN`, `tel`, `mdp`) VALUES
                                            (:email, :pays, :nom, :prenom, :dateN, :tel, :mdp);";
                                            $stmt = $cnx->prepare($sql);
                                            $stmt->bindParam(':email', $email, PDO::PARAM_STR);
                                            $stmt->bindParam(':pays', $pays, PDO::PARAM_STR);
                                            $stmt->bindParam(':nom', $nom, PDO::PARAM_STR);
                                            $stmt->bindParam(':prenom', $prenom, PDO::PARAM_STR);
                                            $stmt->bindParam(':dateN', $dateN, PDO::PARAM_STR);
                                            $stmt->bindParam(':tel', $tel, PDO::PARAM_STR);
                                            $stmt->bindParam(':mdp', $mdp, PDO::PARAM_STR);
                                            // exécution de la requête
                                            $stmt->execute();

                                            // On redirige avec le message de succès
                                            header('Location: view/inscription.php?reg_err=success');
                                        }
                                        else{ 
                                            header('Location: view/inscription.php?reg_err=password'); die();
                                        }
                                    }else{
                                        header('Location: view/inscription.php?reg_err=tel'); die();
                                    }
                                }else{
                                    header('Location: view/inscription.php?reg_err=email'); die();
                                }
                            }else{ 
                                header('Location: view/inscription.php?reg_err=email_length'); die();
                            }
                        }else{ 
                            header('Location: view/inscription.php?reg_err=prenom_length'); die();
                        }
                    }else{ 
                        header('Location: view/inscription.php?reg_err=nom_length'); die();
                    }
                }else{
                    header('Location: view/inscription.php?reg_err=already'); die();
                }
            }
            
        ?>
