@extends('layouts.app')
@section('content')
    <div class="container search-wrapper">
        @if ($latitude)
            <div id="phantom-search">
                <input type="hidden" id="phantom-lat" value="{{ $latitude }}"/>
                <input type="hidden" id="phantom-lng"  value="{{ $longitude }}"/>
                <input type="hidden" id="phantom-range"  value="{{ $range }}"/>
            </div>
        @endif
        <div class="row search-header">
            <div class="col-12 col-md-4 mb-3">
                <label for="address-input">Dove vuoi cercare?</label>
                <input type="search" name="address-input" id="address-input" placeholder="Es. Firenze"/>
                <input type="hidden" id="search-lat"/>
                <input type="hidden" id="search-lng"/>
            </div>
            <div class="col-12 col-md-4 mb-3 text-md-center">
                <label for="range-field">Entro quanti KM?(1-50)</label>
                <input name="range-field" id="range-field" type="number" min='1' max='50' value="30">
            </div>
            <div class="col-12 col-md-4 mb-3 text-md-right">
                <button id="search-submit">Inizia la ricerca</button>
            </div>
        </div>
        <div class="row search-body">
            <div class="col-12 search-results-filters">
                <h4>Mostra solo risultati con:</h4>
                <div id="filters-list">
                @foreach ($facilities as $facility)
                    <div>
                        <label for="{{ $facility->type }} d-inline"><input type="checkbox" name="{{ $facility->type }}" value="{{ $facility->type }}"> {{ $facility->type }}</label>
                    </div>
                @endforeach
                </div>
            </div>
            <div class="col-12 search-results-details">
                <div id="results-count">
                </div>
                <div id="sponsored-results">
                    <div id="sponsored-header"></div>
                    <div id="sponsored-body"></div>
                </div>
                <div id="normal-results">
                </div>
            </div>
        </div>
    </div>
@endsection
