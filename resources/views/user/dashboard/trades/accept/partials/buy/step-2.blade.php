<h4 class="text-center my-4">Step 2</h4>
@if(($trade->seller_transaction_stage == 1 && $trade->buyer_transaction_stage == 2) || ($trade->seller_transaction_stage == 2 && $trade->buyer_transaction_stage == 2 && $trade->ace_transaction_stage == 1))
    <div class="text-center" id="transaction-message-waiting">
        <strong class="text-info" style="font-size: 23px">Waiting For Seller's Coin Verification</strong>
        <img width="50px" src="{{ asset('assets/img/waiting.gif') }}" alt="waiting">
    </div>
@elseif($trade->seller_transaction_stage == 2 && $trade->buyer_transaction_stage == 2 && $trade->ace_transaction_stage == 2)
    <div class="text-center" id="transaction-message-proceed">
        <strong class="text-success" style="font-size: 23px">Coin Verified, Proceed with Trade Below </strong>
        <img width="100px" src="{{ asset('assets/img/proceed.gif') }}" alt="proceed">
    </div>
@endif
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
        <label for="address">A total of <strong>{{ $trade->coin_amount }} {{ $trade->market->coin->abbr }}</strong> will be transferred to your <strong>{{ $trade->market->coin->abbr }}</strong> address below, please verify your wallet ID and cancel the transaction if there's any issue.</label>
                               <input type="text" name="address" id="address" value="{{ \App\Wallet::where('user_id', Auth::user()->id)->where('coin_id', $trade->market->coin->id)->first()->address }}" class="form-control wallet-address" readonly>
    </div>
    <div class="mx-auto">
        <button type="reset" id="step-2-cancel" class="btn btn-danger mx-4">Cancel Transaction</button>
        @if($trade->buyer_transaction_stage == 1)
            <button type="submit" id="step-2-proceed" class="btn btn-special mx-4">Verify Wallet</button>
        @else
            <button type="submit" id="step-3-nav" class="btn btn-special mx-4">Proceed</button>
        @endif
    </div>
</form>
