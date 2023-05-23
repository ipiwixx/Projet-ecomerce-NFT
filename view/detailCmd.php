<?php

/**
 * /view/detailCmd.php
 * 
 * Page des détails d'une commande
 *
 * @author A. Espinoza
 * @date 08/2022
 */

if (!isset($_SESSION['user']) || $exist == false) {
  header('Location: ' . SERVER_URL . '/erreur/');
} else {

  $title = 'Détails commande | Shiba Club Nft';
  $actifA = '';
  $actifB = '';
  $actifN = '';
  include 'header.php';

?>

  <div class="container my-5 bg-dark p-5">
    <h3 class="text-light">Commande n°<?= $cmd->getId() ?></h3>
    <div class="bg-light p-3">
      <?php foreach ($nftsCmd as $nft) {
        $img = '<img src="' . SERVER_URL . '/' . $nft->getPathPhoto() . '" alt="photo_' . $nft->getLibelle() . '" class="dtlImg">';
      ?>
        <div class="row d-flex align-items-center py-2">
          <div class="col-lg-2">
            <?= $img ?>
          </div>
          <div class="col">
            <?= $nft->getRefInterne() ?>
          </div>
          <div class="col">
            Qte : <?= $nft->getQteCmd() ?>
          </div>
          <div class="col">
            <?= $nft->getPrixVenteUht() * $nft->getQteCmd() ?> €
          </div>
          <div class="col">
            <a href="<?= SERVER_URL ?>/description/<?= $nft->getId() ?>/" class="btna mb-3">Voir plus</a>
          </div>
        </div>
      <?php } ?>
      <h2 class="text-dark text-end me-3">Prix Total : <?= $cmd->getPrixCmd() ?> €</h2>
    </div>
    <a type="button" href="<?= SERVER_URL ?>/commandes/" class="mt-3 btn btn-secondary btnb w-25"><i class="fa fa-undo"></i>&nbsp; Revenir aux commandes</a>

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