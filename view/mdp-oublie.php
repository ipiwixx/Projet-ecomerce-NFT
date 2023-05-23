<?php

/**
 * /view/mdp-oublie.php
 * 
 * Page de mot de passe oublié
 *
 * @author A. Espinoza
 * @date 04/2022
 */

if (isset($_SESSION['user'])) {
  header('Location: ' . SERVER_URL . '/erreur/');
} else {

  $title = 'Mot de passe oublié | Shiba Club Nft';
  $actifA = '';
  $actifB = '';
  $actifN = '';
  include 'header.php';
?>

  <!-- Début jumbotron -->
  <div class="jumbotron mt-5 pt-5">
    <h3 class="display-6 text-center">Mot de passe oublié ? </h3>
  </div>
  <!-- Fin jumbotron -->

  <div class="d-flex justify-content-center text-center">
    <?= $error ?>
  </div>

  <form method="POST" action="<?= SERVER_URL ?>/mot-de-passe-oublié/" class="row g-3 bg-dark m-4 py-5">
    <div class="row mt-5">
      <div class="offset-4 col-lg-4 col-6">
        <div class="form-floating mb-1">
          <input type="email" name="recup_mail" class="form-control" id="floatingInput4" placeholder="name@example.com" required pattern="^[A-Za-z0-9]+@{1}[A-Za-z]+\.{1}[A-Za-z]{2,}$">
          <label for="floatingInput4" class="text-light">Email</label>
        </div>
        <p class="text-light">Renseigner votre adresse Email pour réinitialiser votre mot de passe !</p>
      </div>
    </div>
    <div class="d-flex justify-content-center mb-5">
      <div class="col-lg-1">
        <input class="btn btn-light color-perso ms-3 mb-5" type="submit" value="Continuer" name="recup_submit">
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