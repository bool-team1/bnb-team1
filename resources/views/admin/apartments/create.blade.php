@extends('layouts.app_admin')

@section('content')

<main class="content col-lg-12 col-md-10 col-sm-4 new-apartament-cont">
  <div class="dashboard_header">
      <h4>NUOVO APPARTAMENTO</h4>
  </div>
     <div class="container">
         <div class="row fix-container">
            <div class="col-9 offset-2 new-apartament">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form action="{{ route('admin.apartments.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="titolo">Titolo</label>
                        <input  type="text" name="title" class="form-control" id="titolo" placeholder="..." value="{{ old('title') }}" max-length="30">
                    </div>
                    {{-- input per la ricerca --}}
                    <div class="form-group">
                            <label for="address">Inserisci l'indirizzo</label>
                            <input required type="search" name="address" id="address-input" placeholder="Es. Firenze" max-length="100"/>
                            <input type="hidden" id="search-lat" name="latitude" value="{{ old('latitude') }}"/>
                            <input type="hidden" id="search-lng" name="longitude" value="{{ old('longitude') }}"/>
                    </div>
                    <div class="form-group">
                        <label for="rooms_n">Numero di stanze</label>
                        <input min="1" required type="number" name="rooms_n" class="form-control" id="rooms_n" placeholder="..." value="{{ old('rooms_n') }}">
                    </div>
                    <div class="form-group">
                        <label for="bathrooms_n">Numero di bagni</label>
                        <input min="1" required  type="number" name="bathrooms_n" class="form-control" id="bathrooms_n" placeholder="..." value="{{ old('bathrooms_n') }}">
                    </div>
                    <div class="form-group">
                        <label for="square_mt">Metri quadri</label>
                        <input min="1" required type="number" name="square_mt" class="form-control" id="square_mt" placeholder="..." value="{{ old('square_mt') }}">
                    </div>
                    <input type="hidden" name="user_id" class="form-control-file" id="user_id" value= "{{$user_id}}">


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
                       @foreach ($facilities ?? '' as $facility)
                           <div class="form-check">
                               <label class="form-check-label">
                                   <input
                                       {{ in_array($facility->id, old('facilities', [])) ? 'checked' : '' }}
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
                       <label for="main_pic" class="input-file-label"></label>
                       <input type="file" name="main_pic" class="form-control-file" id="main_pic">
                   </div>
                    <div class="form-group">
                        <input type="hidden" name="isPublic" value="0">
                        <label for="isPublic">Vuoi rendere l'appartamento visibile a tutti?</label>
                        <input id="isPublic" type="checkbox" name="isPublic" class="switch-input" value="1" {{ old('isPublic') ? 'checked="checked"' : '' }}/>
                    </div>
                    <button type="submit" class="btn btn-primary">Salva</button>
                </form>
             </div>
        </div>
     </div>
</main>

@endsection
