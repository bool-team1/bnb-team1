@extends('layouts.app')
@section('content')
    <div class="message-create-wrapper">
        <div class="message-create-header">
            <h5>Chiedi informazioni al proprietario</h5>
        </div>
        <div class="message-create-apartment-ref">
            <p>In riferimento all'appartamento situato al seguente indirizzo: {{$apartment->address}}</p>
        </div>
        <div class="message-create-body">
            <form  action=" {{ route('message.store', ['apartment_id' => $apartment->id]) }} " method="post">
                @csrf
                <input type="hidden" name="apartment_id" value="{{ $apartment->id }}">
                <div class="form-group">
                    <label for="sender">Inserisci il tuo nome</label>
                    <input type="text" name="sender" class="form-control" id="sender" placeholder="Nome / Cognome" required value="{{ old('title') }}">
                </div>
                <div class="form-group">
                    <label for="sender_email">Inserisci il tuo indirizzo email</label>
                    <input type="text" name="sender_email" class="form-control" id="sender_email" placeholder="Email" required value="{{ old('content') }}">
                </div>
                <div class="form-group">
                    <label for="object">Oggetto messaggio</label>
                    <input type="text" name="object" class="form-control" id="object" required placeholder="Es: Richiesta disponibilità"  value="{{ old('content') }}">
                </div>
                <div class="form-group">
                    <label for="body">Messaggio</label>
                    <textarea type="text" name="body" rows="4" cols="50" class="form-control" required id="body" placeholder="Scrivi il tuo messaggio"  value="{{ old('content') }}"></textarea>
                </div>
                <div class="message-footer text-center">
                    <button type="submit" class="btn message-btn-main">Invia</button>
                    <p>Tutti i campi sono obbligatori</p>
                    <a href="{{route('detail', ['apartment_id' => $apartment->id])}}" class="btn message-btn-back">Torna alla pagina dell'appartamento</a>
                </div>
            </form>
        </div>
    </div>
@endsection
