<?php

class VuePage
{
    // Variables privées qui contient les mois de l'années
    private $aMois = array("Janvier", "Février", "Mars", "Avril", "Mai", "Juin", "Juillet", "Août", "Septembre", "Octobre", "Novembre", "Décembre");

    public function afficherPage($oUtilisateur, $aoEvenements)
    {
        // Initialisation de la page HTML
        $sHtml = '';

        // Injection HTML
        $sHtml .= $this->getHeader();
        $sHtml .= $this->afficherUnUtilisateur($oUtilisateur);
        $sHtml .= $this->getSite();
        $sHtml .= $this->afficherEvenements($aoEvenements);
        $sHtml .= $this->getFinCalendrier();
        $sHtml .= $this->getFinMiddle();
        $sHtml .= $this->getMeteo();
        $sHtml .= $this->getModal();
        $sHtml .= $this->getScripts();
        $sHtml .= $this->getFinHTML();

        // Affichage
        echo $sHtml;
    }

    // Affiche le header HTML
    public function getHeader()
    {
        $sHeader = '<!doctype html>
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
            
            <body>';
        return $sHeader;
    } // fin ()

    // Afficher un utilisateur
    public function afficherUnUtilisateur(Utilisateur $oUtilisateur, $sMsg = "")
    {
        date_default_timezone_set('America/Toronto');

        $sHtml = "
            <nav>
                <img src='medias/" . $oUtilisateur->getsAvatar() . "' alt=''>
                <ul>
                    <li><a href='#'><i class='fas fa-home'></i></a></li>
                    <li><a href='#'><i class='fas fa-cog'></i></a></li>
                    <li><a href='#'><i class='fas fa-sign-out-alt'></i></a></li>
                </ul>
            </nav>
            
            <main>
                <div id='contenu' class='flex-container'>
                    <div id='info' class='row'>";


        $iHeure = date("G");

        if ($iHeure >= 5 && $iHeure < 10) {
            $sMotBienvenue = "Bon matin ";
        } else if ($iHeure >= 10 && $iHeure < 17) {
            $sMotBienvenue = "Bonjour ";
        } else {
            $sMotBienvenue = "Bonsoir ";
        }


        $sHtml .= "
                        <h1>" . $sMotBienvenue . $oUtilisateur->getsPrenom() . " " . substr($oUtilisateur->getsNom(), 0, 1) . ".</h1>
                        <div class='flex-container'>
                        <p>Aujourd'hui sera une belle journée!</p>
                    </div>
                </div>
        ";

        return $sHtml;
    }

    // Permet l'affichage des événements
    public function afficherEvenements($aoEvenements, $sMsg = "")
    {
        date_default_timezone_set('America/Toronto');

        $sHtml = "
        <div id='calendrier' class='card'>
            <div style='background-image: url(\"https://source.unsplash.com/random\");'>
                <h2>Calendrier</h2>
                <div>
                    <p>" . date("d") . "</p>
                    <p>" . $this->aMois[date("n") - 1] . "</p>
                </div>
                <a href='#'><i class='fas fa-plus'></i></a>
            </div>
            <div>
                <h3>Événements</h3>
                <div>";

        if ($aoEvenements) {
            for ($i = 0; $i < count($aoEvenements); $i++) {
                $sHtml .= "
                        <div class='flex-container event-item'>
                            <div>";

                if ($aoEvenements[$i]->getsDateDebut() <= date("Y-m-d H:i:s") && $aoEvenements[$i]->getsDateFin() >= date("Y-m-d H:i:s")) {
                    $sHtml .= "<span>En cours - Fin à " . date("H:i", strtotime($aoEvenements[$i]->getsDateFin())) . "</span>";
                } else if ($aoEvenements[$i]->getsDateDebut() >= date("Y-m-d H:i:s")) {
                    $sHtml .= "<span>" . date("H:i", strtotime($aoEvenements[$i]->getsDateDebut())) . "</span>";
                }

                $sHtml .= "
                            <p>" . $aoEvenements[$i]->getsNomEvenement() . "</p>
                        </div>
                        <a href='#'><i class='fas fa-ellipsis-v'></i></a>
                    </div>
                    ";
            }
        } else {
            $sHtml .= "<p>Aucun événement prévu.</p>";
        }

        $sHtml .= "
                </div>
            </div>
        </div>
        ";

        return $sHtml;
    }

    // affichage de la section site
    public function getSite()
    {
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
        return $sSite;
    } // fin ()

    // affichage de la section middle
    public function getFinCalendrier()
    {
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
        return $sToDo;
    } // fin ()

    // affichage du timer
    public function getFinMiddle()
    {
        $sfinMiddle = '<div class="flex-container">
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
        </div>';
        return $sfinMiddle;
    } // fin ()

    // Affiche la section météo
    public function getMeteo()
    {
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
        </main>';
        return $sMeteo;
    } // fin ()

    // Affiche la section modal
    public function getModal()
    {
        $sModal = '<div class="modal" id="modalEvent">
        <div class="modal-contenu event">
            <span><i class="fas fa-times"></i></span>
            <h3>Ajouter un événement</h3>

            <form action="">
                <div class="flex-container">
                    <p>Titre</p>
                    <input type="text" name="sNomEvenement" id="sNomEvenement" placeholder="Titre de l\'événement">
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
    </div>';
        return $sModal;
    } // fin ()

    // Affiche les scripts qu'on insere dans le HTML
    public function getScripts()
    {
        $sScripts = '<script src="js/app.js"></script>';
        return $sScripts;
    } // fin ()

    // fin des tags
    public function getFinHTML()
    {
        $sfinHTML = '
        </body>
        
        </html> ';
        return $sfinHTML;
    } // fin ()
} // fin classe
