<?php

/**
 * /view/commandes.php
 * 
 * Page de l'historique des commandes de l'utilisateur
 *
 * @author A. Espinoza
 * @date 05/2022
 */

if (!isset($_SESSION['user'])) {
  header('Location: ' . SERVER_URL . '/erreur/');
} else {

  $title = 'Commandes | Shiba Club Nft';
  $actifA = '';
  $actifB = '';
  $actifN = '';
  include 'header.php';

?>

  <!-- Début jumbotron -->
  <div class="jumbotron mt-5 pt-5">
    <h3 class="display-6 text-center">Historique de commandes</h3>
    <p class="lead text-center">Vous pourrez retrouvez toutes vos commandes effectuées sur Shiba Club NFT</p>
  </div>
  <!-- Fin jumbotron -->

  <!-- Affichage des commandes -->
  <div class="container my-5 bg-dark p-5">
    <div class="row d-flex justify-content-center mb-3">
      <div class="col-lg-8">
        <h3 class="display-6 text-center text-light mb-3">Vos commandes</h3>
        <?php
        foreach ($cmds as $cmd) {
        ?>
          <div class="card mb-3">
            <div class="row g-0">
              <div class="col-md-4">
                <img src="<?= SERVER_URL ?>/img/carton.png" alt="carton" class="col-8 m-5">
              </div>
              <div class="col-md-8">
                <div class="card-body">
                  <div class="modal-header">
                    <h4 class="card-title"></h4>
                    <p class="text-end">Commande n°<?= $cmd->getId() ?></p>
                  </div>
                  <p class="card-text">Date de la commande <?= $cmd->getDateCommande()->format('Y-m-d') ?></p>
                  <div class="row">
                    <div class="col-lg-4">
                      <p>Nombre d'articles : </p>
                    </div>
                    <div class="col-lg-3">
                      <?= $cmd->getNbArticle() ?>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-lg-4">
                      <p>Prix : </p>
                    </div>
                    <div class="col-lg-3">
                      <?= $cmd->getPrixCmd() ?> €
                    </div>
                  </div>
                  <a href="<?= SERVER_URL ?>/commandes/<?= $cmd->getId() ?>/" class="btna mb-3">Voir les détails</a>
                </div>
              </div>
            </div>
          </div>
        <?php }
        if (empty($cmd)) { ?>
          <p class="text-light text-center display-6 mt-4">Vous n'avez effectuées aucune commande</p>
        <?php } ?>

      </div>
    </div>
  </div>

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