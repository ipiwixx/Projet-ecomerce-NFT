<?php

/**
 * /view/code-mdp-oublie.php
 * 
 * Page de confirmation de mot de passe oublié par l'envoie d'un code par mail
 *
 * @author A. Espinoza
 * @date 03/2022
 */

if (!isset($_SESSION['recup_mail'])) {
  header('Location: ' . SERVER_URL . '/erreur/');
} else {

  $title = 'Code mot de passe oublié | Shiba Club Nft';
  $actifA = '';
  $actifB = '';
  $actifN = '';
  include 'header.php';

?>

  <!-- Début jumbotron -->
  <div class="jumbotron mt-5 pt-5">
    <h3 class="display-6 text-center">Un code de vérification vous a été envoyé par mail :
      <?= $_SESSION['recup_mail'] ?>
    </h3>
    <p class="text-dark text-center"><strong>Regarder votre boîte mail</strong></p>
    <p class="text-center">Vous recevrez un code uniquement si vous avec un compte à cette adresse email</p>
  </div>
  <!-- Fin jumbotron -->

  <div class="d-flex justify-content-center text-center">
    <?= $error ?>
  </div>

  <form method="POST" action="<?= SERVER_URL ?>/mot-de-passe-oublié-code/" class="row g-3 bg-dark m-4 py-5">
    <div class="row mt-5">
      <div class="offset-4 col-lg-4">
        <div class="form-floating mb-1">
          <input type="text" name="verif_code" class="form-control" id="floatingInput4" required pattern="^[0-9]{8}$" minlength="8" maxlength="8">
          <label for="floatingInput4" class="text-light">Code</label>
        </div>
        <p class="text-light">Taper le code reçu sur votre email !</p>
      </div>
    </div>
    <div class="d-flex justify-content-center mb-5">
      <div class="col-lg-1">
        <input class="btn btn-light color-perso ms-5 mb-4" name="verif_submit" type="submit" value="Valider">
      </div>
    </div>
  </form>

  <!-- Début footer -->
  <?php
  include 'footer.php';
  ?>
  <!-- Fin footer -->

  <!-- JS Libraries -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
  </body>

  </html>
<?php } ?>