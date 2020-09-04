@extends('layouts.app_admin');

@section('content')
    {{-- <div class="container"> --}}
        {{-- <div class="row">
            <div class="col-12"> --}}
                {{-- <div class="d-flex align-items-center">
                    <h1>Inserisci un nuovo appartamento</h1>
                </div> --}}
                <h1 class="text-center">Inserisci un nuovo appartamento</h1>
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
                        <input type="text" name="title" class="form-control" id="titolo" placeholder="..." value="{{ old('title') }}">
                    </div>
                    <div class="form-group">
                        <label for="rooms_n">Numero di stanze</label>
                        <input type="text" name="rooms_n" class="form-control" id="rooms_n" placeholder="..." value="{{ old('rooms_n') }}">
                    </div>
                    <div class="form-group">
                        <label for="bathrooms_n">Numero di bagni</label>
                        <input type="text" name="bathrooms_n" class="form-control" id="bathrooms_n" placeholder="..." value="{{ old('bathrooms_n') }}">
                    </div>
                    <div class="form-group">
                        <label for="square_mt">Metri quadri</label>
                        <input type="text" name="square_mt" class="form-control" id="square_mt" placeholder="..." value="{{ old('square_mt') }}">
                    </div>
                    <div class="form-group">
                        <label for="img">Immagine</label>
                        <input type="file" name="image" class="form-control-file" id="img">
                    </div>
                    <button type="submit" class="btn btn-primary">Salva</button>
                </form>
            {{-- </div>
        </div> --}}
    {{-- </div> --}}
@endsection