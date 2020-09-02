    {{-- menu + HEAD  --}}
    @include("partials.menu")
    {{-- fine menu --}}
    <body>

        {{-- main --}}
        @yield('content')
        {{-- fine main --}}

        {{-- footer --}}
        @include('partials.footer')
        {{-- fine footer --}}
        <script src="{{("js/app.js")}}" charset="utf-8"></script>
    </body>
</html>
