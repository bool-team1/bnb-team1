<!--Navbar -->
<nav class="mb-1 navbar navbar-expand-lg navbar-dark secondary-color lighten-1">
  <a class="navbar-brand" href="{{ url('/') }}"> <img src="{{ asset('img/logo.png')}}" alt=""> </a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent-555"
    aria-controls="navbarSupportedContent-555" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarSupportedContent-555">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="{{ url('/') }}">Home
          <span class="sr-only">(current)</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{route('search')}}">Appartamenti</a>
      </li>
    </ul>
    <ul class="navbar-nav ml-auto nav-flex-icons">
      @guest
        <button class="button" type="button" name="button"><a href="{{ route('register') }}">Diventa un Host</a></button>
      @endguest
      <!-- <div class="language dropdown" class="nav-link dropdown-toggle" id="navbarDropdownlaguage" data-toggle="dropdown"
        aria-haspopup="true" aria-expanded="false">
          <i class="fas fa-globe"></i>
          Lingua
          <i class="fas fa-angle-down"></i>
      </div>
      <div class="dropdown-menu dropdown-menu-lg-lang dropdown-menu-lg-right dropdown-secondary"
        aria-labelledby="navbarDropdownlaguage">
        <a class="dropdown-item" href="#">Italiano</a>
        <a class="dropdown-item" href="#">Inglese</a>
      </div> -->
      <li class="nav-item avatar dropdown">
        <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink-55" data-toggle="dropdown"
          aria-haspopup="true" aria-expanded="false">
          <i class="fas fa-user"></i> Account
        </a>
        <div class="dropdown-menu dropdown-menu-lg-right dropdown-secondary"
          aria-labelledby="navbarDropdownMenuLink-55">
          <!-- Authentication Links -->
          @guest
            <a class="dropdown-item" href="{{ route('login') }}">Login</a>
          @else
            <a class="dropdown-item" href="{{ url('/admin') }}">Dashboard</a>
            <a class="dropdown-item" href="{{ route('logout') }}">Logout</a>
          @endguest
        </div>
      </li>
    </ul>
  </div>
</nav>

<!--/.Navbar -->
