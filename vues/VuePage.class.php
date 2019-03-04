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
                
                <link rel="stylesheet" href="css/style.css">
                <link rel="stylesheet" href="css/style_po.css">
                <link rel="stylesheet" href="css/style_ulysse.css">
                <link rel="stylesheet" href="css/style_quotes.css">
                <link rel="stylesheet" href="css/darkMode.css">
                <link rel="stylesheet" href="css/tabs.css">
                <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css">
                <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700" rel="stylesheet">
                
                <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
            </head>
            
            <body>';

        echo $sHeader;
    } // fin ()


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
