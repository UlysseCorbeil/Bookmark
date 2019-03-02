<?php
/**
 * Created by PhpStorm.
 * User: PO
 * Date: 2019-03-01
 * Time: 18:26
 */

require "../../modeles/Utilisateur.class.php";
require "../../modeles/Evenement.class.php";

require "../../lib/PDOLib.class.php";
require "../../lib/TypeException.class.php";

require "../../vues/VueEvenement.class.php";


try{

    $oUtilisateur = new Utilisateur(1);
    $oVueEvenement = new VueEvenement();

    if(isset($_POST['cmd']) == true){

        $sDateDebut =  date('Y-m-d H:i:s', strtotime($_POST['sDateDebut'] ." ". $_POST['sHeureDebut'] . ":00"));
        $sDateFin =  date('Y-m-d H:i:s', strtotime($_POST['sDateFin'] ." ". $_POST['sHeureFin'] . ":00"));

        $oEvenement = new Evenement(1, $sDateDebut, $sDateFin, $_POST['sNomEvenement']);
        $oEvenement->setoUtilisateur($oUtilisateur);

        if($oEvenement->ajouter()){
            $sMsg = "Événement ajouté!";
        }
        else{
            $sMsg = "Erreur lors de l'ajout de l'événement";
        }

        $aoEvenements = $oEvenement->rechercherTousAuj();
        //var_dump($aoEvenements);


        $oVueEvenement->afficherEvenements($aoEvenements);
    }
    else{
        echo "Oh Oh, la police...";
    }

}
catch (Exception $oException){
    echo $oException->getMessage();
}