<h4 class="text-center my-4">Step 1</h4>
<div class="text-center">
    <strong class="text-info" style="font-size: 23px">Waiting For Buyer to Accept Trade </strong>
    <img width="50px" src="{{ asset('assets/img/waiting.gif') }}" alt="waiting">
</div>
<form class="row mb-4">
    <div class="form-group col-md-6">
        <label>Coin Amount</label>
                        <input type="type" name="amount" value="{{ $trade->coin_amount }} {{ $trade->market->coin->abbr }}" class="form-control" disabled>
    </div>
    <div class="form-group col-md-6">
        <label>Amount in USD</label>
        <input type="text" name="amount-usd" value="{{ $trade->coin_amount_usd }}" class="form-control" disabled>
    </div>
    <div class="form-group col-md-6">
        <label>Amount in NGN</label>
        <input type="text" name="amount-ngn" value="{{ $trade->coin_amount_ngn }}" class="form-control" disabled>
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
    <div class="mx-auto">
        <button type="submit" id="step-1-nav" class="btn btn-special px-5">Proceed</button>
    </div>
</form>
