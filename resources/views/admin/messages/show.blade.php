@extends('layouts.app_admin')
@section('content')
    <div class="message-read-wrapper">
        <div class="message-read-header">
            <h5>MITTENTE: {{ $message->sender }}</h5>
            <h6>EMAIL MITTENTE: {{ $message->sender_email }}</h6>
            <h6>OGGETTO: {{ $message->object}}</h5>
        </div>
        <div class="message-read-apartment-ref">
            <p>In riferimento all'appartamento situato al seguente indirizzo: {{$apartment->address}}</p>
        </div>
        <div class="message-read-body">
            {{ $message->body }}
        </div>
    </div>
@endsection