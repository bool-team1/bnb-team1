{{-- menu + HEAD  --}}
@include("partials.menu")
{{-- fine menu --}}
<body>
    <div class="container main-ctn">
            <div class="row">
                <div class="sidebar col-2">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12">
                                <ul>
                                    <li>
                                        <a href="#" class="active">
                                            My apartments
                                        </a>
                                        <i class="far fa-building"></i>
                                    </li>
                                    <li>
                                        <a href="#">
                                            Messages
                                        </a>
                                        <i class="far fa-envelope"></i>
                                    </li>
                                    <li>
                                        <a href="#">
                                            Charts
                                        </a>
                                        <i class="fas fa-chart-pie"></i>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                @yield('content')
            </div>
        </div>



    {{-- footer --}}
    @include('partials.footer')
    {{-- fine footer --}}
    <script src="{{("js/app.js")}}" charset="utf-8"></script>
</body>
</html>
