<?php
/**
 * /view/addCategorie.php
 * 
 * Page pour l'ajout d'une catégorie
 * @author A. Espinoza
 * @date 03/2023
 */

if(!isset($_SESSION['user']) || $_SESSION['user']->getRole() != 'admin') {
    header('Location: '.SERVER_URL.'/erreur/');
} else {

$title = 'Ajouter Catégorie | Shiba Club Nft';
$actifA = '';
$actifB = '';
$actifN = '';
include 'header.php';

?> 

        <form class="row g-3 needs-validation m-4 pt-5" method="POST" action="<?= SERVER_URL ?>/catégorie/ajouter/">
            <div class="text-center d-flex justify-content-center">
                <?= $mess ?>
            </div>
            <div class="row justify-content-center mt-3">
                <h1 class="mb-4 text-center">Ajouter Catégorie</h1>
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
                        <label for="refInterne">Référence interne</label>       
                        <input type="text" name="refInterne" class="form-control" id="refInterne" placeholder="Référence interne" maxlength="64" required>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-lg-2 ms-5">
                    <button class="btnGreen ms-5" name="addSubmit" type="submit">Ajouter</button>
                </div>
            </div>
            <div class="container">
                <a href="/catégorie/" class="mt-5 offset-3 btnBlue"><i class='bx bx-undo'></i>&nbsp;Dashboard</a>
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