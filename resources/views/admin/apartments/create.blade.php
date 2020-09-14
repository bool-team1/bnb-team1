@extends('layouts.app_admin');

@section('content')
     <div class="container create_ctn mb-5">
         <div class="row fix-container">
            <div class="col-9 offset-2">
                 <div class="d-flex align-items-center">
                    <h1>Inserisci un nuovo appartamento</h1>
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
                <form action="{{ route('admin.apartments.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="titolo">Titolo</label>
                        <input type="text" name="title" class="form-control" id="titolo" placeholder="..." value="{{ old('title') }}" max-length="30" size="35">
                    </div>
                    {{-- input per la ricerca --}}
                    <div class="form-group">
                            <label for="address">Inserisci l'indirizzo</label>
                            <input type="search" name="address" id="address-input" placeholder="Es. Firenze" max-length="100"/>
                            <input type="hidden" id="search-lat" name="latitude"/>
                            <input type="hidden" id="search-lng" name="longitude"/>
                    </div>
                    <div class="form-group">
                        <label for="rooms_n">Numero di stanze</label>
                        <input type="text" name="rooms_n" class="form-control text-center" id="rooms_n" placeholder="..." value="{{ old('rooms_n') }}" size="1">
                    </div>
                    <div class="form-group">
                        <label for="bathrooms_n">Numero di bagni</label>
                        <input type="text" name="bathrooms_n" class="form-control text-center" id="bathrooms_n" placeholder="..." value="{{ old('bathrooms_n') }}" size="1">
                    </div>
                    <div class="form-group">
                        <label for="square_mt">Metri quadri</label>
                        <input type="text" name="square_mt" class="form-control text-center" id="square_mt" placeholder="..." value="{{ old('square_mt') }}" size="2">
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
@endsection
