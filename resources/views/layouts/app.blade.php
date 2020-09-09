<!-- HEAD   -->
@include("partials.head")
 <!-- HEAD  -->
<body>

    @include("partials.menu")
    
     <!-- main  -->
    @yield('content')
    <!-- fine main  -->

    <!-- footer  -->
    @include('partials.footer')
     <!-- fine footer  -->
</body>
</html>
