@extends('layouts.app_admin')

@section('content')
@if(Auth::check())
    <script>
        var userID = "{{ Auth::user()->id }}";
    </script>
@endif
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <h1>Statistiche visualizzazioni appartamento</h1>
                <div>
                    <div class="input-group mb-3">
                      <div class="input-group-prepend">
                        <label class="input-group-text" for="inputGroupSelect01">Options</label>
                      </div>
                      <select class="custom-select" id="inputGroupSelect01">
                        <option selected>Scegli</option>
                        <option value="1">Jimmie Ranch</option>
                        <option value="2">Clifton Rest</option>
                        <option value="3">Everett Centers</option>
                      </select>
                    </div>
                    <canvas id="myChart"></canvas>
                </div>
            </div>
        </div>
    </div>
@endsection
