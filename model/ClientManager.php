<?php

require_once 'PHPMailer/src/PHPMailer.php';
require_once 'PHPMailer/src/SMTP.php';
require_once 'PHPMailer/src/Exception.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

/**
 * /model/ClientManager.php
 *
 * Définition de la class ClientManager
 * Class qui gère les interactions entre les clients de l'application
 *  et les clients de la bdd
 *
 * @author A. Espinoza
 * @date 05/2022
 */

class ClientManager
{

    private static ?\PDO $cnx = null;
    private static Client $unClient;
    private static array $lesClients = array();


    /**
     * getLesClients
     * récupère dans la bbd tous les clients
     *
     * @return array
     */
    public static function getLesClients()
    {
        try {
            if (self::$cnx == null) {
                self::$cnx = DbManager::getConnexion();
            }

            // Requête select qui récupère toutes les informations des clients
            $sql = 'SELECT idClient, email, cpt, ville, pays, aPostale, nom, prenom, dateN, tel, mdp, roles';
            $sql .= ' FROM Client;';
            $stmt = self::$cnx->prepare($sql);
            $stmt->execute();

            self::$lesClients = array();
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            while ($row = $stmt->fetch()) {

                self::$unClient = new Client();
                self::$unClient->setId($row['idClient']);
                self::$unClient->setEmail($row['email']);
                self::$unClient->setCpt($row['cpt']);
                self::$unClient->setVille($row['ville']);
                self::$unClient->setPays($row['pays']);
                self::$unClient->setAdressePostale($row['aPostale']);
                self::$unClient->setNom($row['nom']);
                self::$unClient->setPrenom($row['prenom']);
                $laDateNaissance = new DateTime($row['dateN']);
                self::$unClient->setDateNaissance($laDateNaissance);
                self::$unClient->setTel($row['tel']);
                self::$unClient->setMdp($row['mdp']);
                self::$unClient->setRole($row['roles']);
                self::$lesClients[] = self::$unClient;
            }
            return self::$lesClients;
        } catch (PDOException $e) {
            die('Erreur : ' . $e->getMessage());
        }
    }

    /**
     * getLesClientsCmd
     * récupère dans la bbd tous les clients
     * qui ont fait une commande ou plus
     *
     * @return array
     */
    public static function getLesClientsCmd()
    {
        try {
            if (self::$cnx == null) {
                self::$cnx = DbManager::getConnexion();
            }

            // Requête select qui récupère toutes les informations des clients
            $sql = 'SELECT idClient, email, cpt, ville, pays, aPostale, nom, prenom, dateN, tel, mdp, roles';
            $sql .= ' FROM Client C';
            $sql .= ' WHERE EXISTS (SELECT idClient From Commande CO';
            $sql .= ' WHERE C.idClient = CO.idClient);';
            $stmt = self::$cnx->prepare($sql);
            $stmt->execute();

            self::$lesClients = array();
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            while ($row = $stmt->fetch()) {

                self::$unClient = new Client();
                self::$unClient->setId($row['idClient']);
                self::$unClient->setEmail($row['email']);
                self::$unClient->setCpt($row['cpt']);
                self::$unClient->setVille($row['ville']);
                self::$unClient->setPays($row['pays']);
                self::$unClient->setAdressePostale($row['aPostale']);
                self::$unClient->setNom($row['nom']);
                self::$unClient->setPrenom($row['prenom']);
                $laDateNaissance = new DateTime($row['dateN']);
                self::$unClient->setDateNaissance($laDateNaissance);
                self::$unClient->setTel($row['tel']);
                self::$unClient->setMdp($row['mdp']);
                self::$unClient->setRole($row['roles']);
                self::$lesClients[] = self::$unClient;
            }
            return self::$lesClients;
        } catch (PDOException $e) {
            die('Erreur : ' . $e->getMessage());
        }
    }

    /**
     * getUnClientById
     * récupère dans la bbd le client
     * avec l'id passé en paramètre
     *
     * @param int $identifier
     * @return Client
     */
    public static function getUnClientById(int $identifier): Client
    {
        try {
            if (self::$cnx == null) {
                self::$cnx = DbManager::getConnexion();
            }

            // Requête select qui récupère toutes les informations du client
            $sql = 'SELECT idClient, nom, prenom, email, mdp, tel, dateN, aPostale, ville, cpt, pays, roles FROM client';
            $sql .= ' WHERE idClient = :id_client;';
            // Gestion des erreurs par exception
            self::$cnx->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stmt = self::$cnx->prepare($sql);
            $stmt->bindParam(':id_client', $identifier, PDO::PARAM_INT);
            $stmt->execute();

            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $row = $stmt->fetch();

            self::$unClient = new Client();
            self::$unClient->setId($row['idClient']);
            self::$unClient->setEmail($row['email']);
            self::$unClient->setCpt($row['cpt']);
            self::$unClient->setVille($row['ville']);
            self::$unClient->setPays($row['pays']);
            self::$unClient->setAdressePostale($row['aPostale']);
            self::$unClient->setNom($row['nom']);
            self::$unClient->setPrenom($row['prenom']);
            $laDateNaissance = new DateTime($row['dateN']);
            self::$unClient->setDateNaissance($laDateNaissance);
            self::$unClient->setTel($row['tel']);
            self::$unClient->setMdp($row['mdp']);
            self::$unClient->setRole($row['roles']);

            return self::$unClient;
        } catch (PDOException $e) {
            die('Erreur : ' . $e->getMessage());
        }
    }

