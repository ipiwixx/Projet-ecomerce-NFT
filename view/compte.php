<?php

/**
 * /view/compte.php
 * 
 * Page des informations du compte de l'utilisateur
 *
 * @author A. Espinoza
 * @date 06/2022
 */

if (!isset($_SESSION['user'])) {
  header('Location: ' . SERVER_URL . '/erreur/');
} else {

  $title = 'Mon compte | Shiba Club Nft';
  $actifA = '';
  $actifB = '';
  $actifN = '';
  include 'header.php';

?>

  <!-- Début jumbotron -->
  <div class="jumbotron mt-5 pt-5">
    <h3 class="display-6 text-center">Mon compte</h3>
    <p class="lead text-center">Vous pourrez modifier ou rajouter des informations directement sur cette page</p>
  </div>
  <!-- Fin jumbotron -->

  <div class="d-flex justify-content-center text-center">
    <?= $mess ?>
    <?= $messMdp ?>
  </div>

  <!-- Début informations mon compte -->
  <form class="row g-3 bg-dark m-4 pb-5" method="post" action="<?= SERVER_URL ?>/mon-compte/">
    <h3 class="display-6 text-center text-light">Informations personnelles</h3>
    <div class="col-lg-2"></div>
    <div class="col-lg-2">
      <div class="col-lg-5"></div>
      <div class="mb-3">
        <input type="text" name="prenom" value="<?= $user->getPrenom() ?>" class="form-control" id="floatingInput1" placeholder="Prénom" pattern="^[A-Za-z]+$" minlength="2" maxlength="50">
        <label for="floatingInput1" class="text-light">Prénom</label>
      </div>
    </div>
    <div class="col-lg-2">
      <div class="mb-3">
        <input type="text" name="nom" value="<?= $user->getNom() ?>" class="form-control" id="floatingInput2" placeholder="Nom de famille" pattern="^[A-Za-z]+$" minlength="2" maxlength="50">
        <label for="floatingInput2" class="text-light">Nom</label>
      </div>
    </div>
    <div class="col-lg-4">
      <div class="mb-1">
        <input type="email" name="email" value="<?= $user->getEmail() ?>" class="form-control py-2" id="floatingInput3" placeholder="name@example.com" pattern="^[A-Za-z0-9]+@{1}[A-Za-z]+\.{1}[A-Za-z]{2,}$" maxlength="50" disabled>
        <label for="floatingInput3" class="text-light">Email</label>
      </div>
    </div>
    <div class="col-lg-2"></div>
    <div class="col-lg-2"></div>
    <div class="col-lg-4">
      <div class="mb-1">
        <input type="text" name="tel" value="0<?= $user->getTel() ?>" class="form-control py-2" id="floatingInput4" placeholder="Numéro de téléphone" pattern="[0]{1}[0-9]{9}" minlength="10" maxlength="10">
        <label for="floatingInput4" class="text-light">Numéro de téléphone</label>
      </div>
    </div>
    <div class="col-lg-3">
      <div class="mb-1">
        <input type="text" name="date" value="<?= $user->getDateNaissance()->format('Y-m-d') ?>" class="form-control py-2" id="floatingInput6" placeholder="Date Naissance">
        <label for="floatingInput6" class="text-light">Date de naissance</label>
      </div>
    </div>
    <h3 class="display-6 text-center text-light">Informations Livraisons</h3>
    <div class="col-lg-2"></div>
    <div class="col-lg-4">
      <div class="mb-1">
        <input type="text" name="adresse" value="<?= $user->getAdressePostale() ?>" class="form-control py-2" id="floatingInput7" placeholder="Adresse">
        <label for="floatingInput7" class="text-light">Adresse</label>
      </div>
    </div>
    <div class="col-lg-2">
      <div class="mb-3">
        <input type="text" name="cpt" value="<?= $user->getCpt() ?>" class="form-control py-2" id="floatingInput8" placeholder="Code Postale" pattern="[0-9]{5}" minlength="5" maxlength="5">
        <label for="floatingInput8" class="text-light">Code postal</label>
      </div>
    </div>
    <div class="col-lg-2">
      <div class="mb-3">
        <input type="text" name="ville" value="<?= $user->getVille() ?>" class="form-control py-2" id="floatingInput9" placeholder="Ville">
        <label for="floatingInput9" class="text-light">Ville</label>
      </div>
    </div>
    <div class="col-lg-2"></div>
    <div class="col-lg-2"></div>
    <div class="col-lg-2">
      <div class="mb-3">
        <input type="text" name="pays" value="<?= $user->getPays() ?>" class="form-control py-2" id="floatingInput10" placeholder="Pays">
        <label for="floatingInput10" class="text-light">Pays</label>
      </div>
    </div>
    <div class="text-center">
      <div class="d-flex justify-content-center">
        <div class="col-lg-2">
          <button class="btn btn-light color-perso btnEnr" name="editSubmit" type="submit">Enregistrer</button>
        </div>
      </div>
    </div>
  </form>
  <form class="row g-3 bg-dark m-4 pb-5" method="post" action="<?= SERVER_URL ?>/mon-compte/">
    <h3 class="display-6 text-center text-light">Mot de Passe</h3>
    <div class="col-lg-2"></div>
    <div class="col-lg-4">
      <div class="mb-1 lblU">
        <input type="password" name="mdp" class="form-control py-2 old" id="floatingInput5" placeholder="Ancien mot de passe" minlength="8" required>
        <label for="floatingInput5" class="text-light">Ancien mot de passe</label>
        <div class="password-icon">
          <i class='bx bx-show oldE'></i>
          <i class='bx bx-low-vision oldEO'></i>
        </div>
      </div>
    </div>
    <div class="col-lg-4">
      <div class="mb-1 lblU">
        <input type="password" name="newMdp" class="form-control py-2 new" id="floatingInput11" placeholder="Nouveau mot de passe" minlength="8" required>
        <label for="floatingInput11" class="text-light">Nouveau mot de passe</label>
        <div class="password-icon">
          <i class='bx bx-show newE'></i>
          <i class='bx bx-low-vision newEO'></i>
        </div>
      </div>
    </div>
    <div class="text-center">
      <div class="d-flex justify-content-center">
        <div class="col-lg-2">
          <button class="btn btn-light color-perso" name="editSubmitP" type="submit">Enregistrer</button>
        </div>
      </div>
    </div>
  </form>
  <!-- Fin informations mon compte -->

  <!-- Début footer -->
  <?php
  include 'footer.php';
  ?>
  <!-- Fin footer -->

  <!-- JS Libraries -->
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="<?= SERVER_URL ?>/js/compte.js"></script>
  </body>

  </html>
<?php } ?>