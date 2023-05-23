<?php

/**
 * /view/connexion.php
 * 
 * Page du formulaire de connexion
 *
 * @author A. Espinoza
 * @date 01/2022
 */

if (isset($_SESSION['user'])) {
  header('Location: ' . SERVER_URL . '/');
} else {

  $title = 'Connexion | Shiba Club Nft';
  $actifA = '';
  $actifB = '';
  $actifN = '';
  include 'header.php';

?>



  <!-- Début jumbotron -->
  <div class="jumbotron mt-5 pt-5">
    <h3 class="display-6 text-center">Connectez-vous pour régler <br>vos achats plus rapidement.</h3>
    <p class="lead text-center">Connectez-vous pour voir si vous avez des articles enregistrés ou poursuivez vos achats.</p>
  </div>
  <!-- Fin jumbotron -->

  <div class="d-flex justify-content-center text-center">
    <?= $mess ?>
  </div>

  <!-- Début formulaire connexion -->
  <form class="row g-3 needs-validation bg-dark m-4 pb-5" method="POST" action="<?= SERVER_URL ?>/connexion/">
    <div class="container mt-2">
      <div class="row py-3">
        <div class="col-lg-5"></div>
        <div class="col-lg-2">
          <div class="col-lg-5"></div>
          <div class="mb-3">
            <label for="floatingInput1" class="text-light">Email</label>
            <input type="email" name="email" class="form-control" id="floatingInput1" placeholder="name@example.com" value="<?php if (isset($_COOKIE['comail'])) {
                                                                                                                              $decrypted_chaine = openssl_decrypt($_COOKIE['comail'], 'AES-128-ECB', 'gK/9NcMJdNxJTtmp0SBa7w==xLCs.xunD9uNzief2gw9Qh.ZP7vuoCOCS3l');
                                                                                                                              echo $decrypted_chaine;
                                                                                                                            } ?>" required>
          </div>
        </div>
        <div class="col-lg-5"></div>
        <div class="col-lg-5"></div>
        <div class="col-lg-2">
          <div class="mb-3 lblCon">
            <label for="floatingInput2" class="text-light">Mot de passe</label>
            <input type="password" name="mdp" class="form-control" id="floatingInput2" placeholder="Mot de passe" value="<?php if (isset($_COOKIE['copassword'])) {
                                                                                                                            $decrypted_chaine = openssl_decrypt($_COOKIE['copassword'], 'AES-128-ECB', 'gK/9NcMJdNxJTtmp0SBa7w==xLCs.xunD9uNzief2gw9Qh.ZP7vuoCOCS3l');
                                                                                                                            echo $decrypted_chaine;
                                                                                                                          } ?>" required>
            <div class="password-icon">
              <i class='bx bx-show'></i>
              <i class='bx bx-low-vision'></i>
            </div>
            <a class="inscrip" href="<?= SERVER_URL ?>/mot-de-passe-oublié/">Mot de passe oublié ?</a>
          </div>
        </div>
        <div class="col-lg-5"></div>
        <div class="col-lg-5"></div>
        <div class="col-lg-2 mt-2">
          <div class="form-check">
            <input class="form-check-input bg-light" name="remember" type="checkbox" value="" id="validationCustom02">
            <label class="form-check-label color-perso" for="validationCustom02">Se souvenir de moi</label>
          </div>
        </div>
        <div class="text-center">
          <p>Je n'ai pas de compte. Je m'en <span class="inscrip"><a class="inscrip" href="<?= SERVER_URL ?>/inscription/">crée</a></span> un.</p>
          <div class="d-flex justify-content-center">
            <div class="col-lg-2">
              <button class="btn btn-light color-perso" name="loginSubmit" type="submit">Continuer</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </form>
  <!-- Fin formulaire connexion -->

  <!-- Début footer -->
  <?php
  include 'footer.php';
  ?>
  <!-- Fin footer -->

  <!-- JS Libraries -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="<?= SERVER_URL ?>/js/connexion.js"></script>
  </body>

  </html>
<?php } ?>