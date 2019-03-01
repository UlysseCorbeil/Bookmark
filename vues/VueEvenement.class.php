<?php
/**
 * Created by PhpStorm.
 * User: PO
 * Date: 2019-02-26
 * Time: 21:38
 */

class VueEvenement
{

    private $aMois = array("Janvier", "Février", "Mars", "Avril", "Mai", "Juin", "Juillet", "Août", "Septembre", "Octobre", "Novembre", "Décembre");

    public function afficherTousAuj($aoEvenements, $sMsg = "")
    {
        date_default_timezone_set('America/Toronto');

        $sHtml = "
        <div id='calendrier' class='card'>
            <div style='background-image: url(\"https://source.unsplash.com/random\");'>
                <h2>Calendrier</h2>
                <div>
                    <p>" . date("d") . "</p>
                    <p>" . $this->aMois[date("n") - 1] . "</p>
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
                            $sHtml .= "<span>En cours - Fin à ". date("H:i", strtotime($aoEvenements[$i]->getsDateFin())) ."</span>";
                        }
                        else if ($aoEvenements[$i]->getsDateDebut() >= date("Y-m-d H:i:s")) {
                            $sHtml .= "<span>". date("H:i", strtotime($aoEvenements[$i]->getsDateDebut())) ."</span>";
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
