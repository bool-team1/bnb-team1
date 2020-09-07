@extends('layouts.app_admin')
@section('content')
    <div class="messages-list-wrapper">
        <div class="messages-list-header">
            <h3>Elenco messaggi</h1>
        </div>
        <table class="table">
                    <thead>
                        <tr>
                            <th>Mittente</th>
                            <th>Oggetto</th>
                            <th>Azioni</th>
                        </tr>
                    </thead>
                    <tbody>
                    @forelse ($messages as $message)
                            <tr>
                                <td>{{ $message->sender }}</td>
                                <td>{{ $message->object }}</td>
                                <td>
                                    <a class="btn btn-info" href="{{ route('admin.message.show', ['message_id' => $message->id])}}">Dettagli</a>
                                    <form class="" action="{{ route("admin.message.destroy", ["message_id" => $message->id]) }}"method="post">
                                        @csrf
                                        @method("DELETE")
                                        <input type="submit" class="btn btn-danger" value="Elimina">
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td>
                                    Non ci sono messaggi in archivio
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
    </div>
    
@endsection