<?php
/**
 * /view/accueil.php
 * 
 * Page d'accueil du site Shiba Club NFT
 *
 * @author A. Espinoza
 * @date 02/2022
 */

if(isset($_GET['accepte-cookie'])) {
  setcookie('accepte-cookie', 'true', time() + 365*24*3600);
  header('Location:./');
} 
if(isset($_GET['refus-cookie'])) {
  setcookie('refus-cookie', 'true', time() + 10*24*3600);
  header('Location:./');
}

$title = 'Accueil | Shiba Club Nft';
$actifA = 'active';
$actifB = '';
$actifN = '';
include 'header.php';

?> 

    <!-- Début du slider -->
    <div id="demo" class="carousel slide" data-bs-ride="carousel">

      <!-- Indicateurs/points -->
      <div class="carousel-indicators">
        <button type="button" data-bs-target="#demo" data-bs-slide-to="0" class="active"></button>
        <button type="button" data-bs-target="#demo" data-bs-slide-to="1"></button>
      </div>
            
      <!-- Le carrousel -->
      <div class="carousel-inner">
        <div class="carousel-item active">
          <img src="<?= SERVER_URL ?>/img/accueil/slide.jpg" alt="Shibac" class="d-block" style="width:100%">
          <div class="carousel-caption">
            <h3>SHIBA CLUB NFT</h3>
            <p>Des images toujours plus détaillées et personnalisées</p>
          </div>
          </div>
          <div class="carousel-item">
            <img src="<?= SERVER_URL ?>/img/accueil/slide2.png" alt="Shibas" class="d-block" style="width:100%">
            <div class="carousel-caption">
              <h3>SHIBA CLUB NFT</h3>
              <p>La nouvelle collection est arrivée !</p>
            </div> 
          </div>  
        </div>
      </div>
        
      <!-- Commandes/icônes gauche et droite -->
      <button class="carousel-control-prev" type="button" data-bs-target="#demo" data-bs-slide="prev">
        <span class="carousel-control-prev-icon"></span>
      </button>
      <button class="carousel-control-next" type="button" data-bs-target="#demo" data-bs-slide="next">
        <span class="carousel-control-next-icon"></span>
      </button>

    </div>
    <!-- Fin du slider -->

    <?php if(isset($_SESSION['LOGGED_USER'])) { ?>
      <div class="alert alert-success alert-dismissible fade show offset-4 col-4" role="alert">
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        <strong>Succès</strong> Connexion réussie !
        <?= $_SESSION['nom']; ?>
      </div>
    <?php } ?>
  
    <!-- section-1 Informations -->
    <section id="features" class="section--spacing mt-5">
      <div class="container mb-5">
        <div class="row align-items-center justify-content-between">
          <div class="col-lg-5 col-12 features--content">
            <h6 class="text-uppercase">Informations</h6>
            <h2 class="d-block mb-4 text-uppercase f-akira">BIENVENUE AU SHIBA CLUB NFT</h2>
            <p>Le Shiba Club NFT est notre toute nouvelle collection avec 10 000 Shiba NFT à vendre !<br>
            <br> Nous avons utilisé notre expérience pour vous apporter des personnages encore plus uniques avec près de 200 traits de caractères différents. Cela nous rapprochera encore plus de notre objectif de construire une communauté forte et diversifiée autour des NFTs.<br>
            <a href="https://discord.gg/shibasocialclub" class="btn btn-dark mt-3 color-perso">Rejoins nous</a>
          </div>
          <div class="col-lg-6 features--image-wrapper">
            <img src="<?= SERVER_URL ?>/img/accueil/bby.jpg" alt="Shiba Watches" class="col-md-11 col-sm-11 col-xs-auto features--image" loading="lazy">
          </div>
        </div>
      </div>
    </section>
        
    <!-- section-2 Nouveautés -->
    <section id="new-arrivals">
      <div class="new-arrivals wrapper">
        <div class="container">
          <div class="row">
            <div class="col-12 mb-2 text-content text-center">
              <h2>Nouveautés</h2>
              <p>Ces NFTs uniques sont crées spécialement par nos graphistes et vous promettent une qualité d'image exceptionnel. 
              Voir la collection Shiba Club NFT de 2022.</p>
            </div>
          </div>
          <div class="row align-items-center">
            <div class="col-sm-4 col-12 p-sm-0 card-banner">
              <div class="card-banner position-relative text-center">
                <a href="<?= SERVER_URL ?>/description/21/" class="card-thumb">
                  <img src="<?= SERVER_URL ?>/img/accueil/img1.png" alt="img-1" class="img-fluid">
                </a>
                <div class="banner-info text-center">
                  <h2>Shiba Club #2094</h2>
                  <p>-20% STOCK LIMITÉ</p>
                  <a href="<?= SERVER_URL ?>/description/21/" class="main-btn">Acheter maintenant</a>
                </div>
              </div>
            </div>
            <div class="col-sm-4 col-12 p-sm-0 card-banner">
              <div class="card-banner position-relative text-center">
                <a href="<?= SERVER_URL ?>/description/29/" class="card-thumb">
                  <img src="<?= SERVER_URL ?>/img/accueil/img2.png" alt="img-2" class="img-fluid">
                </a>
                <div class="banner-info text-center">
                  <h2>Shiba Club #5452</h2>
                  <p>-20% STOCK LIMITÉ</p>
                  <a href="<?= SERVER_URL ?>/description/29/" class="main-btn">Acheter maintenant</a>
                </div>
              </div>
            </div>
            <div class="col-sm-4 col-12 p-sm-0 card-banner">
              <div class="card-banner position-relative text-center">
                <a href="<?= SERVER_URL ?>/description/31/" class="card-thumb">
                  <img src="<?= SERVER_URL ?>/img/accueil/img3.png" alt="img-3" class="img-fluid">
                </a>
                <div class="banner-info text-center">
                  <h2>Shiba Club #1725</h2>
                  <p>-20% STOCK LIMITÉ</p>
                  <a href="<?= SERVER_URL ?>/description/31/" class="main-btn">Acheter maintenant</a>
                </div>
              </div>
            </div>
          </div>
        </div>  
      </div>
    </section>
    
    <!-- section-3 Blog -->
    <section id="blog">
      <div class="blog-section wrapper">
        <div class="container">
          <div class="row">
            <div class="col-12 mb-2 text-content text-center">
              <h2>DERNIÈRES NOUVELLES DU BLOG</h2>
              <p>Ces NFT sont conçus depuis des années par nos graphistes spécialistes. Voici quelques articles pour avoir plus d'informations.</p>
            </div>
          </div>
          <div class="row align-items-center">
            <div class="col-md-4 col-sm-6 mb-4 mb-lg-0">
              <div class="text-center px-2 mt-2">
                <h2>Explications sur les NFT</h2>
                <p>NFT est l'abréviation de Nun Fongible Token, que l'on pourrait traduire en français par « Jeton non fongible ». Ce sont des éléments...</p>
                <a href="<?= SERVER_URL ?>/nft/" class="main-btn">Voir Plus</a>
              </div>            
            </div>
            <div class="col-md-4 col-sm-6 mb-4 mb-lg-0">
              <div class="text-center px-2 mt-2">
                <h2>Avantages des Shiba Club NFT</h2>
                <p>Bien que le marché des NFT se soit popularisé ces derniers mois grâce à différentes ventes d'art numérique, les actifs échangés...</p>
                <a href="<?= SERVER_URL ?>/nft/" class="main-btn">Voir Plus</a>
              </div>
            </div>
            <div class="col-md-4 col-sm-6 mb-4 mb-lg-0">
              <div class="text-center px-2 mt-2">
                <h2>Nos graphistes</h2>
                <p>Nos graphistes sont originaires de France mais aussi d'Angleterre, des États-Unis, d'Allemagne et d'Italie. Tous ont eu plus de 3 ans de...</p>
                <a href="<?= SERVER_URL ?>/nft/" class="main-btn graphistes">Voir Plus</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- section-4 Affaires du jour -->
    <section id="deal">
      <div class="wrapper">
        <div class="container">
          <div class="row">
            <div class="col-12">
              <div class="text-center border border-white deal-of-the-day py-5">
                <div class="text-content py-5">
                  <h2>AFFAIRES DU JOUR</h2>
                  <h4>Jusqu'à -60% !!</h4>
                  <p>En ce moment les Shiba Club NFT sont en promotions jusqu'à -60% dans la boutique.</p>
                  <a href="<?= SERVER_URL ?>/boutique/" class="btna">Allez à la boutique !</a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Début footer -->
    <?php 
      include 'footer.php'; 
    ?>
    <!-- Fin footer -->

    <!-- JS Libraries --> 
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="<?= SERVER_URL ?>/js/cookie.js"></script>
  </body>
</html>