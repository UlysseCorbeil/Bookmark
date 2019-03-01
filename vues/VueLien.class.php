<?php
/**
 * Created by PhpStorm.
 * User: Pierrot
 * Date: 2019-03-01
 * Time: 13:13
 */

class VueLien {

    public function afficherTous($aoLiens, $sMsg = "") {
        $sSite = "
        <div id='site' class='row'>
        <div class='flex-container'>
            <div class='site-lien'>
                <a href=''>
                    <img src='https://www.google.com/s2/favicons?domain=www.google.com' alt=''>
                    <p>Google</p>
                </a>
            </div>
            <div class='site-lien'>
                <a href=''>
                    <img src='https://www.google.com/s2/favicons?domain=www.google.com' alt=''>
                    <p>Google</p>
                </a>
            </div>
            <div class='site-lien'>
                <span id='ajoutSite' data-open='false'><i class='fas fa-plus'></i></span>
                <div>
                    <input type='text' placeholder='Google.com' name='sUrlSite' id='sUrlSite'>
                    <button><i class='fas fa-angle-right'></i></button>
                </div>
            </div>
        </div>
    </div>
    <div id='actu' class='flex-container row'>
    ";

        echo $sSite;
    }

}
