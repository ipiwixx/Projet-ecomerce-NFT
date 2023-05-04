<?php
echo 'err-log = '.$_GET['reg_err'];
?>



 
<button type="button" class="btn btn-primary" id="liveToastBtn">Show success</button>
<button type="button" class="btn btn-primary" id="liveToastBtnError">Show erreur</button>

<?php if (1 == 1) { ?>
<div class="toast-container">
  <div class="toast-container position-fixed bottom-0 end-0 p-3">
  <div id="liveToast" class="toast colorGreen" role="alert" aria-live="assertive" aria-atomic="true">
    <div class="toast-body">
      <i class="fa fa-check"></i>&nbsp;

      L'article à bien été ajouté à votre panier !&nbsp;&nbsp;&nbsp;&nbsp;
      <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>

    </div>
    <div id="Progress_Status">
      <div id="myprogressBar" class="myprogressBar"></div>
    </div>
  </div>
</div>

<?php } else { ?>

<div class="toast-container position-fixed bottom-0 end-0 p-3">
  <div id="liveToast" class="toast colorRed" role="alert" aria-live="assertive" aria-atomic="true">
    <div class="toast-body">
      <i class="fa fa-times"></i>&nbsp;
      Erreur lors de l'ajout au panier !
      <button type="button" class="btn-close btn-close-white me-5 m-auto position-absolute top-2 end-0" data-bs-dismiss="toast" aria-label="Close"></button>

    </div>
    <div id="Progress_StatusE">
      <div id="myprogressBar" class="myprogressBarE"></div>
    </div>
  </div>
</div>

<?php } ?>

<div class="toast-container position-fixed bottom-0 end-0 p-3">
  <div id="liveToastEr" class="toast colorRed" role="alert" aria-live="assertive" aria-atomic="true">
    <div class="toast-body">
      <i class="fa fa-times"></i>&nbsp;

      Vous devez être connexté pour ajouter cet article au panier !&nbsp;&nbsp;&nbsp;&nbsp;
      <button type="button" class="btn-close btn-close-white me-1 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>

    </div>
    <div id="Progress_Status">
      <div id="myprogressBar"></div>
    </div>
  </div>
</div>

<?php require_once '../model/NftManager.php';
 $panier = NftManager::getLePanier($_SESSION['id']);

foreach ($panier as $unP) {
  
  echo $unP;
}?>
             

    
    <!-- Début footer -->
    <?php 
      include 'view/footer.php'; 
    ?>
    <!-- Fin footer -->
<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
    
    <script src="../Projet-ecomerce-NFT/js/test.js"></script>

    </body>
</html>