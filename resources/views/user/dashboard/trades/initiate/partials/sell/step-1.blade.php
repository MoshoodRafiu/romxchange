<h4 class="text-center my-4">Step 1</h4>
@if(isset($trade))
    @if($trade->transaction_status == "cancelled")
        <div class="text-center">
            <strong class="text-danger" style="font-size: 23px">Trade Cancelled, Close Trade Window</strong>
            <img width="50px" src="{{ asset('assets/img/cancel.gif') }}" alt="cancel">
        </div>
    @else
        @if(($trade->seller_transaction_stage == 1 && $trade->buyer_transaction_stage == null) || ($trade->seller_transaction_stage == 1 && $trade->buyer_transaction_stage == 1) || ($trade->seller_transaction_stage == 1 && $trade->buyer_transaction_stage == 2 && $trade->ace_transaction_stage == null))
            <div class="text-center" id="transaction-message">
                <strong class="text-info" id="info-1-text" style="font-size: 23px">Waiting For Buyer to Accept Trade </strong>
                <img width="50px" id="info-1-img" src="{{ asset('assets/img/waiting.gif') }}" alt="waiting">
            </div>
        @elseif($trade->seller_transaction_stage == 1 && $trade->buyer_transaction_stage == 2 && $trade->ace_transaction_stage == 1)
            <div class="text-center" id="transaction-message">
                <strong class="text-success" id="info-1-text" style="font-size: 23px">Trade Accepted, Proceed with Trade Below </strong>
                <img width="100px" id="info-1-img" src="{{ asset('assets/img/proceed.gif') }}" alt="proceed">
            </div>
        @endif
    @endif
@endisset
<form class="row mb-4">
    <div class="form-group col-md-12">
        <label for="transactionID">Transaction ID</label>
                    <div class="d-flex ">
            <input type="text" name="transactionID" id="transactionID" value="{{ $trade->transaction_id }}" class="form-control col-sm-11 col-10" readonly>
            <span class="bg-dark text-white px-2 py-1 clipboard-message">Copied to clipboard</span>
            <a onclick="copyText('transactionID')" class="col-sm-1 m-0 col-2 btn text-white btn-secondary"><i class="fas fa-copy"></i></a>
        </div>
    </div>
    <div class="form-group col-md-6">
        <label>Coin Amount</label>
        <input type="number" name="volume" value="{{ $trade->coin_amount }}" class="form-control" disabled>
    </div>
    <div class="form-group col-md-6">
        <label>Amount in USD</label>
                        <input type="text" name="amount-usd" value="{{ round($trade->coin_amount_usd, 2) }}" class="form-control" disabled>
    </div>
    <div class="form-group col-md-6">
        <label>Amount in NGN</label>
                        <input type="text" name="amount-ngn" value="{{ round($trade->coin_amount_ngn, 2) }}" class="form-control" disabled>
    </div>
    <div class="form-group col-md-6">
        <label>Wallet Company</label>
        <select name="wallet" class="form-control" disabled>
            <option value="{{ $trade->seller_wallet_company }}">{{ $trade->seller_wallet_company }}</option>
        </select>
    </div>
    <div class="mx-auto text-center" id="trade-cancel">
        @if($trade->transaction_status == "cancelled")
            <a href="{{ route('trade.index') }}"  class="btn btn-info px-5">Close Trade Window</a>
        @else
            <button type="button" id="step-2-nav"  class="btn btn-special px-5">Proceed</button>
        @endif
    </div>
</form>
