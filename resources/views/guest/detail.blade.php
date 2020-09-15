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
            <img src="{{ asset('storage/' . $apartment->main_pic) }}" alt="">
            </div>
        </div>
        <div class="apartment-info-wrapper row mt-4">
            <div class="apartment-map col-12 col-md-6 text-center">
                <h2>Dove si trova:</h2>
                    <div id="map" class="map"></div>
                    <script type="text/javascript">
                    const iconFeature = new ol.Feature({
                        geometry: new ol.geom.Point(ol.proj.fromLonLat([{{$apartment->longitude}}, {{$apartment->latitude}}])),
                        name: 'Posizione appartamento',
                    });
                    const map = new ol.Map({
                    target: 'map',
                    layers: [
                        new ol.layer.Tile({
                        source: new ol.source.OSM(),
                        }),
                        new ol.layer.Vector({
                        source: new ol.source.Vector({
                            features: [iconFeature]
                        }),
                        style: new ol.style.Style({
                            image: new ol.style.Icon({
                            anchor: [0.5, 46],
                            anchorXUnits: 'fraction',
                            anchorYUnits: 'pixels',
                            src: '{{ asset("storage/marker.png")}}'
                            })
                        })
                        })
                    ],
                    view: new ol.View({
                            center: ol.proj.fromLonLat([{{$apartment->longitude}}, {{$apartment->latitude}}]),
                            zoom: 15
                        })
                    });
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
