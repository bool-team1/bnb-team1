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

});
//Algolia references
var places = require('places.js');
var placesAutocomplete = places({
  appId: 'plNNICPWC6MP',
  apiKey: 'b7a397b2d5106c810a38e7f10cdd967a',
  container: document.querySelector('#address-input')
});
//Updating latitude and longitude with Algolia
    placesAutocomplete.on("change", function resultSelected(e) {
      document.querySelector("#search-lat").value =
        e.suggestion.latlng.lat || "";
      document.querySelector("#search-lng").value =
      e.suggestion.latlng.lng || "";
    });

    $("#search-submit").on("click", function(){
      //Retrieve data for latitude, longitude and range
      $latitude = $("#search-lat").val();
      $longitude = $("#search-lng").val();
      $range = $("#range-field").val();
      $filters = [];
      $("#filters-list input:checked").each(function(index) {
        $filters.push($(this).val());
      });
      console.log($filters);
}
