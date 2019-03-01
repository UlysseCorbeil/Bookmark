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

// Variables pour les classes
let oAjoutSite = document.getElementById("ajoutSite"),
    oInputAjout = document.querySelector(".site-lien:last-of-type>div"),
    modalEvent = document.getElementById("modalEvent"),
    btnAjoutEvent = document.querySelector("#calendrier a"),

    // Variables du temps
    elmTemps = document.querySelector('.small-box h1'),
    currentDate = new Date(),
    iHeure = currentDate.getHours(),
    iMinute = currentDate.getMinutes(),

    // Classes
    interaction = new class {},
    meteo = new class {},
    animSite = new class {},
    autoRefresh = new class {};

interaction = new Interaction(oAjoutSite, oInputAjout, btnAjoutEvent, modalEvent);
meteo = new Meteo();

autoRefresh = new AutoRefresh(elmTemps, iHeure, iMinute);

// animSite = new animSite();