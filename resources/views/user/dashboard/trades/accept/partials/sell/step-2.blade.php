<h4 class="text-center my-4">Step 2</h4>
<div class="text-center">
    <strong class="text-info" style="font-size: 23px">Waiting For Buyer to Accept Trade </strong>
    <img width="50px" src="{{ asset('assets/img/waiting.gif') }}" alt="waiting">
</div>
<form class="row mb-4">
    <div class="form-group col-md-6">
        <label>Coin Volume</label>
                       <input type="text" name="volume" value="{{ $trade->coin_amount }} {{ $trade->market->coin->abbr }}" class="form-control" disabled>
    </div>
    <div class="form-group col-md-6">
        <label>Transaction Charges</label>
                        <input type="text" name="charges" value="{{ $trade->transaction_charge_coin }} {{ $trade->market->coin->abbr }}" class="form-control" disabled>
    </div>
    <div class="form-group col-md-12">
        <label>Total Coin To Be Deposited</label>
        <div class="d-flex">
            <input type="text" name="coin-amount" id="coin-amount" value="{{ $trade->coin_amount + $trade->transaction_charge_coin }} {{ $trade->market->coin->abbr }}" class="form-control" readonly>
            <span class="bg-dark text-white px-2 py-1 clipboard-message">Copied to clipboard</span>
            <a class="btn btn-secondary" onclick="copyText('coin-amount')"><i class="fas fa-copy mx-1"></i></a>
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
        <button type="reset" id="step-2-cancel" class="btn btn-danger mx-4">Cancel Transaction</button>
        @if($trade->seller_transaction_stage == 1)
            <button type="submit" id="step-2-proceed" class="btn btn-special mx-4">I Have Deposited</button>
        @else
            <button type="submit" id="step-3-nav" class="btn btn-special mx-4">Proceed</button>
        @endif
    </div>
</form>
