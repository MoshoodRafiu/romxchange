<h4 class="text-center my-4">Step 4</h4>
<div class="col-12 text-center mb-3">
    <div><img src="{{ asset('assets/img/success.gif') }}" width="100px" alt="success"></div>
    <h4 class="text-success">Success</h4>
</div>
<p>Transaction completed, <strong class="text-info">{{ $trade->coin_amount }} {{ $trade->market->coin->abbr }}</strong> has been <strong class="text-danger">sold</strong> to <strong>{{ \App\User::whereId($trade->buyer_id)->first()->display_name }}</strong> at the rate of <strong class="text-success">NGN {{ number_format($trade->market->rate) }}</strong> per USD. Click the button below to go back to dashboard</p>
<div class="text-center my-3">
    @if($trade->seller_transaction_stage == 3)
        <button id="step-4-proceed" class="btn btn-special p-2" type="button">Rate Transaction & Finish</button>
    @else
        <button id="step-5-nav" class="btn btn-special p-2" type="button">Proceed</button>
    @endif
</div>
