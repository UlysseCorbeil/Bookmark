<?php
/**
 * Created by PhpStorm.
 * User: Pierrot
 * Date: 2019-03-01
 * Time: 13:13
 */

class VueTache
{

    /**
     * Afficher la liste des tâches à faire
     * @param $aoTaches
     * @param string $sMsg
     */
    public function afficherTous($aoTaches, $sMsg = "")
    {

        $sHtml = "<div id='middle' class='flex-container'>
        <div id='todo'>
            <h2><span>À faire</span><a href='#'><i class='fas fa-plus'></i> Ajouter</a></h2>
            <div>";


        for ($i = 0; $i < count($aoTaches); $i++) {
            $sHtml .= "
                <div class='flex-container todo-item'>
                    <label class='container'>";

            if ($aoTaches[$i]->getbComplete() == 1) {
                $bChecked = "checked";
            } else {
                $bChecked = "";
            }

            $sHtml .= "
                        <input type='checkbox' " . $bChecked . " name='cchTache_" . $aoTaches[$i]->getidTache() . "' id='cchTache_" . $aoTaches[$i]->getidTache() . "'>
                        <span class='checkmark'></span>
                        <p>" . $aoTaches[$i]->getsTache() . "</p>
                    </label>
                    <a href='#'><i class='fas fa-ellipsis-v'></i></a>
                </div>";
        }

        $sHtml .= "
            </div>
        </div>";

        echo  $sHtml;
    }
}
