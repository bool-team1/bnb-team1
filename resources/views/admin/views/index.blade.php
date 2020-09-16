@extends('layouts.app_admin')
@section('content')
@if(Auth::check())
    <script>
        var userID = "{{ Auth::user()->id }}";
    </script>
@endif
    <div class="container">
        <div class="row">
            <div class="col-8 offset-4">
                <div class="input-group">
                    @if (count($apartments) <= 0)
                        @php
                            dd('vuoto');
                        @endphp
                    @else
                        <select class="custom-select" id="inputGroupSelect04">
                            <option value="0">Seleziona un appartamento</option>
                            @foreach ($apartments as $apartment)
                                <option id="{{$apartment->title}}" value="{{$apartment->id}}">{{$apartment->title}}</option>
                            @endforeach
                        </select>
                    @endif
                </div>
            </div>
            <h2 id="view_apt_title" class="col-8 offset-4 text-center my-5"></h2>
            <div class="col-8 offset-4">
                <div id="msg_per_month">
                    <h2>Messaggi per mese</h2>
                    <canvas id="ChartMessage"></canvas>
                </div>
            </div>
            <div class="col-8 offset-4">
                <div id="views_per_month">
                    <h2>Visualizzazioni per mese</h2>
                    <canvas id="ChartViews"></canvas>
                </div>
            </div>
        </div>
    </div>
@endsection
