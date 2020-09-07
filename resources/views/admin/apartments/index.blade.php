@extends('layouts.app_admin')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="d-flex justify-content-between align-items-center">
                    <h1 class="mt-3 mb-3">I tuoi appartamenti</h1>
                    <a class="btn btn-primary"
                    href="{{ route('admin.apartments.create') }}">
                        Nuovo appartamento
                    </a>
                </div>
                <table class="table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Titolo</th>
                            <th>Indirizzo</th>
                            <th>Nr.stanze</th>
                            <th>Nr.bagni</th>
                            <th>Mt quadri</th>
                            <th>Slug</th>
                            <th>Facilities</th>
                            <th>Immagine</th>
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
