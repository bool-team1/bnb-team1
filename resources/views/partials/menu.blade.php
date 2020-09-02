<head>
    <meta charset="utf-8">
    {{-- titolo da mettere con yeld --}}
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="{{ asset('css/app.css')}}">
    <script src="https://kit.fontawesome.com/594896ea47.js" crossorigin="anonymous"></script>
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