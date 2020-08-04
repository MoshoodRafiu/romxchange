<h4 class="text-center my-4">Step 2</h4>
<div class="text-center">
    <strong class="text-info" style="font-size: 23px">Waiting For Seller to Accept Trade </strong>
    <img width="50px" src="{{ asset('assets/img/waiting.gif') }}" alt="waiting">
</div>
<form class="row mb-4">
    <div class="form-group col-md-6">
        <label>Coin Volume</label>
                               <input type="text" name="volume" value="{{ $trade->coin_amount }} {{ $trade->market->coin->abbr }}" class="form-control" disabled>
    </div>
    <div class="form-group col-md-6">
        <label>Amount in NGN</label>
                               <input type="number" name="amountNGN" value="{{ $trade->coin_amount_ngn }}" class="form-control" disabled>
    </div>
    <div class="form-group col-md-12">
        <label for="address">A total of <strong>NGN {{ number_format($trade->coin_amount_ngn) }}</strong> will be transferred to your <strong>{{ $trade->market->coin->abbr }}</strong> address below, please verify your wallet ID and cancel the transaction if there's any issue.</label>
                               <input type="text" name="address" id="address" value="{{ \App\Wallet::where('user_id', Auth::user()->id)->where('coin_id', $trade->market->coin->id)->first()->address }}" class="form-control wallet-address" readonly>
    </div>
    <div class="mx-auto">
        <button type="reset" id="step-2-cancel" class="btn btn-danger mx-4">Cancel Transaction</button>
        @if($trade->buyer_transaction_stage == 1)
            <button type="submit" id="step-2-proceed" class="btn btn-special mx-4">Make Payment</button>
        @else
            <button type="submit" id="step-3-nav" class="btn btn-special mx-4">Proceed</button>
        @endif
    </div>
</form>
