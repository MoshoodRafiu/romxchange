<h4 class="text-center my-4">Step 3</h4>
@if($trade->buyer_transaction_stage == 2 && $trade->seller_transaction_stage == 2)
    <div class="text-center">
        <strong class="text-info" style="font-size: 23px">Waiting For Buyer to Make Payment </strong>
        <img width="50px" src="{{ asset('assets/img/waiting.gif') }}" alt="waiting">
    </div>
@elseif($trade->buyer_transaction_stage == 3 && $trade->seller_transaction_stage == 2)
    <div class="text-center">
        <strong class="text-success" style="font-size: 23px">Payment Made, Verify Payment and Proceed</strong>
        <img width="100px" src="{{ asset('assets/img/proceed.gif') }}" alt="proceed">
    </div>
@endif
<p>Acknowledge payment of <strong class="text-success">NGN {{ number_format($trade->coin_amount_ngn) }}</strong>, once you receive a credit alert from the <strong>{{ \App\User::whereId($trade->buyer_id)->first()->display_name }}</strong>, at this point of the transaction, the transaction is been processed and cannot be canceled. Please note that your coin is safe with us and will only be released after payment has been acknowledged.</p>
<div class="text-center">
    @if($trade->seller_transaction_stage == 2)
        <button id="step-3-proceed" class="btn btn-special p-2" type="button">I Have Received Payment</button>
    @else
        <button id="step-4-nav" class="btn btn-special p-2" type="button">Proceed</button>
    @endif
</div>
