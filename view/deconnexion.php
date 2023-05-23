<?php

/**
 * /view/deconnexion.php
 * 
 * Page de déconnexion
 *
 * @author A. Espinoza
 * @date 05/2022
 */

session_start();
session_destroy();
header('Location: ' . SERVER_URL);
