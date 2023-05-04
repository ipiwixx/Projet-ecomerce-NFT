<?php

/**
 * /view/cookies.php
 * 
 * Page d'information des cookies
 *
 * @author A. Espinoza
 * @date 05/2022
 */

$title = 'Cookies | Shiba Club Nft';
$actifA = '';
$actifB = '';
$actifN = '';
include 'header.php';

?> 
    
    <!-- Début jumbotron -->
    <div class="jumbotron mt-5 pt-5">
        <h1 class="display-4 text-center">Utilisation des cookies</h1>
        <hr class="my-4 m-5">
    </div>
    <!-- Fin jumbotron -->

    <!-- Contenu -->
    <div class="container">
      <div class="row">
        <div class="col-lg-2"></div>
        <div class="col-lg-8 mt-4">
          <p class="text-white">Les sites web et services en ligne de Shiba Club NFT sont susceptibles d'utiliser des "cookies". Les cookies vous permettent d'utiliser des paniers d'achat et de personnaliser votre parcours sur nos sites. Ils nous indiquent quelles pages de nos sites web sont les plus consultées, nous aident à mesurer l'efficacité de la publicité et des recherches sur le Web et nous donnent une idée du comportement des utilisateurs, ce qui nous permet d'améliorer notre communication et nos produits.<br><br>
          Comme les cookies sont très largement présents sur nos sites web, leur désactivation risque de vous empêcher d'utiliser certaines parties de ces sites.<br><br>
          Les cookies auxquels nos sites web ont recours ont été classés à partir des directives réunies dans le guide des cookies publié par la RGPD de la France. Ainsi, nous utilisons les catégories suivantes sur nos sites web et pour d'autres services en ligne :<br><br></p>

          <!-- Catégorie 1 - Cookies strictement nécessaires -->
          <h6 class="display-6 color-perso">Catégorie 1 - Cookies strictement nécessaires</h6>
          <p class="text-white">Ces cookies sont essentiels pour vous permettre de parcourir nos sites web et d'en utiliser les fonctionnalités. Sans ces cookies, des services tels que les paniers d'achat et la facturation électronique ne peuvent pas être assurés.</p><br>

          <!-- Catégorie 2 - Cookies de suivi -->
          <h6 class="display-6 color-perso">Catégorie 2 - Cookies de suivi</h6>
          <p class="text-white">Ces cookies recueillent des informations sur votre utilisation de nos sites web : par exemple, les pages que vous consultez le plus souvent. Ces données peuvent nous servir à optimiser nos sites web et à les rendre plus faciles à parcourir. Ces cookies permettent également à nos affiliés de savoir si vous avez accédé à l'un de nos sites web à partir de leur site et si votre visite a donné lieu à l'utilisation ou à l'achat d'un produit ou d'un service auprès de nous, en incluant les références du produit ou du service ainsi acheté. Ces cookies ne recueillent aucune information permettant de vous identifier. Toutes les informations qu'ils recueillent sont agrégées et, par conséquent, anonymes.</p><br>

          <!-- Catégorie 3 - Cookies de fonctionnalité -->
          <h6 class="display-6 color-perso">Catégorie 3 - Cookies de fonctionnalité</h6>
          <p class="text-white">Ces cookies permettent à nos sites web de mémoriser les choix que vous avez faits lors de votre visite. Nous pouvons, par exemple, conserver votre localisation géographique dans un cookie afin de veiller à vous présenter notre site web dans la langue de votre pays. Nous pouvons également retenir des préférences telles que la taille et la police des caractères et d'autres éléments configurables. Ces cookies peuvent aussi servir à garder la trace des produits ou des vidéos que vous avez consultés, afin d'éviter toute répétition. Les informations qu'ils recueillent ne permettront pas de vous identifier personnellement, ni de suivre votre activité d'exploration sur des sites web ne dépendant pas de Shiba Club NFT.</p>
        </div>
      </div>
    </div>
    <!-- Fin Contenu -->

    <!-- Début footer -->
    <?php 
      include 'footer.php'; 
    ?>
    <!-- Fin footer -->

    <!-- JS Libraries --> 
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
  </body>
</html>
