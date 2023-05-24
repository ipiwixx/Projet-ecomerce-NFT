<?php

/**
 * /view/footer.php
 *
 * Page du footer
 *
 * @author A. Espinoza
 * @date 02/2022
 */

?>

<?php
if (!isset($_COOKIE['refus-cookie']) && !isset($_COOKIE['accepte-cookie'])) {
?>
    <div class="banniere">
        <img src="img/icon.ico" alt="img-3" class="text-start banniere-img">
        <div>
            <p class="banniere-text">Notre site utilise des cookies pour une meilleure expérience</p>
        </div>
        <div class="mb-3">
            <a href="index.php?controller=view&action=accueil&accepte-cookie" class="btAcc m-1">OK, J'accepte</a>
            <button type="button" href="#" class="btAcc m-1" id="showC">Gérer les cookies</button>
            <a href="index.php?controller=view&action=accueil&refus-cookie" class="btRef m-1">Je refuse</a>
        </div>
    </div>

    <div class="gest-cookie d-none" id="divC">
        <div class="row">
            <div class="col-lg-11">
                <p>Veuillez cochez vos préférences pour les cookies</p>
            </div>
            <div class="col-lg-1">
                <button type="button" class="btn-close" aria-label="Close" id="hideC"></button>
            </div>
        </div>

        <hr>
        <div class="body-cookie">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked" checked disabled>
                <label class="form-check-label" for="flexCheckChecked">
                    Uniquement les cookies nécessaire
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                <label class="form-check-label" for="flexCheckDefault">
                    Marketing
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                <label class="form-check-label" for="flexCheckDefault">
                    Performances et analyses Web
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                <label class="form-check-label" for="flexCheckDefault">
                    Personnalisation
                </label>
            </div>
            <a type="submit" href="index.php?controller=view&action=accueil&accepte-cookie" class="btn btn-light mt-3">J'accepte</a>

        </div>
    </div>

<?php } ?>

<!-- Début footer -->
<footer class="bg-light text-center text-white">
    <!-- Grid container -->
    <div class="container p-4">
        <!-- Section: Social media -->
        <section class="mb-4">
            <!-- Facebook -->
            <a class="btn btn-outline-dark btn-floating m-1 color-perso" href="https://www.facebook.com/shibasocialclub" role="button"><i class="fab fa-facebook-f"></i></a>
            <!-- Twitter -->
            <a class="btn btn-outline-dark btn-floating m-1 color-perso" href="https://twitter.com/Shibaclubnft" role="button"><i class="fab fa-twitter"></i></a>
            <!-- Discord -->
            <a class="btn btn-outline-dark btn-floating m-1 color-perso" href="https://discord.gg/shibasocialclub" role="button"><i class="fab fa-discord"></i></a>
            <!-- Instagram -->
            <a class="btn btn-outline-dark btn-floating m-1 color-perso" href="https://instagram.com/shibasocialclub_nft?utm_medium=copy_link" role="button"><i class="fab fa-instagram"></i></a>
        </section>
        <!-- Section: Social media -->

        <!-- Section: Form -->
        <section>
            <form action="<?= SERVER_URL ?>" method="POST">
                <!--Grid row-->
                <div class="row d-flex justify-content-center">
                    <!--Grid column-->
                    <div class="col-auto">
                        <p class="pt-2">
                            <strong>Inscrivez-vous à notre newsletter</strong>
                        </p>
                    </div>
                    <!--Grid column-->

                    <!--Grid column-->
                    <div class="col-md-5 col-12">
                        <!-- Email input -->
                        <div class="form-outline form-white mb-4">
                            <input name="email" id="newsletter" class="form-control" placeholder="Email" />
                            <label class="form-label" for="newsletter"></label>
                        </div>
                    </div>
                    <!--Grid column-->

                    <!--Grid column-->
                    <div class="col-auto">
                        <!-- Submit button -->
                        <button type="submit" class="btn btn-outline-dark mb-4 color-perso">
                            S'abonner
                        </button>
                    </div>
                    <!--Grid column-->

                </div>
                <!--Grid row-->
            </form>
        </section>
        <!-- Section: Form -->

        <!-- Section: Text -->
        <section class="mb-4">
            <p>
                Service clientèle disponible au 0467845287 ou par mail via support.shibaclubnft@gmail.com.
            </p>
        </section>
        <!-- Section: Text -->

        <!-- Section: Links -->
        <section>
            <!--Grid row-->
            <div class="row">
                <!--Grid column-->
                <ul class="list-unstyled mb-0">
                    <li>
                        <a class="liens" href="<?= SERVER_URL ?>/politique/">Politique de confidentialité</a>

                        <a class="liens" href="<?= SERVER_URL ?>/cookies/">Utilisation des cookies</a>

                        <a class="liens" href="<?= SERVER_URL ?>/conditions/">Conditions d'utilisation</a>

                        <a class="liens" href="<?= SERVER_URL ?>/ventes/">Ventes et remboursements</a>

                        <a class="liens" href="<?= SERVER_URL ?>/mentions/">Mentions légales</a>
                    </li>
                </ul>
                <!--Grid column-->
            </div>
            <!--Grid row-->
        </section>
        <!-- Section: Links -->
    </div>
    <!-- Grid container -->

    <!-- Copyright -->
    <div class="text-center p-3" id="footer-copyright">
        Copyright © 2023 <u>Antoine Espinoza</u>. Tous droits réservés.
    </div>
    <!-- Copyright -->
</footer>
<!-- JS Libraries -->
<script type="text/javascript" src="<?= SERVER_URL ?>/js/jquery-3.6.0.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>