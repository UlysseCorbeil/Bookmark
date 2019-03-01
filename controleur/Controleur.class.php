<?php
/**
 * @author Ulysse
 * @version: 2019-02-28
 */

class Controleur
{
    // Affiche le site
    public function gererSite()
    {
        // Afficher la page
        $this->gererAfficherPage();
    } // fin ()

    public function gererAfficherPage()
    {

        try {
            // Initilisation de la classe utilisateur et recherche d'un utilisateur
            $oUtilisateur = new Utilisateur(2);
            $oUtilisateur->rechercherUn();

            // Initilisation des methodes la classe Evenement
            $oEvenement = new Evenement();
            $oEvenement->setoUtilisateur($oUtilisateur);

            // Recherche de tous les evenements
            $aoEvenements = $oEvenement->rechercherTousAuj();

            // Initilisation de la classe VuePage
            $oVuePage = new VuePage();

            // Affichage du site
            $oVuePage->afficherPage($oUtilisateur, $aoEvenements);
        } catch (Exception $oException) {
            echo "<p>" . $oException->getMessage() . "</p>";
        }
    } // fin ()
} // fin classe
