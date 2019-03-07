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
            <div id='horloge'
                 style='background-image: url(\"https://source.unsplash.com/daily\");'>
                <h2>05 : 42 <span>PM</span></h2>
            </div>
            ";
        echo $sHtml;
    }

    public function afficherDate()
    {
        $sHtml = "
            <div class='row'>
                <div id='date'>
                    <span>Aujourd'hui</span>
                    <p>"  . '<span>' . $this->aJours[date('w') - 1] . '</span>' . " " . date("j") . " " . $this->aMois[date("n") - 1] . " " . date("Y") . " <span class = 'displayTemps'></span></p>
                </div>
            </div>
            ";
        echo $sHtml;
    }
}
