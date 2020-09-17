@php
    $alph = ['a', 'b', 'c', 'd', 'e', 'f'];
    $i = 0;
@endphp

<div class="container">
    <div class="title-1">
        <h3>Case in evidenza</h3>
    </div>
</div>
<div class="container" id="house-feat">
        <ul id="autoWidth" class="cs-hidden">
            @foreach ($sponsored_results as $apt)
                <li class="item-{{$alph[$i]}}">
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
                @php $i++; @endphp
            @endforeach
        </ul>
</div>
