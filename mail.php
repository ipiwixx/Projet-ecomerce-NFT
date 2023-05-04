<?php 

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer-master/PHPMailer-master/src/Exception.php';
require 'PHPMailer-master/PHPMailer-master/src/PHPMailer.php';
require 'PHPMailer-master/PHPMailer-master/src/SMTP.php';

$mail = new PHPMailer();
$mail->IsSMTP();
$mail->Host = '127.0.0.1';               //Adresse IP ou DNS du serveur SMTP
$mail->Port = 3307;                          //Port TCP du serveur SMTP
$mail->SMTPAuth = 1;                        //Utiliser l'identification
$mail->CharSet = 'UTF-8';

if($mail->SMTPAuth){
   $mail->SMTPSecure = 'ssl';               //Protocole de sécurisation des échanges avec le SMTP
   $mail->Username   =  'shibaclubnfts@gmail.com';    //Adresse email à utiliser
   $mail->Password   =  'antoine13140';         //Mot de passe de l'adresse email à utiliser
}

$mail->From       =  'shibaclubnfts@gmail.com';                //L'email à afficher pour l'envoi
$mail->FromName   = 'Contact de Shiba Club NFT';      //L'alias de l'email de l'emetteur

$mail->AddAddress('bekem91822@leafzie.com');

$mail->Subject    =  'Mon sujet';                      //Le sujet du mail
$mail->WordWrap   = 50;
 $mail->Body = '<p>Coucou</p>';			       //Nombre de caracteres pour le retour a la ligne automatique
$mail->AltBody = 'Mon message à changer en brut'; 	       //Texte brut
$mail->IsHTML(false);                                  //Préciser qu'il faut utiliser le texte brut

if (!$mail->send()) {
      echo $mail->ErrorInfo;
} else{
      echo 'Message bien envoyé';
}



?>