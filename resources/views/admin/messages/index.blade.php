@extends('layouts.app_admin')
@section('content')
<main class="content col-lg-12 col-md-10 col-sm-4">
  <div class="dashboard_header">
      <h4>MESSAGGI</h4>
  </div>
    <div class="messages-list-wrapper col-lg-6 col-md-10 col-sm-4">
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
                                    <a class="btn btn-info btn-message" href="{{ route('admin.message.show', ['message_id' => $message->id])}}">Dettagli</a>
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
</main>
@endsection
