export class Interaction {


    // Classe permettant de créer et d'animer les elements de mon calendrier 
    constructor(oAjoutSite, oInputAjout, btnAjoutEvent, modalEvent) {

        // Initilisation des variables
        this.oAjoutSite = oAjoutSite;
        this.oInputAjout = oInputAjout;
        this.btnAjoutEvent = btnAjoutEvent;
        this.modalEvent = modalEvent;

        // Appel des fonctions
        this.clicAjoutSite();
        this.btnAjoutSite();
        this.modalEventClic();

    } // fin constr

    // Fait apparaitre le menu et ses icones
    clicAjoutSite() {
        this.oAjoutSite.addEventListener('click', () => {
            if (this.oAjoutSite.getAttribute("data-open") === "false") {
                this.oInputAjout.style.display = "block";

                this.oAjoutSite.querySelector("i").classList.replace("fa-plus", "fa-minus");
                this.oAjoutSite.setAttribute("data-open", "true");
            } else {
                this.oInputAjout.style.display = "none";
                this.oAjoutSite.querySelector("i").classList.replace("fa-minus", "fa-plus");

                this.oAjoutSite.setAttribute("data-open", "false");
            }
        });
    } // fin ()

    // On fait apprait le menu au clic du bouton
    // On empêche aussi l'utilisateur de cliquer ailleurs
    btnAjoutSite() {
        this.btnAjoutEvent.addEventListener('click', (evt) => {
            evt.preventDefault();
            this.modalEvent.style.display = "flex";
            document.getElementById("sNomEvenement").focus();
        });
    }

    // Clic du modalEvent
    modalEventClic() {
        this.modalEvent.querySelector("span").addEventListener('click', () => {
            this.modalEvent.style.display = "none";
        });
    }

} // fin classe