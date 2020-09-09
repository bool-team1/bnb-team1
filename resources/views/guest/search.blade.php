@extends('layouts.app')

@section('content')
    <div class="search-wrapper">
        @if ($latitude) 
            <div id="phantom-search">
                <input type="hidden" id="phantom-lat" value="{{ $latitude }}"/>
                <input type="hidden" id="phantom-lng"  value="{{ $longitude }}"/>  
                <input type="hidden" id="phantom-range"  value="{{ $range }}"/>
            </div>
        @endif
        <div class="search-header">
            <div>
                <label for="address-input">Dove vuoi cercare?</label>
                <input type="search" name="address-input" id="address-input" placeholder="Es. Firenze"/>
                <input type="hidden" id="search-lat"/>
                <input type="hidden" id="search-lng"/>  
            </div>
            <div>
                <label for="range-field">Entro quanti KM?(1-50)</label>
                <input name="range-field" id="range-field" type="number" min='1' max='50' value="30">
            </div>
            <button id="search-submit">Inizia la ricerca</button>
        </div>
        <div class="search-body">
            <div class="search-body-welcome d-none">
                <h6>Inizia la tua ricerca per vedere i risultati</h6>
            </div>
            <div class="search-results-filters">
                <h4>Mostra solo risultati con:</h4>
                <div id="filters-list">
                @foreach ($facilities as $facility)
                    <label for="{{ $facility->type }} d-inline"><input type="checkbox" name="{{ $facility->type }}" value="{{ $facility->type }}"> {{ $facility->type }}</label> 
                @endforeach
                </div>
                
            </div>
            <div class="search-results-details">
                <div id="results-count">
                    
                </div>
                <div id="sponsored-results">
                    <div id="sponsored-header"></div>
                    <div id="sponsored-body">
                        
                                     
                    </div>
                </div>
                <div id="normal-results">
                
                </div>
            </div>    
        </div>         
    </div>
@endsection