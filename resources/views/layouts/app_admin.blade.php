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
                                <div class="user_info">
                                    <div class="prof_pic_wrapper">
                                        {{-- <img src="https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460_1280.png" alt="Profile Picture"> --}}
                                    </div>
                                    <p>USER NAME</p>
                                </div>
                                <ul>
                                    <li>
                                        <i class="far fa-building"></i>
                                        <a href="#" class="">
                                            APPARTAMENTI
                                        </a>
                                    </li>
                                    <li>
                                        <i class="far fa-envelope"></i>
                                        <a href="#">
                                            PRENOTAZIONI
                                        </a>
                                    </li>
                                    <li>
                                        <i class="fas fa-chart-pie"></i>
                                        <a href="#">
                                            STATISTICHE
                                        </a>
                                    </li>
                                    <li>
                                        <i class="fas fa-chart-pie"></i>
                                        <a href="#">
                                            MESSAGGI
                                        </a>
                                    </li>
                                    <li>
                                        <i class="fas fa-chart-pie"></i>
                                        <a href="#">
                                            LOG OUT
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                @yield('content')
                {{-- footer --}}
                @include('partials.footer')
                {{-- fine footer --}}
            </div>
        </div>




    <script src="{{("js/app.js")}}" charset="utf-8"></script>
</body>
</html>
