<h4 class="text-center my-4">Step 1</h4>
<div><strong id="error" class="text-danger"></strong></div>
@if(($trade->buyer_transaction_stage == 1 && $trade->seller_transaction_stage == null))
    <div class="text-center">
        <strong class="text-success" style="font-size: 23px">Trade started, Click Proceed</strong>
        <img width="100px" src="{{ asset('assets/img/proceed.gif') }}" alt="proceed">
    </div>
@endif
<form class="row mb-4" id="step-1">
    @csrf
    <div class="form-group col-md-6">
        <label>Coin Amount</label>
        <input type="text" name="volume" id="amount" value="{{ $trade->coin_amount }}" class="form-control" disabled>
    </div>
    <div class="form-group col-md-6">
        <label>Amount in USD</label>
        <input type="text" name="amount-usd" id="amount_usd" value="{{ $trade->coin_amount_usd }}" class="form-control" disabled>
    </div>
    <div class="form-group col-md-6">
        <label>Amount in NGN</label>
        <input type="text" name="amount-ngn" id="amount_ngn" value="{{ $trade->coin_amount_ngn }}" class="form-control" disabled>
    </div>
    <div class="form-group col-md-6">
        <label>Account Number</label>
        <input type="text" name="accountNumber" value="{{ \App\BankAccount::where('user_id', $trade->seller_id)->first()->account_number }}" class="form-control" disabled>
    </div>
    <div class="form-group col-md-12">
        <label>Bank Name</label>
        <input type="text" name="bankName" value="{{ \App\BankAccount::where('user_id', $trade->seller_id)->first()->bank_name }}" class="form-control" disabled>
    </div>
    <div class="mx-auto">
        <button type="button" data-toggle="modal" data-target="#cancelModal" class="btn px-4 m-2 btn-danger">Cancel Trade</button>
        <button id="step-2-nav" class="btn m-2 btn-special px-5">Proceed</button>
    </div>
</form>
