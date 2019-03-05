<?php
/**
 * Created by PhpStorm.
 * User: PO
 * Date: 2019-03-05
 * Time: 16:20
 */

class VueNouvelle {

    /**
     * Afficher toutes les nouvelles
     * @param void
     * @return void
     */
    public function afficherTousNouvelles(){
        $sHtml = "
        <div id='nouvelles'>
                <h2>Nouvelles</h2>
                <div id='news-container' class='div-content'>
                    <div class='item news-item'>
                        <span>La Presse</span>
                        <a href='#'>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</a>
                    </div>
                </div>
            </div>
        ";

        echo $sHtml;
    }

    /**
     * Afficher la bourse
     * @param void
     * @return void
     */
    public function afficherTousBourse(){
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