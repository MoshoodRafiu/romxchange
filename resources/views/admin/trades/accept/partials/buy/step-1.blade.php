<h4 class="text-center my-4">Step 1</h4>
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
        <label for="volume">Coin Amount </label>
                               <input type="text" value="{{ $trade->coin_amount }} {{ $trade->market->coin->abbr }}" name="volume" id="volume" class="form-control" disabled>
    </div>
    <div class="form-group col-md-6">
        <label for="amount-usd">Amount in USD</label>
                               <input type="text" name="amount-usd" id="amount-usd" value="{{ round($trade->coin_amount_usd, 2) }}" class="form-control" disabled>
    </div>
    <div class="form-group col-md-6">
        <label for="amount-ngn">Amount in NGN</label>
                               <input type="text" name="amount-ngn" id="amount-ngn" value="{{ round($trade->coin_amount_ngn, 2) }}" class="form-control" disabled>
    </div>
    <div class="form-group col-md-6">
        <label for="charges">Account Number</label>
                               <input type="text" name="accountNumber" value="{{ \App\BankAccount::where('user_id', $trade->seller_id)->first()->account_number }}" class="form-control" disabled>
    </div>
    <div class="form-group col-md-12">
        <label for="charges">Bank Name</label>
        <input type="text" name="bankName" value="{{ \App\BankAccount::where('user_id', $trade->seller_id)->first()->bank_name }}" class="form-control" disabled>
    </div>
    <div class="mx-auto">
        <button type="button" data-toggle="modal" data-target="#cancelModal" class="btn px-4 btn-danger">Cancel Trade</button>
        <button type="submit" id="step-2-nav" class="btn btn-special px-5">Proceed</button>
    </div>
</form>
