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

        $sHtml = "<div id='taches'>
                <h2>À faire</h2>
                <div id='todo-container' class='div-content'>
                    <div class='flex-container todo-item'>
                        <label class='container'>
                            <input type='checkbox' name='cchTache_1' id='cchTache_1'>
                            <span class='checkmark'></span>
                            <p>d</p>
                        </label>
                        <a href='#'><i class='fas fa-ellipsis-v'></i></a>
                    </div>
                </div>
            </div>";

        echo  $sHtml;
    }

    /**
     * Afficher la liste des tâches à faire
     * @param $aoTaches
     * @param string $sMsg
     */
    public function afficherTaches($aoTaches, $sMsg = "")
    {
        $sHtml = "";

        $sHtml .= $sMsg;

        if ($aoTaches) {
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
        } else {
            $sHtml .= "<p>Aucune tâches pour le moment! Cliquer sur Ajouter pour en créer une.</p>";
        }

        echo $sHtml;
    } // fin ()
}
