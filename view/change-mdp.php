<?php

/**
 * /view/change-mdp.php
 * 
 * Page de mot de passe oublié
 *
 * @author A. Espinoza
 * @date 04/2022
 */

if(!isset($_SESSION['recup_mail'])) {
  header('Location: '.SERVER_URL.'/erreur/');
} else {

$title = 'Changer mot de passe | Shiba Club Nft';
$actifA = '';
$actifB = '';
$actifN = '';
include 'header.php';

?> 

    <!-- Début jumbotron -->
    <div class="jumbotron mt-5 pt-5">
        <h3 class="display-6 text-center">Veillez à mettre un mot de passe sécurisé</h3>
    </div>
    <!-- Fin jumbotron -->

    <div class="d-flex justify-content-center text-center">
      <?= $error ?>
    </div>
                
    <form method="POST" action="<?= SERVER_URL ?>/change-mot-de-passe/" class="row g-3 bg-dark mt-4 py-4">
      <div class="row mt-5">
        <div class="offset-4 col-lg-4 col-6">
          <div class="form-floating mb-1">
            <input type="password" name="change_mdp" class="form-control" id="floatingInput5" placeholder="Mot de passe" required pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" minlength="8" TITLE="Le mot de passe doit contenir au moins 8 caractères composés d'au moins un chiffre et d'une lettre majuscule et minuscule.">
            <label for="floatingInput5" class="text-light">Mot de passe</label> 
          </div>
          <div class="form-floating mb-1">
            <input type="password" name="change_mdpc" class="form-control" id="floatingInput6" placeholder="Confirmer le mot de passe" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" minlength="8">
            <label for="floatingInput6" class="text-light">Confirmer le mot de passe</label>
          </div>
          <p class="text-light">Renseigner votre adresse Email pour réinitialiser votre mot de passe !</p>
        </div>
      </div>
      <div class="d-flex justify-content-center mb-5">
        <div class="col-lg-1">
          <input class="btn btn-light color-perso ms-3" type="submit" value="Continuer" name="change_submit">
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
    