<?php
/**
 * @author Ulysse
 * @version: 2019-02-28
 */

class Controleur
{

    /**
     * Gérer l'affichage du site
     *
     * @param void
     *
     * @return void
     */
    public function gererSite()
    {

        try {

            $oVuePage = new VuePage();

            /* ========================================================================================== */
            /* HEAD DE LA PAGE */
            /* ========================================================================================== */

            // Afficher le HEAD de la page
            $oVuePage->getHead();

            /* ========================================================================================== */
            /* NAV DE LA PAGE */
            /* ========================================================================================== */

            // Afficher le NAV de la page
            $this->gererAfficherNav();

            /* ========================================================================================== */
            /* CONTENU DE LA PAGE */
            /* ========================================================================================== */

            // Afficher les liens des sites
            $this->gererAfficherLiens();


            // DÉBUT DU DIV QUI CONTIENT TOUS LES BLOCS
            echo "<div id='actu' class='flex-container row'>";

            // Afficher le calendrier
            $this->gererAfficherEvenements();

            // Afficher la liste de tache à faire
            $this->gererAfficherTaches();

            // Afficher le temps (chrono et horloge)
            $this->gererAfficherTemps();

            // Afficher la météo
            $this->gererAfficherMeteo();

            // Afficher les modals
            $this->gererAfficherModal();
            // </MAIN>

            /* ========================================================================================== */
            /* FIN DE LA PAGE */
            /* ========================================================================================== */

            // Fin de la page HTML
            $oVuePage->getFoot();
        } catch (Exception $oException) {
            echo "<p>" . $oException->getMessage() . "</p>";
        }
    } // fin ()

    /* ========================================================================================== */

    /**
     * Gérer l'affichage du nav
     *
     * @param void
     *
     * @return void
     */
    public function gererAfficherNav()
    {
        try {
            $oUtilisateur = new Utilisateur(1);
            $oUtilisateur->rechercherUn();
            $oVueUtilisateur = new VueUtilisateur();

            $oVueUtilisateur->afficherNav($oUtilisateur);
        } catch (Exception $oException) {
            echo "<p>" . $oException->getMessage() . "</p>";
        }
    }

    /**
     * Gérer l'affichage du liens vers les sites
     *
     * @param void
     *
     * @return void
     */
    public function gererAfficherLiens()
    {
        try {
            $oUtilisateur = new Utilisateur(1);
            $oRelUtilisateurLien = new RelUtilisateurLien();
            $oRelUtilisateurLien->setoUtilisateur($oUtilisateur);
            $aoLiens = $oRelUtilisateurLien->rechercherTousLiensParUtilisateur();

            $oVueLien = new VueLien();

            $oVueLien->afficherTous($aoLiens);
        } catch (Exception $oException) {
            echo "<p>" . $oException->getMessage() . "</p>";
        }
    }

    /**
     * Gérer l'affichage du calendrier
     *
     * @param void
     *
     * @return void
     */
    public function gererAfficherEvenements()
    {
        try {
            $oUtilisateur = new Utilisateur(1);
            $oUtilisateur->rechercherUn();
            $oVueEvenement = new VueEvenement();

            $oVueEvenement->afficherTousAuj(array());
        } catch (Exception $oException) {
            echo "<p>" . $oException->getMessage() . "</p>";
        }
    }

    /**
     * Gérer l'affichage de la liste des choses à faire
     *
     * @param void
     *
     * @return void
     */
    public function gererAfficherTaches()
    {
        try {
            $oUtilisateur = new Utilisateur(1);
            $oVueTache = new VueTache();
            $oTache = new Tache();
            $oTache->setoUtilisateur($oUtilisateur);

            $aoTaches = $oTache->rechercherTousParUtilisateur();

            $oVueTache->afficherTous($aoTaches);
        } catch (Exception $oException) {
            echo "<p>" . $oException->getMessage() . "</p>";
        }
    }

    /**
     * Gérer l'affichage du temps (Horloge et chronomètre)
     *
     * @param void
     *
     * @return void
     */
    public function gererAfficherTemps()
    {
        try {
            $oUtilisateur = new Utilisateur(1);
            $oUtilisateur->rechercherUn();
            $oVueTemps = new VueTemps();

            $oVueTemps->afficherTous();
        } catch (Exception $oException) {
            echo "<p>" . $oException->getMessage() . "</p>";
        }
    }

    /**
     * Gérer l'affichage de la météo
     *
     * @param void
     *
     * @return void
     */
    public function gererAfficherMeteo()
    {
        try {
            $oUtilisateur = new Utilisateur(1);
            $oUtilisateur->rechercherUn();
            $oVueMeteo = new VueMeteo();

            $oVueMeteo->afficherMeteo();
        } catch (Exception $oException) {
            echo "<p>" . $oException->getMessage() . "</p>";
        }
    }

    /**
     * Gérer l'affichage des fenêtres de dialogue
     *
     * @param void
     *
     * @return void
     */
    public function gererAfficherModal()
    {
        try {
            $oUtilisateur = new Utilisateur(1);
            $oUtilisateur->rechercherUn();
            $oVueModal = new VueModal();

            $oVueModal->afficherModalTache();
            $oVueModal->afficherModalEvenement();
        } catch (Exception $oException) {
            echo "<p>" . $oException->getMessage() . "</p>";
        }
    }
} // fin classe
