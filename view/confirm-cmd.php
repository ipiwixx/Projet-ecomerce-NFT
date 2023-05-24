<?php

/**
 * /view/confirm-cmd.php
 *
 * Page de confirmationde la commande
 *
 * @author A. Espinoza
 * @date 03/2022
 */

if (!isset($_SESSION['user']) || $exist == false) {
  header('Location: ' . SERVER_URL . '/erreur/');
} else {

  $title = 'Confirmation commande | Shiba Club Nft';
  $actifA = '';
  $actifB = '';
  $actifN = '';
  include_once 'header.php';

?>

  <div class="container my-5 pt-5">
    <h1 class="text-center">Confirmation de votre commande n°<?= $cmd->getId() ?></h1>
    <p>Merci pour votre commande sur Shiba Club NFT. Notre équipe s'occupe au plus vite de votre commande. Elle sera envoyé sous 3 jours ouvrés.</p>
    <h4>Récapitulatif de votre commande :</h4>
    <div class="mx-5">

      <div class="card w-50 mb-3">
        <?php foreach ($lesNfts as $nft) {
          $img = '<img src="' . SERVER_URL . '/' . $nft->getPathPhoto() . '" alt="photo_' . $nft->getRefInterne() . '" class="img-fluid rounded-start h-100">';
        ?>
          <div class="row g-0">
            <div class="col-md-4">
              <?= $img ?>
            </div>
            <div class="col-md-6">
              <div class="card-body">
                <h6><strong><?= $nft->getPrixVenteUht() ?> €</strong></h6>
                <p class="card-text"><?= $nft->getLibelle() ?></p>
                <p class="card-text">Qté: <strong><?= $nft->getQteCmd() ?></strong></p>
              </div>
            </div>
          </div>
        <?php } ?>
      </div>
      <p>Total de la commande : <?= $cmd->GetPrixCmd() ?> €</p>
      <p>Commande effectuée le <?= $cmd->getDateCommande()->format('d/m/Y') ?></p>
      <p>Accéder au détail de votre commande directement <a class="inscrip" href="<?= SERVER_URL ?>/commandes/<?= $cmd->getId() ?>/">ici</a>.</p>
    </div>
  </div>

  <!-- Début footer -->
  <?php include_once 'footer.php'; ?>
  <!-- Fin footer -->

  <!-- JS Libraries -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
  </body>

  </html>
<?php } ?>