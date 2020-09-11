<h4 class="text-center mb-4">Step 1</h4>
@if($trade->transaction_status == "cancelled")
    <div class="text-center">
        <strong class="text-danger" style="font-size: 23px">Trade Cancelled, Close Trade Window</strong>
        <img width="50px" src="{{ asset('assets/img/cancel.gif') }}" alt="cancel">
    </div>
@else
    @if($trade->is_dispute == 1)
        <div class="text-center">
            <strong class="text-warning" style="font-size: 23px">Trade Dispute, Use Dispute Chatbox Below</strong>
            <img width="30px" src="{{ asset('assets/img/warning.gif') }}" alt="proceed">
        </div>
    @endif
    @if($trade->buyer_transaction_stage == 1 && $trade->seller_transaction_stage == null && $trade->ace_transaction_stage == null)
        <div class="text-center">
            <strong class="text-info" id="info-1-text" style="font-size: 23px">Waiting For Buyer to Verify Wallet </strong>
            <img width="50px" id="info-1-img" src="{{ asset('assets/img/waiting.gif') }}" alt="waiting">
        </div>
    @elseif($trade->buyer_transaction_stage == 1 && $trade->seller_transaction_stage == null && $trade->ace_transaction_stage == 1)
        <div class="text-center">
            <strong class="text-info" id="info-1-text" style="font-size: 23px">Waiting For Buyer to Verify Wallet </strong>
            <img width="50px" id="info-1-img" src="{{ asset('assets/img/waiting.gif') }}" alt="waiting">
        </div>
    @elseif($trade->buyer_transaction_stage == 2 && $trade->seller_transaction_stage == null && $trade->ace_transaction_stage == null)
        <div class="text-center">
            <strong class="text-info" id="info-1-text" style="font-size: 23px">Waiting For Buyer to Verify Wallet </strong>
            <img width="50px" id="info-1-img" src="{{ asset('assets/img/waiting.gif') }}" alt="waiting">
        </div>
    @elseif($trade->buyer_transaction_stage == 2 && $trade->seller_transaction_stage == null && $trade->ace_transaction_stage == 1)
        <div class="text-center">
            <strong class="text-success" id="info-1-text" style="font-size: 23px">Wallet Verified, Proceed with Transaction</strong>
            <img width="100px" id="info-1-img" src="{{ asset('assets/img/proceed.gif') }}" alt="proceed">
        </div>
    @endif
@endif
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
                        <input type="type" name="amount" value="{{ $trade->coin_amount }} {{ $trade->market->coin->abbr }}" class="form-control" disabled>
    </div>
    <div class="form-group col-md-6">
        <label>Amount in USD</label>
        <input type="text" name="amount-usd" value="{{ number_format($trade->coin_amount_usd, 2) }}" class="form-control" disabled>
    </div>
    <div class="form-group col-md-6">
        <label>Amount in NGN</label>
        <input type="text" name="amount-ngn" value="{{ number_format($trade->coin_amount_ngn, 2) }}" class="form-control" disabled>
    </div>
    <div class="form-group col-md-6">
        <label>Transaction Charges</label>
                                <input type="number" name="charges" value="{{ $trade->transaction_charge_coin }}" class="form-control" disabled>
    </div>
    <div class="form-group col-md-12">
        <label>Wallet Company</label>
        @if(!$trade->seller_transaction_stage == null)
            <select name="wallet" id="wallet-company" class="form-control" disabled>
                <option value="">Select Wallet You Are Sending From</option>
                @foreach(\App\Wallet::where("is_special", 1)->where("coin_id", $trade->market->coin_id)->get() as $wallet)
                    <option value="{{ $wallet->company }}" @if($trade->seller_wallet_company === $wallet->company) selected @endif>{{ $wallet->company }}</option>
                @endforeach
                <option value="others" @if($trade->seller_wallet_company === "others") selected @endif>Others</option>
            </select>
        @else
            <select name="wallet" id="wallet-company" class="form-control">
                <option value="">Select Wallet You Are Sending From</option>
                @foreach(\App\Wallet::where("is_special", 1)->where("coin_id", $trade->market->coin_id)->get() as $wallet)
                    <option value="{{ $wallet->company }}">{{ $wallet->company }}</option>
                @endforeach
                <option value="others">Others</option>
            </select>
        @endif
    </div>
    <div class="mx-auto text-center" id="trade-cancel">
        @if($trade->transaction_status == "cancelled")
            <a href="{{ route('trade.index') }}"  class="btn btn-info px-5">Close Trade Window</a>
        @else
            <button type="button" id="step-2-nav" class="btn btn-special px-5">Proceed</button>
        @endif
    </div>
</form>
