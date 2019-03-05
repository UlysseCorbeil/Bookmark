<?php
/**
 * Created by PhpStorm.
 * User: PO
 * Date: 2019-03-05
 * Time: 16:23
 */

class VueCalculatrice {

    public function afficherUn(){
        $sHtml = "
            <div id='calculatrice'>
                <h2>Calculatrice</h2>
                <div id='calculator-container'>
                    <input type='text' placeholder='Expression...' id='txtCalcul'>
                    <p><span>=</span>0</p>
                </div>
            </div>
        ";

        echo $sHtml;
    }

}