    /**
     * getUnClientByEmail
     * récupère dans la bbd le client
     * avec l'email passé en paramètre
     *
     * @param string $email
     * @return Client
     */
    public static function getUnClientByEmail(string $email): Client
    {
        try {
            if (self::$cnx == null) {
                self::$cnx = DbManager::getConnexion();
            }

            // Requête select qui récupère toutes les informations du client
            $sql = 'SELECT idClient, nom, prenom, email, mdp, tel, dateN, aPostale, ville, cpt, pays, roles FROM client';
            $sql .= ' WHERE email = :email;';
            // Gestion des erreurs par exception
            self::$cnx->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stmt = self::$cnx->prepare($sql);
            $stmt->bindParam(':email', $email, PDO::PARAM_STR);
            $stmt->execute();

            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $row = $stmt->fetch();

            self::$unClient = new Client();
            self::$unClient->setId($row['idClient']);
            self::$unClient->setEmail($row['email']);
            self::$unClient->setCpt($row['cpt']);
            self::$unClient->setVille($row['ville']);
            self::$unClient->setPays($row['pays']);
            self::$unClient->setAdressePostale($row['aPostale']);
            self::$unClient->setNom($row['nom']);
            self::$unClient->setPrenom($row['prenom']);
            $laDateNaissance = new DateTime($row['dateN']);
            self::$unClient->setDateNaissance($laDateNaissance);
            self::$unClient->setTel($row['tel']);
            self::$unClient->setMdp($row['mdp']);
            self::$unClient->setRole($row['roles']);

            return self::$unClient;
        } catch (PDOException $e) {
            die('Erreur : ' . $e->getMessage());
        }
    }

    /**
     * ChangeInformations
     * change les informations du client
     * selon ce qu'il aura complété dans l'espace compte
     *
     * @param string $nom
     * @param string $prenom
     * @param string $pays
     * @param int $cp
     * @param string $ville
     * @param string $tel
     * @param string $aPostale
     * @param string $dateN
     * @return void
     */
    public static function changeInformations(string $nom, string $prenom, string $pays, int $cp, string $ville, string $tel, string $aPostale, string $dateN): void
    {
        try {
            if (self::$cnx == null) {
                self::$cnx = DbManager::getConnexion();
            }

            // Requête update qui modifie les valeurs de l'utilisateurs
            $sql = 'UPDATE client SET pays = :pays, nom = :nom, prenom = :prenom, dateN = :dateN, tel = :tel, ville = :ville, cpt = :cpt, aPostale = :aPostale';
            $sql .= ' WHERE idClient = :param_id;';
            $stmt = self::$cnx->prepare($sql);
            $stmt->bindParam(':pays', $pays, PDO::PARAM_STR);
            $stmt->bindParam(':nom', $nom, PDO::PARAM_STR);
            $stmt->bindParam(':prenom', $prenom, PDO::PARAM_STR);
            $stmt->bindParam(':dateN', $dateN, PDO::PARAM_STR);
            $stmt->bindParam(':tel', $tel, PDO::PARAM_STR);
            $stmt->bindParam(':ville', $ville, PDO::PARAM_STR);
            $stmt->bindParam(':cpt', $cp, PDO::PARAM_INT);
            $stmt->bindParam(':aPostale', $aPostale, PDO::PARAM_STR);
            $stmt->bindParam(':param_id', $_SESSION['id'], PDO::PARAM_INT);

            // Exécution de la requête
            $stmt->execute();

            $_SESSION['nom'] = $nom;
        } catch (PDOException $e) {
            die('Erreur : ' . $e->getMessage());
        }
    }

    /**
     * ChangeAdresse
     * change les informations du client pour la livraison
     * selon ce qu'il aura complété pour le paiement
     *
     * @param string
     * @param string
     * @param int
     * @return void
     */
    public static function changeAdresse(string $adresse, string $ville, int $cp): void
    {
        try {
            if (self::$cnx == null) {
                self::$cnx = DbManager::getConnexion();
            }

            // Requête update qui modifie les informations du client
            $sql = "UPDATE client SET ville = :ville, cpt = :cpt, aPostale = :aPostale";
            $sql .= " WHERE idClient = :param_id;";
            $stmt = self::$cnx->prepare($sql);
            $stmt->bindParam(':ville', $ville, PDO::PARAM_STR);
            $stmt->bindParam(':cpt', $cp, PDO::PARAM_INT);
            $stmt->bindParam(':aPostale', $adresse, PDO::PARAM_STR);
            $stmt->bindParam(':param_id', $_SESSION['id'], PDO::PARAM_INT);
            // Exécution de la requête
            $stmt->execute();
        } catch (PDOException $e) {
            die('Erreur : ' . $e->getMessage());
        }
    }

