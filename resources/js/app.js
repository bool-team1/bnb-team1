require('./bootstrap');

//Dipendenza Jquery
var $ = require( "jquery" );
var places = require('places.js');


var placesAutocomplete = places({
  appId: 'plNNICPWC6MP',
  apiKey: 'b7a397b2d5106c810a38e7f10cdd967a',
  container: document.querySelector('#address-input')
});
