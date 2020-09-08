{{-- menu + HEAD  --}}
@include("partials.menu")
{{-- fine menu --}}
<body>
    <div class="container main-ctn">
            <div class="row">
                <div class="sidebar">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12 side_wrap">
                                <div class="user_info">
                                    <div class="prof_pic_wrapper">
                                        <img src="https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460_1280.png" alt="Profile Picture">
                                    </div>
                                    <p>USER NAME</p>
                                </div>
                                <ul>
                                    <li>
                                        <i class="far fa-building"></i>
                                        <a href="{{ route('admin.apartments.index') }}" class="">
                                            APPARTAMENTI
                                        </a>
                                    </li>
                                    <li>
                                        <i class="far fa-chart-bar"></i>
                                        <a href="#">
                                            STATISTICHE
                                        </a>
                                    </li>
                                    <li>
                                        <i class="far fa-envelope"></i>
                                        <a href="#">
                                            MESSAGGI
                                        </a>
                                    </li>
                                    <li>
                                        <i class="fas fa-sign-out-alt"></i>
                                        <a href="#">
                                            {{-- modificare per il logout serve il metodo post --}}
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



        @yield('script')
    <script src="{{("js/app.js")}}" charset="utf-8"></script>
</body>
</html>
