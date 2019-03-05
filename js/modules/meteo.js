export class Meteo {

    // Classe permettant de créer et d'animer les elements de mon calendrier 
    constructor() {

        // Appel des fonctions
        this.getLocation();

        this.options = options = {
            enableHighAccuracy: true,
            timeout: 5000,
            maximumAge: 0
          };

    } // fin constr


    getLocation() {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(this.afficherMeteo);
            //console.log(navigator.geolocation.getCurrentPosition());
        } else {
            afficherMeteo();
        }

        navigator.geolocation.getCurrentPosition(this.success, this.error, this.options);
    } // fin ()

    afficherMeteo(position = "") {

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
                    document.getElementById("meteo-actuelle").innerHTML = "<h2>" + sHtml.current.condition.text + "</h2>" +
                        "<p>" + sHtml.location.name + ", " + sHtml.location.region + "</p>" +
                        "<p>" + Math.floor(sHtml.current.temp_c) + " <span>°C</span></p>";

                    // Afficher prévision
                    var sPrevision = "";

                    for (var i = 0; i < sHtml.forecast.forecastday.length; i++) {
                        sPrevision += "<div class='flex-container meteo-item'>\n" +
                            "<p>" + aJour[new Date(sHtml.forecast.forecastday[i].date).getDay()] + "</p>" +
                            "<div>" +
                            "<p>" + Math.floor(sHtml.forecast.forecastday[i].day.avgtemp_c) + "°C</p>" +
                            "<p>" + sHtml.forecast.forecastday[i].day.condition.text + "</p>" +
                            "</div>" +
                            "</div>"
                    }

                    document.getElementById("meteo-prevision").innerHTML = sPrevision;
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
      
      success(pos) {
        var crd = pos.coords;
      
        console.log(crd.latitude);
      }
      
      error(err) {
        console.warn(`ERREUR (${err.code}): ${err.message}`);
      }
      
      

} // fin classe