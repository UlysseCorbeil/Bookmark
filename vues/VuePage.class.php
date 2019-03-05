<?php

class VuePage
{

    /**
     * Affichage du Head de la page HTML
     * @param void
     * @return void
     */
    public function getHead()
    {
        $sHeader = '<!doctype html>
            <html lang="fr">
            
            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <meta http-equiv="X-UA-Compatible" content="ie=edge">
                
                <title>Bookmark | Développement</title>
                
<<<<<<< HEAD
<<<<<<< HEAD
                <link rel="stylesheet" href="css/style.css">
                <link rel="stylesheet" href="css/style_po.css">
                <link rel="stylesheet" href="css/style_ulysse.css">
                <link rel="stylesheet" href="css/style_quotes.css">
                <link rel="stylesheet" href="css/darkMode.css">
                <link rel="stylesheet" href="css/tabs.css">
=======
                <link rel="stylesheet" href="css/global.css">
                <link rel="stylesheet" href="css/layout.css">
>>>>>>> 6af8f3151e8bd2ee64854088aed909e717701506
=======
                <link rel="stylesheet" href="css/global.css">
                <link rel="stylesheet" href="css/layout.css">
                <link rel="stylesheet" href="css/style_quotes.css">
                <link rel="stylesheet" href="css/tabs.css">
>>>>>>> ulysse
                <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css">
                <link href="https://fonts.googleapis.com/css?family=Montserrat:200,400,700,900" rel="stylesheet">
                
                <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
            </head>
            
            <body>';

        echo $sHeader;
    } // fin ()

    /**
     * Afficher la barre de navigation du site
     * @param void
     * @return void
     */
    public function getNav()
    {
        $sHtml = "
        <nav>
            <span><i class='fas fa-bars'></i></span>
            <ul>
                <li class='actif'><a href='#'><i class='fas fa-home'></i></a></li>
                <li id='btnAjouterEvenement'><a href='#'><i class='far fa-calendar-plus'></i></a></li>
                <li id='btnAjouterTache'><a href='#'><i class='fas fa-tasks'></i></a></li>
            </ul>
            <div>
                <a href='#'><i class='fas fa-heart'></i></a>
                <p><a href='https://pobourdeau.com' target='_blank'>POB</a> &amp; <a href='http://ulyssecorbeil.com' target='_blank'>UC</a></p>
            </div>
        </nav>
        ";

        echo $sHtml;
    }


    /**
     * Affichage de la fin de la page HTML
     * @param void
     * @return void
     */
    public function getFoot()
    {
        $sfinHTML = '
            <script src="https://spotify-player.herokuapp.com/spotify-player.js"></script>
            <script type="module" src="js/app.js"></script>
        </body>
        
        </html> ';
        echo $sfinHTML;
    } // fin ()
} // fin classe
