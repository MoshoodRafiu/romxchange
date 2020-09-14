<h4 class="text-center my-4">Step 2</h4>
@if($trade->transaction_status == "cancelled")
    <div class="text-center">
        <strong class="text-danger" id="info-2-text" style="font-size: 23px">Trade Cancelled, Close Trade Window</strong>
        <img width="50px" id="info-2-img" src="{{ asset('assets/img/cancel.gif') }}" alt="proceed">
    </div>
@else
    @if($trade->buyer_transaction_stage == 2 && $trade->seller_transaction_stage == 1)
        <div class="text-center">
            <strong class="text-info" id="info-2-text" style="font-size: 23px">Waiting For Buyer to Make Payment </strong>
            <img width="50px" id="info-2-img" src="{{ asset('assets/img/waiting.gif') }}" alt="waiting">
        </div>
    @elseif($trade->buyer_transaction_stage == 3 && $trade->seller_transaction_stage == 1)
        <div class="text-center">
            <strong class="text-success" id="info-2-text" style="font-size: 23px">Payment Made, Verify Payment and Proceed</strong>
            <img width="100px" id="info-2-img" src="{{ asset('assets/img/proceed.gif') }}" alt="proceed">
        </div>
    @endif
@endif
<p>Acknowledge payment of <strong class="text-success">NGN {{ number_format($trade->coin_amount_ngn, 2) }}</strong>, once you receive a credit alert from the <strong>{{ \App\User::whereId($trade->buyer_id)->first()->display_name }}</strong>, at this point of the transaction, the transaction is been processed and cannot be canceled. Please note that your coin is safe with us and will only be released after payment has been acknowledged.</p>
<div class="text-center mx-auto my-3" id="trade-cancel">
    @if($trade->transaction_status == "cancelled")
        <a href="{{ route('admin.trades') }}" class="btn btn-info">Close Trade Window</a>
    @else
        <button type="button" data-toggle="modal" data-target="#cancelModal" class="btn my-1 px-4 btn-danger">Cancel Trade</button>
        @if($trade->seller_transaction_stage == 1)
            <button id="step-2-proceed" class="btn my-1 btn-special p-2" type="button">I Have Received Payment</button>
        @else
            <button id="step-3-nav" class="btn my-1 btn-special p-2" type="button">Proceed</button>
        @endif
    @endif
</div>
