<?php
/**
 * Created by PhpStorm.
 * User: Pierrot
 * Date: 2019-03-01
 * Time: 14:43
 */

class VueMeteo
{

    /**
     * Afficher la météo
     * @param void
     * @return void
     */
    public function afficherMeteo()
    {
        $sHtml = "
            <div id=\"meteo\">
                <h1><span></span></h1>
                <div>
                    <h2></h2>
                    <div id=\"prevision-container\">
                        <div class=\"item meteo-item\">
                            <span></span>
                            <p><span></span><span></span></p>
                        </div>
                    </div>
                </div>
            </div>
        ";
        echo $sHtml;
    }
}