    /**
     * ChangePassword
     * change le mot de passe du client
     *
     * @param string $mdp
     * @param string $newMdp
     * @return string
     */
    public static function changePassword(string $mdp, string $newMdp): string
    {
        try {
            if (self::$cnx == null) {
                self::$cnx = DbManager::getConnexion();
            }

            $mess = '';

            // Requête select qui récupère l'id et le mdp du utilisateurs
            $sql = 'SELECT idClient, mdp FROM client WHERE idClient = :param_id';
            $stmt = self::$cnx->prepare($sql);
            $stmt->bindParam(':param_id', $_SESSION['id'], PDO::PARAM_INT);
            $stmt->execute();
            $row = $stmt->fetch();
            $hash = $row['mdp'];
            $resultAuth = password_verify($mdp, $hash);

            // Vérifie si l'ancien mot de passe correspond bien
            if ($resultAuth) {

                // On hash le mot de passe avec Bcrypt, via un coût de 12
                $cost = ['cost' => 12];
                $newMdp = password_hash($newMdp, PASSWORD_BCRYPT, $cost);

                // Requête update qui modifie le mdp du client
                $sql = "UPDATE client SET mdp = :mdp";
                $sql .= " WHERE idClient = :param_id;";
                $stmt = self::$cnx->prepare($sql);
                $stmt->bindParam(':mdp', $newMdp, PDO::PARAM_STR);
                $stmt->bindParam(':param_id', $_SESSION['id'], PDO::PARAM_INT);
                // Exécution de la requête
                $stmt->execute();

                // Message de succès
                $mess = '<div class="alert alert-success">
                <strong>Succès</strong> Modification du mot de passe réussie !
                </div>';
            } else {
                $mess = '<div class="alert alert-danger">
                <strong>Erreur</strong> Mot de passe incorrect !
                </div>';
            }

            return $mess;
        } catch (PDOException $e) {
            die('Erreur : ' . $e->getMessage());
        }
    }

    /**
     * newsletterSub
     * inscrit l'utilisateur à la newsletter
     *
     * @param string $email
     * @return void
     */
    public static function newsletterSub(string $email): void
    {
        try {
            if (self::$cnx == null) {
                self::$cnx = DbManager::getConnexion();
            }

            // Requête select qui récupère l'id du client
            $sql = 'SELECT idClient FROM client WHERE email = :param_email';
            $stmt = self::$cnx->prepare($sql);
            $stmt->bindParam(':param_email', $email, PDO::PARAM_STR);
            $stmt->execute();

            $row = $stmt->fetch();
            // Le client existe
            if ($row == 1) {

                // Requête update qui modifie la newsletter
                $sql = "UPDATE client SET newsletter = 1";
                $sql .= " WHERE email = :param_email;";
                $stmt = self::$cnx->prepare($sql);
                $stmt->bindParam(':param_email', $email, PDO::PARAM_STR);
                // Exécution de la requête
                $stmt->execute();
            }
        } catch (PDOException $e) {
            die('Erreur : ' . $e->getMessage());
        }
    }

