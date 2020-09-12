@extends('layouts.app_admin')
@section('content')
{{-- Page content --}}


@if(Auth::check())
    <script>
        var userID = "{{ Auth::user()->id }}";
    </script>
@endif
@if (isset($_GET['success']) && $_GET['success'] == 'true')
    <div id="alert-transaction">
        <p>Transazione andata a buon fine! La tua sponsorizzazione è ora attiva.</p>
    </div>
@endif
@if (isset($_GET['active_sponsor']) && $_GET['active_sponsor'] == 'true')
    <div id="alert-active-sponsor">
        <p>Hai già una sponsorizzazione attiva per questo appartamento.</p>
    </div>
@endif
<main class="content col-lg-12 col-md-10 col-sm-4 ">
  <div class="dashboard_header">
      <h4>APPARTAMENTI</h4>
  </div>
  @forelse ($apartments as $apartment)

      <div class="container apt_card col-lg-10 offset-lg-1 col-md-12 col-sm-4">
          <div class="row">
              <h2 class="col-12 apt_title">{{$apartment->title}}</h2>
          </div>
          <div class="row apt_info">
              <div class="poster_wrapper col-lg-6 col-md-10">
                  <img class="col-12" src="{{$apartment->main_pic}}" alt="">
              </div>
              <div class="info_wrap col-lg-6 col-md-12">
                  <div class="row">
                      <div class="col-6 col-xs-12">
                          <ul>
                              <li>
                                  <b>Info</b>
                              </li>
                              <li>
                                  <b>Rooms: </b> <span>{{$apartment->rooms_n}}</span>
                              </li>
                              <li>
                                  <b>Bathrooms: </b> <span>{{$apartment->bathrooms_n}}</span>
                              </li>
                              <li>
                                  <b>Square meters: </b> <span>{{$apartment->square_mt}}</span>
                              </li>
                              <li>
                                  <b>Address: </b> <span>{{$apartment->address}}</span>
                              </li>
                          </ul>
                      </div>
                      <div class="col-6 col-xs-12">
                          @php
                              $services = [
                                  1 => '<li>Wifi<i class="fas fa-wifi"></i></li>',
                                  2 => '<li>Swimming pool<i class="fas fa-swimming-pool"></i></li>',
                                  3 => '<li>Turkish Bath<i class="fas fa-hot-tub"></i></li>',
                                  4 => '<li>Car Spot<i class="fas fa-parking"></i></li>',
                                  5 => '<li>Reception<i class="fas fa-concierge-bell"></i></li>',
                                  6 => '<li>Sea sight<i class="fas fa-water"></i></li>',
                              ];
                          @endphp
                          <ul>
                              <li>Services</li>

                            @forelse ($apartment->facilities as $facility)
                                {!! $services[$facility->id] !!}
                            @empty
                                <li>Nessun servizio</li>
                            @endforelse
                          </ul>
                      </div>
                  </div>
               </div>
          </div>{{--//Row Info--}}
          <div class="row buttons">
              <button class="btn btn-info" type="button" name="button"><a href="{{route('detail', ['apartment_id'=>$apartment->id])}}">Visit Apartment page</a> </button>
              <button class="btn btn-info" type="button" name="button"><a href="{{route('admin.apartments.edit', ['apartment'=>$apartment->id])}}">Edit Apartment</a> </button>
              <form class="d-inline" action="{{ route('admin.apartments.destroy', ['apartment' => $apartment->id]) }}" method="post">
                  @csrf
                  @method('DELETE')
                  <input type="submit" class="btn btn-small btn-danger btn-delete" value="Delete">
              </form>
          </div>

 <!-- Check if apt has already an active sponsor  -->
          @php

              $data = $ads->where('apartment_id', $apartment->id);
              date_default_timezone_set('Europe/Rome');
              $isActive = false;
          @endphp
          @foreach ($data as $ad)

              @php
              $end_date = new DateTime($ad->end);
              $now_date = new DateTime('now');
              $difference = $now_date->diff($end_date);
              if ($difference->invert == 0) {
                  $isActive = true;
              }
              @endphp


          @endforeach
          @if (!$isActive)
              <div class="plans row mt-5">
                  <p class="col-12">Sponsor this apartment and get more clients!</p>
                  <div class="plans_wrap">
                      <div class="plan_card">
                          <h3>Base Plan</h3>
                          <h2>24 Hours</h2>
                          <span class="price">$2.99</span>
                          <a href="{{route('admin.sponsor', ['plan_id' => '1', 'apt_id' => $apartment->id])}}">Buy Now</a>
                      </div>
                      <div class="plan_card">
                          <h3>Expert Plan</h3>
                          <h2>72 Hours</h2>
                          <span class="price">$5.99</span>
                          <a href="{{route('admin.sponsor', ['plan_id' => '2', 'apt_id' => $apartment->id])}}">Buy Now</a>
                      </div>
                      <div class="plan_card">
                          <h3>Business Plan</h3>
                          <h2>144 Hours</h2>
                          <span class="price">$9.99</span>
                          <a href="{{route('admin.sponsor', ['plan_id' => '3', 'apt_id' => $apartment->id])}}">Buy Now</a>
                      </div>
                  </div>
              </div>
          @else
              <div class="plans row mt-5">
                  <p class="col-12">This apartment has an active sponsorship until {{$end_date->format('Y-m-d H:i')}}</p>
              </div>
          @endif
      </div>
      @empty
          <div class="create_btn">
              <h3>Non hai ancora registrato nessun appartamento</h3>
              <a class="create" href="{{route('admin.apartments.create')}}">DIVENTA UN HOST</a>
          </div>
  @endforelse

</main>
@endsection
