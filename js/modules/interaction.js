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
        this.AjouterEvenement();

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
                    sNomEvenement : sNomEvenement,
                    sDateDebut : sDateDebut,
                    sHeureDebut : sHeureDebut,
                    sDateFin : sDateFin,
                    sHeureFin : sHeureFin,
                    cmd : "cmd"
                }
            })
            // Si la reqête est terminée
                .done(function (sHtml) {
                    let el = document.querySelector("#calendrier > div:last-of-type > div");

                    console.log(sHtml);

                    el.innerHTML = sHtml;
                    //console.log(sHtml);
                });

        })


    }

} // fin classe