    /**
     * recupMdp
     * vérifie si l'email existe
     * puis envoie un code par mail pour récupérer son mot de passe
     *
     * @return string
     */
    public static function recupMdp(): string
    {
        try {
            if (self::$cnx == null) {
                self::$cnx = DbManager::getConnexion();
            }

            $error = '';

            // Vérifie que tous les champs sont remplis
            if (isset($_POST['recup_submit']) && isset($_POST['recup_mail'])) {

                // Filtre les input de type poste pour enlever les caractères indésirables
                $recupMail = filter_input(INPUT_POST, 'recup_mail', FILTER_DEFAULT);

                // Vérifie que l'email est de la bonne forme
                if (filter_var($recupMail, FILTER_VALIDATE_EMAIL)) {

                    // Requête select qui récupère toutes les informations de l'utilisateur
                    $sql = 'SELECT idClient, nom, prenom, email FROM client WHERE email = :param_email;';
                    self::$cnx->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                    $stmt = self::$cnx->prepare($sql);
                    $stmt->bindParam(':param_email', $recupMail, PDO::PARAM_STR);
                    $stmt->execute();
                    $row = $stmt->rowCount();
                    $_SESSION['recup_mail'] = $recupMail;

                    // Si la requete renvoie un 0 alors l'utilisateur n'existe pas
                    if ($row == 1) {
                        $fetch = $stmt->fetch();
                        $nom = $fetch['nom'];
                        $prenom = $fetch['prenom'];

                        $recupCode = "";

                        // Créer un code aléatoire de 8 chiffre
                        for ($i = 0; $i < 8; $i++) {
                            $recupCode .= mt_rand(0, 9);
                        }

                        // Requête select qui récupère l'id recupération de l'utilisateur
                        $mailRecupExist = 'SELECT idRecup FROM recuperation WHERE mail = :mail;';
                        $stmt = self::$cnx->prepare($mailRecupExist);
                        $stmt->bindParam(':mail', $recupMail, PDO::PARAM_STR);
                        $stmt->execute();
                        $row = $stmt->rowCount();

                        // L'utilisateur à déja un code de recup donc on update
                        if ($row == 1) {

                            // Requête update qui modifie le code de l'utilisateur
                            $recupUpdate = 'UPDATE recuperation SET code = :code WHERE mail = :mail;';
                            $stmt = self::$cnx->prepare($recupUpdate);
                            $stmt->bindParam(':code', $recupCode, PDO::PARAM_INT);
                            $stmt->bindParam(':mail', $recupMail, PDO::PARAM_STR);
                            $stmt->execute();

                            // L'utilisateur n'a pas de code de recup
                        } else {

                            // Requête insert qui insère un code à l'utilisateur
                            $recupInsert = 'INSERT INTO recuperation (mail, code) VALUES (:email, :code);';
                            $stmt = self::$cnx->prepare($recupInsert);
                            $stmt->bindParam(':email', $recupMail, PDO::PARAM_STR);
                            $stmt->bindParam(':code', $recupCode, PDO::PARAM_INT);
                            $stmt->execute();
                        }

                        // Crée une instance de PHPMailer
                        $mail = new PHPMailer(true);

                        $mail->isSMTP(); // Active l'envoi via SMTP
                        $mail->Host = 'sandbox.smtp.mailtrap.io'; // Adresse du serveur SMTP
                        $mail->SMTPAuth = true; // Activation de l'authentification SMTP
                        $mail->Username = '14d4bc1fa326d5'; // Nom d'utilisateur SMTP
                        $mail->Password = '5aaad707afb027'; // Mot de passe SMTP
                        $mail->SMTPSecure = 'tls'; // Type de sécurité SMTP (tls ou ssl)
                        $mail->Port = 2525; // Port SMTP
                        $mail->CharSet = 'UTF-8';
                        $mail->isHTML(true);

                        // Paramètres de base
                        $mail->setFrom('support.shibaclubnft@gmail.com', 'Shiba Club NFT');
                        $mail->addAddress($_SESSION['recup_mail'], $nom . ' ' . $prenom);

                        $mail->AddEmbeddedImage("img/accueil/slide3.png", "logo", "slide3.png");
                        $mail->AddEmbeddedImage("img/icon.ico", "icon", "icon.ico");

                        // Envoie un email de récupération de mot de passe
                        $mail->Subject = 'Récupération de mot de passe Shiba Club NFT';
                        $mail->Body = '<!DOCTYPE html>
                        <head>
                            <title>Récupération de mot de passe - shybaclubnft.fr</title>
                            <meta charset="utf-8" />
                        </head>
                        <body>
                            <div style="padding: 0 10% 0 15%;">
                                <div style="justify-content: center;display: flex;text-align: center;">
                                    <img src="cid:logo" alt="shiba_logo" style="width: 60%;">
                                </div>
                                <div>
                                    <br />
                                    Bonjour <b>' . $prenom . ' ' . $nom . '</b>,<br /><br />
                                    Nous avons bien reçu votre demande de réinitialisation de votre mot de passe pour accéder à votre compte. Afin de procéder à cette réinitialisation, nous vous envoyons un code de vérification unique : <b>' . $recupCode . '.</b><br /><br />
                                    Veuillez ne pas partager ce code confidentiel avec qui que ce soit.<br /><br />
                                    Cordialement,<br /><br />
                                    La Team Shiba Club NFT<br /><br /><br /><br />
                                </div>
                                <div style="text-align: center;">
                                    <hr>
                                    <font size="2">
                                        Ceci est un email automatique, merci de ne pas y répondre
                                    </font>
                                </div>
                                <div style="justify-content: center;display: flex;text-align: center;margin-top: 5%;">
                                    <img src="cid:icon" alt="shiba_icon" style="width: 40%;">
                                </div>
                            </div>
                        </body>
                        </html>';

                        $mail->AltBody = 'Bonjour <b>' . $prenom . ' ' . $nom . '</b>,

                        Nous avons bien reçu votre demande de réinitialisation de votre mot de passe pour accéder à votre compte. Afin de procéder à cette réinitialisation, nous vous envoyons un code de vérification unique : <b>' . $recupCode . '.</b>

                        Veuillez ne pas partager ce code confidentiel avec qui que ce soit.

                        Cordialement,

                        La Team Webylo';

                        // Envoyer le message et vérifier si l'envoi a réussi
                        if ($mail->send()) {
                            $msg = 'Le message a été envoyé avec succès !';
                        } else {
                            $msg = 'Une erreur s\'est produite lors de l\'envoi du message : ' . $mail->ErrorInfo;
                        }

                        header('Location: ' . SERVER_URL . '/mot-de-passe-oublié-code/');
                    }
                    header('Location: ' . SERVER_URL . '/mot-de-passe-oublié-code/');
                }
            }

            // Vérifie que tous les champs sont remplis
            if (isset($_POST['verif_submit']) && isset($_POST['verif_code'])) {

                // Si le champ n'est pas vide
                if (!empty($_POST['verif_code'])) {

                    // Filtre les input de type poste pour enlever les caractères indésirables
                    $verifCode = filter_input(INPUT_POST, 'verif_code', FILTER_DEFAULT);

                    // Récupère l'adresse ip de l'utilisateur qui essaye de se connecter
                    $ip = isset($_SERVER['HTTP_CLIENT_IP']) ? $_SERVER['HTTP_CLIENT_IP'] : (isset($_SERVER['HTTP_X_FORWARDED_FOR']) ? $_SERVER['HTTP_X_FORWARDED_FOR'] : $_SERVER['REMOTE_ADDR']);

                    date_default_timezone_set('Europe/Paris');
                    $dateC = new DateTime();
                    $dateC = $dateC->format('Y-m-d H:i:s');

                    // Requête delete qui supprime les anciennes log de connexion
                    $sql = 'DELETE FROM logins';
                    $sql .= ' WHERE created_at < DATE_SUB(NOW(), INTERVAL 5 MINUTE);';
                    $stmt = self::$cnx->prepare($sql);
                    $stmt->execute();

                    // Requête select qui récupère le nombre de tentative de connexion d'une ip et d'un mail
                    $sql = 'SELECT COUNT(*) AS NbTentative FROM logins';
                    $sql .= ' WHERE ip = :ip and email = :email and created_at BETWEEN DATE_SUB(NOW(), INTERVAL 5 MINUTE) AND NOW();';
                    $stmt = self::$cnx->prepare($sql);
                    $stmt->bindParam(':ip', $ip, PDO::PARAM_STR);
                    $stmt->bindParam(':email', $_SESSION['recup_mail'], PDO::PARAM_STR);
                    $stmt->execute();
                    $row = $stmt->fetch();

                    if ($row['NbTentative'] < 3) {

                        // Requête select qui récupère toutes les informations de l'utilisateur
                        $verifReq = 'SELECT idRecup, mail, code FROM recuperation WHERE mail = :email and code = :code;';
                        $stmt = self::$cnx->prepare($verifReq);
                        $stmt->bindParam(':email', $_SESSION['recup_mail'], PDO::PARAM_STR);
                        $stmt->bindParam(':code', $verifCode, PDO::PARAM_INT);
                        $stmt->execute();
                        $row = $stmt->rowCount();

                        // Si le code de recup est bon pour l'email
                        if ($row == 1) {

                            // Requête update pour modifié le champ confirme (le code est bon)
                            $updateReq = 'UPDATE recuperation SET confirme = 1 WHERE mail = :email';
                            $stmt = self::$cnx->prepare($updateReq);
                            $stmt->bindParam(':email', $_SESSION['recup_mail'], PDO::PARAM_STR);
                            $stmt->execute();
                            header('Location: ' . SERVER_URL . '/change-mot-de-passe/');
                        } else {
                            $error = '<div class="alert alert-danger">
                            <strong>Erreur</strong> Code invalide !
                            </div>';

                            // Requête insert qui insère une connexion
                            $sql = 'INSERT INTO logins (created_at, email, ip) VALUES';
                            $sql .= ' (:created_at, :email, :ip);';
                            $stmt = self::$cnx->prepare($sql);
                            $stmt->bindParam(':created_at', $dateC, PDO::PARAM_STR);
                            $stmt->bindParam(':email', $_SESSION['recup_mail'], PDO::PARAM_STR);
                            $stmt->bindParam(':ip', $ip, PDO::PARAM_STR);
                            $stmt->execute();
                        }
                    } else {
                        $error = '<div class="alert alert-danger">
                        <strong>Erreur</strong> Trop de tentatives. Réessayer dans 5 minutes !
                        </div>';
                    }
                } else {
                    $error = '<div class="alert alert-danger">
                    <strong>Erreur</strong> Veuillez entrer votre code de confirmation !
                    </div>';
                }
            }

            if (isset($_POST['change_submit'])) {

                // Vérifie que tous les champs sont remplis
                if (isset($_POST['change_mdp']) && isset($_POST['change_mdpc'])) {

                    // Requête select qui récupère le champ confirme de l'utilisateur
                    $verifConfirme = 'SELECT confirme FROM recuperation WHERE mail = :email';
                    $stmt = self::$cnx->prepare($verifConfirme);
                    $stmt->bindParam(':email', $_SESSION['recup_mail'], PDO::PARAM_STR);
                    $stmt->execute();
                    $fetch = $stmt->fetch();
                    $verifConf = $fetch['confirme'];

                    // Si le code de recup est bon (confirme = 1)
                    if ($verifConf == 1) {

                        // Filtre les input de type poste pour enlever les caractères indésirables
                        $mdp = filter_input(INPUT_POST, 'change_mdp', FILTER_DEFAULT);
                        $mdpc = filter_input(INPUT_POST, 'change_mdpc', FILTER_DEFAULT);

                        // Si les champs sont pas vide
                        if (!empty($mdp) && !empty($mdpc)) {

                            // Vérifie que les 2 mot de passes correspondent
                            if ($mdp == $mdpc) {

                                $cost = ['cost' => 12];
                                // Hash le mot de passe
                                $mdp = password_hash($mdp, PASSWORD_BCRYPT, $cost);

                                // Requête update qui modifie le mot de passe de l'utilisateur
                                $insertMdp = 'UPDATE client SET mdp = :mdp WHERE email = :email';
                                $stmt = self::$cnx->prepare($insertMdp);
                                $stmt->bindParam(':mdp', $mdp, PDO::PARAM_STR);
                                $stmt->bindParam(':email', $_SESSION['recup_mail'], PDO::PARAM_STR);
                                $stmt->execute();

                                // Requête delete qui supprime la recuperation de l'utilisateur
                                $delReq = 'DELETE FROM recuperation WHERE mail = :email';
                                $stmt = self::$cnx->prepare($delReq);
                                $stmt->bindParam(':email', $_SESSION['recup_mail'], PDO::PARAM_STR);
                                $stmt->execute();

                                header('Location: ' . SERVER_URL . '/connexion/');
                            } else {
                                $error = '<div class="alert alert-danger">
                                <strong>Erreur</strong> Vos mots de passes ne correspondent pas !
                                </div>';
                            }
                        } else {
                            $error = '<div class="alert alert-danger">
                            <strong>Erreur</strong> Veuillez remplir tous les champs !
                            </div>';
                        }
                    } else {
                        $error = '<div class="alert alert-danger">
                        <strong>Erreur</strong> Veuillez valider votre email grâce au code vérification !
                        </div>';
                    }
                } else {
                    $error = '<div class="alert alert-danger">
                    <strong>Erreur</strong> Veuillez remplir tous les champs !
                    </div>';
                }
            }

            return $error;
        } catch (PDOException $e) {
            die('Erreur : ' . $e->getMessage());
        }
    }

