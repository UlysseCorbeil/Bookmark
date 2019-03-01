// Importation des modules

import {
    Interaction
} from "./modules/interaction.js";
import {
    Meteo
} from "./modules/meteo.js";

// Variables pour les classes
let oAjoutSite = document.getElementById("ajoutSite"),
    oInputAjout = document.querySelector(".site-lien:last-of-type>div"),
    modalEvent = document.getElementById("modalEvent"),
    btnAjoutEvent = document.querySelector("#calendrier a"),
    interaction = new class {},
    meteo = new class {},
    animSite = new class {};

interaction = new Interaction(oAjoutSite, oInputAjout, btnAjoutEvent, modalEvent);
meteo = new Meteo();

// animSite = new animSite();