<h4 class="text-center my-4">Step 3</h4>
<div class="col-12 text-center mb-3">
    @if($trade->seller_transaction_stage == 1 && $trade->buyer_transaction_stage == 2)
        <div class="text-center" id="transaction-message-waiting">
            <strong class="text-info" id="info-3-text" style="font-size: 23px">Waiting For Seller to Send Coin</strong>
            <img width="50px" id="info-3-img" src="{{ asset('assets/img/waiting.gif') }}" alt="waiting">
        </div>
    @elseif($trade->seller_transaction_stage == 2 && $trade->buyer_transaction_stage == 2)
        <div class="text-center" id="transaction-message-proceed">
            <strong class="text-success" id="info-3-text" style="font-size: 23px">Coin Sent, Verify Coin </strong>
            <img width="100px" id="info-3-img" src="{{ asset('assets/img/verify.gif') }}" alt="proceed">
        </div>
    @endif
</div>
<p>Verify coin of <strong class="text-info">{{ $trade->coin_amount }} {{ $trade->market->coin->abbr }}</strong> from <strong>{{ \App\User::whereId($trade->seller_id)->first()->display_name }}</strong>  in company's <span class="text-uppercase font-weight-bold">@if($trade->seller_wallet_company == "others") Blockchain @else {{ $trade->seller_wallet_company }} @endif</span> wallet. This coin worth currently is <strong class="text-info">NGN {{ number_format($trade->coin_amount_ngn, 2) }}</strong>. The trade rate is at <strong class="text-success">NGN {{ number_format($trade->market->rate) }}</strong> per USD. Please ensure you confirm coin before clicking the button below.</p>
<div class="text-center my-3">
    <button type="button" data-toggle="modal" data-target="#cancelModal" class="btn my-1 px-4 btn-danger">Cancel Trade</button>
    @if($trade->buyer_transaction_stage == 2)
        <button class="btn btn-special my-1 p-2" id="step-3-proceed" type="button">I Have Received Coin</button>
    @else
        <button type="submit" id="step-4-nav" class="btn my-1 btn-special mx-4">Proceed</button>
    @endif
</div>
