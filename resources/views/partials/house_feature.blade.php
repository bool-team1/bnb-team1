@php
    $alph = ['a', 'b', 'c', 'd', 'e', 'f'];
    $spn_i = 0;
    $pop_i = 0;
@endphp

<div class="container">
    <div class="title-1 pb-2">
        <h3>Appartamenti in evidenza</h3>
    </div>
</div>
<div class="container house-feat">
        <ul id="autoWidth" class="cs-hidden">
            @foreach ($sponsored_results as $apt)
                <li class="item-{{$alph[$spn_i]}}">
                    <div class="card mb-4 app-ev card-apartment">
                        <a href="{{route('detail', ['apartment_id' => $apt['id']])}}" style="text-decoration: none;color: white;">
                            <div class="card-img-top-wrap">
                                <img class="card-img-top img-fluid" src="{{ asset('storage/' . $apt['main_pic']) }}" alt="">
                            </div>
                            <div class="card-body">
                                <h4 class="card-title">{{ $apt['title'] }}</h4>
                                <p class="card-text">{{ $apt['address']}}</p>
                                <p class="card-text"><small class="text-muted">{{ $apt['rooms_n'] . ' rooms'}}</small></p>
                            </div>
                        </a>
                    </div>
                </li>
                @php $spn_i++; @endphp
            @endforeach
        </ul>
        <button name="button" id="spn_prev"><</button>
        <button name="button" id="spn_next">></button>
</div>
<div class="container">
    <div class="title-1 pb-2">
        <h3>Appartamenti più popolari</h3>
    </div>
</div>
<div class="container house-feat">
        <ul id="responsive">
            @foreach ($popular_results as $apt)
                <li class="item-{{$alph[$pop_i]}}">
                    <div class="card mb-4 app-ev card-apartment">
                        <a href="{{route('detail', ['apartment_id' => $apt['id']])}}" style="text-decoration: none;color: white;">
                            <div class="card-img-top-wrap">
                                <img class="card-img-top img-fluid" src="{{ asset('storage/' . $apt['main_pic']) }}" alt="">
                            </div>
                            <div class="card-body">
                                <h4 class="card-title">{{ $apt['title'] }}</h4>
                                <p class="card-text">{{ $apt['address']}}</p>
                                <p class="card-text"><small class="text-muted">{{ $apt['rooms_n'] . ' rooms'}}</small></p>
                            </div>
                        </a>
                    </div>
                </li>
                @php $pop_i++; @endphp
            @endforeach
        </ul>
        <button name="button" id="pop_prev"><</button>
        <button name="button" id="pop_next"></button>
</div>
