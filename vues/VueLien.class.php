<?php
/**
 * Created by PhpStorm.
 * User: Pierrot
 * Date: 2019-03-01
 * Time: 13:13
 */

class VueLien
{

    /**
     * Afficher tous les liens vers les sites
     * @param $aoLiens
     * @param string $sMsg
     */
    public function afficherTous($aoLiens, $sMsg = "")
    {
        $sHtml = "
            <div id='site' class='row'>
                <div class='flex-container'>";

        for ($i = 0; $i < count($aoLiens); $i++) {
            $sHtml .= "<div class='site-lien'>
                        <a href='" . $aoLiens[$i]->getoLien()->getsUrl() . "' target='_BLANK'>
                            <img src='https://www.google.com/s2/favicons?domain=" . $aoLiens[$i]->getoLien()->getsFavicon() . "' alt=''>
                            <p>" . $aoLiens[$i]->getoLien()->getsNomSite() . "</p>
                        </a>
                    </div>";
        }

        $sHtml .= "
                    <div class='site-lien'>
                        <span id='ajoutSite' data-open='false'><i class='fas fa-plus'></i></span>
                        <div>
                            <input type='text' placeholder='Google.com' name='sUrlSite' id='sUrlSite'>
                            <button><i class='fas fa-angle-right'></i></button>
                        </div>
                    </div>
                </div>
            </div>";

        echo $sHtml;
    }
}
