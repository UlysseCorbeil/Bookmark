export class AutoRefresh {

    // Classe permettant de créer et d'animer les elements de mon calendrier 
    constructor(elmTemps, iHeure, iMinute) {

        this.elmTemps = elmTemps;
        this.iHeure = iHeure;
        this.iMinute = iMinute;

        this.tempsTimer();

    } // fin ()

    tempsTimer = setInterval(() => {
        sTempsComplet = this.iHeure + this.iMinute;
        elmTemps.innerHTML = sTempsComplet;
    }, 60 * 1000);

} // fin classe