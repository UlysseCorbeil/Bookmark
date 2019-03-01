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

            $oVuePage = new VuePage();

            // Afficher le HEAD de la page
            $oVuePage->getHead();

            // Afficher le NAV de la page
            $this->gererAfficherNav();

            // Afficher les liens des sites
            $this->gererAfficherLiens();

            // Afficher le calendrier
            $this->gererAfficherEvenements();

            $this->gererAfficherTaches();

        } catch (Exception $oException) {
            echo "<p>" . $oException->getMessage() . "</p>";
        }
    } // fin ()

    public function gererAfficherNav(){
        try{
            $oUtilisateur = new Utilisateur(1);
            $oUtilisateur->rechercherUn();
            $oVueUtilisateur = new VueUtilisateur();

            $oVueUtilisateur->afficherNav($oUtilisateur);
        }
        catch (Exception $oException){
            echo "<p>" . $oException->getMessage() . "</p>";
        }
    }

    public function gererAfficherLiens(){
        try{
            $oUtilisateur = new Utilisateur(1);
            $oUtilisateur->rechercherUn();
            $oVueLien = new VueLien();

            $oVueLien->afficherTous(array());
        }
        catch (Exception $oException){
            echo "<p>" . $oException->getMessage() . "</p>";
        }
    }

    public function gererAfficherEvenements(){
        try{
            $oUtilisateur = new Utilisateur(1);
            $oUtilisateur->rechercherUn();
            $oVueEvenement = new VueEvenement();

            $oVueEvenement->afficherTousAuj(array());
        }
        catch (Exception $oException){
            echo "<p>" . $oException->getMessage() . "</p>";
        }
    }

    public function gererAfficherTaches(){
        try{
            $oUtilisateur = new Utilisateur(1);
            $oUtilisateur->rechercherUn();
            $oVueTache = new VueTache();

            $oVueTache->afficherTous(array());
        }
        catch (Exception $oException){
            echo "<p>" . $oException->getMessage() . "</p>";
        }
    }

} // fin classe
