<h4 class="text-center my-4">Step 2</h4>
@if(isset($trade))
    @if($trade->is_special == 1)
        @if($trade->seller_transaction_stage == 2 && $trade->buyer_transaction_stage == 2)
            <div class="text-center" id="transaction-message">
                <strong class="text-info" style="font-size: 23px">Waiting For Coin Verification</strong>
                <img width="50px" src="{{ asset('assets/img/waiting.gif') }}" alt="waiting">
            </div>
        @elseif($trade->seller_transaction_stage == 2 && $trade->buyer_transaction_stage > 2)
            <div class="text-center" id="transaction-message">
                <strong class="text-success" style="font-size: 23px">Coin Verified, Proceed with Trade Below </strong>
                <img width="100px" src="{{ asset('assets/img/proceed.gif') }}" alt="proceed">
            </div>
        @endif
    @else
        @if($trade->seller_transaction_stage == 2 && $trade->buyer_transaction_stage == 2 && $trade->ace_transaction_stage == 1)
            <div class="text-center" id="transaction-message">
                <strong class="text-info" style="font-size: 23px">Waiting For Coin Verification</strong>
                <img width="50px" src="{{ asset('assets/img/waiting.gif') }}" alt="waiting">
            </div>
        @elseif($trade->seller_transaction_stage == 2 && $trade->buyer_transaction_stage == 2 && $trade->ace_transaction_stage == 2)
            <div class="text-center" id="transaction-message">
                <strong class="text-success" style="font-size: 23px">Coin Verified, Proceed with Trade Below </strong>
                <img width="100px" src="{{ asset('assets/img/proceed.gif') }}" alt="proceed">
            </div>
        @endif
    @endif
@endisset
<form class="row mb-4">
    <div class="form-group col-md-6">
        <label>Coin Volume</label>
                                <input type="text" name="volume" id="volume" value="{{ $trade->coin_amount }}" class="form-control" disabled>
    </div>
    <div class="form-group col-md-6">
        <label>Transaction Charges</label>
                                <input type="number" name="charges" value="{{ $trade->transaction_charge_coin }}" class="form-control" disabled>
    </div>
    <div class="form-group col-md-12">
        <label>Total Coin To Be Deposited</label>
        <div class="d-flex">
            <input type="text" name="total-coin" id="total-coin" value="{{ $trade->coin_amount + $trade->transaction_charge_coin }}" class="form-control" readonly>
            <span class="bg-dark text-white px-2 py-1 clipboard-message">Copied to clipboard</span>
            <a class="btn btn-secondary" onclick="copyText('total-coin')"><i class="fas fa-copy mx-1"></i></a>
        </div>
    </div>
    <div class="form-group col-md-12">
        <label>You are required to deposit <strong>{{ $trade->coin_amount + $trade->transaction_charge_coin }} {{ $trade->market->coin->abbr }}</strong> to the {{ $trade->market->coin->abbr }} address below</label>
        <div class="d-flex">
            <input type="text" name="address" id="address" value="{{ \App\Wallet::where('user_id', $trade->buyer_id)->where('coin_id', $trade->market->coin->id)->first()->address }}" class="form-control" readonly>
            <span class="bg-dark text-white px-2 py-1 clipboard-message">Copied to clipboard</span>
            <a class="btn btn-secondary" onclick="copyText('address')"><i class="fas fa-copy mx-1"></i></a>
        </div>
    </div>
    <div class="mx-auto">
        <button type="reset" class="btn btn-danger mx-4">Cancel Transaction</button>
        @if($trade->seller_transaction_stage == 1)
            <button type="submit" id="step-2-proceed" class="btn btn-special mx-4">I Have Deposited</button>
        @else
            <button type="submit" id="step-3-nav" class="btn btn-special mx-4">Proceed</button>
        @endif
    </div>
</form>
