<?php
/**
 * Created by PhpStorm.
 * User: PO
 * Date: 2019-02-26
 * Time: 16:34
 */

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require "modeles/Utilisateur.class.php";
require "modeles/Evenement.class.php";

require "vues/VueUtilisateur.class.php";
require "vues/VueEvenement.class.php";

require "lib/PDOLib.class.php";
require "lib/TypeException.class.php";

?>

<!doctype html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css">
    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
</head>

<body>

    <?php

    try {
        $oUtilisateur = new Utilisateur(2);
        $oVueUtilisateur = new VueUtilisateur();

        $oUtilisateur->rechercherUn();

        $oVueUtilisateur->afficherUn($oUtilisateur);
    } catch (Exception $oException) {
        echo "<p>" . $oException->getMessage() . "</p>";
    }

    ?>

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

        <!-- CALENDRIER -->
        <?php

        try {
            $oUtilisateur = new Utilisateur(1);
            $oEvenement = new Evenement();
            $oVueEvenement = new VueEvenement();

            $aoEvenements = $oEvenement->rechercherTousAuj();
            $oVueEvenement->afficherTousAuj($aoEvenements);
        } catch (Exception $oException) {
            echo "<p>" . $oException->getMessage() . "</p>";
        }

        ?>
        <!-- FIN CALENDRIER -->
        <div id="middle" class="flex-container">
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
            </div>

            <div class="flex-container">
                <div class="small-box" id="chrono">
                    <p>00:00:00</p>
                    <div class="flex-container">
                        <button>Effacer</button>
                        <button>Démarrer</button>
                    </div>
                </div>
                <div class="small-box">
                    <h2>Horloge</h2>
                </div>
            </div>
        </div>


        <div id='meteo' class='card'>
            <div class='flex-container morning' id="meteo-actuelle">
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

    <div class="modal" id="modalEvent">
        <div class="modal-contenu event">
            <span><i class="fas fa-times"></i></span>
            <h3>Ajouter un événement</h3>

            <form action="">
                <div class="flex-container">
                    <p>Titre</p>
                    <input type="text" name="sNomEvenement" id="sNomEvenement" placeholder="Titre de l'événement">
                </div>
                <div class="flex-container">
                    <p>Début</p>
                    <div>
                        <label for="sDateDebut"><i class="far fa-calendar"></i></label>
                        <input type="text" name="sDateDebut" id="sDateDebut" placeholder="2019-02-27">
                    </div>
                    <div>
                        <label for="sHeureDebut"><i class="far fa-clock"></i></label>
                        <input type="text" name="sHeureDebut" id="sHeureDebut" placeholder="12:00">
                    </div>

                    <label class="container">
                        <input type="checkbox" name="cchJournee" id="cchJournee">
                        <span class="checkmark"></span>
                        <p>Toute la journée</p>
                    </label>
                </div>
                <div class="flex-container">
                    <p>Fin</p>
                    <div>
                        <label for="sDateFin"><i class="far fa-calendar"></i></label>
                        <input type="text" name="sDateFin" id="sDateFin" placeholder="2019-02-27">
                    </div>
                    <div>
                        <label for="sHeureFin"><i class="far fa-clock"></i></label>
                        <input type="text" name="sHeureFin" id="sHeureFin" placeholder="12:00">
                    </div>
                </div>

                <button>Créer</button>
            </form>
        </div>
    </div>

    <div class="modal" id="modalTodo">
        <div class="modal-contenu modal-todo">
            <span><i class="fas fa-times"></i></span>
            <h3>Ajouter une tâche</h3>

            <form action="" method="get">
                <div class="flex-container">
                    <p>Tâche</p>
                    <input type="text" name="sNomTache" id="sNomTache" placeholder="Tâche à réaliser">
                </div>

                <button>Créer</button>
            </form>
        </div>
    </div>

    <script src="js/app.js"></script>

</body>

</html> 