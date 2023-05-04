<?php

/**
 * /view/description.php
 * 
 * Page de la description des produits
 *
 * @author A. Espinoza
 * @date 03/2022
 */

if($exist == false){
  header('Location: '.SERVER_URL.'/erreur/');
} else {

$title = 'Description produits | Shiba Club Nft';
$actifA = '';
$actifB = '';
$actifN = '';
include 'header.php';

?> 
        
    <?php
      $img = '<img src="'.SERVER_URL.'/'.$unNft->getPathPhoto().'" class="img-fluid" alt="photo_'.$unNft->getLibelle().'">'; 
    ?>
    <div class="container mt-5 mb-1 py-5">
      <div class="row mt-3">
        <div class="col-lg-5 col-md-5 col-sm-12">
          <?= $img; ?>
        </div>
        <div class="mt-2 col-lg-5 col-md-5 col-sm-12">
          <div class="bg-light p-3 rounded border border-secondary">        
            <h1><?= $unNft->getLibelle(); ?></h1>
            <hr>
            <p><?= $unNft->getDescription(); ?></p>
            <div class="row">
              <div class="col">
                <h2><?= $unNft->getPrixVenteUht() ?> €</h2>
                <?php
                  if($unNft->getPrixVenteUht() < 20) { ?>
                    <h4 class="text-danger">PROMO -20%</h4>
                <?php } ?> 
              </div>
            </div>
            <div class="row">
              <div class="col-lg-5">
                <?php if($unNft->getQuantiteStock() == 0) { ?>
                  <p>En rupture de stock, revient bientôt.</p>
                  <button class="btnpanier justify-content-center mt-3" disabled>
                    Rupture&nbsp; <i class="fa fa-shopping-basket"></i>
                </button>
                <?php } else { 
                   if(isset($_SESSION['LOGGED_USER'])) { ?>
                      <button class="btnpanier justify-content-center mt-3" id="addPanier" data-id="<?= $unNft->getId() ?>">
                      Ajouter au panier&nbsp; <i class="fa fa-shopping-basket"></i>
                      </button>
                    <?php } else { ?>
                  <a href="<?= SERVER_URL ?>/connexion/" class="btnpanier justify-content-center mt-3">
                    Ajouter au panier&nbsp; <i class="fa fa-shopping-basket"></i>
                    </a>
                <?php } } ?>
              </div>      
              <div class="col-lg-3"></div>
              <div class="col-lg-4">
                <?php if(isset($_SESSION['LOGGED_USER'])) { ?>
                  <button class="btnfavoris justify-content-center mt-3" id="addFavoris" data-id="<?= $unNft->getId() ?>">
                  Favoris&nbsp; <i class="fa fa-heart"></i>
                  </button>
                <?php } else { ?>
                  <a href="<?= SERVER_URL ?>/connexion/" class="btnfavoris justify-content-center mt-3">
                    Favoris&nbsp; <i class="fa fa-heart"></i>
                  </a>
                <?php } ?>
              </div>
            </div> 
          </div>
          <div class="bg-light pt-3 px-3 pb-1 mt-3 rounded border border-secondary">        
            <p><i class="fa fa-envelope"></i>&nbsp; Envoie gratuit.<br>
            <i class="fa fa-truck"></i>&nbsp;Livraison payante.<br>
            <i class="fa fa-arrow-circle-left"></i>&nbsp; Retours gratuits.<br>
            &nbsp;&nbsp;&nbsp;&nbsp; Les conditions générales sont d'application.<br>
            &nbsp;&nbsp;&nbsp;&nbsp; <a href="<?= SERVER_URL ?>/ventes/" class="text-white">En savoir plus</a></p>
          </div>
          <a href="<?= SERVER_URL ?>/boutique/" class="btna justify-content-center mt-3"><i class="fa fa-undo"></i>&nbsp; Boutique</a>
        </div>
      </div>
    </div>

    <div class="toast-container">
      <div class="toast-container position-fixed bottom-0 end-0 p-3">
        <div id="liveToast" class="toast colorSite" role="alert" aria-live="assertive" aria-atomic="true">
          <div class="toast-header colorSite">
            <img src="<?= SERVER_URL ?>/img/icon.ico" class="rounded me-2 imgToast" alt="icon">
            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
          </div>
          <div class="toast-body">

            <i class="fa fa-check"></i>&nbsp; L'article à bien été ajouté à votre panier !
          </div>
          <div id="Progress_Status">
            <div id="myprogressBar" class="myprogressBar"></div>
          </div>
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
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="<?= SERVER_URL ?>/js/description.js"></script>

  </body>
</html>
<?php } ?>