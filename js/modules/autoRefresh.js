export class AutoRefresh {

    // Classe permettant de créer et d'animer les elements de mon calendrier 
    constructor(elmTemps) {

        this.elmTemps = elmTemps;

        // Appel de la fonction
        this.tempsTimer();

    } // fin ()

    // Fonction qui calcule l'heure et l'affiche
    tempsTimer() {

        let currentDate = new Date(),
            iHeure = currentDate.getHours(),
            iMinute = currentDate.getMinutes(),
            sTempsComplet,
            sPeriode;

        sTempsComplet = "" + ((iHeure > 12) ? iHeure - 12 : iHeure);
        sTempsComplet += ((iMinute < 10) ? ":0" : ":") + iMinute;
        sPeriode = (iHeure >= 12) ? " PM" : " AM";

        this.elmTemps.innerHTML = sTempsComplet + "<span>" + sPeriode +"</span>";

        setTimeout(this.tempsTimer.bind(this), 1000);
    } // fin ()

} // fin classe