    /**
     * testLaConnexion
     * teste la connexion de l'utilisateur
     *
     * @param string $email
     * @param string $mdp
     * @return string
     */
    public static function testLaConnexion(string $email, string $mdp): string
    {
        try {
            if (self::$cnx == null) {
                self::$cnx = DbManager::getConnexion();
            }

            $mess = '';

            // Récupère l'adresse ip de l'utilisateur qui essaye de se connecter
            $ip = isset($_SERVER['HTTP_CLIENT_IP']) ? $_SERVER['HTTP_CLIENT_IP'] : (isset($_SERVER['HTTP_X_FORWARDED_FOR']) ? $_SERVER['HTTP_X_FORWARDED_FOR'] : $_SERVER['REMOTE_ADDR']);

            date_default_timezone_set('Europe/Paris');
            $dateC = new DateTime();
            $dateC = $dateC->format('Y-m-d H:i:s');

            // Requête delete qui supprime les anciennes log de connexion
            $sql = 'DELETE FROM logins';
            $sql .= ' WHERE created_at < DATE_SUB(NOW(), INTERVAL 5 MINUTE);';
            $stmt = self::$cnx->prepare($sql);
            $stmt->execute();

            // Requête select qui récupère le nombre de tentative de connexion d'une ip et d'un mail
            $sql = 'SELECT COUNT(*) AS NbTentative FROM logins';
            $sql .= ' WHERE ip = :ip and email = :email and created_at BETWEEN DATE_SUB(NOW(), INTERVAL 5 MINUTE) AND NOW();';
            $stmt = self::$cnx->prepare($sql);
            $stmt->bindParam(':ip', $ip, PDO::PARAM_STR);
            $stmt->bindParam(':email', $email, PDO::PARAM_STR);
            $stmt->execute();
            $row = $stmt->fetch();

            if ($row['NbTentative'] < 3) {

                // Requête select qui récupère l'id, le mdp et le nom du client
                $sql = 'SELECT idClient, mdp, nom FROM client WHERE email = :param_email';
                $stmt = self::$cnx->prepare($sql);
                $stmt->bindParam(':param_email', $email, PDO::PARAM_STR);
                $stmt->execute();
                $row = $stmt->fetch();
                $count = $stmt->rowCount();

                if ($count > 0) {
                    $hash = $row['mdp'];
                    $id = $row['idClient'];
                    $nom = $row['nom'];

                    // Vérifie les 2 mots de passes
                    $resultAuth = password_verify($mdp, $hash);

                    // Si l'utilisateur a coché "se souvenir de moi"
                    if (isset($_POST['remember'])) {
                        $keyCookie = 'gK/9NcMJdNxJTtmp0SBa7w==xLCs.xunD9uNzief2gw9Qh.ZP7vuoCOCS3l';
                        $emailC = openssl_encrypt($email, "AES-128-ECB", $keyCookie);
                        $mdpC = openssl_encrypt($mdp, "AES-128-ECB", $keyCookie);
                        setcookie('comail', $emailC, time() + 3600 * 24 * 100, '/', '', false, true);
                        setcookie('copassword', $mdpC, time() + 3600 * 24 * 100, '/', '', false, true);
                    } else {
                        if (isset($_COOKIE['copassword']) && isset($_COOKIE['comail'])) {
                            setcookie('comail', '', -1, '/', '', false, true);
                            setcookie('copassword', '', -1, '/', '', false, true);
                        }
                    }

                    // Les 2 mots de passes correspondent
                    if ($resultAuth) {
                        $_SESSION['LOGGED_USER'] = $email;
                        $_SESSION['id'] = $id;
                        $_SESSION['nom'] = $nom;
                        $_SESSION['user'] = ClientManager::getUnClientById($id);

                        // Message de succès de connexion
                        $mess = '<div class="col-4 alert alert-success">
                        <strong>Succès</strong> Connexion réussie !
                        </div>';

                        header('Location: ' . SERVER_URL);
                    } else {
                        // Message d'erreur de connexion
                        $mess = '<div class="col-4 alert alert-danger">
                        <strong>Erreur</strong> Identifiants incorrect !
                        </div>';

                        // Requête insert qui insère une connexion
                        $sql = 'INSERT INTO logins (created_at, email, ip) VALUES';
                        $sql .= ' (:created_at, :email, :ip);';
                        $stmt = self::$cnx->prepare($sql);
                        $stmt->bindParam(':created_at', $dateC, PDO::PARAM_STR);
                        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
                        $stmt->bindParam(':ip', $ip, PDO::PARAM_STR);
                        $stmt->execute();
                    }
                } else {
                    // Message d'erreur de connexion
                    $mess = '<div class="col-4 alert alert-danger">
                    <strong>Erreur</strong> Identifiants incorrect !
                    </div>';

                    // Requête insert qui insère une connexion
                    $sql = 'INSERT INTO logins (created_at, email, ip) VALUES';
                    $sql .= ' (:created_at, :email, :ip);';
                    $stmt = self::$cnx->prepare($sql);
                    $stmt->bindParam(':created_at', $dateC, PDO::PARAM_STR);
                    $stmt->bindParam(':email', $email, PDO::PARAM_STR);
                    $stmt->bindParam(':ip', $ip, PDO::PARAM_STR);
                    $stmt->execute();
                }
            } else {
                // Message d'erreur de connexion
                $mess = '<div class="col-4 alert alert-danger">
                <strong>Erreur</strong> Trop de tentatives. Réessayer dans 5 minutes !
                </div>';
            }


            return $mess;
        } catch (PDOException $e) {
            die('Erreur : ' . $e->getMessage());
        }
    }

