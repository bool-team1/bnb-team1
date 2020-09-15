@extends('layouts.app_admin')

@section('content')
<main class="content col-lg-12 col-md-10 col-sm-4 new-apartament-cont">
  <div class="dashboard_header">
      <h4>MODIFICA APPARTAMENTO</h4>
  </div>
    <div class="">
        <div class="row">
            <div class="col-9 offset-2 new-apartament">
                <div class="d-flex align-items-center">
                    <h1 class="mt-3 mb-3">Modifica</h1>
                </div>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form action="{{ route('admin.apartments.update', ['apartment' => $apartment->id]) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="titolo">Titolo</label>
                        <input required type="text" name="title" class="form-control" id="titolo" placeholder="..." value="{{ old('title', $apartment->title) }}">
                    </div>
                    <div class="form-group">
                            <label for="address">Inserisci l'Indirizzo</label>
                            <input type="search" name="address" id="address-input" placeholder="Es. Firenze" value="{{ old('address', $apartment->address) }}"/>
                            <input type="hidden" id="search-lat" name="latitude" value="{{ old('latitude', $apartment->latitude) }}"/>
                            <input type="hidden" id="search-lng" name="longitude" value="{{ old('longitude', $apartment->longitude) }}"/>
                    </div>
                    <div class="form-group">
                        <label for="rooms_n">Numero di stanze</label>
                        <input required min="1" type="number" name="rooms_n" class="form-control" id="rooms_n" placeholder="..." value="{{ old('rooms_n', $apartment->rooms_n) }}">
                    </div>
                    <div class="form-group">
                        <label for="bathrooms_n">Numero di bagni</label>
                        <input required min="1" type="number" name="bathrooms_n" class="form-control" id="bathrooms_n" placeholder="..." value="{{ old('bathrooms_n', $apartment->bathrooms_n) }}">
                    </div>
                    <div class="form-group">
                        <label for="square_mt">Metri quadri</label>
                        <input required min="1" type="number" name="square_mt" class="form-control" id="square_mt" placeholder="..." value="{{ old('square_mt', $apartment->square_mt) }}">
                    </div>
                    <div class="form-group mt-3">
                       Servizi:
                       @php
                           $services = [
                               1 => 'Wifi<i class="fas fa-wifi"></i></li>',
                               2 => 'Swimming pool<i class="fas fa-swimming-pool"></i>',
                               3 => 'Turkish Bath<i class="fas fa-hot-tub"></i>',
                               4 => 'Car Spot<i class="fas fa-parking"></i>',
                               5 => 'Reception<i class="fas fa-concierge-bell"></i>',
                               6 => 'Sea sight<i class="fas fa-water"></i>',
                           ];
                       @endphp
                       @foreach ($facilities  as $facility)
                           <div class="form-check">
                               <label class="form-check-label">
                                   <input
                                   @if($errors->any())
                                       {{ in_array($facility->id, old('facilities', [])) ? 'checked' : '' }}
                                   @else
                                       {{ $apartment->facilities->contains($facility) ? 'checked' : '' }}
                                   @endif
                                       class="form-check-input"
                                       name="facilities[]"
                                       type="checkbox"
                                       value="{{ $facility->id }}">
                                   {!! $services[$facility->id] !!}
                               </label>
                           </div>
                       @endforeach
                   </div>
                    <div class="form-group">
                        <label for="img">Immagine</label>
                        <input type="file" name="image" class="form-control-file ">
                        {{-- @if ( $apartment->main_pic)
                            <img class="rounded" src="{{ asset('storage/' . $apartment->main_pic) }}">
                            @else
                                <p>Immagine non disponibile</p>
                        @endif --}}
                    </div>
                    <div class="form-group">
                        <input type="hidden" name="isPublic" value="0">
                        <label for="isPublic">Vuoi rendere l'appartamento visibile a tutti?</label>
                        <input id="isPublic" type="checkbox" name="isPublic" class="switch-input" value="1" {{ old('isPublic') ? 'checked="checked"' : '' }}/>
                    </div>
                    <input type="hidden" name="user_id" value="{{$user_id}}">
                    <button type="submit" class="btn btn-primary">Salva</button>
                </form>
            </div>
        </div>
    </div>
</main>
@endsection
