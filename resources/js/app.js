require('./bootstrap');
require('./lightslider');

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
    container: document.querySelector('#address-input'),
    useDeviceLocation: false,
    aroundLatLngViaIP: false
  });
};


$(document).ready(function(){
    $('.create_ctn #main_pic').on('click touchstart' , function(){
        $(this).val('');
    });

    $(".create_ctn #main_pic").change(function(e) {
            var file_name = e.target.files[0]['name'];
            $('.input-file-label').html('<p><i class="fas fa-camera"></i></p>' + file_name);
            console.log(e.target.files[0]);
    });

    //Delete transaction success alert alert after 3 seconds
    var alert_t = $('#alert-transaction');
    if (alert_t.length > 0) {
        setTimeout(function(){
            alert_t.hide('swing');
        }, 3000);
    };
    //Delete active sponsor alert alert after 4 seconds
    var alert_s = $('#alert-active-sponsor');
    if (alert_s.length > 0) {
        setTimeout(function(){
            alert_s.hide('swing');
        }, 3000);
    };

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

if (document.getElementById('myChart')) {

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
    if (document.getElementById("phantom-search")) {
        $latitude = $("#phantom-lat").val();
        $longitude = $("#phantom-lng").val();
        $range = $("#phantom-range").val();
        $filters = [];
        $("#filters-list input:checked").each(function() {
        $filters.push($(this).val());
        });

        //AJAX call to API for apartment results
        printSearchResults($latitude, $longitude, $range, $filters);
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
      printSearchResults($latitude, $longitude, $range, $filters);
    });
    $("#home-search").on("click", function(){
        //Retrieve data for latitude, longitude and range
        $latitude = $("#search-lat").val();
        $longitude = $("#search-lng").val();
        console.log('ok');

        window.location.replace('http://localhost:8000/search?lat=' + $latitude + '&lng=' + $longitude + '&range=30');
    });

    //-------------- HOMEPAGE SLIDERS -----------------
    var sponsored_slider = $('#autoWidth').lightSlider({
        autoWidth:true,
        loop:true,
        controls: false,
        onSliderLoad: function() {
            $('#autoWidth').removeClass('cS-hidden');
        }
    });
    var populars_slider = $('#responsive').lightSlider({
        item: 3,
        loop:true,
        controls: false,
        responsive : [
           {
               breakpoint:992,
               settings: {
                   item:2,
                   slideMove:1
                 }
           },
           {
               breakpoint: 390,
               settings: {
                   item:1,
                   slideMove:1
                 }
           }
       ]
    });

    $('#pop_prev').click(function(){
        populars_slider.goToPrevSlide();
    });
    $('#pop_next').click(function(){
        populars_slider.goToNextSlide();
    });
    $('#spn_prev').click(function(){
        sponsored_slider.goToPrevSlide();
        console.log('spn_prev');
    });
    $('#spn_next').click(function(){
        sponsored_slider.goToNextSlide();
        console.log('spn_next');
    });

    //-------------- HOMEPAGE SLIDERS END-----------------

    $('.custom-select').on("change", function(){

        if ($('.custom-select option:selected').val() != 0) {
            var apt_title = $('.custom-select option:selected').text();
            $('#view_apt_title').text(apt_title);
        }

        var select_apartment_id = $(this).val();

        $.ajax({
            url : "http://localhost:8000/api/views",
            method : "GET",
            data : { user_id : userID },
            success: function(data) {
                $('#msg_per_month').show();
                $('#views_per_month').show();

                var months = [
                    'January',
                    'February',
                    'March',
                    'April',
                    'May',
                    'June',
                    'July',
                    'August',
                    'September',
                    'October',
                    'November',
                    'December'
                ];
                var apartments = data.apts_array;
                console.log(apartments);
                //Cicla gli appartamenti restituiti dal json
                apartments.forEach((apartment) => {
                    //Lavora sull'appartamento dell'input select
                    if (apartment.apt_id == select_apartment_id) {
                        //Chart per messaggi
                        var message_array = [];
                        //Ordina per mese i dati dei messaggi
                        for (var i = 1; i < 13; i++) {
                           if (apartment.msg_per_month[i]) {
                               message_array.push(apartment.msg_per_month[i]);
                            } else {
                                message_array.push(0);
                            }
                        }
                        //Compila il grafico dei messaggi
                        var myChart = new Chart($('#ChartMessage')[0].getContext('2d'), {
                            type: 'line',
                            data: {
                                labels: months,
                                datasets: [{
                                    label: 'messaggi',
                                    data: message_array,
                                    backgroundColor: [
                                        'rgba(255, 99, 132, .3)',
                                    ],
                                    borderColor: [
                                        'rgb(255, 99, 132)',
                                    ],
                                    borderWidth: 3
                                }]
                            },
                            options: {
                                responsive: true,
                                maintainAspectRatio: false,
                                scales: {
                                    yAxes: [{
                                        ticks: {
                                            beginAtZero: true
                                        }
                                    }]
                                },
                                responsive: true
                            }
                        });

                        // chart per visualizzazioni
                        var views_array = [];
                        //Ordina per mese i dati delle visualizzazioni
                        for (var i = 1; i < 13; i++) {
                           if (apartment.views_per_month[i]) {
                               views_array.push(apartment.views_per_month[i]);
                            } else {
                                views_array.push(0);
                            }
                        }
                        //Compila il grafico delle views
                        var mySecondChart = new Chart($('#ChartViews')[0].getContext('2d'), {
                            type: 'line',
                            data: {
                                labels: months,
                                datasets: [{
                                    label: 'visualizzazioni',
                                    data: views_array,
                                    backgroundColor: [
                                        'rgba(207, 0, 15, .3)',
                                    ],
                                    borderColor: [
                                        'rgba(207, 0, 15)',
                                    ],
                                    borderWidth: 3
                                }]
                            },
                            options: {
                                responsive: true,
                                maintainAspectRatio: false,
                                scales: {
                                    yAxes: [{
                                        ticks: {
                                            beginAtZero: true
                                        }
                                    }]
                                }
                            }
                        });
                    };
                });
            },
            error : function(e) {
                alert("Error:" + e);
            }
        }); //END statistics api call
    });


});//END Document.ready