    /**
     * testInscription
     * teste l'inscription de l'utilisateur
     *
     * @param string $email
     * @param string $nom
     * @param string $prenom
     * @param string $pays
     * @param string $dateN
     * @param string $mdp
     * @param string $tel
     * @return string
     */
    public static function testInscription(string $email, string $nom, string $prenom, string $pays, string $dateN, string $mdp, string $tel): string
    {
        try {
            if (self::$cnx == null) {
                self::$cnx = DbManager::getConnexion();
            }
            $mess = '';

            // Requête select qui récupère toutes les informations du client
            $sql = 'SELECT nom, prenom, email, mdp FROM client WHERE email = :param_email';
            $stmt = self::$cnx->prepare($sql);
            $stmt->bindParam(':param_email', $email, PDO::PARAM_STR);
            $stmt->execute();
            $row = $stmt->rowCount();

            // Si la requete renvoie un 0 alors l'utilisateur n'existe pas
            if ($row == 0) {

                // On hash le mot de passe avec Bcrypt, via un coût de 12
                $cost = ['cost' => 12];
                $mdp = password_hash($mdp, PASSWORD_BCRYPT, $cost);
                $roles = 'user';

                // Requête insert qui insère un nouveau client
                $sql = "INSERT INTO `client` (`email`, `pays`, `nom`, `prenom`, `dateN`, `tel`, `mdp`, `roles`) VALUES
                (:email, :pays, :nom, :prenom, :dateN, :tel, :mdp, :roles);";
                $stmt = self::$cnx->prepare($sql);
                $stmt->bindParam(':email', $email, PDO::PARAM_STR);
                $stmt->bindParam(':pays', $pays, PDO::PARAM_STR);
                $stmt->bindParam(':nom', $nom, PDO::PARAM_STR);
                $stmt->bindParam(':prenom', $prenom, PDO::PARAM_STR);
                $stmt->bindParam(':dateN', $dateN, PDO::PARAM_STR);
                $stmt->bindParam(':tel', $tel, PDO::PARAM_STR);
                $stmt->bindParam(':mdp', $mdp, PDO::PARAM_STR);
                $stmt->bindParam(':roles', $roles, PDO::PARAM_STR);
                // Exécution de la requête
                $stmt->execute();

                // On affiche le message de succès
                $mess = '<div class="alert alert-success">
                <strong>Succès</strong> Inscription réussie !
                </div>';
            } else {
                // Message d'erreur, l'utilisateur existe déjà
                $mess = '<div class="alert alert-danger">
                <strong>Erreur</strong> Compte déjà existant
                </div>';
            }

            return $mess;
        } catch (PDOException $e) {
            die('Erreur : ' . $e->getMessage());
        }
    }

