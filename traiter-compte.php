<?php

/*
 * /traiter-compte.php
 * Page du traitement de l'espace mon compte
 * 
 * @auteur: Antoine Espinoza
 * @date: 05/2022
 */


            // inclut le fichier php des fonctions utilitaires forms
            require_once 'utils-form.php';
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
            
            if(isset($_POST['email']) && !empty($_POST['email']) && isset($_POST['nom']) && !empty($_POST['nom']) && isset($_POST['pays']) && !empty($_POST['pays']) && isset($_POST['date']) && !empty($_POST['date']) && isset($_POST['mdp']) && !empty($_POST['mdp']) && isset($_POST['tel']) && !empty($_POST['tel']))
            {
                // On nettoie les champs pour éviter des caractères indésirés
                $email = nettoyer($_POST['email']);
                $nom = nettoyer($_POST['nom']);
                $prenom = nettoyer($_POST['prenom']);
                $pays = nettoyer($_POST['pays']);
                $cpt = nettoyer($_POST['cpt']);
                $mdp = nettoyer($_POST['mdp']);
                $ville = nettoyer($_POST['ville']);
                $tel = nettoyer($_POST['tel']);
                $aPosale = nettoyer($_POST['adresse']);
                $dateN = nettoyer($_POST['date']);

                // On vérifie si l'utilisateur existe
                $sql = 'SELECT idClient, nom, prenom, email, mdp FROM client';
                $sql .= ' WHERE idClient = :param_id and email = :param_email;';
                $stmt = $cnx->prepare($sql);
                $stmt->bindParam(':param_email', $email, PDO::PARAM_STR);
                $stmt->bindParam(':param_id', $_SESSION['id'], PDO::PARAM_STR);
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
                                        if(1 === $_SESSION['id']) {    
                                            // On hash le mot de passe avec Bcrypt, via un coût de 12
                                            $cost = ['cost' => 12];
                                            $mdp = password_hash($mdp, PASSWORD_BCRYPT, $cost);
                                            //var_dump('$mdp = '.$mdp);
                                            
                                            // préparation de la requête paramètré sql update
                                            $sql = "UPDATE client SET email = :email, pays = :pays, nom = :nom, prenom = :prenom, dateN = :dateN, tel = :tel, mdp = :mdp, ville = :ville, cpt = :cpt, aPostale = :aPostale";
                                            $sql .= " WHERE idClient = :param_id;";
                                            $stmt = $cnx->prepare($sql);
                                            $stmt->bindParam(':email', $email, PDO::PARAM_STR);
                                            $stmt->bindParam(':pays', $pays, PDO::PARAM_STR);
                                            $stmt->bindParam(':nom', $nom, PDO::PARAM_STR);
                                            $stmt->bindParam(':prenom', $prenom, PDO::PARAM_STR);
                                            $stmt->bindParam(':dateN', $dateN, PDO::PARAM_STR);
                                            $stmt->bindParam(':tel', $tel, PDO::PARAM_STR);
                                            $stmt->bindParam(':mdp', $mdp, PDO::PARAM_STR);
                                            $stmt->bindParam(':ville', $ville, PDO::PARAM_STR);
                                            $stmt->bindParam(':cpt', $cpt, PDO::PARAM_STR);
                                            $stmt->bindParam(':aPostale', $aPostale, PDO::PARAM_STR);
                                            $stmt->bindParam(':param_id', $_SESSION['id'], PDO::PARAM_STR);
                                            // exécution de la requête
                                            $stmt->execute();

                                            $id = $_SESSION['id'];
                                            // On redirige avec le message de succès
                                            header('Location: view/compte.php?reg_err=success&id=' . $id);
                                        } else {
                                            header('Location: index.php?action=compte&id=' . $_SESSION['id']); die();
                                        }
                                    }else{
                                        header('Location: view/compte.php?reg_err=tel&id=' . $_SESSION['id']); die();
                                    }
                                }else{
                                    header('Location: view/compte.php?reg_err=email&id=' . $_SESSION['id']); die();
                                }
                            }else{ 
                                header('Location: view/compte.php?reg_err=email_length&id=' . $_SESSION['id']); die();
                            }
                        }else{ 
                            header('Location: view/compte.php?reg_err=prenom_length&id=' . $_SESSION['id']); die();
                        }
                    }else{ 
                        header('Location: view/compte.php?reg_err=nom_length&id=' . $_SESSION['id']); die();
                    }
                }else{
                    header('Location: view/compte.php?reg_err=already&id=' . $_SESSION['id']); die();
                }
            }
            
        ?>