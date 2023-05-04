<?php
/**
 * /view/addNft.php
 * 
 * Page pour l'ajout d'un nft
 * @author A. Espinoza
 * @date 03/2023
 */

if(!isset($_SESSION['user']) || $_SESSION['user']->getRole() != 'admin') {
    header('Location: '.SERVER_URL.'/erreur/');
} else {

$title = 'Ajouter Produit | Shiba Club Nft';
$actifA = '';
$actifB = '';
$actifN = '';
include 'header.php';

?> 

        <form class="row g-3 needs-validation m-4 pt-5" method="POST" enctype="multipart/form-data" action="<?= SERVER_URL ?>/produit/ajouter/">
            <div class="text-center d-flex justify-content-center">
                <?= $mess ?>
            </div>
            <?php var_dump($_FILES); ?>
            <div class="row justify-content-center mt-3">
                <h1 class="mb-4 text-center">Ajouter Produit</h1>
                <div class="col-lg-5">
                    <div class="mb-3">
                        <label for="refInterne">Référence interne</label>       
                        <input type="text" name="refInterne" class="form-control" id="refInterne" placeholder="Référence interne" maxlength="32" required>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-lg-5">
                    <div class="mb-3">
                        <label for="libelle">Libelle</label>       
                        <input type="text" name="libelle" class="form-control" id="libelle" placeholder="Libelle" maxlength="64" required> 
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-lg-5">
                    <div class="mb-3">
                        <label for="resume">Résumé</label>       
                        <input type="text" name="resume" class="form-control" id="resume" placeholder="Résumé" maxlength="128" required> 
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-lg-5">
                    <div class="mb-3">
                        <label for="description">Description</label>       
                        <textarea type="text" name="description" class="form-control" id="description" placeholder="Description" maxlength="256" required></textarea>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-lg-5">
                    <div class="mb-3">
                        <label for="qteStock">Quantité en stock</label>       
                        <input type="text" name="qteStock" class="form-control" id="qteStock" placeholder="Quantité en stock" required> 
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-lg-5">
                    <div class="mb-3">
                        <label for="prix">Prix</label>       
                        <input type="text" name="prix" class="form-control" id="prix" placeholder="Prix" required> 
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-lg-5 mb-3">
                    <label for="categorie" class="text-dark">Catégorie</label>                        
                    <select class="form-select" name="categorie" id="categorie" required>
                        <option value="" selected>Selectionner une catégorie</option>
                        <?php foreach($lesCategories as $uneCateg) { ?>
                        <option value="<?= $uneCateg->getId() ?>"><?= $uneCateg->getLibelle() ?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-lg-4 mb-3">
                    <label for="formFile">Déposer l'image</label>
                    <input class="form-control" name="path" type="file" id="formFile" accept=".png, .jpeg, .jpg" required>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-lg-2 ms-5">
                    <button class="btnGreen ms-5" name="addSubmit" type="submit">Ajouter</button>
                </div>
            </div>
            <div class="container">
                <a href="/produit/" class="mt-5 offset-3 btnBlue"><i class='bx bx-undo'></i>&nbsp;Dashboard</a>
            </div>
        </form>

        <!-- Début footer -->
        <?php 
        include 'footer.php'; 
        ?>
        <!-- Fin footer -->
    </body>
</html>
<?php } ?>