function printSearchResults(latitude, longitude, range, filters) {
    $.ajax({
      url : "http://localhost:8000/api/apartments",
      method : "GET",
      data : {
          lat : latitude,
          lng: longitude,
          range: range,
          filters: filters
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

                  $(".search-results-details #sponsored-header").append("<p>Annunci sponsorizzati</p>");
                  $(".search-results-details #sponsored-results").addClass("sponsored-border");

                for (i = 0; i < $tot_sponsored; i++) {
                  if (data['sponsored_results'][i]['facilities']) {
                    $facilities_to_add = data['sponsored_results'][i]['facilities'].join(', ');
                  } else {
                    $facilities_to_add = "Nessuno";
                  }

                  $html_item_to_add = "<div class='result-item'><h6>" + data['sponsored_results'][i]['title'] + "</h6><div class='result-item-body'><img src='http://localhost:8000/storage/" + data['sponsored_results'][i]['main_pic'] + "' alt=''><div class='result-item-details'><p><strong>Indirizzo: </strong>" + data['sponsored_results'][i]['address'] + "</p> <p><strong>Metri quadri: </strong>" + data['sponsored_results'][i]['square_mt'] + "</p> <p><strong>Stanze da letto: </strong>" + data['sponsored_results'][i]['rooms_n'] + "</p> <p><strong>Servizi: </strong>" + $facilities_to_add + "</p><p><strong>Distanza: </strong>" + data['sponsored_results'][i]['distance'].toFixed(2) + " km</p></div></div><a href='http://localhost:8000/" + data['sponsored_results'][i]['id'] +"/detail' class='btn btn-primary result-view'>Vedi i dettagli</a></div>";

                  $(".search-results-details #sponsored-body").append($html_item_to_add);
                }

              };

              //Cycling through not sponsored results and adding it to specific container
              $tot_not_sponsored = data['normal_results'].length;
              if($tot_not_sponsored > 0) {

                for (i = 0; i < $tot_not_sponsored; i++) {
                  if (data['normal_results'][i]['facilities']) {
                    $facilities_to_add = data['normal_results'][i]['facilities'].join(', ');
                  } else {
                    $facilities_to_add = "Nessuno"
                  }

                  $html_item_to_add = "<div class='result-item'><h6>" + data['normal_results'][i]['title'] + "</h6><div class='result-item-body'><img src='http://localhost:8000/storage/" + data['normal_results'][i]['main_pic'] + "' alt=''><div class='result-item-details'><p><strong>Indirizzo: </strong>" + data['normal_results'][i]['address'] + "</p> <p><strong>Metri quadri: </strong>" + data['normal_results'][i]['square_mt'] + "</p> <p><strong>Stanze da letto: </strong>" + data['normal_results'][i]['rooms_n'] + "</p> <p><strong>Servizi: </strong>" + $facilities_to_add + "</p><p><strong>Distanza: </strong>" + data['normal_results'][i]['distance'].toFixed(2) + " km</p></div></div><a href='http://localhost:8000/" + data['normal_results'][i]['id'] +"/detail' class='btn btn-primary result-view'>Vedi i dettagli</a></div>";

                  $(".search-results-details #normal-results").append($html_item_to_add);
                }

              };
          },
      error : function(e) {
          alert("Error: API Apartment" + e);
          }
    });
}
