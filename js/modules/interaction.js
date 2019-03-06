export class Interaction {


    // Classe permettant de créer et d'animer les elements de mon calendrier 
    constructor(oAjoutSite, oInputAjout, btnAjoutEvent, modalEvent, btnAjoutTache, modalTache) {

        // Initilisation des variables
        this.oAjoutSite = oAjoutSite;
        this.oInputAjout = oInputAjout;
        this.btnAjoutEvent = btnAjoutEvent;
        this.modalEvent = modalEvent;
        this.btnAjoutTache = btnAjoutTache;
        this.modalTache = modalTache;

        // Appel des fonctions
        // this.clicAjoutSite();
        this.btnAjoutSite();
        this.AjouterEvenement();
        this.AjouterTache();
        this.BloquerHeureFin();

    } // fin constr

    // Fait apparaitre le menu et ses icones
    // clicAjoutSite() {
    //     this.oAjoutSite.addEventListener('click', () => {
    //         if (this.oAjoutSite.getAttribute("data-open") === "false") {
    //             this.oInputAjout.style.display = "block";

    //             this.oAjoutSite.querySelector("i").classList.replace("fa-plus", "fa-minus");
    //             this.oAjoutSite.setAttribute("data-open", "true");
    //         } else {
    //             this.oInputAjout.style.display = "none";
    //             this.oAjoutSite.querySelector("i").classList.replace("fa-minus", "fa-plus");

    //             this.oAjoutSite.setAttribute("data-open", "false");
    //         }
    //     });
    // } // fin ()

    /**
     * Ajouter les écouteurs d'événements sur le X et sur le bouton pour ajouter un événement
     * @param void
     * @return void
     */
    btnAjoutSite() {

        // Au clic du bouton pour ajouter une evenement
        this.btnAjoutEvent.addEventListener('click', (evt) => {
            evt.preventDefault();

            this.modalEvent.style.display = "flex";
            document.getElementById("sNomEvenement").focus();
        });

        // Au clic du X du panneau d'ajout d'événement
        document.querySelector("#modalEvent .event>span").addEventListener("click", function(){
            document.getElementById("modalEvent").style.display = "none";
        });

        // Au clic du bouton pour ajouter une tâche
        this.btnAjoutTache.addEventListener('click', (evt) => {
            evt.preventDefault();
            this.modalTache.style.display = "flex";
            document.getElementById("sNomTache").focus();
        });
    }

    /**
     * Ajouter un événement dans le calendrier
     * @constructor
     */
    AjouterEvenement() {
        let cchJournee = document.getElementById("cchJournee");
        let btnAjouter = document.getElementById("btnAjouterEvenement");

        btnAjouter.addEventListener("click", function (evt) {

            evt.preventDefault();

            let sNomEvenement = document.getElementById("sNomEvenement").value;
            let sDateDebut = document.getElementById("sDateDebut").value;
            let sHeureDebut = document.getElementById("sHeureDebut").value;
            let sDateFin = document.getElementById("sDateFin").value;
            let sHeureFin = document.getElementById("sHeureFin").value;


            if (cchJournee.checked) {
                sHeureFin = "23:59:59";
                sDateFin = sDateDebut;
            }

            $.ajax({
                    url: "controleur/ajax/gererAjouterEvenement.php",
                    method: "POST",
                    data: {
                        sNomEvenement: sNomEvenement,
                        sDateDebut: sDateDebut,
                        sHeureDebut: sHeureDebut,
                        sDateFin: sDateFin,
                        sHeureFin: sHeureFin,
                        cmd: "cmd"
                    }
                })
                // Si la reqête est terminée
                .done(function (sHtml) {

                    let oEvenements = document.querySelector("#calendrier > div:last-of-type > div");

                    oEvenements.innerHTML = sHtml;

                    document.getElementById("modalEvent").style.display = "none";
                });

        })
    }

    // Permet d'ajouter des tâches 
    AjouterTache() {

        let btnAjouter = document.getElementById("btnAjouterTache");

        btnAjouter.addEventListener("click", function (evt) {

            evt.preventDefault();

            // Les variables
            let sNomTache = document.getElementById("sNomTache").value;

            $.ajax({
                    url: "controleur/ajax/gererAjouterTache.php",
                    method: "POST",
                    data: {
                        sNomTache: sNomTache,
                        cmd: "cmd"
                    }
                })
                // Si la reqête est terminée
                .done(function (sHtml) {
                    let oTaches = document.querySelector("#todo div:last-of-type");

                    oTaches.innerHTML = sHtml;
                }); // fin AJAX

        }) // fin evt
    } // fin ()

    BloquerHeureFin() {
        let cchJournee = document.getElementById("cchJournee");
        let oDateFin = document.querySelector("#modalEvent .modal-contenu form > div:last-of-type");

        cchJournee.addEventListener("input", function () {
            if (cchJournee.checked) {
                oDateFin.style.display = "none";
            } else {
                oDateFin.style.display = "flex";
            }
        });
    } // fin ()

} // fin classe