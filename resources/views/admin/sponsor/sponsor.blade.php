@extends('layouts.app_admin')
@section('content')
    @php
        use App\Apartment;
        use App\Plan;
        $apartment = Apartment::find($_GET['apt_id']);
        $plan = Plan::find($_GET['plan_id']);
        $plans = [1 => 'Base Plan', 2 => 'Expert Plan', 3 => 'Business Plan'];
    @endphp
    <div class="form_wrap">
        <h1>{{$plans[$_GET['plan_id']] . ' Payment'}}</h1>
        <ul>
            <li>Apartment's name: {{$apartment->title}}</li>
            <li>Hours of sponsorship: {{$plan->hours_n}}</li>
        </ul>
        <form method="post" id="payment-form" action="{{ url('/checkout') }}">
            @csrf
            <section>
                <input id="amount" name="amount" min="1" type="hidden" value="{{$plan->price}}">
                <input id="plan_id" name="plan_id" type="hidden" value="{{$plan->id}}">
                <input id="apt_id" name="apt_id" type="hidden" value="{{$apartment->id}}">
                <div class="bt-drop-in-wrapper">
                    <div id="bt-dropin"></div>
                </div>
            </section>
            <input id="nonce" name="payment_method_nonce" type="hidden" />
            <button class="button-h" type="submit"><span>Buy Sponsorship Plan</span></button>
        </form>
        @if (session('success_message'))
            <div class="alert alert-success" style="width: 20%;margin: auto;text-align: center;margin-top: 20px;">Transaction Completed</div>
        @endif
        @if (count($errors) > 0))
            <div class="alert alert-danger" style="width: 20%;margin: auto;text-align: center;margin-top: 20px;">An error occured during transaction, try again</div>
        @endif
    </div>
@endsection
@section('script')
    <script src="https://js.braintreegateway.com/web/dropin/1.23.0/js/dropin.min.js"></script>
    <script>
        var form = document.querySelector('#payment-form');
        var client_token = "{{ $token }}";
        braintree.dropin.create({
          authorization: client_token,
          selector: '#bt-dropin',
          paypal: {
            flow: 'vault'
          }
        }, function (createErr, instance) {
          if (createErr) {
            console.log('Create Error', createErr);
            return;
          }
          form.addEventListener('submit', function (event) {
            event.preventDefault();
            instance.requestPaymentMethod(function (err, payload) {
              if (err) {
                console.log('Request Payment Method Error', err);
                return;
              }
              // Add the nonce to the form and submit
              document.querySelector('#nonce').value = payload.nonce;
              form.submit();
            });
          });
        });
    </script>
@endsection
