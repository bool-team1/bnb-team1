@extends('layouts.app')
@section('content')
    <div class="container apartment-detail-wrapper">
        <div class="row">
            <div class="apartment-detail-header col-12 text-center">
                <h2>{{ $apartment->title }}</h2>
                <h3>{{ $apartment->address }}</h3>
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-md-8 offset-md-2">
            <img src="{{ $apartment->main_pic }}" alt="">
            </div>
        </div>
        <div class="apartment-info-wrapper row mt-4">
            <div class="apartment-map col-12 col-md-6 text-center">
                <h3>Dove si trova:</h3>
                <!--The div element for the map -->
                <div id="map"></div>
                <script>
                    // Initialize and add the map
                    function initMap() {
                    // The location of Uluru
                    var current_location = {lat: {{ $apartment->latitude }}, lng:{{ $apartment->longitude}} };
                    // The map, centered at Uluru
                    var map = new google.maps.Map(
                        document.getElementById('map'), {zoom: 4, center: current_location});
                    // The marker, positioned at Uluru
                    var marker = new google.maps.Marker({position: current_location, map: map});
                    }
                </script>
                <!--Load the API from the specified URL
                * The async attribute allows the browser to render the page while the API loads
                * The callback parameter executes the initMap() function
                -->
                <script defer
                src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&callback=initMap">
                </script>
            </div>
            <div class="apartment-info col-12 col-md-6 text-center">
                <p><strong>Metri quadrati: </strong>{{ $apartment->square_mt }}</p>
                <p><strong>Stanze da letto: </strong>{{ $apartment->rooms_n }}</p>
                <p><strong>Numero bagni: </strong>{{ $apartment->bathrooms_n }}</p>
                @php
                         $services = [
                                  1 => '<li><i class="fas fa-wifi"></i> Wifi</li>',
                                  2 => '<li><i class="fas fa-swimming-pool"></i> Piscina</li>',
                                  3 => '<li><i class="fas fa-hot-tub"></i> Sauna</li>',
                                  4 => '<li><i class="fas fa-parking"></i> Posto Auto</li>',
                                  5 => '<li><i class="fas fa-concierge-bell"></i> Reception</li>',
                                  6 => '<li><i class="fas fa-water"></i> Vista mare</li>',
                              ];
                          @endphp
                          <div class="apartment-services">
                              <p><strong>Servizi:</strong></p>
                              <ul>
                                    @forelse ($apartment->facilities as $facility)
                                        {!! $services[$facility->id] !!}
                                    @empty
                                        {{ "Nessun servizio" }}
                                    @endforelse
                                </ul>
                          </div>
            </div>
        </div>
        <div class="row">
            <div class="apartment-links text-center col-12 mt-5">
                <a class="btn apartment-btn-back" href=" {{ route('search') }}">Prova una nuova ricerca</a>
                <a class="btn apartment-btn-main" href=" {{ route('message.create',  ['apartment_id' => $apartment->id])}}">Contatta il proprietario</a>
            </div>
        </div>
    </div>
@endsection