    /**
     * existClient
     * vérifie si le client existe
     *
     * @param int $idClient
     * @return bool
     */
    public static function existClient(int $idClient): bool
    {
        try {
            if (self::$cnx == null) {
                self::$cnx = DbManager::getConnexion();
            }
            $exist = false;

            // Requête select qui récupère toutes les informations du client
            $sql = 'SELECT idClient, email, cpt, ville, pays, aPostale, nom, prenom, dateN, tel, mdp, roles';
            $sql .= ' FROM client';
            $sql .= ' WHERE idClient = :idClient';
            $stmt = self::$cnx->prepare($sql);
            $stmt->bindParam(':idClient', $idClient, PDO::PARAM_INT);
            $stmt->execute();
            $row = $stmt->rowCount();

            // Le client existe
            if ($row == 1) {
                $exist = true;
            }

            return $exist;
        } catch (PDOException $e) {
            die('Erreur : ' . $e->getMessage());
        }
    }

    /**
     * deleteClient
     * supprime le client avec l'id passé en paramètre
     *
     * @param int $idClient
     * @return void
     */
    public static function deleteClient(int $idClient): void
    {
        try {
            if (self::$cnx == null) {
                self::$cnx = DbManager::getConnexion();
            }

            // Requête delete qui supprime la commande du client
            $sql = 'DELETE FROM commande';
            $sql .= ' WHERE idClient = :idC;';
            $stmt = self::$cnx->prepare($sql);
            $stmt->bindParam(':idC', $idClient, PDO::PARAM_INT);
            $stmt->execute();

            // Requête delete qui supprime le panier du client
            $sql = 'DELETE FROM panier';
            $sql .= ' WHERE idClient = :idC;';
            $stmt = self::$cnx->prepare($sql);
            $stmt->bindParam(':idC', $idClient, PDO::PARAM_INT);
            $stmt->execute();

            // Requête delete qui supprime les favoris du client
            $sql = 'DELETE FROM favoris';
            $sql .= ' WHERE idClient = :idC;';
            $stmt = self::$cnx->prepare($sql);
            $stmt->bindParam(':idC', $idClient, PDO::PARAM_INT);
            $stmt->execute();

            // Requête delete qui supprime le client
            $sql = 'DELETE FROM client';
            $sql .= ' WHERE idClient = :idC;';
            $stmt = self::$cnx->prepare($sql);
            $stmt->bindParam(':idC', $idClient, PDO::PARAM_INT);
            $stmt->execute();
        } catch (PDOException $e) {
            die('Erreur : ' . $e->getMessage());
        }
    }

