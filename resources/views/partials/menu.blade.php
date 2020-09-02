<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>

{{-- menu section --}}
<nav class="navbar navbar-expand-lg navbar-light fixed-top">
  <a class="navbar-brand" href="#"> <img src="{{ asset('img/logo.png')}}" alt=""> </a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
    <div class="navbar-nav menu">
        <div class="menu-link">
            <a class="nav-item nav-link" href="#">HOME</a>
            <i class="fas fa-angle-down"></i>
        </div>
        <div class="menu-link">
            <a class="nav-item nav-link" href="#">APPARTAMENTI</a>
            <i class="fas fa-angle-down"></i>
        </div>
        <div class="menu-link">
            <a class="nav-item nav-link" href="#">ASSISTENZA</a>
            <i class="fas fa-angle-down"></i>
        </div>
    </div>
    <div class="navbar-nav ml-auto">
        <button class="button" type="button" name="button">DIVENTA UN HOST</button>
        <div class="language">
            <i class="fas fa-globe"></i>
            <i class="fas fa-angle-down"></i>
        </div>
        <div class="avatar">
            <i class="far fa-user-circle"></i>
        </div>
    </div>
  </div>
</nav>
