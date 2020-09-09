@include("partials.head")
<input type="checkbox" id="check">
<body>
    <!-- menu + HEAD   -->
    @include("partials.menu")
    <!-- fine menu  -->
  <label for="check">
    <i class="fas fa-bars" id="sidebar_btn"></i>
  </label>
  <div class="sidebar">
    <center>
      <img src="https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460_1280.png" alt="Profile Picture" class="profile_image">
      <h4>USER NAME</h4>
    </center>
    <a href="{{route('admin.home')}}"><i class="far fa-building"></i><span>APPARTAMENTI</span></a>
    <a href="{{route('admin.views')}}"><i class="far fa-chart-bar"></i></i><span>STATISTICHE</span></a>
    <a href="{{route('admin.message.index')}}"><i class="far fa-envelope"></i></i><span>MESSAGGI</span></a>
  </div>

  @yield('content')

  <!-- footer  -->
   @include('partials.footer')
  <!-- fine footer  -->
    @yield('script')
</body>
</html>
