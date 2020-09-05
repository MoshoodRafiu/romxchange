<h4 class="text-center my-4">Step 1</h4>
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
    <div class="mx-auto">
        <button type="button" data-toggle="modal" data-target="#cancelModal" class="btn px-4 btn-danger">Cancel Trade</button>
        <button type="submit" id="step-1-nav" class="btn btn-special px-5">Proceed</button>
    </div>
</form>
