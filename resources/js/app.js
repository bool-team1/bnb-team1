require('./bootstrap');

//Jquery dependency
var $ = require( "jquery" );
// Chart js
var Chart = require('chart.js');

//Algolia references (Activate if using Algolia in page)
if (document.getElementById("address-input")) {
  var places = require('places.js');
  var placesAutocomplete = places({
    appId: 'plNNICPWC6MP',
    apiKey: 'b7a397b2d5106c810a38e7f10cdd967a',
    container: document.querySelector('#address-input')
  });
};


$(document).ready(function(){

    //CLIENT SIDE VALIDATION
    //Validation for registration form email
    var registration_form_email = document.getElementById("email");

    if (registration_form_email) {
      registration_form_email.addEventListener("input", function (event) {
        if (email.validity.typeMismatch) {
          email.setCustomValidity("Inserisci un indirizzo email valido");
        } else {
          email.setCustomValidity("");
        }
      });
    };

    var visualizzazioni_appartamenti = {
            'appartamenti': ['Jimmie Ranch', 'Clifton Rest', 'Everett Centers'],
            'visualizzazioni': [1, 5, 10]
        };

    var myChart = new Chart($('#myChart')[0].getContext('2d'), {
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
    };
    
    //SEARCH APARTMENT
    //Updating latitude and longitude with Algolia, if active
    if (document.getElementById("address-input")) {
      placesAutocomplete.on("change", function resultSelected(e) {
        document.querySelector("#search-lat").value =
          e.suggestion.latlng.lat || "";
        document.querySelector("#search-lng").value =
        e.suggestion.latlng.lng || "";
      });
    };

    //Apartment search if passed parameters at opening search page
    if (document.getElementById("address-input")) {
        $latitude = $("#phantom-lat").val();
        $longitude = $("#phantom-lng").val();
        $range = $("#phantom-range").val();
        $filters = [];
        $("#filters-list input:checked").each(function() {
        $filters.push($(this).val());
        });

      //AJAX call to API for apartment results
      $.ajax({
        url : "http://localhost:8000/api/apartments",
        method : "GET",
        data : {
            lat : $latitude,
            lng: $longitude,
            range: $range,
            filters: $filters
            },
        success: function(data) {
                //Resetting HTML fields
                $(".search-results-details #results-count").html("");
                $("#sponsored-header").text("");
                $("#sponsored-body").html("");
                $("#normal-results").html("");


                //Updating results count description
                $(".search-results-details #results-count").append("<p>Totale appartamenti trovati: " + data['filtered_count'] + "</p>");

                //Cycling through sponsored results and adding it to specific container
                $tot_sponsored = data['sponsored_results'].length;
                if($tot_sponsored > 0) {
                  
                  $(".search-results-details #sponsored-header").text("Annunci sponsorizzati");

                  for (i = 0; i < $tot_sponsored; i++) {
                    if (data['sponsored_results'][i]['facilities']) {
                      $facilities_to_add = data['sponsored_results'][i]['facilities'].toString();
                    } else {
                      $facilities_to_add = "Nessuno"
                    }

                    $html_item_to_add = "<div class='result-item'><h6>" + data['sponsored_results'][i]['title'] + "</h6><div class='result-item-body'><img src='"+ data['sponsored_results'][i]['main_pic'] + "' alt=''><div class='result-item-details'><p><strong>Indirizzo: </strong>" + data['sponsored_results'][i]['address'] + "</p> <p><strong>Metri quadri: </strong>" + data['sponsored_results'][i]['square_mt'] + "</p> <p><strong>Stanze da letto: </strong>" + data['sponsored_results'][i]['rooms_n'] + "</p> <p><strong>Servizi: </strong>" + $facilities_to_add + "</p><p><strong>Distanza: </strong>" + data['sponsored_results'][i]['distance'].toFixed(2) + " km</p></div></div><a href='http://localhost:8000/" + data['sponsored_results'][i]['id'] +"/detail' class='btn btn-primary result-view'>Vedi i dettagli</a></div>";
                    
                    $(".search-results-details #sponsored-body").append($html_item_to_add);
                  }

                };

                //Cycling through not sponsored results and adding it to specific container
                $tot_not_sponsored = data['normal_results'].length;
                if($tot_not_sponsored > 0) {
                  
                  for (i = 0; i < $tot_not_sponsored; i++) {
                    if (data['normal_results'][i]['facilities']) {
                      $facilities_to_add = data['normal_results'][i]['facilities'].toString();
                    } else {
                      $facilities_to_add = "Nessuno"
                    }

                    $html_item_to_add = "<div class='result-item'><h6>" + data['normal_results'][i]['title'] + "</h6><div class='result-item-body'><img src='"+ data['normal_results'][i]['main_pic'] + "' alt=''><div class='result-item-details'><p><strong>Indirizzo: </strong>" + data['normal_results'][i]['address'] + "</p> <p><strong>Metri quadri: </strong>" + data['normal_results'][i]['square_mt'] + "</p> <p><strong>Stanze da letto: </strong>" + data['normal_results'][i]['rooms_n'] + "</p> <p><strong>Servizi: </strong>" + $facilities_to_add + "</p><p><strong>Distanza: </strong>" + data['normal_results'][i]['distance'].toFixed(2) + " km</p></div></div><a href='http://localhost:8000/" + data['normal_results'][i]['id'] +"/detail' class='btn btn-primary result-view'>Vedi i dettagli</a></div>";
                    
                    $(".search-results-details #normal-results").append($html_item_to_add);
                  }

                };
            },
        error : function() {
            alert("Error: API Apartment");
            }
          });
        };

    //Apartment search with Ajax at clicking button
    $("#search-submit").on("click", function(){
      //Retrieve data for latitude, longitude and range
      $latitude = $("#search-lat").val();
      $longitude = $("#search-lng").val();
      $range = $("#range-field").val();
      $filters = [];
      $("#filters-list input:checked").each(function() {
        $filters.push($(this).val());
      });

      //AJAX call to API for apartment results
      $.ajax({
        url : "http://localhost:8000/api/apartments",
        method : "GET",
        data : {
            lat : $latitude,
            lng: $longitude,
            range: $range,
            filters: $filters
            },
        success: function(data) {
                //Resetting HTML fields
                $(".search-results-details #results-count").html("");
                $("#sponsored-header").text("");
                $("#sponsored-body").html("");
                $("#normal-results").html("");


                //Updating results count description
                $(".search-results-details #results-count").append("<p>Totale appartamenti trovati: " + data['filtered_count'] + "</p>");

                //Cycling through sponsored results and adding it to specific container
                $tot_sponsored = data['sponsored_results'].length;
                if($tot_sponsored > 0) {
                  
                  $(".search-results-details #sponsored-header").text("Annunci sponsorizzati");

                  for (i = 0; i < $tot_sponsored; i++) {
                    if (data['sponsored_results'][i]['facilities']) {
                      $facilities_to_add = data['sponsored_results'][i]['facilities'].toString();
                    } else {
                      $facilities_to_add = "Nessuno"
                    }

                    $html_item_to_add = "<div class='result-item'><h6>" + data['sponsored_results'][i]['title'] + "</h6><div class='result-item-body'><img src='"+ data['sponsored_results'][i]['main_pic'] + "' alt=''><div class='result-item-details'><p><strong>Indirizzo: </strong>" + data['sponsored_results'][i]['address'] + "</p> <p><strong>Metri quadri: </strong>" + data['sponsored_results'][i]['square_mt'] + "</p> <p><strong>Stanze da letto: </strong>" + data['sponsored_results'][i]['rooms_n'] + "</p> <p><strong>Servizi: </strong>" + $facilities_to_add + "</p><p><strong>Distanza: </strong>" + data['sponsored_results'][i]['distance'].toFixed(2) + " km</p></div></div><a href='http://localhost:8000/" + data['sponsored_results'][i]['id'] +"/detail' class='btn btn-primary result-view'>Vedi i dettagli</a></div>";
                    
                    $(".search-results-details #sponsored-body").append($html_item_to_add);
                  }

                };

                //Cycling through not sponsored results and adding it to specific container
                $tot_not_sponsored = data['normal_results'].length;
                if($tot_not_sponsored > 0) {
                  
                  for (i = 0; i < $tot_not_sponsored; i++) {
                    if (data['normal_results'][i]['facilities']) {
                      $facilities_to_add = data['normal_results'][i]['facilities'].toString();
                    } else {
                      $facilities_to_add = "Nessuno"
                    }

                    $html_item_to_add = "<div class='result-item'><h6>" + data['normal_results'][i]['title'] + "</h6><div class='result-item-body'><img src='"+ data['normal_results'][i]['main_pic'] + "' alt=''><div class='result-item-details'><p><strong>Indirizzo: </strong>" + data['normal_results'][i]['address'] + "</p> <p><strong>Metri quadri: </strong>" + data['normal_results'][i]['square_mt'] + "</p> <p><strong>Stanze da letto: </strong>" + data['normal_results'][i]['rooms_n'] + "</p> <p><strong>Servizi: </strong>" + $facilities_to_add + "</p><p><strong>Distanza: </strong>" + data['normal_results'][i]['distance'].toFixed(2) + " km</p></div></div><a href='http://localhost:8000/" + data['normal_results'][i]['id'] +"/detail' class='btn btn-primary result-view'>Vedi i dettagli</a></div>";
                    
                    $(".search-results-details #normal-results").append($html_item_to_add);
                  }

                };
            },
        error : function() {
            alert("Error: API Apartment");
            }
      });



    });

});