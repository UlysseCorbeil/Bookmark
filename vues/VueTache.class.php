<?php
/**
 * Created by PhpStorm.
 * User: Pierrot
 * Date: 2019-03-01
 * Time: 13:13
 */

class VueTache {

    /**
     * Afficher la liste des tâches à faire
     * @param $aoTaches
     * @param string $sMsg
     */
    public function afficherTous($aoTaches, $sMsg=""){

        $sToDo = "<div id='middle' class='flex-container'>
        <div id='todo'>
            <h2><span>À faire</span><a href='#'><i class='fas fa-plus'></i> Ajouter</a></h2>
            <div>
                <div class='flex-container todo-item'>
                    <label class='container'>
                        <input type='checkbox' checked='checked'>
                        <span class='checkmark'></span>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
                    </label>
                    <a href='#'><i class='fas fa-ellipsis-v'></i></a>
                </div>
                <div class='flex-container todo-item'>
                    <label class='container'>
                        <input type='checkbox' checked='checked'>
                        <span class='checkmark'></span>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
                    </label>
                    <a href='#'><i class='fas fa-ellipsis-v'></i></a>
                </div>
                <div class='flex-container todo-item'>
                    <label class='container'>
                        <input type='checkbox' checked='checked'>
                        <span class='checkmark'></span>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
                    </label>
                    <a href='#'><i class='fas fa-ellipsis-v'></i></a>
                </div>
            </div>
        </div>";

        echo  $sToDo;
    }

}
