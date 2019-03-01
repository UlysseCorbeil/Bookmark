<?php
/**
 * Created by PhpStorm.
 * User: Pierrot
 * Date: 2019-03-01
 * Time: 13:37
 */

// Controleur
//require('controleur/Controleur.class.php');

// Vues
require('vues/VuePage.class.php');
require('vues/VueUtilisateur.class.php');
require('vues/VueLien.class.php');
require('vues/VueEvenement.class.php');
require('vues/VueTache.class.php');


// Modeles
require('modeles/Evenement.class.php');
require('modeles/Utilisateur.class.php');

// Error Handlers
require('lib/PDOLib.class.php');
require('lib/TypeException.class.php');


/* ================================= */

try {
    $oUtilisateur = new Utilisateur(1);
    $oUtilisateur->rechercherUn();
} catch (Exception $o) {
    echo $o->getMessage();
}

?>

<nav>
    <h1><?php echo $oUtilisateur->getsPrenom() ?> <?php echo $oUtilisateur->getsNom() ?> </h1>
</nav>
