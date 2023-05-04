<?php

/**
 * /view/paiement.php
 * 
 * Page de paiement
 *
 * @author A. Espinoza
 * @date 03/2022
 */

if(!isset($_SESSION['user']) || empty($lesNfts)){
  header('Location: '.SERVER_URL.'/erreur/');
} else {

$title = 'Paiement | Shiba Club Nft';
$actifA = '';
$actifB = '';
$actifN = '';
include 'header.php';

$panier = new Panier();
?>

    <!-- Contenu -->
    <form method="POST" action="<?= SERVER_URL ?>/paiement/">
      <div class="container mt-5 mb-5 bg-dark p-5">
        <div class="row">
          <div class="col-lg-8">
            <h2 class="text-light">Adresse de livraison</h2>
            <div class="row">
              <div class="col-lg-5">
                <div class="form-floating my-3">
                  <input type="text" name="ville" class="form-control" id="floatingInput1" placeholder="Ville" minlength="2" maxlength="32" required>
                  <label for="floatingInput1" class="text-light">Ville</label>
                </div>
              </div>
              <div class="col-lg-5">
                <div class="form-floating my-3">
                  <input type="text" name="cpt" class="form-control" id="floatingInput2" placeholder="Code Postale" pattern="[0-9]{5}" minlength="5" maxlength="5" required>
                  <label for="floatingInput2" class="text-light">Code Postale</label>
                </div>
              </div>
            </div>
            <div class="offset-1 col-lg-8">
              <div class="form-floating my-3">
                <input type="text" name="adresse" class="form-control" id="floatingInput3" placeholder="Adresse" minlength="5" maxlength="100" required>
                <label for="floatingInput3" class="text-light">Adresse</label>
              </div>
            </div>
            <h2 class="text-light">Options de livraison</h2>
            <div class="form-check">
              <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1" disabled>
              <div class="row">
                <div class="col-lg-6">
                  <span class="text-black"><strong>(Indisponible) Livraison standard avec Colissimo</strong><br></span>
                </div>
                <div class="col-lg-2">
                  <p class="text-end color-perso text-uppercase"><strong>4.95 €</strong></p>
                </div>
              </div>
              <p class="text-muted">Livraison prévue avant ou pour le <?php 
              // Fonction afficher date en français
              function date_fran()
              {
                $mois = array("Janvier", "Février", "Mars",
                "Avril","Mai", "Juin", 
                "Juillet", "Août","Septembre",
                "Octobre", "Novembre", "Decembre");
                $jours= array("Dimanche", "Lundi", "Mardi",
                "Mercredi", "Jeudi", "Vendredi",
                "Samedi");
                return $jours[date("w")]." ".date("j").(date("j")==1 ? "er":" ").
                $mois[date("n")-1]." ".date("Y");
              }
              // Affiche la date du jour
              echo date_fran();
              ?></p>
              <p class="info text-light"><i class="fas fa-info-circle"></i>&nbsp; Aucune livraison les jours fériés.</p><br>        
            </div>
            <div class="form-check">
              <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2" checked>
              <div class="row">
                <div class="col-lg-6">
                  <span class="text-black"><strong>Livraison par email</strong></span><br>
                </div>
                <div class="col-lg-2">
                  <p class="text-end color-perso text-uppercase"><strong>Gratuit</strong></p>
                </div>
              </div>
              <p class="text-muted">Livraison prévue dès l'achat de la photo dans votre boîte mail</p><br>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault3" disabled>
              <div class="row">
                <div class="col-lg-6">
                  <span class="text-black"><strong>(Indisponible) Livraison 24h</strong></span><br>
                </div>
                <div class="col-lg-2">
                  <p class="text-end color-perso text-uppercase"><strong>10.00 €</strong></p>
                </div>
              </div>
              <p class="text-muted">Livraison entre 7h et 22h le <?= date_fran() ?></p>
              <p class="info text-light"><i class="fas fa-info-circle"></i>&nbsp; Aucune livraison les jours fériés.</p>
            </div>
            <h2 class="text-light">Adresse de facturation</h2>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" id="checkFac" onclick="aFacturation()">
                <label class="form-check-label text-light" for="flexCheckDefault">
                  Utiliser la même adresse que pour l'adresse de livraison
                </label>
              </div>
            <div class="row" id="divFac">
              <div class="col-lg-5">
                <div class="form-floating my-3">
                  <input type="text" class="form-control" id="floatingInput4" placeholder="Ville" minlength="2" maxlength="32">
                  <label for="floatingInput4" class="text-light">Ville</label>
                </div>
              </div>
              <div class="col-lg-5">
                <div class="form-floating my-3">
                  <input type="text" class="form-control" id="floatingInput5" placeholder="Code Postale" pattern="[0-9]{5}" minlength="5" maxlength="5">
                  <label for="floatingInput5" class="text-light">Code Postale</label>
                </div>
              </div>
              <div class="offset-1 col-lg-8">
                <div class="form-floating my-3">
                  <input type="text" class="form-control" id="floatingInput6" placeholder="Adresse" minlength="5" maxlength="100">
                  <label for="floatingInput6" class="text-light">Adresse</label>
                </div>
              </div>
            </div>
            
            <h2 class="text-light">Mode de paiement</h2>
            <a href="https://www.paypal.com/signin" class="btn btn-outline-light mb-4 color-perso"> 
              <i class="fab fa-paypal"></i>&nbsp; Paypal
            </a>
            <button type="button" name="visa" id="visa" class="btn btn-outline-light mb-4 color-perso"> 
              <i class="fab fa-cc-visa"></i>&nbsp; Carte Bancaire
            </button>
            <div class="d-none" id="divVisa">
              <div class="row">
                <div class="col-lg-6">
                  <div class="form-floating my-3">
                    <input type="text" name="numCB" class="form-control" id="floatingInput7" placeholder="Numéro de carte" pattern="^[0-9]*$" maxlength="16" required>
                    <label for="floatingInput7" class="text-light">Numéro de carte</label>                                
                  </div>
                </div>
              </div>
              <div class="row mb-3">
                <div class="col-lg-3">
                  <label for="validationCustom01" class="form-label text-light">Date d'expiration</label>
                  <select class="form-select p-3" id="validationCustom01" aria-label="Default select example">
                    <option selected>Mois</option>
                    <option value="01">01</option>
                    <option value="02">02</option>
                    <option value="03">03</option>
                    <option value="04">04</option>
                    <option value="05">05</option>
                    <option value="06">06</option>
                    <option value="07">07</option>
                    <option value="08">08</option>
                    <option value="09">09</option>
                    <option value="10">10</option>
                    <option value="11">11</option>
                    <option value="12">12</option>
                  </select>
                </div>
                <div class="col-lg-2">
                  <label for="validationCustom02" class="form-label text-light"></label>
                  <select class="form-select p-3 mt-2" id="validationCustom02" aria-label="Default select example">
                    <option selected>Année</option>
                    <option value="2023">2023</option>
                    <option value="2024">2024</option>
                    <option value="2025">2025</option>
                    <option value="2026">2026</option>
                    <option value="2027">2027</option>
                    <option value="2028">2028</option>
                    <option value="2029">2029</option>
                    <option value="2030">2030</option>
                    <option value="2031">2031</option>
                    <option value="2032">2032</option>
                  </select>
                </div>
              </div>
              <div class="row">
                <div class="col-lg-6">
                  <div class="form-floating my-3">
                    <input type="tel" name="nomCB" class="form-control" id="floatingInput8" placeholder="Nom apparaissant sur la carte" maxlength="32" required>
                    <label for="floatingInput8" class="text-light">Nom apparaissant sur la carte</label>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-lg-2">
                  <div class="form-floating my-3">
                    <input type="tel" name="cvvCB" class="form-control" id="floatingInput9" placeholder="Cvv" pattern="^[0-9]*$" maxlength="3" required>
                    <label for="floatingInput9" class="text-light">Cvv</label>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-10">
              <button class="bouton-cmd text-white text-center ms-5" type="submit">Commander</button>
              <p class="text-light">En passant votre commande, vous acceptez nos <a class="inscrip" href="<?= SERVER_URL ?>/conditions/">Modalités</a>, ainsi que <a class="inscrip" href="<?= SERVER_URL ?>/politique/">nos politiques de confidentialité</a> et de <a class="inscrip" href="<?= SERVER_URL ?>/ventes/">retour</a>. Vous consentez à ce que certaines de vos données, qui seront utilisées pour améliorer le processus d'achats, soient enregistrées par Shiba Club NFT.</p>
            </div>
          </div>
          <div class="col-lg-4">
            <div class="col-lg-7">
              <div class="row">
                <div class="col-lg-10">
                  <p class="text-light"><?= $_SESSION['panier'] ?> Articles</p>
                </div>
                <div class="col-lg-2">
                  <p class="text-end"><a class="inscrip" href="<?= SERVER_URL ?>/panier/">Changer</a></p>
                </div>
              </div>
            </div>
              
            <div class="card mb-3">
              <?php foreach($lesNfts as $nft) { 
                $img = '<img src="'.SERVER_URL.'/'.$nft->getPathPhoto().'" alt="photo_'.$nft->getRefInterne().'" class="img-fluid rounded-start">';
              ?>
              <div class="row g-0">
                <div class="col-md-4" >
                  <?= $img ?>
                </div>
                <div class="col-md-8">
                  <div class="card-body">
                    <h6><strong><?= $nft->getPrixVenteUht() ?> €</strong></h6>                         
                    <p class="card-text"><?= $nft->getLibelle() ?></p>
                    <p class="card-text">Qté: <strong><?php if($nft->getQuantiteStock() < $nft->getQtePanier()) { echo $nft->getQuantiteStock(); $nft->setQtePanier($nft->getQuantiteStock()); } else { echo $nft->getQtePanier(); }?></strong></p>
                  </div>                            
                </div>
              </div>
              <?php } ?>
            </div>
            <div class="row">
              <div class="col-lg-6">
                <p class="text-light">Sous-total</p>
              </div>
              <div class="col-lg-6">
                <p class="text-light text-end"><?= $panier->total() ?> €</p>
              </div>
            </div>
            <div class="row">
              <div class="col-lg-6">
                <p class="text-light">Livraison</p>
              </div>
              <div class="col-lg-6">
                <p class="text-light text-end">Gratuit</p>
              </div>
            </div>
            <div class="row">
              <div class="col-lg-6">
                <p class="text-light text-uppercase"><strong>Total à régler</strong></p>
              </div>
              <div class="col-lg-6">
                <p class="text-light text-end"><strong><?= $panier->total()/1.5 ?> €</strong></p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </form>
    <!-- Contenu -->

    <!-- Début footer -->
    <?php include 'footer.php';?>
    <!-- Fin footer -->
        
    <!-- JS Libraries --> 
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="<?= SERVER_URL ?>/js/paiement.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
  </body>
</html>
<?php } ?>
