<h4 class="text-center my-4">Step 3</h4>
<div class="col-12 text-center mb-3">
    @if($trade->seller_transaction_stage == 1 && $trade->buyer_transaction_stage == 2)
        <div class="text-center" id="transaction-message-waiting">
            <strong class="text-info" style="font-size: 23px">Waiting For Seller to Send Coin</strong>
            <img width="50px" src="{{ asset('assets/img/waiting.gif') }}" alt="waiting">
        </div>
    @elseif($trade->seller_transaction_stage == 2 && $trade->buyer_transaction_stage == 2)
        <div class="text-center" id="transaction-message-proceed">
            <strong class="text-success" style="font-size: 23px">Coin Sent, Verify Coin </strong>
            <img width="100px" src="{{ asset('assets/img/verify.gif') }}" alt="proceed">
        </div>
    @endif
</div>
<p>Verify coin of <strong class="text-info">{{ $trade->coin_amount }} {{ $trade->market->coin->abbr }}</strong> from <strong>{{ \App\User::whereId($trade->seller_id)->first()->display_name }}</strong>. This coin worth <strong class="text-info">NGN {{ number_format($trade->coin_amount_ngn) }}</strong> / <strong class="text-info">USD {{ number_format($trade->coin_amount_usd) }}</strong>. The trade rate is at <strong class="text-success">NGN {{ number_format($trade->market->price_ngn) }}</strong> per {{ $trade->market->coin->abbr }}. Please ensure you confirm coin before clicking the button below.</p>
<div class="text-center my-3">
    @if($trade->buyer_transaction_stage == 2)
        <button class="btn btn-special p-2" id="step-3-proceed" type="button">I Have Received Coin</button>
    @else
        <button type="submit" id="step-4-nav" class="btn btn-special mx-4">Proceed</button>
    @endif
</div>
