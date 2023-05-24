<?php

/**
 * /view/boutique.php
 *
 * Page de la boutique
 *
 * @author A. Espinoza
 * @date 05/2022
 */

$title = 'Boutique | Shiba Club Nft';
$actifA = '';
$actifB = 'active';
$actifN = '';
include_once 'header.php';

?>

<!-- section-3 products-->
<section id="products" class="products">
  <div class="wrapper">
    <div class="container">
      <div class="row">
        <div class="col-12 text-content text-center mt-4">
          <h2>MEILLEURS VENTES</h2>
          <p>Les Shiba Club NFT ont connu un énorme succès et tout particulièrement les Baby Shiba Club.</p>
        </div>
        <div class="col-12">
          <form action="<?= SERVER_URL ?>/boutique/" method="GET">
            <ul class="nav nav-tabs mb-3" id="myTab" role="tablist">
              <?php foreach ($lesCategs as $categ) { ?>
                <li class="nav-item" role="presentation">
                  <a href="<?= SERVER_URL ?>/boutique/<?= $categ->getRefInterne() ?>/" class="nav-link" id="<?= $categ->getLibelle() ?>-tab" role="tab" aria-controls="<?= $categ->getLibelle() ?>"><?= $categ->getLibelle() ?></a>
                </li>
              <?php } ?>
              <li class="nav-item" role="presentation">
                <a href="<?= SERVER_URL ?>/boutique/" class="nav-link">Tout</a>
              </li>
            </ul>
            <ul class="nav justify-content-center bg-dark fixed p-3">
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle text-light" href="#" id="navbarDarkDropdownMenuLink3" role="button" data-bs-toggle="dropdown" aria-expanded="false">Trier</a>
                <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="navbarDarkDropdownMenuLink3">
                  <li><a class="dropdown-item" href="<?= SERVER_URL ?>/boutique/nouveau/">Nouveau</a></li>
                  <li><a class="dropdown-item" href="<?= SERVER_URL ?>/boutique/croissant/">Prix croissant</a></li>
                  <li><a class="dropdown-item" href="<?= SERVER_URL ?>/boutique/decroissant/">Prix décroissant</a></li>
                </ul>
              </li>
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle text-light" href="#" id="navbarDarkDropdownMenuLink5" role="button" data-bs-toggle="dropdown" aria-expanded="false">Gamme de prix</a>
              </li>
            </ul>
          </form>
          <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="Tout" role="tabpanel" aria-labelledby="Tout-tab">
              <div class="row">
                <h1 class="text-center mt-3"><?= $reponse ?></h1>

                <?php
                if (empty($lesNfts) && empty($_GET['search'])) { ?>
                  <h2 class="text-center mt-3">Pas de produit pour cette catégorie</h2>
                  <?php } else {
                  foreach ($lesNfts as $nft) {
                    $img = '<img src="' . SERVER_URL . '/' . $nft->getPathPhoto() . '" alt="photo_' . $nft->getLibelle() . '" class="img-fluid">';
                    $id = urlencode($nft->getId());
                  ?>

                    <!-- Début de la boutique -->
                    <div class="col-md-4 col-lg-3 col-sm-6 mb-3">
                      <div class="item-product">
                        <a href="<?= SERVER_URL ?>/description/<?= $id ?>/" class="product-thumb-link">
                          <?= $img ?>
                        </a>
                      </div>
                      <div class="product-info">
                        <div class="d-flex justify-content-between py-3">
                          <?php if ($nft->getQuantiteStock() == 0) { ?>
                            <button type="button" class="btn btn-secondary btnb" disabled>Rupture</button>
                          <?php } else { ?>
                            <a type="button" href="<?= SERVER_URL ?>/description/<?= $id ?>/" class="btn btn-secondary btnb">Voir plus</a>

                          <?php }
                          $date_produit = date_format($nft->getDatePublication(), 'Y-m-d');
                          $aujourdhui = date('Y-m-d');
                          $date_produit = strtotime($date_produit);
                          $aujourdhui = strtotime($aujourdhui);

                          $nbJoursTimesstamp = $aujourdhui - $date_produit;
                          $nbJours = $nbJoursTimesstamp / 86400;
                          if ($nbJours < 300) {
                          ?>
                            <h4><span class="badge bg-secondary">Nouveau</span></h4>
                          <?php } ?>
                          <?php
                          if ($nft->getPrixVenteUht() < 20) { ?>
                            <h4 class="text-danger"><strong>-20%</strong></h4>
                            <?php }
                          if (isset($_SESSION['LOGGED_USER'])) {
                            if (FavorisManager::isFavoris($id, $_SESSION['id'])) { ?>
                              <div class="heart-fav">
                                <i class="fa fa-heart delfav" data-id="<?= $id ?>"></i>
                              </div>
                            <?php } else { ?>
                              <div class="heart">
                                <i class="fa fa-heart fav" data-id="<?= $id ?>"></i>
                              </div>
                            <?php }
                          } else { ?>
                            <div class="heart">
                              <a href="<?= SERVER_URL ?>/connexion/">
                                <i class="fa fa-heart"></i>
                              </a>
                            </div>
                          <?php } ?>
                        </div>
                        <h4 class="product-title">
                          <a><?= $nft->getLibelle() ?></a>
                        </h4>
                        <div class="product-price">
                          <ins><span class="money text-white"><?= $nft->getPrixVenteUht() ?> €</span></ins>
                        </div>
                        <div class="d-flex align-items-center justify-content-between py-1">
                          <div class="rating">
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                          </div>
                          <div class="basket">
                            <?php if (isset($_SESSION['LOGGED_USER'])) {
                              if ($nft->getQuantiteStock() <= 0) { ?>
                                <i class="fa fa-shopping-basket ruptS"></i>
                              <?php } else { ?>
                                <i class="fa fa-shopping-basket addPanier" data-id="<?= $id ?>"></i>

                              <?php }
                            } else { ?>
                              <a href="<?= SERVER_URL ?>/connexion/" class="addPanier">
                                <i class="fa fa-shopping-basket"></i>
                              </a>
                            <?php } ?>
                          </div>
                        </div>
                      </div>
                    </div>
                <?php }
                } ?>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Début Pagination -->
  <nav aria-label="Pagination" class="bg-black">
    <?php
    $page = nettoyer($_GET['page'] ?? 1);
    if (!filter_var($page, FILTER_VALIDATE_INT)) {
      throw new Exception('Numéro de page invalide');
    }

    if (isset($_GET['search']) && !empty($_GET['search'])) {
      $recherche = filter_input(INPUT_GET, 'search', FILTER_DEFAULT);
      $linkS = SERVER_URL . "/boutique/recherche/$recherche/";
    } elseif (isset($_GET['filtreCateg']) && !empty($_GET['filtreCateg'])) {
      $filtreCateg = filter_input(INPUT_GET, 'filtreCateg', FILTER_DEFAULT);
      $linkF = SERVER_URL . "/boutique/$filtreCateg/";
    } elseif (isset($_GET['filtrePrix']) && !empty($_GET['filtrePrix'])) {
      $filtrePrix = filter_input(INPUT_GET, 'filtrePrix', FILTER_DEFAULT);
      if ($filtrePrix == 'ASC') {
        $linkP = SERVER_URL . "/boutique/croissant/";
      } elseif ($filtrePrix == 'DESC') {
        $linkP = SERVER_URL . "/boutique/decroissant/";
      }
    } elseif (isset($_GET['filtreDate']) && !empty($_GET['filtreDate'])) {
      $filtreDate = filter_input(INPUT_GET, 'filtreDate', FILTER_DEFAULT);
      $linkD = SERVER_URL . "/boutique/nouveau/";
    }
    $currentPage = (int)$page;
    $link = SERVER_URL . "/boutique/";
    ?>
    <div class="container">
      <ul class="pagination justify-content-center bg-dark p-1">
        <?php if ($currentPage > 1) {
          if ($currentPage > 2) {
            $link .= ($currentPage - 1) . "/";
          }
        ?>


          <?php if (isset($recherche) && !empty($recherche)) { ?>
            <li class="page-item">
              <?php if ($currentPage == 2) { ?>
                <a href="<?= $linkS ?>" class="page-link color-perso">Précédente</a>
              <?php } else { ?>
                <a href="<?= $linkS ?><?= $currentPage - 1 ?>/" class="page-link color-perso">Précédente</a>
              <?php } ?>
            </li>
          <?php } elseif (isset($filtreCateg) && !empty($filtreCateg)) { ?>
            <li class="page-item">
              <?php if ($currentPage == 2) { ?>
                <a href="<?= $linkF ?>" class="page-link color-perso">Précédente</a>
              <?php } else { ?>
                <a href="<?= $linkF ?><?= $currentPage - 1 ?>/" class="page-link color-perso">Précédente</a>
              <?php } ?>
            </li>
          <?php } elseif (isset($filtrePrix) && !empty($filtrePrix)) { ?>
            <li class="page-item">
              <?php if ($currentPage == 2) { ?>
                <a href="<?= $linkP ?>" class="page-link color-perso">Précédente</a>
              <?php } else { ?>
                <a href="<?= $linkP ?><?= $currentPage - 1 ?>/" class="page-link color-perso">Précédente</a>
              <?php } ?>
            </li>
          <?php } elseif (isset($filtreDate) && !empty($filtreDate)) { ?>
            <li class="page-item">
              <?php if ($currentPage == 2) { ?>
                <a href="<?= $linkD ?>" class="page-link color-perso">Précédente</a>
              <?php } else { ?>
                <a href="<?= $linkD ?><?= $currentPage - 1 ?>/" class="page-link color-perso">Précédente</a>
              <?php } ?>
            </li>
          <?php } else { ?>
            <li class="page-item">
              <a href="<?= $link ?>" class="page-link color-perso">Précédente</a>
            </li>
          <?php } ?>
        <?php } else { ?>
          <li class="page-item disabled">
            <a class="page-link color-perso">Précédente</a>
          </li>
        <?php } ?>

        <?php
        $i = 1;
        while ($i - 1 != $nb) { ?>
          <?php if (isset($recherche) && !empty($recherche)) {
            if ($i == 1) { ?>
              <li class="page-item"><a class="page-link color-perso" href="<?= $linkS ?>"><?= $i ?></a></li>
            <?php } else { ?>
              <li class="page-item"><a class="page-link color-perso" href="<?= $linkS ?><?= $i ?>/"><?= $i ?></a></li>
            <?php }
          } elseif (isset($filtreCateg) && !empty($filtreCateg)) {
            if ($i == 1) { ?>
              <li class="page-item"><a class="page-link color-perso" href="<?= $linkF ?>"><?= $i ?></a></li>
            <?php } else { ?>
              <li class="page-item"><a class="page-link color-perso" href="<?= $linkF ?><?= $i ?>/"><?= $i ?></a></li>
            <?php }
          } elseif (isset($filtrePrix) && !empty($filtrePrix)) {
            if ($i == 1) { ?>
              <li class="page-item"><a class="page-link color-perso" href="<?= $linkP ?>"><?= $i ?></a></li>
            <?php } else { ?>
              <li class="page-item"><a class="page-link color-perso" href="<?= $linkP ?><?= $i ?>/"><?= $i ?></a></li>
            <?php }
          } elseif (isset($filtreDate) && !empty($filtreDate)) {
            if ($i == 1) { ?>
              <li class="page-item"><a class="page-link color-perso" href="<?= $linkD ?>"><?= $i ?></a></li>
            <?php } else { ?>
              <li class="page-item"><a class="page-link color-perso" href="<?= $linkD ?><?= $i ?>/"><?= $i ?></a></li>
            <?php }
          } else {
            if ($i == 1) {
              $link = SERVER_URL . "/boutique/"; ?>
              <li class="page-item"><a class="page-link color-perso" href="<?= $link ?>"><?= $i ?></a></li>
            <?php } else { ?>
              <li class="page-item"><a class="page-link color-perso" href="<?= $link ?><?= $i ?>/"><?= $i ?></a></li>
          <?php }
          }
          $i += 1; ?>

        <?php  }
        if ($currentPage < $nb) { ?>
          <?php if (isset($recherche) && !empty($recherche)) { ?>
            <li class="page-item">
              <a href="<?= $linkS ?><?= $currentPage + 1 ?>/" class="page-link color-perso">Suivante</a>
            </li>
          <?php } elseif (isset($filtreCateg) && !empty($filtreCateg)) { ?>
            <li class="page-item">
              <a href="<?= $linkF ?><?= $currentPage + 1 ?>/" class="page-link color-perso">Suivante</a>
            </li>
          <?php } elseif (isset($filtrePrix) && !empty($filtrePrix)) { ?>
            <li class="page-item">
              <a href="<?= $linkP ?><?= $currentPage + 1 ?>/" class="page-link color-perso">Suivante</a>
            </li>
          <?php } elseif (isset($filtreDate) && !empty($filtreDate)) { ?>
            <li class="page-item">
              <a href="<?= $linkD ?><?= $currentPage + 1 ?>/" class="page-link color-perso">Suivante</a>
            </li>
          <?php } else { ?>
            <li class="page-item">
              <a href="<?= $link ?><?= $currentPage + 1 ?>/" class="page-link color-perso">Suivante</a>
            </li>
          <?php } ?>
        <?php } else { ?>
          <li class="page-item disabled">
            <a class="page-link color-perso">Suivante</a>
          </li>
        <?php } ?>
      </ul>
    </div>
  </nav>
  <!-- Fin pagination -->
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
<script src="<?= SERVER_URL ?>/js/boutique.js"></script>
</body>

</html>