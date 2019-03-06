// Importation des modules

import {
    Interaction
} from "./modules/interaction.js";
import {
    Meteo
} from "./modules/meteo.js";
import {
    AutoRefresh
} from "./modules/autoRefresh.js";
// import {
//     SpotifyAPI
// } from "./modules/spotify_API.js";

// Variables pour les classes
let oAjoutSite = document.getElementById("ajoutSite"),
    oInputAjout = document.querySelector(".site-lien:last-of-type>div"),
    modalEvent = document.getElementById("modalEvent"),
    btnAjoutEvent = document.querySelector("#btnAjouterEvenement"),
    btnAjoutTache = document.querySelector("#btnAjouterTache"),
    modalTache = document.getElementById('modalTodo'),

    // Variables du temps
    elmTemps = document.querySelector('#horloge h2'),

    // Classes
    interaction = new class {},
    meteo = new class {},
    animSite = new class {},
    autoRefresh = new class {};
// spotify = new class {};

// Intéractions client
interaction = new Interaction(oAjoutSite, oInputAjout, btnAjoutEvent, modalEvent, btnAjoutTache, modalTache);

// Gère l'affichage de la météo avec géolocalisation
meteo = new Meteo();

// Gère les call API à spotify
// spotify = new SpotifyAPI();

// fonction qui gère les événements automatiques
autoRefresh = new AutoRefresh(elmTemps);

// Animations
// animSite = new animSite();