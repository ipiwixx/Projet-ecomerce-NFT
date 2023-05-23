<?php

/**
 * /view/dashboard.php
 * 
 * Page du dashboard pour admin
 *
 * @author A. Espinoza
 * @date 05/2022
 */

if (!isset($_SESSION['user']) || $_SESSION['user']->getRole() != 'admin') {
    header('Location: ' . SERVER_URL . '/erreur/');
} else {

    $title = 'Dashboard | Shiba Club Nft';
    $actifA = '';
    $actifB = '';
    $actifN = '';
    include 'header.php';

?>

    <div class="container my-5 py-5">

        <div class="row mt-3 text-center mt-5 pt-5 mb-3">
            <div class="col">
                <a href="/produit/" class="btna mt-2">Produits</a>
            </div>
            <div class="col">
                <a href="/client/" class="btna mt-2">Clients</a>
            </div>
            <div class="col">
                <a href="/catégorie/" class="btna mt-2">Catégories</a>
            </div>
        </div>

        <?php if ($_GET['controller'] == 'nft') { ?>

            <?php if (isset($_GET['idC'])) { ?>
                <?php if ($_GET['idC'] == 1) { ?>

                    <div class="tableDash my-5">
                        <div class="row">
                            <div class="col">
                                <p class="fs-3">Produits Shiba Club</p>
                            </div>
                            <div class="col">
                                <?php foreach ($lesCategories as $uneC) { ?>
                                    <a href="/produit/<?= $uneC->getRefInterne() ?>/" class="btn btn-light"><?= $uneC->getLibelle() ?></a>
                                <?php } ?>
                                <a href="/produit/" class="btn btn-light">Tout</a>
                            </div>
                            <div class="col text-end">
                                <a href="/produit/ajouter/" class="btn btn-dark">Ajouter</a>
                            </div>
                        </div>
                        <table class="table table-striped" data-toggle="table" id="tProduitCateg" data-search="true" data-pagination="true" data-page-size="18">
                            <thead>
                                <tr>
                                    <th data-sortable="true" data-field="id">Num</th>
                                    <th data-sortable="true" data-field="refinterne">Référence Interne</th>
                                    <th data-sortable="true" data-field="libelle">Libelle</th>
                                    <th data-sortable="true" data-field="prix">Prix</th>
                                    <th data-sortable="true" data-field="quantite">Quantité en stock</th>
                                    <th data-sortable="true" data-field="categorie">Catégorie</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($lesNfts as $unNft) { ?>
                                    <tr>
                                        <td><?= $unNft->getId() ?></td>
                                        <td><?= $unNft->getRefInterne() ?></td>
                                        <td><?= $unNft->getLibelle() ?></td>
                                        <td><?= $unNft->getPrixVenteUht() ?> €</td>
                                        <td><?= $unNft->getQuantiteStock() ?></td>
                                        <td><?= $unNft->getLibelleCateg() ?></td>
                                        <td><a href="/produit/<?= $unNft->getId() ?>/" class="actionsEdit" data-toggle="tooltip" title="Modifier"><i class='bx bx-edit'></i></a><i class='bx bx-trash ms-3 actionsDelete deleteProduit' data-bs-toggle="modal" data-bs-target="#modalProduit" data-id="<?= $unNft->getId() ?>" data-toggle="tooltip" title="Supprimer"></i></td>
                                    </tr>
                                <?php } ?>
                            </tbody>

                        </table>
                    </div>
                    <div id="modalProduit" class="modal fade" role="dialog">
                        <div class="modal-dialog modal-confirm">
                            <div class="modal-content">
                                <div class="modal-header flex-column">
                                    <div class="icon-box">
                                        <i class="bx bx-trash"></i>
                                    </div>
                                    <h4 class="modal-title w-100">Êtes-vous sûr ?</h4>
                                    <button class="btn-close close" data-id="<?= $unNft->getId() ?>" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <p>Voulez-vous vraiment supprimer ce produit ? Cela entraînera une suppression définitive !</p>
                                </div>
                                <div class="modal-footer justify-content-center">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                                    <button type="button" class="btn btn-danger" id="confirm-delete">Supprimer</button>
                                </div>
                            </div>
                        </div>
                    </div>

                <?php } else if ($_GET['idC'] == 2) { ?>

                    <div class="tableDash my-5">
                        <div class="row">
                            <div class="col">
                                <p class="fs-3">Produits Baby Shiba Club</p>
                            </div>
                            <div class="col">
                                <?php foreach ($lesCategories as $uneC) { ?>
                                    <a href="/produit/<?= $uneC->getRefInterne() ?>/" class="btn btn-light"><?= $uneC->getLibelle() ?></a>
                                <?php } ?>
                                <a href="/produit/" class="btn btn-light">Tout</a>
                            </div>
                            <div class="col text-end">
                                <a href="/produit/ajouter/" class="btn btn-dark">Ajouter</a>
                            </div>
                        </div>
                        <table class="table table-striped" data-toggle="table" id="tProduitCateg" data-search="true" data-pagination="true" data-page-size="18">
                            <thead>
                                <tr>
                                    <th data-sortable="true" data-field="id">Num</th>
                                    <th data-sortable="true" data-field="refinterne">Référence Interne</th>
                                    <th data-sortable="true" data-field="libelle">Libelle</th>
                                    <th data-sortable="true" data-field="prix">Prix</th>
                                    <th data-sortable="true" data-field="quantite">Quantité en stock</th>
                                    <th data-sortable="true" data-field="categorie">Catégorie</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($lesNfts as $unNft) { ?>
                                    <tr>
                                        <td><?= $unNft->getId() ?></td>
                                        <td><?= $unNft->getRefInterne() ?></td>
                                        <td><?= $unNft->getLibelle() ?></td>
                                        <td><?= $unNft->getPrixVenteUht() ?> €</td>
                                        <td><?= $unNft->getQuantiteStock() ?></td>
                                        <td><?= $unNft->getLibelleCateg() ?></td>
                                        <td><a href="/produit/<?= $unNft->getId() ?>/" class="actionsEdit" data-toggle="tooltip" title="Modifier"><i class='bx bx-edit'></i></a><i class='bx bx-trash ms-3 actionsDelete deleteProduit' data-bs-toggle="modal" data-bs-target="#modalProduit" data-id="<?= $unNft->getId() ?>" data-toggle="tooltip" title="Supprimer"></i></td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                    <div id="modalProduit" class="modal fade" role="dialog">
                        <div class="modal-dialog modal-confirm">
                            <div class="modal-content">
                                <div class="modal-header flex-column">
                                    <div class="icon-box">
                                        <i class="bx bx-trash"></i>
                                    </div>
                                    <h4 class="modal-title w-100">Êtes-vous sûr ?</h4>
                                    <button class="btn-close close" data-id="<?= $unNft->getId() ?>" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <p>Voulez-vous vraiment supprimer ce produit ? Cela entraînera une suppression définitive !</p>
                                </div>
                                <div class="modal-footer justify-content-center">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                                    <button type="button" class="btn btn-danger" id="confirm-delete">Supprimer</button>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php }
            } else { ?>

                <div class="tableDash my-5">
                    <div class="row">
                        <div class="col">
                            <p class="fs-3">Produits</p>
                        </div>
                        <div class="col">
                            <?php foreach ($lesCategories as $uneC) { ?>
                                <a href="/produit/<?= $uneC->getRefInterne() ?>/" class="btn btn-light"><?= $uneC->getLibelle() ?></a>
                            <?php } ?>
                            <a href="/produit/" class="btn btn-light">Tout</a>
                        </div>
                        <div class="col text-end">
                            <a href="/produit/ajouter/" class="btn btn-dark">Ajouter</a>
                        </div>
                    </div>
                    <table class="table table-striped" data-toggle="table" id="tProduit" data-search="true" data-pagination="true" data-page-size="18">
                        <thead>
                            <tr>
                                <th data-sortable="true" data-field="id">Num</th>
                                <th data-sortable="true" data-field="refinterne">Référence Interne</th>
                                <th data-sortable="true" data-field="libelle">Libelle</th>
                                <th data-sortable="true" data-field="prix">Prix</th>
                                <th data-sortable="true" data-field="quantite">Quantité en stock</th>
                                <th data-sortable="true" data-field="categorie">Catégorie</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($lesNfts as $unNft) { ?>
                                <tr>
                                    <td><?= $unNft->getId() ?></td>
                                    <td><?= $unNft->getRefInterne() ?></td>
                                    <td><?= $unNft->getLibelle() ?></td>
                                    <td><?= $unNft->getPrixVenteUht() ?> €</td>
                                    <td><?= $unNft->getQuantiteStock() ?></td>
                                    <td><?= $unNft->getLibelleCateg() ?></td>
                                    <td><a href="/produit/<?= $unNft->getId() ?>/" class="actionsEdit" data-toggle="tooltip" title="Modifier"><i class='bx bx-edit'></i></a><i class='bx bx-trash ms-3 actionsDelete deleteProduit' data-bs-toggle="modal" data-bs-target="#modalProduit" data-id="<?= $unNft->getId() ?>" data-toggle="tooltip" title="Supprimer"></i></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
                <div id="modalProduit" class="modal fade" role="dialog">
                    <div class="modal-dialog modal-confirm">
                        <div class="modal-content">
                            <div class="modal-header flex-column">
                                <div class="icon-box">
                                    <i class="bx bx-trash"></i>
                                </div>
                                <h4 class="modal-title w-100">Êtes-vous sûr ?</h4>
                                <button class="btn-close close" data-id="<?= $unNft->getId() ?>" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <p>Voulez-vous vraiment supprimer ce produit ? Cela entraînera une suppression définitive !</p>
                            </div>
                            <div class="modal-footer justify-content-center">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                                <button type="button" class="btn btn-danger" id="confirm-delete">Supprimer</button>
                            </div>
                        </div>
                    </div>
                </div>

            <?php } ?>
        <?php } ?>

        <?php if ($_GET['controller'] == 'client') { ?>

            <div class="tableDash my-5">
                <div class="row">
                    <div class="col">
                        <p class="fs-3">Clients</p>
                    </div>
                    <div class="col text-end">
                        <a href="/client/ajouter/" class="btn btn-dark">Ajouter</a>
                    </div>
                </div>
                <table class="table table-striped" data-toggle="table" data-search="true" data-pagination="true" data-page-size="18" id="tClient">
                    <thead>
                        <tr>
                            <th data-sortable="true" data-field="id">Num</th>
                            <th data-sortable="true" data-field="nom">Nom</th>
                            <th data-sortable="true" data-field="prenom">Prénom</th>
                            <th data-sortable="true" data-field="email">Email</th>
                            <th data-sortable="true" data-field="tel">Téléphone</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($lesClients as $unClient) { ?>
                            <tr>
                                <td><?= $unClient->getId() ?></td>
                                <td><?= $unClient->getNom() ?></td>
                                <td><?= $unClient->getPrenom() ?></td>
                                <td><?= $unClient->getEmail() ?></td>
                                <td>0<?= $unClient->getTel() ?></td>
                                <td><a href="/client/<?= $unClient->getId() ?>/" class="actionsEdit" data-toggle="tooltip" title="Modifier"><i class='bx bx-edit'></i></a><i class='bx bx-trash ms-3 actionsDelete deleteClient' data-bs-toggle="modal" data-bs-target="#modalClient" data-id="<?= $unClient->getId() ?>" data-toggle="tooltip" title="Supprimer"></i></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
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
        <?php } ?>

        <?php if ($_GET['controller'] == 'categorie') { ?>

            <div class="tableDash my-5">
                <div class="row">
                    <div class="col">
                        <p class="fs-3">Catégories</p>
                    </div>
                    <div class="col text-end">
                        <a href="/catégorie/ajouter/" class="btn btn-dark">Ajouter</a>
                    </div>
                </div>
                <table class="table table-striped" data-toggle="table" data-search="true" data-pagination="true" data-page-size="18" id="tCategorie">
                    <thead>
                        <tr>
                            <th data-sortable="true" data-field="id">Num</th>
                            <th data-sortable="true" data-field="nom">Libelle</th>
                            <th data-sortable="true" data-field="prenom">Référence Interne</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($lesCategories as $uneCategorie) { ?>
                            <tr>
                                <td><?= $uneCategorie->getId() ?></td>
                                <td><?= $uneCategorie->getLibelle() ?></td>
                                <td><?= $uneCategorie->getRefInterne() ?></td>
                                <td><a href="/catégorie/<?= $uneCategorie->getId() ?>/" class="actionsEdit" data-toggle="tooltip" title="Modifier"><i class='bx bx-edit'></i></a><i class='bx bx-trash ms-3 actionsDelete deleteCategorie' data-bs-toggle="modal" data-bs-target="#modalCategorie" data-id="<?= $uneCategorie->getId() ?>" data-toggle="tooltip" title="Supprimer"></i></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
            <div id="modalCategorie" class="modal fade" role="dialog">
                <div class="modal-dialog modal-confirm">
                    <div class="modal-content">
                        <div class="modal-header flex-column">
                            <div class="icon-box">
                                <i class="bx bx-trash"></i>
                            </div>
                            <h4 class="modal-title w-100">Êtes-vous sûr ?</h4>
                            <button class="btn-close close" data-id="<?= $uneCategorie->getId() ?>" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <p>Voulez-vous vraiment supprimer cette catégorie ? Cela entraînera une suppression définitive !</p>
                        </div>
                        <div class="modal-footer justify-content-center">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                            <button type="button" class="btn btn-danger" id="confirm-delete">Supprimer</button>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
    </div>

    <!-- Début footer -->
    <?php
    include 'footer.php';
    ?>
    <!-- Fin footer -->

    <!-- JS Libraries -->
    <script src="<?= SERVER_URL ?>/js/dashboard.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/bootstrap-table@1.21.3/dist/bootstrap-table.min.js"></script>
    <script src="https://unpkg.com/bootstrap-table@1.21.3/dist/locale/bootstrap-table-fr-FR.min.js"></script>
    </body>

    </html>
<?php } ?>