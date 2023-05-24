<?php

/**
 * /view/favoris.php
 *
 * Page des articles favoris de l'utilisateur
 *
 * @author A. Espinoza
 * @date 03/2022
 */

if (!isset($_SESSION['user'])) {
  header('Location: ' . SERVER_URL . '/erreur/');
} else {

  $title = 'Favoris | Shiba Club Nft';
  $actifA = '';
  $actifB = '';
  $actifN = '';
  include_once 'header.php';

?>

  <section id="products" class="products">
    <div class="wrapper">
      <div class="d-flex justify-content-center py-5 mt-4">
        <h3>Votre sélection</h3>
      </div>
      <div class="container">
        <div class="row">
          <?php
          if (!empty($lesNfts)) {
            foreach ($lesNfts as $unNft) {
              $img = '<img src="' . SERVER_URL . '/' . $unNft->getPathPhoto() . '" alt="photo_' . $unNft->getRefInterne() . '" class="img-fluid">';
              $id = urlencode($unNft->getId());
          ?>
              <!-- Affichage des favoris -->
              <div class="col-md-3 col-sm-6 mb-3">
                <div class="item-product">
                  <a href="<?= SERVER_URL ?>/description/<?= $id ?>/" class="product-thumb-link">
                    <?= $img ?>
                  </a>
                </div>
                <div class="product-info">
                  <div class="d-flex justify-content-between py-3">
                    <a type="button" href="<?= SERVER_URL ?>/description/<?= $id ?>/" class="btn btn-secondary btnb">Voir plus</a>
                    <div class="heart-fav">
                      <i class="fa fa-heart btnDelFav" data-id="<?= $id ?>"></i>
                    </div>
                  </div>
                  <h4 class="product-title">
                    <a><?= $unNft->getLibelle() ?></a>
                  </h4>
                  <div class="product-price">
                    <div class="row">
                      <div class="col-lg-6">
                        <ins><span class="money text-white"><?= $unNft->getPrixVenteUht() ?> €</span></ins>
                      </div>
                      <div class="col-lg-6">
                        <div class="d-flex align-items-center justify-content-end py-1">
                          <div class="basket">
                            <?php if ($unNft->getQuantiteStock() <= 0) { ?>
                              <i class="fa fa-shopping-basket ruptS"></i>

                            <?php } else { ?>
                              <i class="fa fa-shopping-basket addPanier" data-id="<?= $id ?>"></i>

                            <?php } ?>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            <?php
            }
          } else { ?>
            <h1 class="text-dark text-center">Vous n'avez aucun article en favoris.</h1>

          <?php } ?>
        </div>
      </div>
    </div>
  </section>

  <div class="toast-container">
    <div class="toast-container position-fixed bottom-0 end-0 p-3">
      <div id="liveToast" class="toast colorSite" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-header colorSite">
          <img src="<?= SERVER_URL ?>/img/icon.ico" class="rounded me-2 imgToast" alt="icon">
          <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
        <div class="toast-body">

          <i class="fa fa-check"></i>&nbsp; <?= $mess ?>
        </div>
        <div id="Progress_Status">
          <div id="myprogressBar" class="myprogressBar"></div>
        </div>
      </div>
    </div>
  </div>

  <!-- Début footer -->
  <?php
  include_once 'footer.php';
  ?>
  <!-- Fin footer -->

  <!-- JS Libraries -->
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="<?= SERVER_URL ?>/js/favoris.js"></script>
  </body>

  </html>
<?php } ?>