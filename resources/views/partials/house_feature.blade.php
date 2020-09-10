<div class="container">
    <div class="title-1">
        <h3>Case in evidenza</h3>
    </div>
</div>

<div class="container" id="house-feat">
    <div class="card-deck">
        @foreach ($sponsored_results as $apt)
            <div class="card mb-4 app-ev">
                <a href="{{route('detail', ['apartment_id' => $apt['id']])}}" style="text-decoration: none;color: white;">
                    <img class="card-img-top img-fluid" src="{{ $apt['main_pic'] }}" alt="">
                    <div class="card-body">
                        <h4 class="card-title">{{ $apt['title'] }}</h4>
                        <p class="card-text">{{ $apt['address']}}</p>
                        <p class="card-text"><small class="text-muted">{{ $apt['rooms_n'] . ' rooms'}}</small></p>
                    </div>

                </a>
            </div>
        @endforeach
    </div>
</div>
