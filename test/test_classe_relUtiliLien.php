<?php
/**
 * Created by PhpStorm.
 * User: Pierrot
 * Date: 2019-02-28
 * Time: 21:41
 */

require "../modeles/Lien.class.php";
require "../modeles/RelUtilisateurLien.class.php";
require "../modeles/Utilisateur.class.php";

require "../lib/PDOLib.class.php";
require "../lib/TypeException.class.php";

try{

    $oUtilisateur = new Utilisateur(1);
    $oRel = new RelUtilisateurLien();
    $oRel->setoUtilisateur($oUtilisateur);


    echo "<pre>";
    var_dump($oRel->rechercherTousLiensParUtilisateur());

}
catch (Exception $oE){
    echo $oE->getMessage();
}
