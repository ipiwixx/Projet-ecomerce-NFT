<?php
/**
 * /view/editCategorie.php
 * 
 * Page pour la modification d'une catégorie
 * @author A. Espinoza
 * @date 03/2023
 */

 if(!isset($_SESSION['user']) || $exist == false || $_SESSION['user']->getRole() != 'admin') {
    header('Location: '.SERVER_URL.'/erreur/');
} else {

$title = 'Modifier Catégorie | Shiba Club Nft';
$actifA = '';
$actifB = '';
$actifN = '';
include 'header.php';

?> 

        <form class="needs-validation m-4 py-5" method="POST" action="/catégorie/<?= $uneCategorie->getId() ?>/">
            <div class="text-center d-flex justify-content-center mt-5">
                <?= $mess ?>
            </div>
            <div class="row text-center">
                <h1 class="mb-4">Détail de la Catégorie n°<?= $uneCategorie->getId() ?></h1>
            </div>
            <div class="row justify-content-center">
                <div class="col-lg-5">
                    <div class="mb-3">
                        <label for="libelle">Libelle</label>       
                        <input type="text" name="libelle" class="form-control" id="libelle" value="<?= $uneCategorie->getLibelle() ?>" placeholder="Libelle" maxlength="64" required> 
                    </div>
                </div>
            </div>
            <div class="row justify-content-center mt-3">
                <div class="col-lg-5">
                    <div class="mb-3">
                        <label for="refInterne">Référence interne</label>       
                        <input type="text" name="refInterne" class="form-control" id="refInterne" value="<?= $uneCategorie->getRefInterne() ?>" placeholder="Référence interne" maxlength="32" required>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-lg-2">
                    <button class="btnGreen" data-id="<?= $uneCategorie->getId() ?>" name="editSubmit" type="submit">Enregistrer <i class='bx bx-save'></i></button>
                </div>
            </div>
        </form>
        <div class="container">
            <div class="row text-center">
                <div class="col-lg-2 mb-5">
                    <a href="/catégorie/" class="offset-2 btnBlue"><i class='bx bx-undo'></i>&nbsp;Dashboard</a>
                </div>
            </div>
            <div class="row text-center justify-content-center">
                <div class="col-lg-6 col-md-6 col-sm-6 col-6 mb-3" id="dCategorie">
                    <button class="btnRed deleteSubmit" name="deleteSubmit" data-bs-toggle="modal" data-bs-target="#modalCategorie" data-id="<?= $uneCategorie->getId() ?>">Supprimer <i class='bx bx-trash'></i></button>
                </div>
            </div>
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

        <!-- Début footer -->
        <?php 
        include 'footer.php'; 
        ?>
        <!-- Fin footer -->

        <!-- JS Libraries --> 
        <script type="text/javascript" src="/js/editCategorie.js"></script>
    </body>
</html>
<?php } ?>