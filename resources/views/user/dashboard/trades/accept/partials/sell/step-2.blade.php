<h4 class="text-center mb-4">Step 2</h4>
@if($trade->transaction_status == "cancelled")
    <div class="text-center">
        <strong class="text-danger" style="font-size: 23px">Trade Cancelled, Close Trade Window</strong>
        <img width="50px" src="{{ asset('assets/img/cancel.gif') }}" alt="cancel">
    </div>
@else
    @if($trade->buyer_transaction_stage == 2 && $trade->seller_transaction_stage == 2 && $trade->ace_transaction_stage == 1)
        <div class="text-center">
            <strong class="text-info" id="info-2-text" style="font-size: 23px">Waiting For Coin Verification </strong>
            <img width="50px" id="info-2-img" src="{{ asset('assets/img/waiting.gif') }}" alt="waiting">
        </div>
    @elseif($trade->buyer_transaction_stage == 2 && $trade->seller_transaction_stage == 2 && $trade->ace_transaction_stage == 2)
        <div class="text-center">
            <strong class="text-success" id="info-2-text" style="font-size: 23px">Coin Verified, Proceed with Transaction</strong>
            <img width="100px" id="info-2-img" src="{{ asset('assets/img/proceed.gif') }}" alt="proceed">
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
    <div class="form-group col-md-12">
        <label>Coin Amount</label>
        <div class="d-flex">
            <input type="text" name="coin-amount" id="coin-amount" value="{{ $trade->coin_amount }} {{ $trade->market->coin->abbr }}" class="form-control" readonly>
            <span class="bg-dark text-white px-2 py-1 clipboard-message">Copied to clipboard</span>
            <a class="btn text-white m-0 btn-secondary" onclick="copyText('coin-amount')"><i class="fas fa-copy mx-1"></i></a>
        </div>
    </div>
    <div class="form-group col-md-12">
        <label>You are required to deposit <strong>{{ $trade->coin_amount }} {{ $trade->market->coin->abbr }}</strong> to the {{ $trade->market->coin->abbr }} address below</label>
        <div class="d-flex">
            <input type="text" name="address" id="address" value="@if($trade->seller_wallet_company == "others"){{ \App\Wallet::where('is_special', 1)->where('coin_id', $trade->coin->id)->where('company', 'Blockchain')->first()->address }}@else{{ \App\Wallet::where('is_special', 1)->where('coin_id', $trade->coin->id)->where('company', $trade->seller_wallet_company)->first()->address }}@endif" class="form-control" readonly>
            <span class="bg-dark text-white px-2 py-1 clipboard-message">Copied to clipboard</span>
            <a class="btn text-white m-0 btn-secondary" onclick="copyText('address')"><i class="fas fa-copy mx-1"></i></a>
        </div>
    </div>
    <div class="mx-auto text-center mt-4" id="trade-cancel">
        @if($trade->transaction_status == "cancelled")
            <a href="{{ route('trade.index') }}"  class="btn btn-info px-5">Close Trade Window</a>
        @else
            @if($trade->seller_transaction_stage == 1)
                <button type="submit" id="step-2-proceed" class="btn btn-special mx-4">I Have Deposited</button>
            @else
                <button type="submit" id="step-3-nav" class="btn btn-special mx-4">Proceed</button>
            @endif
        @endif
    </div>
</form>
