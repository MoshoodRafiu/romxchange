<h4 class="text-center my-4">Step 1</h4>
<div class="text-center">
    <strong class="text-info" style="font-size: 23px">Waiting For Seller to Accept Trade </strong>
    <img width="50px" src="{{ asset('assets/img/waiting.gif') }}" alt="waiting">
</div>
<form class="row mb-4">
    <div class="form-group col-md-6">
        <label for="volume">Coin Amount </label>
                               <input type="text" value="{{ $trade->coin_amount }} {{ $trade->market->coin->abbr }}" name="volume" id="volume" class="form-control" disabled>
    </div>
    <div class="form-group col-md-6">
        <label for="amount-usd">Amount in USD</label>
                               <input type="text" name="amount-usd" id="amount-usd" value="{{ $trade->coin_amount_usd }}" class="form-control" disabled>
    </div>
    <div class="form-group col-md-6">
        <label for="amount-ngn">Amount in NGN</label>
                               <input type="text" name="amount-ngn" id="amount-ngn" value="{{ $trade->coin_amount_ngn }}" class="form-control" disabled>
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
        <button type="submit" id="step-2-nav" class="btn btn-special px-5">Proceed</button>
    </div>
</form>
