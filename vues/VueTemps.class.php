<?php
/**
 * Created by PhpStorm.
 * User: Pierrot
 * Date: 2019-03-01
 * Time: 14:40
 */

class VueTemps
{

    // Tableau contenant les mois en français
    private $aMois = array("Janvier", "Février", "Mars", "Avril", "Mai", "Juin", "Juillet", "Août", "Septembre", "Octobre", "Novembre", "Décembre");
    // Tableau contenant les jours de la semaine en français
    private $aJours = array('Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi', 'Dimanche');


    /**
     * Afficher les deux boites de temps (horloge et chronomètre)
     * @param void
     * @return void
     */
    public function afficherTous()
    {

        echo "<div class='flex-container'>";

        $this->afficherWebPlayer();
        $this->afficherHorloge();

        echo "</div>";
    }

    /**
     * Afficher le chronomètre
     * @param void
     * @return void
     */
    public function afficherWebPlayer()
    {
        $sfinMiddle = '
        <div class="small-box">
            <div class="container">
            <div class="login-container hidden" id="js-login-container">
            <button class="btn btn--login" id="js-btn-login">Connecter à Spotify</button>
            </div>
            <div class="main-container hidden" id="js-main-container"></div>
        </div>
        </div>';

        echo $sfinMiddle;
    }


    /**
     * Afficher l'horloge
     * @param void
     * @return void
     */
    public function afficherHorloge()
    {
        $sHtml = "
        <div class='small-box'>
                    <h2>" . $this->aJours[date('N') - 1] . "</h2>
                    <h1></h1>
                </div>
            </div>
            ";
        echo $sHtml;
    }
}
