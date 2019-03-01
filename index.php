<?php
/**
 * Created by PhpStorm.
 * User: Ulysse
 * Date: 2019-02-26
 */

// Afficher les erreurs
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

/* ========================================================================================== */

// Définir le fuseau horaire à Toronto
date_default_timezone_set('America/Toronto');

/* ========================================================================================== */

// Controleur
require('controleur/Controleur.class.php');

// Require Modèles / Vues / Lib
require('lib/Autoloader.class.php');
spl_autoload_register('autoload');

/* ========================================================================================== */

try {
    $oControleur = new Controleur();

    $oControleur->gererSite();
} catch (Exception $oException) {
    echo "<p>" . $oException->getMessage() . "</p>";
}
