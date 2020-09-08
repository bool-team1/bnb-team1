require('./bootstrap');

//Jquery dependency
var $ = require( "jquery" );


/* var places = require('places.js');
var placesAutocomplete = places({
  appId: 'plNNICPWC6MP',
  apiKey: 'b7a397b2d5106c810a38e7f10cdd967a',
  container: document.querySelector('#address-input')
}); */

$(document).ready(function(){

    //CLIENT SIDE VALIDATION
    //Validation for registration form email
    var registration_form_email = document.getElementById("email");

    registration_form_email.addEventListener("input", function (event) {
        if (email.validity.typeMismatch) {
          email.setCustomValidity("Inserisci un indirizzo email valido");
        } else {
          email.setCustomValidity("");
        }
    });

    var visualizzazioni_appartamenti = {
            'appartamenti': ['Jimmie Ranch', 'Clifton Rest', 'Everett Centers'],
            'visualizzazioni': [1, 5, 10]
        };

    var myChart = new Chart($('#visualizzazioni_appartamenti')[0].getContext('2d'), {
        type: 'line',
        data: {
            labels: visualizzazioni_appartamenti['appartamenti'],
            datasets: [{
                label: 'visualizzazioni',
                data: visualizzazioni_appartamenti['visualizzazioni'],
                backgroundColor: [
                    'rgb(255, 99, 132)',
                ],
                borderColor: [
                    'rgb(255, 99, 132)',
                ],
                borderWidth: 3
            }]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                }
            }
        });
});
//Algolia references
var places = require('places.js');
var placesAutocomplete = places({
  appId: 'plNNICPWC6MP',
  apiKey: 'b7a397b2d5106c810a38e7f10cdd967a',
  container: document.querySelector('#address')
});
//Updating latitude and longitude with Algolia
    placesAutocomplete.on("change", function resultSelected(e) {
      document.querySelector("#lat").value =
        e.suggestion.latlng.lat || "";
      document.querySelector("#lng").value =
      e.suggestion.latlng.lng || "";
    });

    $("#submit").on("click", function(){
      //Retrieve data for latitude, longitude and range
      $latitude = $("#lat").val();
      $longitude = $("#lng").val();
      $range = $("#range-field").val();
      $filters = [];
      $("#filters-list input:checked").each(function(index) {
        $filters.push($(this).val());
      });
      console.log($filters);
}
