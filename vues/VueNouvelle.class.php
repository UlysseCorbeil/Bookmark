<?php
/**
 * Created by PhpStorm.
 * User: PO
 * Date: 2019-03-05
 * Time: 16:20
 */

class VueNouvelle
{

    /**
     * Afficher toutes les nouvelles
     * @param void
     * @return void
     */
    public function afficherTousNouvelles(Nouvelle $oNouvelle)
    {
        $sHtml = "
            " . $oNouvelle->getNouvelles() . "
        ";

        echo $sHtml;
    }

    /**
     * Afficher la bourse
     * @param void
     * @return void
     */
    public function afficherTousBourse()
    {
        $sHtml = "
            <div id='bourse'>
                <h2>Bourse</h2>
                <div id='stock-container'>
                </div>
            </div>
        ";

        echo $sHtml;
    }
}
