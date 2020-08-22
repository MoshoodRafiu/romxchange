<h4 class="text-center my-4">Acknowledge Coin</h4>
@if(($trade->buyer_transaction_stage < 2 && $trade->seller_transaction_stage < 2))
    <div class="text-center">
        <strong class="text-info" style="font-size: 23px">Waiting For Seller to Deposit Coin </strong>
        <img width="50px" src="{{ asset('assets/img/waiting.gif') }}" alt="waiting">
    </div>
@elseif($trade->buyer_transaction_stage == 2 && $trade->seller_transaction_stage == 2 && $trade->ace_transaction_stage == 1)
    <div class="text-center">
        <strong class="text-success" style="font-size: 23px">Coin Deposited, Verify Coin and Proceed</strong>
        <img width="100px" src="{{ asset('assets/img/proceed.gif') }}" alt="proceed">
    </div>
@elseif(($trade->buyer_transaction_stage < 3 && $trade->seller_transaction_stage < 3 && $trade->ace_transaction_stage == 2) || ($trade->buyer_transaction_stage == 3 && $trade->seller_transaction_stage < 3 && $trade->ace_transaction_stage == 2) || ($trade->buyer_transaction_stage < 3 && $trade->seller_transaction_stage == 3 && $trade->ace_transaction_stage == 2))
    <div class="text-center">
        <strong class="text-info" style="font-size: 23px">Waiting for Traders to Settle Payment</strong>
        <img width="50px" src="{{ asset('assets/img/waiting.gif') }}" alt="proceed">
    </div>
@elseif($trade->buyer_transaction_stage == 3 && $trade->seller_transaction_stage == 3 && $trade->ace_transaction_stage == 2)
    <div class="text-center">
        <strong class="text-success" style="font-size: 23px">Payment Settled, Proceed and Settle</strong>
        <img width="100px" src="{{ asset('assets/img/proceed.gif') }}" alt="proceed">
    </div>
@endif

<p>Acknowledge Coin of <strong class="text-success">{{ $trade->coin_amount_ngn }} <span class="text-uppercase">{{ $trade->coin->abbr }}</span></strong>, once you receive the coin from <strong>{{ \App\User::whereId($trade->seller_id)->first()->display_name }}</strong>. Please ensure that your coin is received before you proceed, as the transaction will continue between buyer and seller.</p>
<div class="text-center">
    @if($trade->buyer_transaction_stage == 2 && $trade->seller_transaction_stage == 2 && $trade->ace_transaction_stage == 1)
        <button id="step-1-proceed" class="btn btn-special p-2" type="button">I Have Received Coin</button>
    @else
        <button id="step-2-nav" class="btn btn-special py-2 px-4" type="button">Proceed</button>
    @endif
</div>
