@extends('layouts.app_admin')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
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
                        <input type="text" name="title" class="form-control" id="titolo" placeholder="..." value="{{ old('title', $apartment->title) }}">
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
                        Facilities:
                        @foreach ($facilities as $facility)
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input
                                        @if($errors->any())
                                            {{ in_array($facility->id, old('facilities', [])) ? 'checked' : '' }}
                                        @else
                                            {{ $apartments->facilities->contains($facility) ? 'checked' : '' }}
                                        @endif
                                        class="form-check-input"
                                        name="facilities[]"
                                        type="checkbox"
                                        value="{{ $facility->id }}">
                                    {{ $facility->type }}
                                </label>
                            </div>
                        @endforeach
                    </div>
                    <div class="form-group">
                        <label for="img">Immagine</label>
                        <input type="file" name="image" class="form-control-file">
                        @if ( $apartment->main_pic)
                            <img src="{{ asset('storage/' . $apartment->main_pic)}}">
                            @else
                                <p>Immagine non disponibile</p>
                        @endif
                    </div>
                    <button type="submit" class="btn btn-primary">Salva</button>
                </form>
            </div>
        </div>
    </div>
@endsection
