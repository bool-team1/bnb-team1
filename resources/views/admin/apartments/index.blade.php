@extends('layouts.app_admin')

@section('content')
    <div class="container-sm fix-container">
        <div class="row">
            <div class="col-12">
                <div class="d-flex justify-content-between align-items-center">
                    <h1 class="mt-3 mb-3">I tuoi appartamenti</h1>
                    <a class="btn btn-primary"
                    href="{{ route('admin.apartments.create') }}">
                        Nuovo appartamento
                    </a>
                </div>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Titolo</th>
                            <th scope="col">Indirizzo</th>
                            <th scope="col">Nr.stanze</th>
                            <th scope="col">Nr.bagni</th>
                            <th scope="col">Mt quadri</th>
                            <th scope="col">Slug</th>
                            <th scope="col">Facilities</th>
                            <th scope="col">Immagine</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($apartments as $apartment)
                            <tr>
                                <td>{{ $apartment->id }}</td>
                                <td>{{ $apartment->title }}</td>
                                <td>{{ $apartment->slug }}</td>
                                <td>
                                    @forelse ($apartment->facilities as $facility)
                                        {{ $facility->type }}{{ $loop->last ? '' : ', '}}
                                    @empty
                                        -
                                    @endforelse
                                </td>
                                <td>
                                    <a class="btn btn-small btn-info"
                                    href="{{ route('admin.apartments.show', ['apartment' => $apartment->id]) }}">
                                        Dettaglio
                                    </a>
                                    <a class="btn btn-small btn-warning" href="{{ route('admin.apartments.edit', ['apartment' => $apartment->id]) }}">
                                        Modifica
                                    </a>
                                    <form class="d-inline" action="{{ route('admin.apartments.destroy', ['apartment' => $apartment->id]) }}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <input type="submit" class="btn btn-small btn-danger" value="Elimina">
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4">
                                    Non hai inserito nessun appartamento
                                </td>
                            </tr>
                        @endforelse

                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
