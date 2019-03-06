export class Meteo {

    // Classe permettant de créer et d'animer les elements de mon calendrier 
    constructor() {

        // Appel des fonctions
        this.getLocation();

    } // fin constr


    getLocation() {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(this.afficherMeteo);
        } else {
            this.afficherMeteo();
        }

    } // fin ()

    afficherMeteo(position) {

        if (position != "") {
            var sRequetePrevision = "https://api.apixu.com/v1/forecast.json?key=4367423a680c4b499f624827192802&days=5&lang=fr&q=" + position.coords.latitude + ",=" + position.coords.longitude;
            var aJour = ['Lundi', 'Mardi', 'Mercredi', 'Jeudi', "Vendredi", "Samedi", 'Dimanche'];

            $.ajax({
                    url: sRequetePrevision,
                    method: "get"
                })
                // Si la reqête est terminée
                .done(function (sHtml) {

                    // Afficher météo actuelle
                    document.querySelector("#meteo h1").innerHTML = Math.floor(sHtml.current.temp_c) + " °C <span>" + sHtml.current.condition.text + "<span>";

                    // Afficher prévision
                    var sPrevision = "";

                    for (var i = 0; i < sHtml.forecast.forecastday.length; i++) {

                        sPrevision += "<div class='item meteo-item'>" +
                            "<span>" + aJour[new Date(sHtml.forecast.forecastday[i].date).getDay()] + "</span>" +
                            "<p>" + Math.floor(sHtml.forecast.forecastday[i].day.avgtemp_c) + "°C <span>//</span><span>" +
                            sHtml.forecast.forecastday[i].day.condition.text + "</span></p></div>";
                    }

                    document.getElementById("prevision-container").innerHTML = sPrevision;
                });
        } else {

            // Afficher météo actuelle
            document.getElementById("meteo-actuelle").innerHTML = "<h2>-</h2>" +
                "<p>-, -</p>" +
                "<p>- °C</span></p>";

            // Afficher prévision
            var sPrevision = "<div class='flex-container meteo-item'>" +
                "<p>" + aJour[new Date().getDay()] + "</p>" +
                "<div>" +
                "<p>- °C</p>" +
                "<p>-</p>" +
                "</div>" +
                "</div>";

            document.getElementById("meteo-prevision").innerHTML = sPrevision;
        } // fin if else


    } // fin ()  


} // fin classe