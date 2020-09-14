<h4 class="text-center my-4">Step 4</h4>
<div class="col-12 text-center mb-3">
    <div><img src="{{ asset('assets/img/success.gif') }}" width="100px" alt="success"></div>
    <h4 class="text-success">Success</h4>
</div>
<p>Transaction completed, <strong class="text-info">{{ $trade->coin_amount }} {{ $trade->market->coin->abbr }}</strong> has been <strong class="text-success">bougth</strong> from <strong>{{ \App\User::whereId($trade->seller_id)->first()->display_name }}</strong> at the rate of <strong class="text-success">NGN {{ number_format($trade->coin_amount_ngn, 2) }}</strong>. Your coin will be released once the seller acknowledges payment. Please note that this can take few minutes to reflect in your provided wallet.</p>
<div class="text-center">
    @if($trade->buyer_transaction_stage == 3)
        <button class="btn btn-special p-2" id="step-4-proceed" type="button">Rate Transaction & Finish</button>
    @else
        <button type="submit" id="step-5-nav" class="btn btn-special mx-4">Proceed</button>
    @endif
</div>
