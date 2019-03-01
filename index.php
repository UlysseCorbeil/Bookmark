<?php
/**
 * Created by PhpStorm.
 * User: Ulysse
 * Date: 2019-02-26
 */

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Les requires

// Modeles
require('modeles/Utilisateur.class.php');
require('modeles/Evenement.class.php');

// Vues
require('vues/VuePage.class.php');

// Controleur
require('controleur/Controleur.class.php');

// Error Handlers
require('lib/Autoloader.class.php');
require('lib/PDOLib.class.php');
require('lib/TypeException.class.php');

spl_autoload_register('autoload');

try {
    $oControleur = new Controleur();

    $oControleur->gererSite();
} catch (Exception $oException) {
    echo "<p>" . $oException->getMessage() . "</p>";
}
