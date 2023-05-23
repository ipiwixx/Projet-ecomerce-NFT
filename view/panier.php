<?php

/**
 * /view/panier.php
 * 
 * Page du panier de l'utilisateur
 *
 * @author A. Espinoza
 * @date 03/2022
 */

if (!isset($_SESSION['user'])) {
  header('Location: ' . SERVER_URL . '/erreur/');
} else {

  $title = 'Panier | Shiba Club Nft';
  $actifA = '';
  $actifB = '';
  $actifN = '';
  include 'header.php';

  $panier = new panier();
?>

  <!-- Container -->
  <div class="container mt-5 bg-dark p-5 mb-3 mt-5">
    <form method="post" action="<?= SERVER_URL ?>/panier/">
      <div class="row">
        <div class="col-lg-8">
          <div class="row">
            <div class="col-lg-5">
              <h3 class="text-light">Mon Panier</h3>
            </div>
            <div class="col-lg-7">
              <p class="text-end text-light">Les articles dans votre panier seront affichée ici</p>
            </div>
          </div>

          <?php

          if (!empty($lesNfts)) {
            foreach ($lesNfts as $unNft) {
              $img = '<img src="' . SERVER_URL . '/' . $unNft->getPathPhoto() . '" alt="photo_' . $unNft->getRefInterne() . '" class="img-fluid rounded-start">';
          ?>
              <div class="card mb-3" data-id="<?= $unNft->getId() ?>">
                <div class="row g-0">
                  <div class="col-md-4">
                    <?= $img ?>
                  </div>
                  <div class="col-md-8">
                    <div class="card-body">
                      <div class="modal-header">
                        <h4 class="card-title"><?= $unNft->getLibelle() ?></h4>
                        <button class="btn-close" data-id="<?= $unNft->getId() ?>" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <p class="card-text"><?= $unNft->getDescription() ?></p>
                      <div class="row">
                        <div class="col-lg-1">
                          <label for="validationCustom01" class="form-label text-dark">Qté</label>
                        </div>
                        <div class="col-lg-2">
                          <input type="number" min="1" max="<?= $unNft->getQuantiteStock() ?>" data-qte="<?php if ($unNft->getQuantiteStock() < $unNft->getQtePanier()) {
                                                                                                            echo $unNft->getQuantiteStock();
                                                                                                          } else {
                                                                                                            echo $unNft->getQtePanier();
                                                                                                          } ?>" data-id="<?= $unNft->getId() ?>" name="panier[quantity][<?= $unNft->getId() ?>]" value="<?php if ($unNft->getQuantiteStock() < $unNft->getQtePanier()) {
                                                                                                                                                                                                                                                                                                                                                echo $unNft->getQuantiteStock();
                                                                                                                                                                                                                                                                                                                                              } else {
                                                                                                                                                                                                                                                                                                                                                echo $unNft->getQtePanier();
                                                                                                                                                                                                                                                                                                                                              } ?>" class="qtePanier" id="validationCustom01">
                        </div>
                        <div class="offset-7 col-lg-2"><?= $unNft->getPrixVenteUht() ?> €</div>
                      </div>
                      <a class="sauv text-white fav" data-id="<?= $unNft->getId() ?>" href="#">
                        <i class="fa fa-heart mt-3 mx-2" data-id="<?= $unNft->getId() ?>"></i>Sauvegarder pour plus tard
                      </a>
                    </div>
                  </div>
                </div>
              </div>
            <?php }
          } else { ?>
            <h3 class="text-light mb-5">Vous n'avez aucun article dans votre panier !</h3>
          <?php } ?>
          <h4 class="text-light">VOUS VOUS DEMANDEZ OÙ SONT PASSÉS VOS ARTICLES ?</h4>
          <p class="text-light">Pas de problème - vous les trouverez dans vos articles enregistrés</p>
          <a href="<?= SERVER_URL ?>/favoris/" class="btn btn-light mt-2 color-perso p-2">Voir tous les articles sauvegardés</a>
          <input type="submit" class="invisible" value="Recalculer">
        </div>
        <div class="offset-1 col-lg-3">
          <div class="card mt-2">
            <div class="card-body">
              <h4 class="card-title">Total</h4><br>
              <div class="row">
                <div class="col-lg-6">
                  <p class="card-text"><strong>Sous-total</strong></p>
                </div>
                <div class="col-lg-6">
                  <p class="text-end" id="prix"><?= $panier->total() ?> €</p>
                </div>
              </div>
              <p class="card-text"><strong>Livraison</strong></p>
              <select class="form-select" id="validationCustom02" aria-label="Default select example">
                <option value="email" dir="auto" selected>Envoi par email (gratuit)</option>
                <option value="standard">Livraison standard (4.95 €)</option>
                <option value="24h" dir="auto">Livraison 24h (10.00 €)</option>
              </select>
            </div>
            <div class="card-body d-flex justify-content-center">
              <?php if (empty($lesNfts)) { ?>
                <a href="<?= SERVER_URL ?>/panier/" class="btn mt-2 text-white p-2 bouton-cmd">Paiement</a>
              <?php } else { ?>
                <a href="<?= SERVER_URL ?>/paiement/" class="btn mt-2 text-white p-2 bouton-cmd">Paiement</a>
              <?php } ?>
            </div>
          </div>
        </div>
      </div>
    </form>
  </div>
  <!-- Container -->

  <!-- Début footer -->
  <?php
  include 'footer.php';
  ?>
  <!-- Fin footer -->

  <script type="text/javascript" src="<?= SERVER_URL ?>/js/panier.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
  </body>

  </html>
<?php } ?>