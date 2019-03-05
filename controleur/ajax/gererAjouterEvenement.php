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

    $oUtilisateur = new Utilisateur(2);
    $oVueEvenement = new VueEvenement();
    $oEvenement = new Evenement();
    $sMsg = "";
    $aErreur = array();
    $erreur = false;

    // Si le formulaire est envoyé,
    if (isset($_POST['cmd']) == true) {

        // Vérifier si les données reçues existent
        if (isset($_POST['sDateDebut']) && isset($_POST['sHeureDebut']) && isset($_POST['sDateFin']) && isset($_POST['sHeureFin']) && isset($_POST['sNomEvenement'])) {

            // Récupérer les valeurs de $_POST
            $sDateDebut = $_POST['sDateDebut'] . " " . $_POST['sHeureDebut'] . ":00";

            if ($_POST['sHeureFin'] == "23:59:59") {
                $sDateFin = $_POST['sDateFin'] . " " . $_POST['sHeureFin'];
            } else {
                $sDateFin = $_POST['sDateFin'] . " " . $_POST['sHeureFin'] . ":00";
            }

            /* ===================================================================================================== */

            // Valider si la date de début est au bon format et n'est pas vide
            if (validerDate($sDateDebut) && !empty($_POST['sDateDebut'])) {
                $sDateDebut = DateTime::createFromFormat('Y-m-d H:i:s', $sDateDebut,  new DateTimeZone('America/Toronto'));
            } else {
                array_push($aErreur, "Date de début invalide! AAAA-MM-JJ HH:MM");
                $erreur = true;
            }

            // Valider si la date de fin est au bon format et n'est pas vide
            if (validerDate($sDateFin) && !empty($_POST['sDateFin'])) {
                $sDateFin = DateTime::createFromFormat('Y-m-d H:i:s', $sDateFin,  new DateTimeZone('America/Toronto'));
            } else {
                array_push($aErreur, "Date de fin invalide! AAAA-MM-JJ HH:MM");
                $erreur = true;
            }

            // Vérifier si la date de fin est plus grande que celle de début
            if ($sDateDebut > $sDateFin) {
                array_push($aErreur, "La date de fin doit être plus grande que la date de début!");
                $erreur = true;
            }

            // Vérifier si le nom de l'événement n'est pas vide
            if (empty($_POST['sNomEvenement']) || preg_match('/^\s*$/', $_POST['sNomEvenement'])) {
                $erreur = true;
                array_push($aErreur, "Nom de l'événement vide!");
            }

            /* ===================================================================================================== */

            // S'il n'y a pas d'erreur,
            if (!$erreur) {
                // Créer l'événement
                $oEvenement = new Evenement(3, $sDateDebut->format('Y-m-d H:i:s'), $sDateFin->format('Y-m-d H:i:s'), $_POST['sNomEvenement']);
                $oEvenement->setoUtilisateur($oUtilisateur);

                // Ajouter l'événement dans la BDD
                if ($oEvenement->ajouter()) {

                    $sMsg = "Événement ajouté!";
                } else {
                    $sMsg = "Erreur lors de l'ajout de l'événement";
                }
            }
        } else {
            $sMsg = "Erreur lors de l'ajout de l'événement";
        }

        if (empty($sMsg)) {
            $sMsg = implode(" ", $aErreur);
        }

        $aoEvenements = $oEvenement->rechercherTousAuj();
        $oVueEvenement->afficherEvenements($aoEvenements, $sMsg);
    } else {
        echo "Oh Oh, la police...";
    }
} catch (Exception $oException) {
    echo $oException->getMessage();
}




/**
 * Valider une date
 * @param $date
 * @param bool $strict
 *
 * @return bool
 */
function validerDate($date, $strict = true)
{
    $oDateTime = DateTime::createFromFormat('Y-m-d H:i:s', $date);

    if ($strict) {
        $aErreurs = DateTime::getLastErrors();
        if (!empty($aErreurs['warning_count'])) {
            return false;
        }
    }

    return $oDateTime != false;
}
