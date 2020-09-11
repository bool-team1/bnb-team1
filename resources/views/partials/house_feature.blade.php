<div class="container">
    <div class="title-1">
        <h3>Case in evidenza</h3>
    </div>
</div>

<div class="container" id="house-feat">
        <ul id="autoWidth" class="cs-hidden">
          <li class="item-a">
              <div class="card mb-4 app-ev">
                  <a href="{{route('detail', ['apartment_id' => $sponsored_results[0]['id']])}}" style="text-decoration: none;color: white;">
                      <img class="card-img-top img-fluid" src="{{ $sponsored_results[0]['main_pic'] }}" alt="">
                      <div class="card-body">
                          <h4 class="card-title">{{ $sponsored_results[0]['title'] }}</h4>
                          <p class="card-text">{{ $sponsored_results[0]['address']}}</p>
                          <p class="card-text"><small class="text-muted">{{ $sponsored_results[0]['rooms_n'] . ' rooms'}}</small></p>
                      </div>
                  </a>
              </div>
          </li>
          <li class="item-b">
              <div class="card mb-4 app-ev">
                  <a href="{{route('detail', ['apartment_id' => $sponsored_results[0]['id']])}}" style="text-decoration: none;color: white;">
                      <img class="card-img-top img-fluid" src="{{ $sponsored_results[0]['main_pic'] }}" alt="">
                      <div class="card-body">
                          <h4 class="card-title">{{ $sponsored_results[0]['title'] }}</h4>
                          <p class="card-text">{{ $sponsored_results[0]['address']}}</p>
                          <p class="card-text"><small class="text-muted">{{ $sponsored_results[0]['rooms_n'] . ' rooms'}}</small></p>
                      </div>
                  </a>
              </div>
          </li>
          <li class="item-c">
              <div class="card mb-4 app-ev">
                  <a href="{{route('detail', ['apartment_id' => $sponsored_results[0]['id']])}}" style="text-decoration: none;color: white;">
                      <img class="card-img-top img-fluid" src="{{ $sponsored_results[0]['main_pic'] }}" alt="">
                      <div class="card-body">
                          <h4 class="card-title">{{ $sponsored_results[0]['title'] }}</h4>
                          <p class="card-text">{{ $sponsored_results[0]['address']}}</p>
                          <p class="card-text"><small class="text-muted">{{ $sponsored_results[0]['rooms_n'] . ' rooms'}}</small></p>
                      </div>
                  </a>
              </div>
          </li>
          <li class="item-d">
              <div class="card mb-4 app-ev">
                  <a href="{{route('detail', ['apartment_id' => $sponsored_results[0]['id']])}}" style="text-decoration: none;color: white;">
                      <img class="card-img-top img-fluid" src="{{ $sponsored_results[0]['main_pic'] }}" alt="">
                      <div class="card-body">
                          <h4 class="card-title">{{ $sponsored_results[0]['title'] }}</h4>
                          <p class="card-text">{{ $sponsored_results[0]['address']}}</p>
                          <p class="card-text"><small class="text-muted">{{ $sponsored_results[0]['rooms_n'] . ' rooms'}}</small></p>
                      </div>
                  </a>
              </div>
          </li>
          <li class="item-e">
              <div class="card mb-4 app-ev">
                  <a href="{{route('detail', ['apartment_id' => $sponsored_results[0]['id']])}}" style="text-decoration: none;color: white;">
                      <img class="card-img-top img-fluid" src="{{ $sponsored_results[0]['main_pic'] }}" alt="">
                      <div class="card-body">
                          <h4 class="card-title">{{ $sponsored_results[0]['title'] }}</h4>
                          <p class="card-text">{{ $sponsored_results[0]['address']}}</p>
                          <p class="card-text"><small class="text-muted">{{ $sponsored_results[0]['rooms_n'] . ' rooms'}}</small></p>
                      </div>
                  </a>
              </div>
          </li>
        </ul>
</div>
