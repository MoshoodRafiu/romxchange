<h4 class="text-center my-4">Step 1</h4>
<div class="text-center">
    <strong class="text-info" style="font-size: 23px">Waiting For Buyer to Accept Trade </strong>
    <img width="50px" src="{{ asset('assets/img/waiting.gif') }}" alt="waiting">
</div>
<form class="row mb-4">
    <div class="form-group col-md-6">
        <label>Coin Amount</label>
                        <input type="number" name="volume" value="{{ $trade->coin_amount }}" class="form-control" disabled>
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
        <label></label>
        <select name="wallet" class="form-control" disabled>
            <option value="{{ $trade->seller_wallet_company }}">{{ $trade->seller_wallet_company }}</option>
        </select>
    </div>
    <div class="mx-auto">
        <button id="step-2-nav" class="btn btn-special px-5">Proceed</button>
    </div>
</form>
