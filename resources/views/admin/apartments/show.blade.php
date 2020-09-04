@extends('layouts.app_admin')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="d-flex align-items-center">
                    <h1 class="mt-3 mb-3">Dettagli appartamento</h1>
                </div>
                <div>
                    <img src="{{ asset('storage/' . $apartment->main_pic) }}" alt="Immagine dell'appartamento">
                </div>
                <p>
                    <strong>Titolo:</strong>
                    {{ $apartment->title }}
                </p>
                <p>
                    <strong>Indirizzo:</strong>
                    {{ $apartment->address }}
                </p>
                <p>
                    <strong>Numero di stanze: </strong>
                    {{ $apartment->rooms_n }}
                </p>
                <p>
                    <strong>Numero di bagni: </strong>
                    {{ $apartment->bathrooms_n }}
                </p>
                <p>
                    <strong>Metri quadri: </strong>
                    {{ $apartment->square_mt }}
                </p>
                <p>
                    <strong>Slug: </strong>
                    {{ $apartment->slug }}
                </p>
                {{-- <p>
                    <strong>Post pubblico: </strong>
                    {{ $apartment->isPublic }}
                </p> --}}
                <p>
                    <strong>URL Immagine: </strong>
                    {{ $apartment->main_pic }}
                </p>
                <p>
                    <strong>Creato il: </strong>
                    {{ $apartment->created_at }}
                </p>
                <p>
                    <strong>Modificato il: </strong>
                    {{ $apartment->updated_at }}
                </p>
            </div>
        </div>
    </div>
@endsection
