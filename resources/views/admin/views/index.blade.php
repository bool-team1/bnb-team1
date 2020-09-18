@extends('layouts.app_admin')
@section('content')
@if(Auth::check())
    <script>
        var userID = "{{ Auth::user()->id }}";
    </script>
@endif
<main class="content col-lg-12 col-md-10 col-sm-4 new-apartament-cont">
    <div class="container view_data">
        <div class="row bg-spdark">
            <div class="col-12">
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
            <div class="container container_view">
              <h2 id="view_apt_title" class="col-12 my-5"></h2>
              <div class="col-12 mb-5">
                  <div id="msg_per_month">
                      <h4>Messaggi per mese</h4>
                      <div class="msg_chart_wrap">
                          <canvas id="ChartMessage"></canvas>
                      </div>
                  </div>
              </div>
              <div class="col-12">
                  <div id="views_per_month">
                      <h4>Visualizzazioni per mese</h4>
                      <div class="views_chart_wrap">
                          <canvas id="ChartViews"></canvas>
                      </div>
                  </div>
              </div>
            </div>
        </div>
    </div>
</main>
@endsection
