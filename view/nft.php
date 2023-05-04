<?php

/**
 * /view/nft.php
 * 
 * Page d'information à propos des NFT
 *
 * @author A. Espinoza
 * @date 01/2022
 */

$title = 'A propos des NFT | Shiba Club Nft';
$actifA = '';
$actifB = '';
$actifN = 'active';
include 'header.php';
?>

    <br class="my-4">
    <!-- Début jumbotron -->
    <div class="jumbotron mt-5 pt-4 ms-5">
      <h1 class="display-4">A propos des nft</h1>
      <p class="lead">Tout ce qu'il y a à savoir sur les NFT.</p>
      <hr class="my-4">
    </div>
    <!-- Fin jumbotron -->

    <!-- Contenu -->
    <div class="container">
      <div class="row">
        <img src="<?= SERVER_URL ?>/img/accueil/slide3.png" alt="Shiba_Watches" id="lesnft"> 
        <div class="col-md-offset-1 col-lg-12 mt-4">
          <p class="display-6 color-perso" id="actifs">Qu'est ce qu'un NFT ?</p>
          <p class="text-white">NFT est l'abréviation de Nun Fongible Token, que l'on pourrait traduire en français par « Jeton non fongible ». 
          Ce sont des éléments virtuels, sortes de crypto-jetons, immatriculés par des codes d'identification et des métadonnées (nom de l'auteur, signature, date…), 
          qui les rendent ainsi uniques, et non-interchangeables. Ils sont non-fongibles car ils ne peuvent pas être remplacés mécaniquement par un équivalent de même valeur.</p>
          <p class="display-6 color-perso">Les actifs qui s'échangent sous forme de NFT</p>
          <p class="text-white">Bien que le marché des NFT se soit popularisé ces derniers mois grâce à différentes ventes d'art numérique, les actifs échangés sous 
          forme de NFT sont de natures bien plus vastes que le simple domaine artistique.
          On y trouve de tout, et surtout tout ce qui est collectionnable :<br><br>
          ► Des collectibles, avatars et objets rares de jeux-vidéos, dont les Cryptokitties en sont l'exemple le plus célèbre.<br>
          ► Des Memes et des GIF, ces formats courts qui s'échangent sur les réseaux sociaux, comme le très connu Nyan Cat, vendu par son créateur en février 2021 pour la coquette somme de 580 000$.<br>
          ► Des Metaverses, qui sont des certificats de propriété de parcelles de terrain virtuelles dans des mondes numériques, tels que Decentraland par exemple.<br>
          ► Des Trading Game Cards, sortes de cartes à jouer virtuelles et échangeables, fonctionnant sur le même principe que les cartes à collectionner classiques : plusieurs éditions, des cartes rares, des cartes communes…<br>
          ► De l' Art : qu'il s'agisse d'art numérique ou d'art vidéo, de photographies non-imprimées sur un support physique… Les NFT peuvent également servir de certificat d'authenticité pour attester de la régularité d'une œuvre matérielle, 
          physique, telle qu'un tableau ou une sculpture.<br>
          ► Et aussi : des vidéos de NBA, des paires de chaussures Nike virtuelles, de la musique, des photographies et tweets de personnalités, du contenu pour adulte… Globalement, tout ce que l'on trouve sur Internet peut être échangé sous forme de NFT.</p>
          <p class="display-6 color-perso">Quel avenir pour les NFT ?</p>
          <p class="text-white">Après les nombreuses ventes records très médiatisées en février et mars 2021, il semble que le puissant dynamisme de ce récent segment commence à s'atténuer. 
          Rien d'étonnant à cela, puisqu'un nouveau marché est souvent synonyme de spéculations excessives liées à l'attrait d'une nouvelle clientèle curieuse perturbant ainsi les lois « naturelles » de l'offre et de la demande. 
          Il reste alors à savoir si l'on assiste à l'éclatement d'une bulle spéculative, ou bien s'il s'agit simplement d'une correction de trajectoire qui, à termes, stabilisera les prix et pérennisera ce marché à fort potentiel.</p>
          <p class="display-6 color-perso">Quels sont les avantages des Shiba Club NFT ?</p>
          <p class="text-white">Nos membres ont accès à des événements et concours haut de gamme. Siroter des cocktails avec des célébrités lors de nos événements en personne ou gagner 20 000 €
          dans des jeux de poker réservés aux membres ne sont que quelques-uns des avantages que vous obtenez en étant un membre Elite du Shiba Social club. Au Shiba Social Club, tout le monde est traité comme un VIP.</p>
          <p class="display-6 color-perso" id="graphistes">Nos graphistes</p>
          <p class="text-white">Nos graphistes sont originaires de France mais aussi d'Angleterre, des États-Unis, d'Allemagne et d'Italie. Tous ont eu plus de 3 ans de formation dans le design, le photoshop, le dessin et le graphisme.
          Notre équipe de graphistes est composé de 13 personnes (9 hommes et 4 femmes). Notre équipe de graphistes vous proposent dès à présent des centaines d'images de qualité avec plusieurs styles différents.</p>
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