@extends('layouts.app')

@section('content')
    <div class="apartment-detail-wrapper">
        <h2>{{ $apartment->title }}</h2>
        <h4>{{ $apartment->address }}</h4>
        <img src="{{ $apartment->main_pic }}" alt="">
        <div class="apartment-info-wrapper">
            <div class="apartment-map">
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
                * The key parameter will contain your own API key (which is not needed for this tutorial)
                * The callback parameter executes the initMap() function
                -->
                <script defer
                src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&callback=initMap">
                </script>
            </div>
            <div class="apartment-info">
                <p><strong>Metri quadrati: </strong>{{ $apartment->square_mt }}</p>
                <p><strong>Stanze da letto: </strong>{{ $apartment->rooms_n }}</p>
                <p><strong>Numero bagni: </strong>{{ $apartment->bathrooms_n }}</p>
                <p><strong>Servizi:</strong></p>
                <p>@forelse ($facilities as $facility)
                    {{$facility}}
                    @if ($loop->last)
                        {{ "." }}
                    @else
                        {{ ", " }}
                    @endif
                @empty
                    {{ Nessuno }}
                @endforelse
                </p>
            </div>
        </div>
        <div class="apartment-links">
            <a class="btn btn-link" href=" {{ route('search') }}">Prova una nuova ricerca</a>
            <a class="btn btn-primary" href=" {{ route('message.create',  ['apartment_id' => $apartment->id])}}">Contatta il proprietario</a>
        </div>    
    </div>
    
@endsection