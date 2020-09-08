@extends('layouts.app_admin')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <h1>Statistiche visualizzazioni appartamento</h1>
                <div class="chart-container">
                    <canvas id="visualizzazioni_appartamenti"></canvas>
                </div>
            </div>
        </div>
    </div>
@endsection
