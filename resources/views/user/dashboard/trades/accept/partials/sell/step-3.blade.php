<h4 class="text-center mb-4">Step 3</h4>
@if($trade->transaction_status == "cancelled")
    <div class="text-center">
        <strong class="text-danger" style="font-size: 23px">Trade Cancelled, Close Trade Window</strong>
        <img width="50px" src="{{ asset('assets/img/cancel.gif') }}" alt="cancel">
    </div>
@else
    @if($trade->is_special == 1)
        @if($trade->buyer_transaction_stage == 3 && $trade->seller_transaction_stage == 2)
            <div class="text-center">
                <strong class="text-info" id="info-3-text" style="font-size: 20px">Buyer Cancelled Trade, AcexWorld agent is Now Going to Make Payment, Kindly Wait For Your Payment</strong>
                <img width="50px" id="info-3-img" src="{{ asset('assets/img/waiting.gif') }}" alt="waiting">
            </div>
        @elseif($trade->buyer_transaction_stage == 4 && $trade->seller_transaction_stage == 2)
            <div class="text-center">
                <strong class="text-success" id="info-3-text" style="font-size: 23px">Payment Made, Verify Payment and Proceed</strong>
                <img width="100px" id="info-3-img" src="{{ asset('assets/img/proceed.gif') }}" alt="proceed">
            </div>
        @endif
    @else
        @if($trade->buyer_transaction_stage == 2 && $trade->seller_transaction_stage == 2)
            <div class="text-center">
                <strong class="text-info" id="info-3-text" style="font-size: 23px">Waiting For Buyer to Make Payment </strong>
                <img width="50px" id="info-3-img" src="{{ asset('assets/img/waiting.gif') }}" alt="waiting">
            </div>
        @elseif($trade->buyer_transaction_stage == 3 && $trade->seller_transaction_stage == 2)
            <div class="text-center">
                <strong class="text-success" id="info-3-text" style="font-size: 23px">Payment Made, Verify Payment and Proceed</strong>
                <img width="100px" id="info-3-img" src="{{ asset('assets/img/proceed.gif') }}" alt="proceed">
            </div>
        @endif
    @endif
@endif
<p>Acknowledge payment of <strong class="text-success">NGN {{ number_format($trade->coin_amount_ngn, 2) }}</strong>, once you receive a credit alert from the <strong>{{ \App\User::whereId($trade->buyer_id)->first()->display_name }}</strong>, at this point of the transaction, the transaction is been processed. Please note that your coin is safe with us and will only be released after payment has been acknowledged.</p>
<div class="mx-auto text-center mt-4 d-md-flex d-block justify-content-center" id="trade-cancel">
    @if($trade->transaction_status == "cancelled")
        <a href="{{ route('trade.index') }}"  class="btn btn-info px-5">Close Trade Window</a>
    @else
        <div id="dispute-button">
            @if($trade->buyer_transaction_stage >= 2 && $trade->seller_transaction_stage == 2)
                @if($trade->is_dispute == 1)
                    <button type="button" disabled class="btn btn-info p-2">Dispute Trade</button>
                @else
                    <a href="{{ route('trade.dispute', $trade) }}" class="btn btn-info p-2">Dispute Trade</a>
                @endif
            @else
                <button type="button" disabled class="btn btn-info p-2">Dispute Trade</button>
            @endif
        </div>
        @if($trade->seller_transaction_stage == 2)
            <button id="step-3-proceed" class="btn btn-special p-2" type="button">I Have Received Payment</button>
        @else
            <button id="step-4-nav" class="btn btn-special p-2" type="button">Proceed</button>
        @endif
    @endif
</div>
