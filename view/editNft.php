<?php
/**
 * /view/editNft.php
 * 
 * Page pour la modification d'un nft
 * @author A. Espinoza
 * @date 03/2023
 */

 if(!isset($_SESSION['user']) || $exist == false || $_SESSION['user']->getRole() != 'admin') {
    header('Location: '.SERVER_URL.'/erreur/');
} else {

$title = 'Modifier Produit | Shiba Club Nft';
$actifA = '';
$actifB = '';
$actifN = '';
include 'header.php';

?> 

        <form class="needs-validation m-4 py-5" method="POST" action="/produit/<?= $unNft->getId() ?>/">
            <div class="text-center d-flex justify-content-center mt-5">
                <?= $mess ?>
            </div>
            <div class="row text-center">
                <h1 class="mb-4">Détail du Produit n°<?= $unNft->getId() ?></h1>
            </div>
            <div class="row justify-content-center mt-3">
                <div class="col-lg-5">
                    <div class="mb-3">
                        <label for="refInterne">Référence interne</label>       
                        <input type="text" name="refInterne" class="form-control" id="refInterne" value="<?= $unNft->getRefInterne() ?>" placeholder="Référence interne" maxlength="32" required>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-lg-5">
                    <div class="mb-3">
                        <label for="libelle">Libelle</label>       
                        <input type="text" name="libelle" class="form-control" id="libelle" value="<?= $unNft->getLibelle() ?>" placeholder="Libelle" maxlength="64" required> 
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-lg-5">
                    <div class="mb-3">
                        <label for="resume">Résumé</label>       
                        <input type="text" name="resume" class="form-control" id="resume" value="<?= $unNft->getResume() ?>" placeholder="Résumé" maxlength="128" required> 
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-lg-5">
                    <div class="mb-3">
                        <label for="description">Description</label>       
                        <textarea type="text" name="description" class="form-control" id="description" placeholder="Description" maxlength="256" required><?= $unNft->getDescription() ?></textarea>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-lg-5">
                    <div class="mb-3">
                        <label for="qteStock">Quantité en stock</label>       
                        <input type="text" name="qteStock" class="form-control" id="qteStock" value="<?= $unNft->getQuantiteStock() ?>" placeholder="Quantité en stock" required> 
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-lg-5">
                    <div class="mb-3">
                        <label for="prix">Prix</label>       
                        <input type="text" name="prix" class="form-control" id="prix" value="<?= $unNft->getPrixVenteUht() ?>" placeholder="Prix" required> 
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-lg-5 mb-3">
                    <?php $idCateg = $unNft->getIdCateg();
                        $categ = CategorieManager::getCategorieById($idCateg);
                        $key = array_search($categ, $lesCategories); 
                        if ($key !== false) {
                            unset($lesCategories[$key]);
                        } ?>
                    <label class="text-dark">Catégorie</label>                         
                    <select class="form-select" name="categorie">
                        <option value="<?= $unNft->getIdCateg() ?>" selected><?= $unNft->getLibelleCateg() ?></option>
                        <?php foreach($lesCategories as $uneCateg) { ?>
                        <option value="<?= $uneCateg->getId() ?>"><?= $uneCateg->getLibelle() ?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-lg-2">
                    <button class="btnGreen" data-id="<?= $unNft->getId() ?>" name="editSubmit" type="submit">Enregistrer <i class='bx bx-save'></i></button>
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
                <div class="col-lg-6 col-md-6 col-sm-6 col-6 mb-3" id="dProduit">
                    <button class="btnRed deleteSubmit" name="deleteSubmit" data-bs-toggle="modal" data-bs-target="#modalProduit" data-id="<?= $unNft->getId() ?>">Supprimer <i class='bx bx-trash'></i></button>
                </div>
            </div>
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

        <!-- Début footer -->
        <?php 
        include 'footer.php'; 
        ?>
        <!-- Fin footer -->

        <!-- JS Libraries --> 
        <script type="text/javascript" src="/js/editNft.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    </body>
</html>
<?php } ?>