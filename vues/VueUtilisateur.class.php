<?php
/**
 * Created by PhpStorm.
 * User: Pierrot
 * Date: 2019-03-01
 * Time: 13:13
 */

class VueUtilisateur
{

    /**
     * Afficher le menu de navigation et le bonjour à l'utilisateur
     * @param Utilisateur $oUtilisateur
     * @param string $sMsg
     */
    public function afficherNav(Utilisateur $oUtilisateur, $sMsg = "")
    {

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

        ";

        echo $sHtml;
    }
}