    /**
     * addClient
     * ajoute le client avec les valeurs saisies en paramètre
     *
     * @param string $nom
     * @param string $prenom
     * @param string $email
     * @param string $pays
     * @param string $dateN
     * @param string $mdp
     * @param string $tel
     * @return string
     */
    public static function addClient(string $nom, string $prenom, string $email, string $pays, string $dateN, string $mdp, string $tel): string
    {
        try {
            if (self::$cnx == null) {
                self::$cnx = DbManager::getConnexion();
            }
            $mess = '';

            // Requête select qui récupère toutes les informations du client
            $sql = 'SELECT nom, prenom, email, mdp FROM client WHERE email = :param_email';
            $stmt = self::$cnx->prepare($sql);
            $stmt->bindParam(':param_email', $email, PDO::PARAM_STR);
            $stmt->execute();
            $row = $stmt->rowCount();

            // Si la requete renvoie un 0 alors l'utilisateur n'existe pas
            if ($row == 0) {

                // On hash le mot de passe avec Bcrypt, via un coût de 12
                $cost = ['cost' => 12];
                $mdp = password_hash($mdp, PASSWORD_BCRYPT, $cost);
                $roles = 'user';

                // Requête insert qui insère un nouveau client
                $sql = 'INSERT INTO `client` (`nom`, `prenom`, `email`, `pays`, `dateN`, `mdp`, `tel`, `roles`) VALUES';
                $sql .= ' (:nom, :prenom, :email, :pays, :dateN, :mdp, :tel, :role);';
                $stmt = self::$cnx->prepare($sql);
                $stmt->bindParam(':nom', $nom, PDO::PARAM_STR);
                $stmt->bindParam(':prenom', $prenom, PDO::PARAM_STR);
                $stmt->bindParam(':email', $email, PDO::PARAM_STR);
                $stmt->bindParam(':pays', $pays, PDO::PARAM_STR);
                $stmt->bindParam(':dateN', $dateN, PDO::PARAM_STR);
                $stmt->bindParam(':mdp', $mdp, PDO::PARAM_STR);
                $stmt->bindParam(':role', $roles, PDO::PARAM_STR);
                $stmt->bindParam(':tel', $tel, PDO::PARAM_STR);
                $stmt->execute();

                // Message de succès le client a été ajouté
                $mess = '<div class="col-4 alert alert-success">
                <strong>Succès</strong> Le client a été ajouté !
                </div>';
            } else {
                // Message d'erreur, l'utilisateur existe déjà
                $mess = '<div class="alert alert-danger">
                <strong>Erreur</strong> Compte déjà existant
                </div>';
            }

            return $mess;
        } catch (PDOException $e) {
            die('Erreur : ' . $e->getMessage());
        }
    }

    /**
     * editClient
     * modifie le client avec les valeurs saisies en paramètre
     *
     * @param string $nom
     * @param string $prenom
     * @param string $email
     * @param string $pays
     * @param string $dateN
     * @param string $mdp
     * @param string $tel
     * @param int $idClient
     * @return void
     */
    public static function editClient(string $nom, string $prenom, string $email, string $pays, string $dateN, string $mdp, string $tel, int $idClient): void
    {
        try {
            if (self::$cnx == null) {
                self::$cnx = DbManager::getConnexion();
            }

            // On hash le mot de passe avec Bcrypt, via un coût de 12
            $cost = ['cost' => 12];
            $mdp = password_hash($mdp, PASSWORD_BCRYPT, $cost);

            // Requête update qui modifie les valeurs du client
            $sql = 'UPDATE client SET nom = :nom, prenom = :prenom, email = :email, pays = :pays, dateN = :dateN, mdp = :mdp, tel = :tel';
            $sql .= ' WHERE idClient = :idC';
            $stmt = self::$cnx->prepare($sql);
            $stmt->bindParam(':nom', $nom, PDO::PARAM_STR);
            $stmt->bindParam(':prenom', $prenom, PDO::PARAM_STR);
            $stmt->bindParam(':email', $email, PDO::PARAM_STR);
            $stmt->bindParam(':pays', $pays, PDO::PARAM_STR);
            $stmt->bindParam(':dateN', $dateN, PDO::PARAM_STR);
            $stmt->bindParam(':mdp', $mdp, PDO::PARAM_STR);
            $stmt->bindParam(':tel', $tel, PDO::PARAM_STR);
            $stmt->bindParam(':idC', $idClient, PDO::PARAM_INT);
            $stmt->execute();
        } catch (PDOException $e) {
            die('Erreur : ' . $e->getMessage());
        }
    }
}
