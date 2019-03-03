<?php
/**
 * Created by PhpStorm.
 * User: PO
 * Date: 2019-03-01
 * Time: 18:26
 */

// Définir le fuseau horaire à Toronto
date_default_timezone_set('America/Toronto');

require "../../modeles/Utilisateur.class.php";
require "../../modeles/Evenement.class.php";

require "../../lib/PDOLib.class.php";
require "../../lib/TypeException.class.php";

require "../../vues/VueEvenement.class.php";


try {

    $oUtilisateur = new Utilisateur(1);
    $oVueEvenement = new VueEvenement();

    if (isset($_POST['cmd']) == true) {

        // Vérifier si les données reçues existent
        if (isset($_POST['sDateDebut']) && isset($_POST['sHeureDebut']) && isset($_POST['sDateFin']) && isset($_POST['sHeureFin']) && isset($_POST['sNomEvenement'])) {

            $sDateDebut = new DateTime($_POST['sDateDebut'] . " " . $_POST['sHeureDebut'] . ":00", new DateTimeZone('America/Toronto'));

            if ($_POST['sHeureFin'] == "23:59:59") {
                $sDateFin = new DateTime($_POST['sDateFin'] . " " . $_POST['sHeureFin'], new DateTimeZone('America/Toronto'));
            } else {
                $sDateFin = new DateTime($_POST['sDateFin'] . " " . $_POST['sHeureFin'] . ":00", new DateTimeZone('America/Toronto'));
            }

            $oEvenement = new Evenement(1, $sDateDebut->format('Y-m-d H:i:s'), $sDateFin->format('Y-m-d H:i:s'), $_POST['sNomEvenement']);
            $oEvenement->setoUtilisateur($oUtilisateur);

            if ($oEvenement->ajouter()) {
                $sMsg = "Événement ajouté!";
            } else {
                $sMsg = "Erreur lors de l'ajout de l'événement";
            }
        } else {
            $sMsg = "Erreur lors de l'ajout de l'événement";
        }

        var_dump($sMsg);

        $aoEvenements = $oEvenement->rechercherTousAuj();
        $oVueEvenement->afficherEvenements($aoEvenements);
    } else {
        echo "Oh Oh, la police...";
    }

} catch (Exception $oException) {
    echo $oException->getMessage();
}