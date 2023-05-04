<?php
/**
 * /view/editClient.php
 * 
 * Page pour la modification d'un client
 * @author A. Espinoza
 * @date 03/2023
 */

 if(!isset($_SESSION['user']) || $exist == false || $_SESSION['user']->getRole() != 'admin') {
    header('Location: '.SERVER_URL.'/erreur/');
} else {

$title = 'Modifier Client | Shiba Club Nft';
$actifA = '';
$actifB = '';
$actifN = '';
include 'header.php';

?> 

        <form class="needs-validation m-4 py-5" method="POST" action="/client/<?= $unClient->getId() ?>/">
            <div class="text-center d-flex justify-content-center mt-5">
                <?= $mess ?>
            </div>
            <div class="row text-center">
                <h1 class="mb-4">Détail du Client n°<?= $unClient->getId() ?></h1>
            </div>
            <div class="row justify-content-center mt-3">
                <div class="col-lg-5">
                    <div class="mb-3">
                        <label for="nom">Nom</label>       
                        <input type="text" name="nom" class="form-control" id="nom" placeholder="Nom de famille" value="<?= $unClient->getNom() ?>" pattern="^[A-Za-z]+$" minlength="2" maxlength="64" required>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-lg-5">
                    <div class="mb-3">
                        <label for="prenom">Prénom</label>       
                        <input type="text" name="prenom" class="form-control" id="prenom" placeholder="Prénom" value="<?= $unClient->getPrenom() ?>" pattern="^[A-Za-z]+$" minlength="2" maxlength="64" required> 
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-lg-5">
                    <div class="mb-3">
                        <label for="email">Email</label>       
                        <input type="text" name="email" class="form-control" id="email" placeholder="Email" value="<?= $unClient->getEmail() ?>" pattern="^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$" maxlength="128" required> 
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-lg-5">
                    <div class="mb-3">
                    <label class="form-label">Pays / Région</label>
                        <select class="form-select p-3" id="select-pays" name="pays" aria-label="Default select example">
                        <option selected><?= $unClient->getPays() ?></option>
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
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-lg-5">
                    <div class="mb-3">
                        <label for="date">Date de naissance</label>
                        <input type="date" name="date" class="form-control" id="date" value="<?= $unClient->getDateNaissance()->format('Y-m-d') ?>" required min="1910-01-01" max="2012-01-01">
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-lg-5">
                    <div class="mb-3">
                        <label for="mdp">Mot de passe</label>
                        <input type="password" name="mdp" class="form-control" id="mdp" value="<?= $unClient->getMdp() ?>" placeholder="Mot de passe" required pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" minlength="8" TITLE="Le mot de passe doit contenir au moins 8 caractères composés d'au moins un chiffre et d'une lettre majuscule et minuscule.">
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-lg-5">
                    <div class="mb-3">
                        <label for="tel">Numéro de téléphone</label>
                        <input type="tel" name="tel" class="form-control" id="tel" value="0<?= $unClient->getTel() ?>" placeholder="Numéro de téléphone" pattern="[0]{1}[0-9]{9}" minlength="10" maxlength="10">
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-lg-2">
                    <button class="btnGreen" data-id="<?= $unClient->getId() ?>" name="editSubmit" type="submit">Enregistrer <i class='bx bx-save'></i></button>
                </div>
            </div>
        </form>
        <div class="container">
            <div class="row text-center">
                <div class="col-lg-2 mb-5">
                    <a href="/produit/" class="offset-2 btnBlue"><i class='bx bx-undo'></i>&nbsp;Dashboard</a>
                </div>
            </div>
            <div class="row text-center justify-content-center">
                <div class="col-lg-6 col-md-6 col-sm-6 col-6 mb-3" id="dClient">
                    <button class="btnRed deleteSubmit" name="deleteSubmit" data-bs-toggle="modal" data-bs-target="#modalClient" data-id="<?= $unClient->getId() ?>">Supprimer <i class='bx bx-trash'></i></button>
                </div>
            </div>
        </div>

        <div id="modalClient" class="modal fade" role="dialog">
            <div class="modal-dialog modal-confirm">
                <div class="modal-content">
                    <div class="modal-header flex-column">
                        <div class="icon-box">
                            <i class="bx bx-trash"></i>
                        </div>
                        <h4 class="modal-title w-100">Êtes-vous sûr ?</h4>
                          <button class="btn-close close" data-id="<?= $unClient->getId() ?>" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p>Voulez-vous vraiment supprimer ce client ? Cela entraînera une suppression définitive !</p>
                    </div>
                    <div class="modal-footer justify-content-center">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                        <button type="button" class="btn btn-danger" id="confirm-delete">Supprimer</button>
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
        <script type="text/javascript" src="/js/editClient.js"></script>
    </body>
</html>
<?php } ?>