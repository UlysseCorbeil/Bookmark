<?php
/**
 * Created by PhpStorm.
 * User: PO
 * Date: 2019-02-26
 * Time: 21:12
 */

class VueUtilisateur
{
    public function afficherUn(Utilisateur $oUtilisateur, $sMsg = "")
    {
        date_default_timezone_set('America/Toronto');

        $sHtml = "
            <nav>
                <img src='medias/" . $oUtilisateur->getsAvatar() . "' alt=''>
                <ul>
                    <li><a href='#'><i class='fas fa-home'></i></a></li>
                    <li><a href='#'><i class='fas fa-cog'></i></a></li>
                    <li><a href='#'><i class='fas fa-sign-out-alt'></i></a></li>
                </ul>
            </nav>
            
            <main>
                <div id='contenu' class='flex-container'>
                    <div id='info' class='row'>";


        $iHeure = date("G");

        if ($iHeure >= 5 && $iHeure < 10) {
            $sMotBienvenue = "Bon matin ";
        } else if ($iHeure >= 10 && $iHeure < 17) {
            $sMotBienvenue = "Bonjour ";
        } else {
            $sMotBienvenue = "Bonsoir ";
        }


        $sHtml .= "
                        <h1>" . $sMotBienvenue . $oUtilisateur->getsPrenom() . " " . substr($oUtilisateur->getsNom(), 0, 1) . ".</h1>
                        <div class='flex-container'>
                        <p>Aujourd'hui sera une belle journée!</p>
                    </div>
                </div>
        ";

        echo $sHtml;
    }
}
