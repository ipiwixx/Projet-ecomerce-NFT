<?php

/**
 * /view/inscription.php
 *
 * Page du formulaire d'inscription
 *
 * @author A. Espinoza
 * @date 02/2022
 */

if (isset($_SESSION['user'])) {
  header('Location: ' . SERVER_URL . '/erreur/');
} else {

  $title = 'Inscription | Shiba Club Nft';
  $actifA = '';
  $actifB = '';
  $actifN = '';
  include_once 'header.php';

?>

  <!-- Début jumbotron -->
  <div class="jumbotron mt-5 pt-5">
    <h3 class="display-6 text-center">Créer votre compte Shiba Club NFT</h3>
    <p class="lead text-center">Inscriver vous pour pouvoir commander des produits.<br>
      Vous avez déjà un compte Shiba Club NFT ? <span class="inscrip"><a class="inscrip" href="<?= SERVER_URL ?>/connexion/">Retrouvez-le ici</a></span>.</p>
  </div>
  <!-- Fin jumbotron -->

  <div class="d-flex justify-content-center text-center">
    <?= $mess ?>
  </div>

  <!-- Début formulaire inscription -->
  <form method="POST" action="<?= SERVER_URL ?>/inscription/" class="row g-3 needs-validation bg-dark m-4 py-4">
    <div class="col-lg-4"></div>
    <div class="col-lg-2">
      <div class="col-lg-5"></div>
      <div class="form-floating mb-3">
        <input type="text" name="prenom" class="form-control" id="floatingInput1" placeholder="Prénom" required pattern="^[A-Za-z]+$" minlength="2" maxlength="64">
        <label for="floatingInput1" class="text-light">Prénom</label>
      </div>
    </div>
    <div class="col-lg-2">
      <div class="form-floating mb-3">
        <input type="text" name="nom" class="form-control" id="floatingInput2" placeholder="Nom de famille" required pattern="^[A-Za-z]+$" minlength="2" maxlength="64">
        <label for="floatingInput2" class="text-light">Nom de Famille</label>
      </div>
    </div>
    <div class="col-lg-1"></div>
    <div class="col-lg-4"></div>
    <div class="col-lg-4">
      <label class="form-label text-light">Pays / Région</label>
      <select class="form-select p-3" id="select-pays" name="pays" aria-label="Default select example">
        <option selected>France</option>
        <option value="Afghanistan" dir="auto">Afghanistan</option>
        <option value="Afrique-du-Sud" dir="auto">Afrique du Sud</option>
        <option value="Albanie" dir="auto">Albanie</option>
        <option value="Algerie" dir="auto">Algérie</option>
        <option value="Allemagne" dir="auto">Allemagne</option>
        <option value="Andorre" dir="auto">Andorre</option>
        <option value="Angola" dir="auto">Angola</option>
        <option value="Anguilla" dir="auto">Anguilla</option>
        <option value="Antarctique" dir="auto">Antarctique</option>
        <option value="Antigua-et-Barbuda" dir="auto">Antigua-et-Barbuda</option>
        <option value="Arabie-saoudite" dir="auto">Arabie saoudite</option>
        <option value="Argentine" dir="auto">Argentine</option>
        <option value="Armenie" dir="auto">Arménie</option>
        <option value="Aruba" dir="auto">Aruba</option>
        <option value="Australie" dir="auto">Australie</option>
        <option value="Autriche" dir="auto">Autriche</option>
        <option value="Azerbaidjan" dir="auto">Azerbaïdjan</option>
        <option value="Bahamas" dir="auto">Bahamas</option>
        <option value="Bahrein" dir="auto">Bahreïn</option>
        <option value="Bangladesh" dir="auto">Bangladesh</option>
        <option value="Barbade" dir="auto">Barbade</option>
        <option value="Belgique" dir="auto">Belgique</option>
        <option value="Belize" dir="auto">Belize</option>
        <option value="Benin" dir="auto">Bénin</option>
        <option value="Bermudes" dir="auto">Bermudes</option>
        <option value="Bhoutan" dir="auto">Bhoutan</option>
        <option value="Bielorussie" dir="auto">Biélorussie</option>
        <option value="Bolivie" dir="auto">Bolivie</option>
        <option value="Bosnie-Herzegovine" dir="auto">Bosnie-Herzégovine</option>
        <option value="Botswana" dir="auto">Botswana</option>
        <option value="Bresil" dir="auto">Brésil</option>
        <option value="Brunei-Darussalam" dir="auto">Brunéi Darussalam</option>
        <option value="Bulgarie" dir="auto">Bulgarie</option>
        <option value="Burkina-Faso" dir="auto">Burkina Faso</option>
        <option value="Burundi" dir="auto">Burundi</option>
        <option value="Cambodge" dir="auto">Cambodge</option>
        <option value="Cameroun" dir="auto">Cameroun</option>
        <option value="Canada" dir="auto">Canada</option>
        <option value="Cap-Vert" dir="auto">Cap-Vert</option>
        <option value="Chili" dir="auto">Chili</option>
        <option value="Chine" dir="auto">Chine</option>
        <option value="Chypre" dir="auto">Chypre</option>
        <option value="Colombie" dir="auto">Colombie</option>
        <option value="Comores" dir="auto">Comores</option>
        <option value="Coree-du-Sud" dir="auto">Corée du Sud</option>
        <option value="Costa-Rica" dir="auto">Costa Rica</option>
        <option value="Cote-d'Ivoire" dir="auto">Côte d'Ivoire</option>
        <option value="Croatie" dir="auto">Croatie</option>
        <option value="Curaçao" dir="auto">Curaçao</option>
        <option value="Danemark" dir="auto">Danemark</option>
        <option value="Djibouti" dir="auto">Djibouti</option>
        <option value="Dominique" dir="auto">Dominique</option>
        <option value="Egypte" dir="auto">Égypte</option>
        <option value="Emirats-arabes-unis" dir="auto">Émirats arabes unis</option>
        <option value="Equateur" dir="auto">Équateur</option>
        <option value="Erythree" dir="auto">Érythrée</option>
        <option value="Espagne" dir="auto">Espagne</option>
        <option value="Estonie" dir="auto">Estonie</option>
        <option value="Eswatini" dir="auto">Eswatini</option>
        <option value="Vatican" dir="auto">État de la Cité du Vatican</option>
        <option value="Micronesie" dir="auto">États fédérés de Micronésie</option>
        <option value="Etats-Unis" dir="auto">États-Unis</option>
        <option value="Ethiopie" dir="auto">Éthiopie</option>
        <option value="Fidji" dir="auto">Fidji</option>
        <option value="Finlande" dir="auto">Finlande</option>
        <option value="France" dir="auto">France</option>
        <option value="Gabon" dir="auto">Gabon</option>
        <option value="Gambie" dir="auto">Gambie</option>
        <option value="Georgie" dir="auto">Géorgie</option>
        <option value="Georgie-Sud" dir="auto">Géorgie du Sud et îles Sandwich du Sud</option>
        <option value="Ghana" dir="auto">Ghana</option>
        <option value="Gibraltar" dir="auto">Gibraltar</option>
        <option value="Grece" dir="auto">Grèce</option>
        <option value="Grenade" dir="auto">Grenade</option>
        <option value="Groenland" dir="auto">Groenland</option>
        <option value="Guadeloupe" dir="auto">Guadeloupe</option>
        <option value="Guam" dir="auto">Guam</option>
        <option value="Guatemala" dir="auto">Guatemala</option>
        <option value="Guernesey" dir="auto">Guernesey</option>
        <option value="Guinee" dir="auto">Guinée</option>
        <option value="Guinee-Bissau" dir="auto">Guinée-Bissau</option>
        <option value="Guinee-équatoriale" dir="auto">Guinée équatoriale</option>
        <option value="Guyana" dir="auto">Guyana</option>
        <option value="Guyane-française" dir="auto">Guyane française</option>
        <option value="Haiti" dir="auto">Haïti</option>
        <option value="Honduras" dir="auto">Honduras</option>
        <option value="Hong-Kong" dir="auto">Hong Kong</option>
        <option value="Hongrie" dir="auto">Hongrie</option>
        <option value="Bouvet" dir="auto">Île Bouvet</option>
        <option value="Christmas" dir="auto">Île Christmas</option>
        <option value="Man" dir="auto">Île de Man</option>
        <option value="Norfolk" dir="auto">Île Norfolk</option>
        <option value="Caimans" dir="auto">Îles Caïmans</option>
        <option value="Cocos" dir="auto">Îles Cocos</option>
        <option value="Cook" dir="auto">Îles Cook</option>
        <option value="Aland" dir="auto">Îles d'Åland</option>
        <option value="Feroe" dir="auto">Îles Féroé</option>
        <option value="Heard" dir="auto">Îles Heard et McDonald</option>
        <option value="Malouines" dir="auto">Îles Malouines</option>
        <option value="Mariannes-Nord" dir="auto">Îles Mariannes du Nord</option>
        <option value="Marshall" dir="auto">Îles Marshall</option>
        <option value="Iles-Etats-Unis" dir="auto">Îles mineures éloignées des États-Unis</option>
        <option value="Pitcairn" dir="auto">Îles Pitcairn</option>
        <option value="Salomon" dir="auto">Îles Salomon</option>
        <option value="Turques-et-Caiques" dir="auto">Îles Turques-et-Caïques</option>
        <option value="Vierges-Britanniques" dir="auto">Îles Vierges britanniques</option>
        <option value="Vierges-Etats-Unis" dir="auto">Îles Vierges des États-Unis</option>
        <option value="Inde" dir="auto">Inde</option>
        <option value="Indonesie" dir="auto">Indonésie</option>
        <option value="Irak" dir="auto">Irak</option>
        <option value="Irlande" dir="auto">Irlande</option>
        <option value="Islande" dir="auto">Islande</option>
        <option value="Israel" dir="auto">Israël</option>
        <option value="Italie" dir="auto">Italie</option>
        <option value="Jamaique" dir="auto">Jamaïque</option>
        <option value="Japon" dir="auto">Japon</option>
        <option value="Jersey" dir="auto">Jersey</option>
        <option value="Jordanie" dir="auto">Jordanie</option>
        <option value="Kazakhstan" dir="auto">Kazakhstan</option>
        <option value="Kenya" dir="auto">Kenya</option>
        <option value="Kirghizistan" dir="auto">Kirghizistan</option>
        <option value="Kiribati" dir="auto">Kiribati</option>
        <option value="Kosovo" dir="auto">Kosovo</option>
        <option value="Koweit" dir="auto">Koweït</option>
        <option value="Laos" dir="auto">Laos</option>
        <option value="La-Reunion" dir="auto">La Réunion</option>
        <option value="Lesotho" dir="auto">Lesotho</option>
        <option value="Lettonie" dir="auto">Lettonie</option>
        <option value="Liban" dir="auto">Liban</option>
        <option value="Liberia" dir="auto">Libéria</option>
        <option value="Libye" dir="auto">Libye</option>
        <option value="Liechtenstein" dir="auto">Liechtenstein</option>
        <option value="Lituanie" dir="auto">Lituanie</option>
        <option value="Luxembourg" dir="auto">Luxembourg</option>
        <option value="Macao" dir="auto">Macao</option>
        <option value="Macedoine" dir="auto">Macedoine du Nord</option>
        <option value="Madagascar" dir="auto">Madagascar</option>
        <option value="Malaisie" dir="auto">Malaisie</option>
        <option value="Malawi" dir="auto">Malawi</option>
        <option value="Maldives" dir="auto">Maldives</option>
        <option value="Mali" dir="auto">Mali</option>
        <option value="Malte" dir="auto">Malte</option>
        <option value="Maroc" dir="auto">Maroc</option>
        <option value="Martinique" dir="auto">Martinique</option>
        <option value="Maurice" dir="auto">Maurice</option>
        <option value="Mauritanie" dir="auto">Mauritanie</option>
        <option value="Mayotte" dir="auto">Mayotte</option>
        <option value="Mexique" dir="auto">Mexique</option>
        <option value="Moldavie" dir="auto">Moldavie</option>
        <option value="Monaco" dir="auto">Monaco</option>
        <option value="Mongolie" dir="auto">Mongolie</option>
        <option value="Montenegro" dir="auto">Monténégro</option>
        <option value="Montserrat" dir="auto">Montserrat</option>
        <option value="Mozambique" dir="auto">Mozambique</option>
        <option value="Myanmar" dir="auto">Myanmar (Birmanie)</option>
        <option value="Namibie" dir="auto">Namibie</option>
        <option value="Nauru" dir="auto">Nauru</option>
        <option value="Nepal" dir="auto">Népal</option>
        <option value="Nicaragua" dir="auto">Nicaragua</option>
        <option value="Niger" dir="auto">Niger</option>
        <option value="Nigeria" dir="auto">Nigéria</option>
        <option value="Niue" dir="auto">Niue</option>
        <option value="Norvege" dir="auto">Norvège</option>
        <option value="Nouvelle-Caledonie" dir="auto">Nouvelle-Calédonie</option>
        <option value="Nouvelle-Zelande" dir="auto">Nouvelle-Zélande</option>
        <option value="Oman" dir="auto">Oman</option>
        <option value="Ouganda" dir="auto">Ouganda</option>
        <option value="Ouzbékistan" dir="auto">Ouzbékistan</option>
        <option value="Pakistan" dir="auto">Pakistan</option>
        <option value="Palaos" dir="auto">Palaos</option>
        <option value="Panama" dir="auto">Panama</option>
        <option value="Papouasie-Nouvelle-Guinee" dir="auto">Papouasie-Nouvelle-Guinée</option>
        <option value="Paraguay" dir="auto">Paraguay</option>
        <option value="Pays-Bas" dir="auto">Pays-Bas</option>
        <option value="Pays-Bas-caribeens" dir="auto">Pays-Bas caribéens</option>
        <option value="Perou" dir="auto">Pérou</option>
        <option value="Philippines" dir="auto">Philippines</option>
        <option value="Pologne" dir="auto">Pologne</option>
        <option value="Polynesie-française" dir="auto">Polynésie française</option>
        <option value="Porto-Rico" dir="auto">Porto Rico</option>
        <option value="Portugal" dir="auto">Portugal</option>
        <option value="Qatar" dir="auto">Qatar</option>
        <option value="Republique-centrafricaine" dir="auto">République centrafricaine</option>
        <option value="Republique-demo-Congo" dir="auto">République démo. du Congo</option>
        <option value="Republique-dominicaine" dir="auto">République dominicaine</option>
        <option value="eépublique-du-Congo" dir="auto">République du Congo</option>
        <option value="Roumanie" dir="auto">Roumanie</option>
        <option value="Royaume-Uni" dir="auto">Royaume-Uni</option>
        <option value="Russie" dir="auto">Russie</option>
        <option value="Rwanda" dir="auto">Rwanda</option>
        <option value="Sahara-occidental" dir="auto">Sahara occidental</option>
        <option value="Saint-Barthélemy" dir="auto">Saint-Barthélemy</option>
        <option value="Saint-Christophe-et-Nieves" dir="auto">Saint-Christophe-et-Niévès</option>
        <option value="Sainte-Helene" dir="auto">Sainte-Hélène</option>
        <option value="Sainte-Lucie" dir="auto">Sainte-Lucie</option>
        <option value="Saint-Marin" dir="auto">Saint-Marin</option>
        <option value="Saint-Martin" dir="auto">Saint-Martin</option>
        <option value="Saint-Martin-autres" dir="auto">Saint-Martin (partie néerlandaise)</option>
        <option value="Saint-Pierre-et-Miquelon" dir="auto">Saint-Pierre-et-Miquelon</option>
        <option value="Saint-Vincent-et-les-Grenadines" dir="auto">Saint-Vincent-et-les-Grenadines</option>
        <option value="Salvador" dir="auto">Salvador</option>
        <option value="SamoaWSM" dir="auto">Samoa</option>
        <option value="Samoa-americaines" dir="auto">Samoa américaines</option>
        <option value="Sao-Tome-et-Principe" dir="auto">Sao Tomé-et-Principe</option>
        <option value="Senegal" dir="auto">Sénégal</option>
        <option value="Serbie" dir="auto">Serbie</option>
        <option value="Seychelles" dir="auto">Seychelles</option>
        <option value="Sierra-Leone" dir="auto">Sierra Leone</option>
        <option value="Singapour" dir="auto">Singapour</option>
        <option value="Slovaquie" dir="auto">Slovaquie</option>
        <option value="Slovenie" dir="auto">Slovénie</option>
        <option value="Somalie" dir="auto">Somalie</option>
        <option value="Soudan" dir="auto">Soudan</option>
        <option value="Soudan-du-Sud" dir="auto">Soudan du Sud</option>
        <option value="Sri-Lanka" dir="auto">Sri Lanka</option>
        <option value="Suede" dir="auto">Suède</option>
        <option value="Suisse" dir="auto">Suisse</option>
        <option value="Suriname" dir="auto">Suriname</option>
        <option value="Svalbard-et-Jan-Mayen" dir="auto">Svalbard et Jan Mayen</option>
        <option value="Tadjikistan" dir="auto">Tadjikistan</option>
        <option value="Taiwan" dir="auto">Taïwan</option>
        <option value="Tanzanie" dir="auto">Tanzanie</option>
        <option value="Tchad" dir="auto">Tchad</option>
        <option value="Tchequie" dir="auto">Tchéquie</option>
        <option value="Terres-australes-françaises" dir="auto">Terres australes françaises</option>
        <option value="Territoire-britannique" dir="auto">Territoire britannique de l'océan Indien</option>
        <option value="Territoires-palestiniens" dir="auto">Territoires palestiniens</option>
        <option value="Thailande" dir="auto">Thaïlande</option>
        <option value="Timor-oriental" dir="auto">Timor oriental</option>
        <option value="Togo" dir="auto">Togo</option>
        <option value="Tokelaou" dir="auto">Tokélaou</option>
        <option value="Tonga" dir="auto">Tonga</option>
        <option value="Trinite-et-Tobago" dir="auto">Trinité-et-Tobago</option>
        <option value="Tunisie" dir="auto">Tunisie</option>
        <option value="Turkmenistan" dir="auto">Turkménistan</option>
        <option value="Turquie" dir="auto">Turquie</option>
        <option value="Tuvalu" dir="auto">Tuvalu</option>
        <option value="Ukraine" dir="auto">Ukraine</option>
        <option value="Uruguay" dir="auto">Uruguay</option>
        <option value="Vanuatu" dir="auto">Vanuatu</option>
        <option value="Venezuela" dir="auto">Venezuela</option>
        <option value="Vietnam" dir="auto"> Vietnam</option>
        <option value="Wallis-et-Futuna" dir="auto">Wallis-et-Futuna</option>
        <option value="Yemen" dir="auto">Yémen</option>
        <option value="Zambie" dir="auto">Zambie</option>
        <option value="Zimbabwe" dir="auto">Zimbabwe</option>
      </select>
    </div>
    <div class="col-lg-2"></div>
    <div class="col-lg-4"></div>
    <div class="col-lg-4">
      <div class="form-floating mb-5">
        <input type="date" name="date" class="form-control" id="floatingInput3" required min="1910-01-01" max="2012-01-01">
        <label for="floatingInput3" class="text-light">Date de naissance</label>
      </div>
    </div>
    <div class="col-lg-4"></div>
    <div class="col-lg-4"></div>
    <div class="col-lg-4">
      <div class="form-floating mb-1">
        <input type="email" name="email" class="form-control" id="floatingInput4" placeholder="name@example.com" required pattern="^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$" maxlength="128">
        <label for="floatingInput4" class="text-light">Email</label>
      </div>
      <p class="text-light">Cette adresse sera votre nouvel identifiant Shiba Club NFT.</p>
    </div>
    <div class="col-lg-1"></div>
    <div class="col-lg-4"></div>
    <div class="col-lg-4">
      <div class="form-floating lblU">
        <input type="password" name="mdp" class="form-control old" id="floatingInput5" placeholder="Mot de passe" required pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" minlength="8" TITLE="Le mot de passe doit contenir au moins 8 caractères composés d'au moins un chiffre et d'une lettre majuscule et minuscule.">
        <label for="floatingInput5" class="text-light">Mot de passe</label>
        <div class="password-icon mt-2">
          <i class='bx bx-show oldE'></i>
          <i class='bx bx-low-vision oldEO'></i>
        </div>
      </div>
    </div>
    <div class="col-lg-4"></div>
    <div class="col-lg-4"></div>
    <div class="col-lg-4">
      <div class="form-floating mb-5 lblU">
        <input type="password" name="mdp-confirm" class="form-control new" id="floatingInput6" placeholder="Confirmer le mot de passe" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" minlength="8">
        <label for="floatingInput6" class="text-light">Confirmer le mot de passe</label>
        <div class="password-icon mt-2">
          <i class='bx bx-show newE'></i>
          <i class='bx bx-low-vision newEO'></i>
        </div>
      </div>
    </div>
    <div class="col-lg-1"></div>
    <div class="col-lg-4"></div>
    <div class="col-lg-4">
      <div class="form-floating">
        <input type="tel" name="tel" class="form-control" id="floatingInput7" placeholder="Numéro de téléphone" pattern="[0]{1}[0-9]{9}" minlength="10" maxlength="10">
        <label for="floatingInput7" class="text-light">Numéro de téléphone</label>
      </div>
      <p class="text-light">Assurez-vous de saisir un numéro de téléphone auquel vous pourrez toujours accéder.</p>
    </div>
    <div class="col-lg-5"></div>
    <div class="col-lg-5"></div>
    <div class="col-lg-4"></div>
    <div class="col-4">
      <div class="form-check">
        <input class="form-check-input is-invalid" name="valid" type="checkbox" value="" id="invalidCheck3" aria-describedby="invalidCheck3Feedback" required>
        <label class="form-check-label text-muted" for="invalidCheck3">J'accepte les <a href="<?= SERVER_URL ?>/conditions/" class="inscrip">termes et conditions</a></label>
        <div id="invalidCheck3Feedback" class="text-muted">
          Vous devez accepter avant de soumettre le formulaire.
        </div>
      </div>
    </div>
    <div class="col-lg-1"></div>
    <div class="col-lg-4"></div>
    <div class="col-2">
      <button class="btn btn-light color-perso" name="signupSubmit" type="submit">Continuer</button>
    </div>
  </form>
  <!-- Fin formulaire inscription -->

  <!-- Début footer -->
  <?php
  include_once 'footer.php';
  ?>
  <!-- Fin footer -->

  <!-- JS Libraries -->
  <script src="<?= SERVER_URL ?>/js/inscription.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
  </body>

  </html>
<?php } ?>