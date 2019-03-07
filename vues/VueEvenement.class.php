<?php
/**
 * Created by PhpStorm.
 * User: Pierrot
 * Date: 2019-03-01
 * Time: 13:13
 */

class VueEvenement
{

    // Tableau contenant les mois en français
    private $aMois = array("Janvier", "Février", "Mars", "Avril", "Mai", "Juin", "Juillet", "Août", "Septembre", "Octobre", "Novembre", "Décembre");
    // Tableau contenant les jours de la semaine en français
    private $aJours = array('Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi', 'Dimanche');


    /**
     * Afficher le calendrier avec les évènements de l'utilisateur
     * @param $aoEvenements
     * @param string $sMsg
     */
    public function afficherTousAuj($aoEvenements, $sMsg = "")
    {

        $oAuj = date("j");
        $aJourSemaine = array(
            date("j", strtotime('monday this week') - 1),
            date("j", strtotime('monday this week')),
            date("j", strtotime('tuesday this week')),
            date("j", strtotime('wednesday this week')),
            date("j", strtotime('thursday this week')),
            date("j", strtotime('friday this week')),
            date("j", strtotime('saturday this week'))
        );

        $sHtml = "
            <div id='calendrier'>
                <table>
                    <tr>
                        <th>D</th>
                        <th>L</th>
                        <th>M</th>
                        <th>M</th>
                        <th>J</th>
                        <th>V</th>
                        <th>S</th>
                    </tr>
                    <tr>";

        for ($i = 0; $i < count($aJourSemaine); $i++) {
            if ($aJourSemaine[$i] == $oAuj) {
                $sHtml .= "<td><span class='auj' class='event-bullet'>" . $aJourSemaine[$i] . "</span></td>";
            } else {
                $sHtml .= "<td>" . $aJourSemaine[$i] . "</td>";
            }
        }

        $sHtml .= "
                    </tr>
                    <tr>
                        <td></td>
                        <td><span></span></td>
                        <td></td>
                        <td><span></span></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                </table>
                <div>
                    <h2>Événements</h2>
                    <div id='events-container'>";

        if ($aoEvenements) {
            for ($i = 0; $i < count($aoEvenements); $i++) {

                $sDateDebut = ($aoEvenements[$i]->getsDateDebut());
                $sDateFin = ($aoEvenements[$i]->getsDateFin());
                $sDateMaintenant = new DateTime("now", new DateTimeZone("America/Toronto"));

                if ($sDateDebut <= $sDateMaintenant->format("Y-m-d H:i:s") && $sDateFin >= $sDateMaintenant->format("Y-m-d H:i:s")) {
                    $sHtml .= "
                        <div class='item events-item live'>
                        <span>En cours - Fin à " . date('H:i', strtotime($sDateFin)) . "</span>";
                } else if ($sDateDebut >= $sDateMaintenant->format("Y-m-d H:i:s")) {
                    $sHtml .= "
                        <div class='item events-item'>
                        <span>Débute à " . date('H:i', strtotime($sDateFin)) . "</span>";
                }

                $sHtml .= "
                            <p>" . $aoEvenements[$i]->getsNomEvenement() . "</p>
                    </div>";
            }
        } else {
            $sHtml .= "<p>Aucun événement pour l'instant.</p>";
        }

        $sHtml .= "
                    </div>
                </div>
            </div>
            ";

        echo $sHtml;
    }

    public function afficherEvenements($aoEvenements, $sMsg = "")
    {
        $sHtml = "";

        $sHtml .= $sMsg;

        if ($aoEvenements) {
            for ($i = 0; $i < count($aoEvenements); $i++) {

                $sDateDebut = ($aoEvenements[$i]->getsDateDebut());
                $sDateFin = ($aoEvenements[$i]->getsDateFin());
                $sDateMaintenant = new DateTime("now", new DateTimeZone("America/Toronto"));

                if ($sDateDebut <= $sDateMaintenant->format("Y-m-d H:i:s") && $sDateFin >= $sDateMaintenant->format("Y-m-d H:i:s")) {
                    $sHtml .= "
                        <div class='flex-container event-item event-item-now'>
                            <div>";
                    $sHtml .= "<span>En cours - Fin à " . date('H:i', strtotime($sDateFin)) . "</span>";
                } else if ($sDateDebut >= $sDateMaintenant->format("Y-m-d H:i:s")) {
                    $sHtml .= "
                        <div class='flex-container event-item'>
                            <div>";
                    $sHtml .= "<span>" . date('H:i', strtotime($sDateDebut)) . "</span>";
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


        echo $sHtml;
    }
}
