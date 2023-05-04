<?php

/**
 * /controller/Controller.php
 * 
 * class technique pour définir les membres communs aux controllers
 *
 * @author A. Espinoza
 * @date 09/2022
 */

    class Controller {
        public static function render($view, $params){
            extract($params);
            require_once $view;
        }
    }
?>