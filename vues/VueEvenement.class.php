<?php
/**
 * Created by PhpStorm.
 * User: Pierrot
 * Date: 2019-03-01
 * Time: 13:13
 */

class VueEvenement {

    // Tableau contenant les mois en français
    private $aMois = array("Janvier", "Février", "Mars", "Avril", "Mai", "Juin", "Juillet", "Août", "Septembre", "Octobre", "Novembre", "Décembre");
    // Tableau contenant les jours de la semaine en français
    private $aJours = array('Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi', 'Dimanche');


    /**
     * Afficher le calendrier avec les évènements de l'utilisateur
     * @param $aoEvenements
     * @param string $sMsg
     */
    public function afficherTousAuj($aoEvenements, $sMsg = "") {
        $sHtml = "
        <div id='calendrier' class='card'>
            <div style='background-image: url(\"https://source.unsplash.com/random\");'>
                <h2>Calendrier</h2>
                <div>
                    <p>" . date("d") . "</p>
                    <p>" . $this->aMois[date('n') - 1] . "</p>
                </div>
                <a href='#'><i class='fas fa-plus'></i></a>
            </div>
            <div>
                <h3>Événements</h3>
                <div>";

        if ($aoEvenements) {
            for ($i = 0; $i < count($aoEvenements); $i++) {
                $sHtml .= "
                        <div class='flex-container event-item'>
                            <div>";

                if ($aoEvenements[$i]->getsDateDebut() <= date("Y-m-d H:i:s") && $aoEvenements[$i]->getsDateFin() >= date("Y-m-d H:i:s")) {
                    $sHtml .= "<span>En cours - Fin à " . date("H:i", strtotime($aoEvenements[$i]->getsDateFin())) . "</span>";
                } else if ($aoEvenements[$i]->getsDateDebut() >= date("Y-m-d H:i:s")) {
                    $sHtml .= "<span>" . date("H:i", strtotime($aoEvenements[$i]->getsDateDebut())) . "</span>";
                }

                $sHtml .= "
                            <p>" . $aoEvenements[$i]->getsNomEvenement() . "</p>
                        </div>
                        <a href='#'><i class='fas fa-ellipsis-v'></i></a>
                    </div>
                    ";
            }
        } else {
            $sHtml .= "<p>Aucun événement prévu.</p>";
        }

        $sHtml .= "
                </div>
            </div>
        </div>
        ";

        echo $sHtml;
    }

}
