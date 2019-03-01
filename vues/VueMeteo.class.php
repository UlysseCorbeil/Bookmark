<?php
/**
 * Created by PhpStorm.
 * User: Pierrot
 * Date: 2019-03-01
 * Time: 14:43
 */

class VueMeteo {

    /**
     * Afficher la météo
     * @param void
     * @return void
     */
    public function afficherMeteo(){
        $sMeteo = '<div id="meteo" class="card">
        <div class="flex-container morning" id="meteo-actuelle">
            <!-- Afficher météo actuelle -->
        </div>
                <div>
                    <h3>Prévision</h3>
                    <div id="meteo-prevision">
                        <!-- Afficher prévision météo -->
                    </div>
                </div>
            </div>

        </div>
        </div>
        </main>
        
        ';
        echo $sMeteo;
    }

}
