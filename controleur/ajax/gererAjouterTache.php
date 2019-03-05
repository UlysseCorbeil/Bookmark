<?php
/**
 * @author Ulysse 
 * @version Dimanche 3 mars
 */

/* =================================== */
/* = Nécessaire ====================== */
/* =================================== */
require "../../modeles/Utilisateur.class.php";
require "../../modeles/Tache.class.php";

require "../../lib/PDOLib.class.php";
require "../../lib/TypeException.class.php";

require "../../vues/VueTache.class.php";




/* =================================== */
/* = Programme Principal ============= */
/* =================================== */
try {
    $oUtilisateur = new Utilisateur(2);
    $oTache = new Tache();
    $oVueTache = new VueTache();
    $sMsg = '';
    $aErreur = array();
    $erreur = false;

    // Si le formulaire est envoyé,
    if (isset($_POST['cmd']) == true) {

        // si le nom de la tache est bien initialisé
        if (isset($_POST['sNomTache'])) {

            // Vérifier si le nom de l'événement n'est pas vide
            if (empty($_POST['sNomTache']) || preg_match('/^\s*$/', $_POST['sNomTache'])) {
                $erreur = true;
                $sMsg = '<b>Veuillez entrez un nom valide</b>';
            } // fin if

            // S'il n'y a pas d'erreur,
            if (!$erreur) {

                // Créer l'événement
                $oTache = new Tache(2, $_POST['sNomTache']);
                $oTache->setoUtilisateur($oUtilisateur);

                // Ajouter l'événement dans la BDD
                if ($oTache->ajouter()) {
                    $sMsg = "Tache ajouté!";
                } else {
                    $sMsg = "Erreur lors de l'ajout de la tache";
                } // fin if

                if (empty($sMsg)) {
                    echo $sMsg;
                }
            } // fin if
        } else {
            $sMsg = "Erreur lors de l'ajout de la tache";
        } // fin isset post nomTache

        $aoTaches = $oTache->rechercherTousParUtilisateur();
        $oVueTache->afficherTaches($aoTaches, $sMsg);
    } else {
        echo 'bigbadworlf';
    } // fin isset post cmd
} catch (Exception $oException) {
    echo "<p>" . $oException->getMessage() . "</p>";
}
